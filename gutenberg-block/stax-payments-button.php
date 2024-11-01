<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_enqueue_scripts', function() {

} );

add_action( 'init', function(){
  wp_register_script(
    'stax-payments-button-block-js',
    STAX_URL . '/gutenberg-block/dist/block.js',
    ['wp-element', 'wp-i18n', 'wp-blocks'],
    '',
    null,
    true
  );

  wp_register_style(
    'stax-payments-button-block-public-css',
    STAX_URL . 'assets/button.css',
    [],
    null
  );

  register_block_type('stax-payments/button', [
    'editor_script' => 'stax-payments-button-block-js',
    'editor_style'  => 'stax-payments-button-block-public-css',
    'style'         => 'stax-payments-button-block-public-css',
    'icon'          => STAX_URL . 'assets/tiny-mce-button.png',
  ]);

  // Use our shortcode instead of the gutenberg markup
  // (because we want access to updated wp_options)
  add_filter('render_block', function ($block_content, $block) {
    if (function_exists('get_current_screen')) return;

    if ('stax-payments/button' === $block['blockName']) {
      $block_content = '<p>' . do_shortcode('[stax_button]') . '</p>';
    }

    return $block_content;
  }, 10, 2);

} );
