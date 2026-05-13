<?php

namespace BrighterElements\FormActions;

class CptSubmissionAction extends \Breakdance\Forms\Actions\Action {

    public static function name(): string {
        return 'Submit to Post';
    }

    public static function slug(): string {
        return 'brighter_cpt_submission';
    }

    public static function run($form, $settings, $extra): array {
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

        $submitted = self::extractFieldValues($form, $extra);

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
            $post_data[$wp_field] = ($wp_field === 'post_content')
                ? wp_kses_post($value)
                : sanitize_text_field($value);
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

            $value = $submitted[$form_field];

            if ($is_acf && function_exists('update_field')) {
                update_field($meta_key, $value, $post_id);
            } else {
                update_post_meta($post_id, sanitize_text_field($meta_key), $value);
            }
        }

        return ['type' => 'success', 'message' => 'Post created successfully (ID: ' . $post_id . ')'];
    }

    private static function extractFieldValues($form, $extra): array {
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
