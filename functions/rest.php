<?php
 if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Create REST Endpoints
 *
 * Creates the various endpoints necessary to fetch sector and summary data from
 * wordpress, as well as reports data from the reports API (via forwarding the
 * request -- the dynamic '/reports/<slug>' endpoint is a 1:1 handoff to the
 * matching endpoint on the reports API server)
 *
 * @todo add reports endpoints as they become available
 */
add_action('rest_api_init', function (): void {
  register_rest_route('stax', '/settings', [
    'methods' => 'POST',
    'callback' => function (WP_REST_Request $request) {
      try {
        $data = json_decode( $request->get_body(), true );

        $clean_data = array(
          'text'              => sanitize_text_field( $data['text'] ),
          'includeLogo'       => rest_sanitize_boolean( $data['includeLogo'] ),
          'inheritFonts'      => rest_sanitize_boolean( $data['inheritFonts'] ),
          'colors'            => sanitize_text_field( $data['colors'] ),
          'bgColorCustom'     => sanitize_hex_color( $data['bgColorCustom'] ),
          'textColorCustom'   => sanitize_hex_color( $data['textColorCustom'] ),
          'borderColorCustom' => sanitize_hex_color( $data['borderColorCustom'] ),
        );

        update_option('stax_payment_btn_options', $clean_data, false);

        return ["success" => true];
      } catch (\Throwable $th) {
        return ["error" => $th];
      }
    },
    'permission_callback' => function () {
      return current_user_can('manage_options');
    }
  ]);
});
