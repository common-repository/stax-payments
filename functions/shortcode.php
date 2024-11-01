<?php
 if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register shortcode
 */
add_shortcode( 'stax_button', function ( $attrs ) {
  $options       = stax_get_button_options();
  $logo          = $options['includeLogo'] ? stax_get_icon( 'logo-small' ) : '';
  $text          = isset( $attrs['text'] ) ? $attrs['text'] : $options['text'];
  $color_class   = $options['colors'];
  $bg_custom     = $options['bgColorCustom'];
  $text_custom   = $options['textColorCustom'];
  $border_custom = $options['borderColorCustom'];
  ob_start();
  ?>
  <button
    class="stax-payments-button <?php echo esc_attr( $color_class ); ?>"
    style="--bg-custom:<?php echo esc_attr( $bg_custom ); ?>; --text-custom:<?php echo esc_attr( $text_custom ); ?>; --border-custom:<?php echo esc_attr( $border_custom ); ?>;"
  >
    <?php if ( $logo ) : ?>
      <span class='stax-payments-button__logo-wrap'><?php echo stax_sanitize_svg( stax_get_icon( 'logo-small' ) ); ?></span>
    <?php endif; ?>
    <span class="stax-payments-button__text"><?php echo esc_html( $text ); ?></span>
  </button>
  <?php
  return ob_get_clean();
} );

/**
 * Add button to Classic Editor (TinyMCE)
 */
add_action(
	'admin_head',
	function() {
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
      add_filter( 'mce_external_plugins', 'stax_mce_button_js' );
      add_filter( 'mce_buttons', 'stax_add_mce_button' );
    }
	}
);

function stax_mce_button_js( $plugin_array ) {
  $plugin_array['jumbo_btn'] = STAX_URL . 'assets/tiny-mce-button.js';
	return $plugin_array;
}

function stax_add_mce_button( $buttons ) {
	array_push( $buttons, 'stax_mce_button_key' );
	return $buttons;
}
