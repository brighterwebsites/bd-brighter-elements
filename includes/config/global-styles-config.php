<?php

/**
 * Global Styles Configuration
 *
 * Define your site's CSS design tokens (variables) and the selectors you want
 * pre-seeded in Breakdance's Selectors panel here.
 *
 * Tokens become CSS custom properties on :root, e.g.:
 *   var(--spacing-sm)   → 10px
 *   var(--color-brand)  → #1a73e8
 *
 * Seeded selectors will:
 *   1. Appear in Breakdance's Selectors panel (so you can pick them up easily).
 *   2. Have an empty CSS rule output on every page, preventing the
 *      "class is assigned but no longer present" ghost warning.
 */

namespace BreakdanceCustomElements;

// ─────────────────────────────────────────────────────────────────────────────
// SPACING TOKENS
// These follow a T-shirt size convention.  Adjust the values to match your
// design system.
// ─────────────────────────────────────────────────────────────────────────────
GlobalStyles::tokenGroup('spacing', [
    'xs'  => '4px',
    'sm'  => '8px',
    'md'  => '16px',
    'lg'  => '32px',
    'xl'  => '64px',
    'xxl' => '96px',
]);

// ─────────────────────────────────────────────────────────────────────────────
// TYPOGRAPHY TOKENS
// ─────────────────────────────────────────────────────────────────────────────
GlobalStyles::tokenGroup('font-size', [
    'xs'   => '0.75rem',   // 12px
    'sm'   => '0.875rem',  // 14px
    'base' => '1rem',      // 16px
    'lg'   => '1.125rem',  // 18px
    'xl'   => '1.25rem',   // 20px
    '2xl'  => '1.5rem',    // 24px
    '3xl'  => '1.875rem',  // 30px
    '4xl'  => '2.25rem',   // 36px
]);

GlobalStyles::tokenGroup('line-height', [
    'tight'  => '1.25',
    'normal' => '1.5',
    'loose'  => '1.75',
]);

// ─────────────────────────────────────────────────────────────────────────────
// COLOUR TOKENS
// Rename / add brand colours to match your palette.
// ─────────────────────────────────────────────────────────────────────────────
GlobalStyles::tokenGroup('color', [
    'brand'       => '#1a73e8',
    'brand-dark'  => '#1558b0',
    'brand-light' => '#e8f0fe',
    'text'        => '#202124',
    'text-muted'  => '#5f6368',
    'surface'     => '#ffffff',
    'border'      => '#dadce0',
]);

// ─────────────────────────────────────────────────────────────────────────────
// BORDER RADIUS TOKENS
// ─────────────────────────────────────────────────────────────────────────────
GlobalStyles::tokenGroup('radius', [
    'sm'   => '4px',
    'md'   => '8px',
    'lg'   => '16px',
    'pill' => '9999px',
]);

// ─────────────────────────────────────────────────────────────────────────────
// SHADOW TOKENS
// ─────────────────────────────────────────────────────────────────────────────
GlobalStyles::tokenGroup('shadow', [
    'sm' => '0 1px 3px rgba(0,0,0,.12)',
    'md' => '0 4px 12px rgba(0,0,0,.15)',
    'lg' => '0 8px 30px rgba(0,0,0,.18)',
]);

// ─────────────────────────────────────────────────────────────────────────────
// PRE-SEEDED SELECTORS
//
// Add every class / ID / compound selector you want available in Breakdance's
// Selectors panel.  They will be output as empty rules (.foo {}) to prevent
// ghosting.  You only need to list selectors you will actually use; Breakdance
// automatically tracks selectors that appear in its own element CSS.
// ─────────────────────────────────────────────────────────────────────────────
GlobalStyles::seedSelector([
    // Example site-section identifiers
    '.ga-hrcy-atif',
    '.ga-hrcy-phs',
    '.ga-hrcy-tac',
    '.ga-hrcy-pricing',
    '.ga-hrcy-auth',
    '.ga-hrcy-method',
    '.ga-hrcy-assist',
    '.ga-hrcy-mid',
    '.ga-hrcy-end',
    '.ga-cta-meeting',
    '.ga-hrcy-specs',
    '.ga-form',
    '.ga-hrcy-ppd',
    '.ga-download-lm',
    '.ga-trust-badge',

    // Add your own selectors below:
    // '.my-section',
    // '#hero-block',
]);
