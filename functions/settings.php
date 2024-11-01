<?php
 if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get Options
 */
function stax_get_button_options(): array
{
	return get_option(
		'stax_payment_btn_options',
		array(
			'text'              => esc_html__( 'Pay Now', 'stax-payments' ),
			'includeLogo'       => true,
			'inheritFonts'      => true,
			'colors'            => 'dark',
			'bgColorCustom'     => '#ffffff',
			'textColorCustom'   => '#333333',
			'borderColorCustom' => '#333333',
		)
	);
}

/**
 * Add admin page
 */
function stax_add_settings_page(): void
{
	add_submenu_page( 'options-general.php', esc_html__( 'Stax Payments', 'stax-payments' ), esc_html__( 'Stax Payments', 'stax-payments' ), 'manage_options', 'stax-payments-settings', 'stax_admin_render' );
}

/**
 * Render admin page
 */
function stax_admin_render(): void
{
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }

  $updated = false;

  // Form handler.
  if ( isset( $_POST['web-payment-token'] ) ) {
    if ( ! isset( $_POST['stax_settings_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['stax_settings_nonce'] ) ), 'save_stax_settings' ) ) {
      wp_die( 'Invalid nonce' );
    } else {
      if ( $_POST['web-payment-token'] || $_POST['web-payment-token'] === "" ) {
        $updated   = true;
        $first_set = ( isset( $_POST['first-set'] ) && 1 === absint( $_POST['first-set'] ) ) ? 1 : 0;
        $token     = sanitize_text_field( $_POST['web-payment-token'] );
        update_option( "stax_token", $token, false );
      }
    }
  }

  $token = get_option("stax_token", "");

  $first_set_status = $token ? '0' : '1';
  ?>

  <div id="poststuff" style="padding-right: 30px">

    <div class="postbox stax-banner">
      <?php echo stax_sanitize_svg( stax_get_icon( 'banner' ) ); ?>
    </div>

    <div class="postbox stax-token-form-box">
      <div class="postbox-header">
        <h2>Stax Account</h2>
      </div>
      <div style="padding: 16px">
        <p>Login to your Stax account to retrieve your Web Payments Token and enter it below to start accepting payments.</p>
        <div class="stax-token-form-layout">
          <strong>Web Payments Token</strong>
          <form action="#" method="POST">
            <input type="text" name="web-payment-token" placeholder="Enter your Web Payments Token" value="<?php echo esc_attr( $token ); ?>">
            <a href="#TB_inline?width=600&height=400&inlineId=stax-help-modal" class="thickbox">How do I find this?</a>
            <input type="hidden" name="first-set" value="<?php echo esc_attr( $first_set_status ); ?>">
            <?php wp_nonce_field( 'save_stax_settings', 'stax_settings_nonce' ); ?>
            <button type="submit" class="button button-primary">Update Token</button>
          </form>

          <!-- Help modal -->
          <div id="stax-help-modal" class="stax-help-modal" style="display:none;">
            <h1>Web Payments Token Instructions</h1>
            <ol>
              <li>
                Login to your Stax account and click on <strong>"Apps"</strong>, then <strong>"Website Payments"</strong>, then <strong>"Launch"</strong>, or just follow the link below:
                <br>
                <a href="https://app.staxpayments.com/#/apps/webpayments" alt="Get your Web Payments Token from Stax Application" target="_blank">https://app.staxpayments.com/#/apps/webpayments</a>
              </li>
              <li>
                Scroll to the bottom of the page to find your "Web Payments Token", and enter it on the plugin settings screen.
              </li>
              <li>
                You must enter your token <strong>exactly</strong> in order to successfully accept payments (we recommend using copy and paste).
              </li>
              <li>
                You may now place the payment button on your site using a Gutenberg block or a shortcode!
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <?php if ($updated) : ?>

      <div id="message" class="updated notice notice-success" style="margin: 40px 0">
        <p>
          <strong>Success. </strong>
          Your token has been <?php echo $first_set ? "added. You may now configure how your payment button appears below." : "updated." ?>
        </p>
      </div>

    <?php endif; ?>

    <?php if ($token) : ?>

      <div class="postbox">
        <div class="postbox-header">
          <h2>Display Options</h2>
        </div>
        <div id="app"></div>
      </div>

      <div class="postbox">
        <div class="postbox-header">
          <h2>How to Use</h2>
        </div>
        <div style="padding: 16px">
          <p>You have 2 different ways you can add the payment button above to your site.</p>
          <ol>
            <li>
              <strong>With a Gutenberg Block</strong>
              <br>
              <span>In the block editor, click the "+" button and search for "Stax" to find the payment button block.</span>
            </li>
            <li>
              <strong>Using a Shortcode</strong>
              <br>
              <span>
                In the classic editor, you may use the following shortcode to place your button. Simply update "Pay Now" with the text you want to use.
                <code>[stax_button text="Pay Now"]</code>
                Alternatively, look for the Stax button in the classic editor toolbar
                <span class="stax-logo-mini">
                  <?php echo stax_sanitize_svg( stax_get_icon( 'logo-small' ) ); ?>
                </span>
                which can generate the shortcode for you.
              </span>
            </li>
          </ol>
        </div>
      </div>

    <?php endif; ?>

  </div><!-- #poststuff -->

<?php
}

/**
 * Setup default button options
 */
$options = get_option( 'stax_payment_btn_options' );

if ( ! $options ) {
	add_option(
		'stax_payment_btn_options',
		array(
			'text'              => esc_html__( 'Pay Now', 'stax-payments' ),
			'includeLogo'       => true,
			'inheritFonts'      => true,
			'colors'            => 'dark',
			'bgColorCustom'     => '#ffffff',
			'textColorCustom'   => '#333333',
			'borderColorCustom' => '#333333',
		)
	);
}
