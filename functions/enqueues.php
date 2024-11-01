<?php
 if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Admin
 */
function stax_admin_assets()
{
  add_thickbox();

  wp_localize_script('jquery', 'STAX', [
    'options'    => stax_get_button_options(),
    'plugin_url' => STAX_URL,
    'wp_nonce'   => wp_create_nonce('wp_rest'),
  ]);

  if (get_current_screen()->id !== "settings_page_stax-payments-settings") return;


  // live preview widget
  wp_enqueue_script('stax-preview', STAX_URL . stax_get_asset_by_glob_path(STAX_PATH . 'live-preview-widget/dist/assets/index.*.js'), [], false, true);
  wp_enqueue_style('stax-preview-styles', STAX_URL . stax_get_asset_by_glob_path(STAX_PATH . 'live-preview-widget/dist/assets/index.*.css'), [], false);

  // global button style
  wp_enqueue_style('stax-button-styles', STAX_URL . 'assets/button.css', [], STAX_ASSET_VERSION);

  // settings styles
  wp_enqueue_style('stax-settings-styles', STAX_URL . 'assets/settings.css', [], STAX_ASSET_VERSION);
}

add_action('admin_enqueue_scripts', 'stax_admin_assets');

function stax_get_asset_by_glob_path( $glob )
{
  $file_detail = glob( $glob );
  $file_path   = reset( $file_detail );
  $exploded    = explode( STAX_BASE_NAME, $file_path );
  $file_clean  = end( $exploded );

  return trim( $file_clean, '/' );
}

function stax_frontend_enqueues()
{
  wp_enqueue_style('stax-button-style', STAX_URL . 'assets/button.css', [], STAX_ASSET_VERSION);
  wp_enqueue_script('stax-lightbox-handler', STAX_URL . 'assets/handler.js', [], STAX_ASSET_VERSION, true);

  $token = get_option("stax_token", "");

  if ( ! empty( $token ) ) {
    wp_enqueue_script('stax-checkout', 'https://checkout.staxpayments.com/v1/checkout.min.js', [], STAX_ASSET_VERSION, true);
  }
}

add_action('wp_enqueue_scripts', 'stax_frontend_enqueues');

function stax_customize_attribute_script_tag( $tag, $handle, $src )
{
  if ( 'stax-checkout' === $handle ) {
    $token = get_option("stax_token", "");

    if ( ! empty( $token ) ) {
      $tag = '<script type="text/javascript" src="' . esc_url( $src ) . '" id="stax_checkout_script" data-webpaymentstoken="' . esc_attr( $token ) . '" data-button="stax-payments-button" data-mode="payment" data-displayConfirmation="true"></script>';
    }
  }

  return $tag;
}

add_filter( 'script_loader_tag', 'stax_customize_attribute_script_tag', 10, 3 );
