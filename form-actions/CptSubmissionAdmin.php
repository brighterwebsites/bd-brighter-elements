<?php

namespace BrighterElements\FormActions;

class CptSubmissionAdmin {

    const OPTION_KEY   = 'brighter_cpt_submission_configs';
    const NONCE_SAVE   = 'brighter_cpt_submission_save';
    const NONCE_DELETE = 'brighter_cpt_submission_delete';
    const MENU_SLUG    = 'brighter-cpt-submissions';

    public function init(): void {
        add_action('admin_menu', [$this, 'addMenuPage']);
        add_action('admin_post_brighter_cpt_submission_save',   [$this, 'handleSave']);
        add_action('admin_post_brighter_cpt_submission_delete', [$this, 'handleDelete']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueAssets']);
    }

    public function addMenuPage(): void {
        add_options_page(
            'CPT Form Submissions',
            'CPT Form Submissions',
            'manage_options',
            self::MENU_SLUG,
            [$this, 'renderPage']
        );
    }

    public function enqueueAssets(string $hook): void {
        if ($hook !== 'settings_page_' . self::MENU_SLUG) {
            return;
        }
        wp_enqueue_style(
            'brighter-cpt-admin',
            plugin_dir_url(__FILE__) . 'assets/admin.css',
            [],
            '1.0.0'
        );
        wp_enqueue_script(
            'brighter-cpt-admin',
            plugin_dir_url(__FILE__) . 'assets/admin.js',
            [],
            '1.0.0',
            true
        );
    }

    public function handleSave(): void {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        check_admin_referer(self::NONCE_SAVE);

        $form_id     = sanitize_text_field($_POST['form_id'] ?? '');
        $old_form_id = sanitize_text_field($_POST['old_form_id'] ?? '');
        $label       = sanitize_text_field($_POST['config_label'] ?? '');
        $post_type   = sanitize_key($_POST['post_type'] ?? '');

        if (empty($form_id) || empty($post_type)) {
            wp_redirect(add_query_arg(['page' => self::MENU_SLUG, 'error' => 'missing_fields'], admin_url('options-general.php')));
            exit;
        }

        $configs = get_option(self::OPTION_KEY, []);

        if ($old_form_id && $old_form_id !== $form_id) {
            unset($configs[$old_form_id]);
        }

        $field_map = [];
        foreach (['post_title', 'post_content', 'post_excerpt', 'post_status'] as $wp_field) {
            $val = sanitize_text_field($_POST['field_map'][$wp_field] ?? '');
            if (!empty($val)) {
                $field_map[$wp_field] = $val;
            }
        }

        $meta_map = [];
        foreach ($_POST['meta_map'] ?? [] as $row) {
            $ff = sanitize_text_field($row['form_field'] ?? '');
            $mk = sanitize_text_field($row['meta_key'] ?? '');
            if (empty($ff) || empty($mk)) {
                continue;
            }
            $meta_map[] = [
                'form_field' => $ff,
                'meta_key'   => $mk,
                'is_acf'     => !empty($row['is_acf']),
            ];
        }

        $configs[$form_id] = [
            'label'     => $label,
            'post_type' => $post_type,
            'field_map' => $field_map,
            'meta_map'  => $meta_map,
        ];

        update_option(self::OPTION_KEY, $configs);

        wp_redirect(add_query_arg(['page' => self::MENU_SLUG, 'saved' => '1'], admin_url('options-general.php')));
        exit;
    }

    public function handleDelete(): void {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        check_admin_referer(self::NONCE_DELETE);

        $form_id = sanitize_text_field($_GET['form_id'] ?? '');
        if ($form_id) {
            $configs = get_option(self::OPTION_KEY, []);
            unset($configs[$form_id]);
            update_option(self::OPTION_KEY, $configs);
        }

        wp_redirect(add_query_arg(['page' => self::MENU_SLUG, 'deleted' => '1'], admin_url('options-general.php')));
        exit;
    }

    public function renderPage(): void {
        if (!current_user_can('manage_options')) {
            return;
        }

        $configs    = get_option(self::OPTION_KEY, []);
        $post_types = $this->getRegisteredPostTypes();
        $edit_id    = sanitize_text_field($_GET['edit'] ?? '');
        $edit_cfg   = ($edit_id && isset($configs[$edit_id])) ? $configs[$edit_id] : null;
        ?>
        <div class="wrap brighter-cpt-admin">
            <h1>CPT Form Submissions</h1>
            <p>Map Breakdance form submissions to custom post type entries. Find your form's ID by inspecting the form element in your browser and looking for the <code>data-id</code> attribute, or check the Breakdance builder's element settings.</p>

            <?php if (!empty($_GET['saved'])): ?>
                <div class="notice notice-success is-dismissible"><p>Configuration saved.</p></div>
            <?php elseif (!empty($_GET['deleted'])): ?>
                <div class="notice notice-success is-dismissible"><p>Configuration deleted.</p></div>
            <?php elseif (!empty($_GET['error'])): ?>
                <div class="notice notice-error is-dismissible"><p>Form ID and Post Type are required fields.</p></div>
            <?php endif; ?>

            <div class="brighter-cpt-layout">

                <div class="brighter-cpt-form-wrap">
                    <h2><?php echo $edit_id ? 'Edit Configuration' : 'Add Configuration'; ?></h2>

                    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <input type="hidden" name="action"      value="brighter_cpt_submission_save">
                        <input type="hidden" name="old_form_id" value="<?php echo esc_attr($edit_id); ?>">
                        <?php wp_nonce_field(self::NONCE_SAVE); ?>

                        <table class="form-table">
                            <tr>
                                <th><label for="config_label">Label</label></th>
                                <td>
                                    <input type="text" id="config_label" name="config_label"
                                           value="<?php echo esc_attr($edit_cfg['label'] ?? ''); ?>"
                                           class="regular-text" placeholder="e.g. Contact Form → Jobs CPT">
                                    <p class="description">A friendly name to identify this configuration.</p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="form_id">Form ID <span aria-hidden="true">*</span></label></th>
                                <td>
                                    <input type="text" id="form_id" name="form_id"
                                           value="<?php echo esc_attr($edit_id); ?>"
                                           class="regular-text" required placeholder="e.g. abc123xyz">
                                    <p class="description">The Breakdance form's unique ID. Inspect the rendered <code>&lt;form&gt;</code> element and look for <code>data-id="..."</code>.</p>
                                </td>
                            </tr>
                            <tr>
                                <th><label for="post_type">Post Type <span aria-hidden="true">*</span></label></th>
                                <td>
                                    <select id="post_type" name="post_type" required>
                                        <option value="">— Select Post Type —</option>
                                        <?php foreach ($post_types as $slug => $label): ?>
                                            <option value="<?php echo esc_attr($slug); ?>" <?php selected($edit_cfg['post_type'] ?? '', $slug); ?>>
                                                <?php echo esc_html($label . ' (' . $slug . ')'); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </table>

                        <h3>Standard Field Mapping</h3>
                        <p class="description">Enter the form field name (its slug from the Breakdance Form Builder) that should populate each WordPress post field. Leave blank to skip that field.</p>

                        <table class="form-table">
                            <?php
                            $wp_field_labels = [
                                'post_title'   => ['Post Title',   'post_title'],
                                'post_content' => ['Post Content', 'post_content'],
                                'post_excerpt' => ['Post Excerpt', 'post_excerpt'],
                                'post_status'  => ['Post Status',  'post_status'],
                            ];
                            foreach ($wp_field_labels as $wf => [$wf_label, $wf_code]):
                                $current = $edit_cfg['field_map'][$wf] ?? '';
                            ?>
                            <tr>
                                <th>
                                    <label><?php echo esc_html($wf_label); ?></label>
                                    <br><code><?php echo esc_html($wf_code); ?></code>
                                </th>
                                <td>
                                    <input type="text" name="field_map[<?php echo esc_attr($wf); ?>]"
                                           value="<?php echo esc_attr($current); ?>"
                                           class="regular-text" placeholder="form field name">
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>

                        <h3>Meta Field Mapping</h3>
                        <p class="description">Map form fields to post meta keys. Enable <strong>ACF</strong> to use <code>update_field()</code> instead of <code>update_post_meta()</code>.</p>

                        <table class="widefat brighter-meta-table" id="brighter-meta-map">
                            <thead>
                                <tr>
                                    <th>Form Field Name</th>
                                    <th>Meta Key</th>
                                    <th>ACF</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="brighter-meta-rows">
                                <?php
                                $meta_rows = $edit_cfg['meta_map'] ?? [['form_field' => '', 'meta_key' => '', 'is_acf' => false]];
                                foreach ($meta_rows as $i => $row):
                                ?>
                                <tr class="brighter-meta-row">
                                    <td>
                                        <input type="text" name="meta_map[<?php echo $i; ?>][form_field]"
                                               value="<?php echo esc_attr($row['form_field']); ?>"
                                               class="regular-text" placeholder="form_field_name">
                                    </td>
                                    <td>
                                        <input type="text" name="meta_map[<?php echo $i; ?>][meta_key]"
                                               value="<?php echo esc_attr($row['meta_key']); ?>"
                                               class="regular-text" placeholder="_meta_key or acf_field_name">
                                    </td>
                                    <td style="text-align:center; vertical-align:middle;">
                                        <input type="checkbox" name="meta_map[<?php echo $i; ?>][is_acf]"
                                               value="1" <?php checked(!empty($row['is_acf'])); ?>>
                                    </td>
                                    <td>
                                        <button type="button" class="button brighter-remove-row">Remove</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <p style="margin-top:8px;">
                            <button type="button" class="button" id="brighter-add-meta-row">+ Add Row</button>
                        </p>

                        <p class="submit">
                            <input type="submit" class="button button-primary"
                                   value="<?php echo $edit_id ? 'Update Configuration' : 'Save Configuration'; ?>">
                            <?php if ($edit_id): ?>
                                <a href="<?php echo esc_url(add_query_arg(['page' => self::MENU_SLUG], admin_url('options-general.php'))); ?>"
                                   class="button">Cancel</a>
                            <?php endif; ?>
                        </p>
                    </form>
                </div>

                <?php if (!empty($configs)): ?>
                <div class="brighter-cpt-list">
                    <h2>Saved Configurations</h2>
                    <table class="widefat">
                        <thead>
                            <tr>
                                <th>Label</th>
                                <th>Form ID</th>
                                <th>Post Type</th>
                                <th>Fields Mapped</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($configs as $fid => $cfg): ?>
                            <tr>
                                <td><?php echo esc_html($cfg['label'] ?: '—'); ?></td>
                                <td><code><?php echo esc_html($fid); ?></code></td>
                                <td><code><?php echo esc_html($cfg['post_type']); ?></code></td>
                                <td>
                                    <?php
                                    $count = count(array_filter($cfg['field_map'] ?? [])) + count($cfg['meta_map'] ?? []);
                                    echo esc_html($count . ' field' . ($count !== 1 ? 's' : ''));
                                    ?>
                                </td>
                                <td>
                                    <a href="<?php echo esc_url(add_query_arg(['page' => self::MENU_SLUG, 'edit' => $fid], admin_url('options-general.php'))); ?>"
                                       class="button button-small">Edit</a>
                                    <a href="<?php echo esc_url(
                                        wp_nonce_url(
                                            add_query_arg(
                                                ['action' => 'brighter_cpt_submission_delete', 'form_id' => $fid],
                                                admin_url('admin-post.php')
                                            ),
                                            self::NONCE_DELETE
                                        )
                                    ); ?>"
                                       class="button button-small"
                                       style="color:#b32d2e;"
                                       onclick="return confirm('Delete this configuration?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

            </div>
        </div>
        <?php
    }

    private function getRegisteredPostTypes(): array {
        $post_types = get_post_types(['public' => true], 'objects');
        $result     = [];
        foreach ($post_types as $pt) {
            $result[$pt->name] = $pt->labels->singular_name ?? $pt->name;
        }
        return $result;
    }
}
