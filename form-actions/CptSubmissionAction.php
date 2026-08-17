<?php

namespace BrighterElements\FormActions;

class CptSubmissionAction extends \Breakdance\Forms\Actions\Action {

    public static function name(): string {
        return 'Submit to Post';
    }

    public static function slug(): string {
        return 'brighter_cpt_submission';
    }

    public function run($form, $settings, $extra): array {
        $form_id = $extra['formId'] ?? '';

        if (empty($form_id)) {
            return ['type' => 'error', 'message' => 'CPT Submission: Form ID not available.'];
        }

        $configs = get_option('brighter_cpt_submission_configs', []);
        $config  = $configs[$form_id] ?? null;

        if (!$config || empty($config['post_type'])) {
            return [
                'type'    => 'error',
                'message' => 'CPT Submission: No configuration found for form "' . esc_html($form_id) . '". Configure it under Settings > CPT Form Submissions.',
            ];
        }

        $submitted = $this->extractFieldValues($form, $extra);

        $post_data = [
            'post_type'   => sanitize_key($config['post_type']),
            'post_status' => 'publish',
        ];

        // Standard WP field mappings
        foreach (['post_title', 'post_content', 'post_excerpt', 'post_status'] as $wp_field) {
            $form_field = $config['field_map'][$wp_field] ?? '';
            if (empty($form_field) || !array_key_exists($form_field, $submitted)) {
                continue;
            }
            $value = $submitted[$form_field];

            // post_status reaches wp_insert_post from an unauthenticated submitter
            // whenever an admin maps it. Constrain it to a known-safe set rather
            // than passing an arbitrary string through.
            if ($wp_field === 'post_status') {
                $status = is_scalar($value) ? sanitize_key((string) $value) : '';
                $post_data[$wp_field] = in_array($status, ['publish', 'draft', 'pending', 'private'], true)
                    ? $status
                    : 'draft';
                continue;
            }

            $scalar = is_scalar($value) ? (string) $value : '';
            $post_data[$wp_field] = ($wp_field === 'post_content')
                ? wp_kses_post($scalar)
                : sanitize_text_field($scalar);
        }

        $post_id = wp_insert_post($post_data, true);

        if (is_wp_error($post_id)) {
            return ['type' => 'error', 'message' => 'CPT Submission: Failed to create post — ' . $post_id->get_error_message()];
        }

        // Meta mappings
        foreach ($config['meta_map'] ?? [] as $mapping) {
            $form_field = $mapping['form_field'] ?? '';
            $meta_key   = $mapping['meta_key'] ?? '';
            $is_acf     = !empty($mapping['is_acf']);

            if (empty($form_field) || empty($meta_key) || !array_key_exists($form_field, $submitted)) {
                continue;
            }

            // Submitted values are unauthenticated input. They were previously
            // written to post meta verbatim, leaving any escaping entirely to
            // whatever theme or template later renders them.
            $value    = $this->sanitizeValue($submitted[$form_field]);
            $meta_key = sanitize_text_field($meta_key);

            if ($is_acf && function_exists('update_field')) {
                update_field($meta_key, $value, $post_id);
            } else {
                update_post_meta($post_id, $meta_key, $value);
            }
        }

        return ['type' => 'success', 'message' => 'Post created successfully (ID: ' . $post_id . ')'];
    }

    /**
     * Sanitise a submitted value before it is stored as post meta.
     *
     * Strings go through wp_kses_post — the same filter this action already
     * applies to post_content — so ordinary formatting survives while script
     * tags and event-handler attributes do not. Arrays are walked recursively
     * with a depth cap, since a crafted submission can nest arbitrarily.
     *
     * @param mixed $value
     * @return mixed
     */
    private function sanitizeValue($value, int $depth = 0) {
        if (is_array($value)) {
            if ($depth >= 8) {
                return [];
            }
            $clean = [];
            foreach ($value as $key => $item) {
                $clean_key = is_string($key) ? sanitize_text_field($key) : $key;
                $clean[$clean_key] = $this->sanitizeValue($item, $depth + 1);
            }
            return $clean;
        }

        if (is_bool($value) || is_int($value) || is_float($value) || $value === null) {
            return $value;
        }

        if (is_scalar($value)) {
            return wp_kses_post((string) $value);
        }

        // Objects and resources are not expected from a form submission.
        return '';
    }

    private function extractFieldValues($form, $extra): array {
        // $extra['fields'] is typically an array of field objects: [['name' => ..., 'value' => ...], ...]
        if (!empty($extra['fields']) && is_array($extra['fields'])) {
            $values = [];
            foreach ($extra['fields'] as $field) {
                if (is_array($field) && isset($field['name'])) {
                    $values[$field['name']] = $field['value'] ?? '';
                }
            }
            if (!empty($values)) {
                return $values;
            }
            // Flat associative fallback
            if (!isset($extra['fields'][0])) {
                return $extra['fields'];
            }
        }

        // Fallback: field definitions in $form
        if (!empty($form['fields']) && is_array($form['fields'])) {
            $values = [];
            foreach ($form['fields'] as $field) {
                if (isset($field['name'], $field['value'])) {
                    $values[$field['name']] = $field['value'];
                }
            }
            return $values;
        }

        return [];
    }
}
