<?php

/**
 * Plugin Name: Brighter BD Elements
 * Plugin URI: https://breakdance.com/
 * Description: Custom elements created with Element Studio.
 * Author: Breakdance
 * Author URI: https://breakdance.com/
 * License: GPLv2
 * Text Domain: breakdance
 * Domain Path: /languages/
 * Version: 0.0.1
 */

namespace BreakdanceCustomElements;

use function Breakdance\Util\getDirectoryPathRelativeToPluginFolder;

const DECISION_QUIZ_SHORTCODE = 'bd_decision_quiz';

add_action('breakdance_loaded', function () {
    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/elements',
        'BreakdanceCustomElements',
        'element',
        'Custom Elements',
        false
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/macros',
        'BreakdanceCustomElements',
        'macro',
        'Custom Macros',
        false,
    );

    \Breakdance\ElementStudio\registerSaveLocation(
        getDirectoryPathRelativeToPluginFolder(__DIR__) . '/presets',
        'BreakdanceCustomElements',
        'preset',
        'Custom Presets',
        false,
    );
},
    // register elements before loading them
    9
);

add_action('init', function () {
    add_shortcode(DECISION_QUIZ_SHORTCODE, __NAMESPACE__ . '\\render_decision_quiz_shortcode');
});

function render_decision_quiz_shortcode(): string
{
    $css_path = plugin_dir_path(__FILE__) . 'assets/decision-quiz.css';
    $js_path = plugin_dir_path(__FILE__) . 'assets/decision-quiz.js';
    $css_version = file_exists($css_path) ? (string) filemtime($css_path) : '1.0.0';
    $js_version = file_exists($js_path) ? (string) filemtime($js_path) : '1.0.0';
    $plugin_url = plugin_dir_url(__FILE__);

    wp_enqueue_style(
        'bd-decision-quiz',
        $plugin_url . 'assets/decision-quiz.css',
        [],
        $css_version
    );

    wp_enqueue_script(
        'bd-decision-quiz',
        $plugin_url . 'assets/decision-quiz.js',
        [],
        $js_version,
        true
    );

    ob_start();
    ?>
    <section class="bd-decision-quiz" data-bd-decision-quiz>
        <h2 class="bd-decision-quiz__title">Decision Framework</h2>
        <p class="bd-decision-quiz__subtitle">
            If you tick four or more modular boxes, the kit route will likely serve you best. Two or three means a
            hybrid approach (modular bays + custom roof or arena). One or fewer, and you’re squarely in custom build
            territory.
        </p>

        <div class="bd-decision-quiz__table">
            <table>
                <thead>
                <tr>
                    <th>Factor</th>
                    <th>Modular Priority</th>
                    <th>Custom Build Priority</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Timeline</td>
                    <td>2–4 weeks delivery, weekend assembly</td>
                    <td>3–6 months design + construction</td>
                </tr>
                <tr>
                    <td>Budget</td>
                    <td>$4,500–$5,000 per bay; expand as needed</td>
                    <td>30–50% higher upfront investment</td>
                </tr>
                <tr>
                    <td>Site Conditions</td>
                    <td>Flat slab or retrofit-friendly shed</td>
                    <td>Sloped or complex terrain</td>
                </tr>
                <tr>
                    <td>Labour Skill</td>
                    <td>DIY or local crew</td>
                    <td>Licensed builder required</td>
                </tr>
                <tr>
                    <td>Project Scale</td>
                    <td>1–6 bays, staged growth</td>
                    <td>6+ bays or full complex</td>
                </tr>
                <tr>
                    <td>Flexibility</td>
                    <td>Easy to expand or reconfigure</td>
                    <td>Fixed layout for long-term facilities</td>
                </tr>
                </tbody>
            </table>
        </div>

        <form class="bd-decision-quiz__form" data-quiz-form>
            <fieldset class="bd-decision-quiz__fieldset" data-quiz-factor>
                <legend class="bd-decision-quiz__legend">Timeline</legend>
                <div class="bd-decision-quiz__options">
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="timeline" value="modular" data-choice="modular">
                        2–4 weeks delivery, weekend assembly
                    </label>
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="timeline" value="custom" data-choice="custom">
                        3–6 months design + construction
                    </label>
                </div>
            </fieldset>

            <fieldset class="bd-decision-quiz__fieldset" data-quiz-factor>
                <legend class="bd-decision-quiz__legend">Budget</legend>
                <div class="bd-decision-quiz__options">
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="budget" value="modular" data-choice="modular">
                        $4,500–$5,000 per bay; expand as needed
                    </label>
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="budget" value="custom" data-choice="custom">
                        30–50% higher upfront investment
                    </label>
                </div>
            </fieldset>

            <fieldset class="bd-decision-quiz__fieldset" data-quiz-factor>
                <legend class="bd-decision-quiz__legend">Site Conditions</legend>
                <div class="bd-decision-quiz__options">
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="site_conditions" value="modular" data-choice="modular">
                        Flat slab or retrofit-friendly shed
                    </label>
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="site_conditions" value="custom" data-choice="custom">
                        Sloped or complex terrain
                    </label>
                </div>
            </fieldset>

            <fieldset class="bd-decision-quiz__fieldset" data-quiz-factor>
                <legend class="bd-decision-quiz__legend">Labour Skill</legend>
                <div class="bd-decision-quiz__options">
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="labour_skill" value="modular" data-choice="modular">
                        DIY or local crew
                    </label>
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="labour_skill" value="custom" data-choice="custom">
                        Licensed builder required
                    </label>
                </div>
            </fieldset>

            <fieldset class="bd-decision-quiz__fieldset" data-quiz-factor>
                <legend class="bd-decision-quiz__legend">Project Scale</legend>
                <div class="bd-decision-quiz__options">
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="project_scale" value="modular" data-choice="modular">
                        1–6 bays, staged growth
                    </label>
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="project_scale" value="custom" data-choice="custom">
                        6+ bays or full complex
                    </label>
                </div>
            </fieldset>

            <fieldset class="bd-decision-quiz__fieldset" data-quiz-factor>
                <legend class="bd-decision-quiz__legend">Flexibility</legend>
                <div class="bd-decision-quiz__options">
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="flexibility" value="modular" data-choice="modular">
                        Easy to expand or reconfigure
                    </label>
                    <label class="bd-decision-quiz__option">
                        <input type="radio" name="flexibility" value="custom" data-choice="custom">
                        Fixed layout for long-term facilities
                    </label>
                </div>
            </fieldset>
        </form>

        <div class="bd-decision-quiz__actions">
            <button class="bd-decision-quiz__submit" type="button" data-quiz-submit>See recommendation</button>
            <button class="bd-decision-quiz__reset" type="button" data-quiz-reset>Reset</button>
        </div>
        <p class="bd-decision-quiz__error" data-quiz-error hidden></p>

        <div class="bd-decision-quiz__result" data-quiz-result hidden>
            <h3 data-quiz-result-title></h3>
            <p data-quiz-result-body></p>
        </div>

        <p class="bd-decision-quiz__note">
            Whatever you choose, prioritise safety and welfare standards — like minimum 3.6 × 3.6 m bays, 2.4 m
            height, and strong airflow — across all designs.
        </p>
    </section>
    <?php

    return (string) ob_get_clean();
}
