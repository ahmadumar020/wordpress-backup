<?php
/**
 * Document history
 * [REQ2020_0002 - Fix error child theme couldn't get info style.css]
 *    + 24/07/2020: <Modified by Kenny Nguyen> Update function wp_schools_enqueue_scripts to get child stylesheet
 * [REQ2020_0004 - Single Checkout]
 *    + 11/08/2020: <Added by Duke Ho> Implement Sign checkout
 * [REQ2020_0006 - Item Checkout]
 *    + 14/08/2020: <Added by Duke Ho> Change Woocommerce default add-to-cart message and Get custom add-to-cart message
 *
 * 15/09/2020 - <Added by Kenny Nguyen>: add meta noindex to header for preventing Search Engine
 * 16/11/2020 - <Added by Duke Ho>: Change loading icon's style
 *
 * [REQ2020_0010 - Restriction Rule]
 *    + 12/25/2020: <Added by Duke Ho> Insert user subscription info to db invedev2_user_subscription_info
 *    + 12/28/2020: <Added by Duke Ho> Set Token
 *
 * <Added by Vinod>:
 *    - Display an 'Out of Stock' label on archive / shop pages
 *    - Replace out of stock with coming soon on product page
 *    - Replace error message if user already has purchased same plan
 *
 * 10/03/2021 - <Added by Duke Ho>: Create a url to attach coupon code
 * 13/03/2021 - <Added by Duke Ho>: Create custom message for order details table - Checkout page
 * 14/03/2021 - <Added by Duke Ho>: Create custom message for adding coupon successfully - Checkout page
 * 15/03/2021 - <Added by Duke Ho>: Validate Edit Account Form, Validate Billing Address Form
 * 03/05/2021 - <Added by Duke Ho>: Add hotjar to header
 *
 * 03/05/2021 - <Added by Duke Ho>:
 *    - Add PHPDoc for functions
 *    - Remove unused code
 *
 * [INVESTIFY-89]
 * 17/05/2021 - <Added by Duke Ho>:
 *    - Add function woocommerce_banhammer_validation & mydomain_plugin_checks to validate email domain using Ban Hammer
 *    plugin
 *
 * [INVESTIFY-27]
 * 28/05/2021 - <Added by Duke Ho>:
 *    - Add function register_custom_api to register custom rest api for AI commentary
 *
 * [INVESTIFY-98]
 * 09/06/2021 - <Added by Duke Ho>:
 *    - Register custom rest api for user's subscription info
 * 12/07/2021 - <Added by Duke Ho>:
 *    - Delete function register_subscription_info_api
 *    - Rename function insert_user_subscription_info to create_user_subscription_info
 *    - Fix issue when delete stock viewed after renewing/buying subscription
 *
 * [INVESTIFY-96]
 * 02/07/2021 - <Added by Duke Ho>:
 *    - Cancel previous active subscription after purchasing new subscription
 * 05/07/2021 - <Added by Duke Ho>:
 *    - Delete old stocks viewed after purchasing or renewing new subscription
 *    - Delete user subscription info when deleting a user
 *
 * [INVESTIFY-130]
 * 12/07/2021 - <Added by Duke Ho>:
 *    - Add function create_user_watchlist to insert user watchlist to db
 *    - Add function delete_watchlist to user watchlist from db
 *
 * [INVESTIFY-138]
 * 19/07/2021 - <Added by Duke Ho>:
 *    - Add function create_user_portfolio to insert user portfolio to db
 *    - Add function delete_portfolio to user portfolio from db
 * 26/07/2021 - <Added by Duke Ho>:
 *    - Remove function create_user_portfolio
 *
 * [INVESTIFY-139]
 * 23/08/2021 - <Added by Duke Ho>:
 *    - Remove function add_registration_privacy_policy, bbloomer_validate_privacy_registration
 *    - Remove password validation
 *    - Make email field, privacy checkbox required
 *    - Change style for privacy checkbox
 * 26/08/2021 - <Added by Duke Ho>:
 *    - Remove current password validation for edit account page
 * 17/09/2021 - <Modified by Duke Ho>:
 *    - Remove display name validation for edit account page
 * 22/09/2021 - <Modified by Duke Ho>:
 *    - Change name regex to accept "-"
 *
 * [INVESTIFY-152]
 * 27/08/2021 - <Added by Duke Ho>:
 *    - Add function add_google_tag_manager to add google tag manager tracking code
 *
 * [INVESTIFY-150]
 * 07/09/2021 - <Added by Duke Ho>:
 *    - Add function change_renewal_method_before_confirmation_msg
 *
 * [INVESTIFY-154]
 * 08/09/2021 - <Added by Duke Ho>:
 *    - Change the message when applying coupon successfully
 *
 * [INVESTIFY-161]
 * 17/09/2021 - <Added by Duke Ho>:
 *    - Add function change_subscription_before_confirmation_msg
 *
 * [INVESTIFY-163]
 * 18/09/2021 - <Added by Duke Ho>:
 *    - Add functions: add_registration_referral_code, save_registration_referral_code, edit_account_referral_code,
 *    save_edit_account_referral_code to add & edit referral code when creating & editing account
 *
 * [INVESTIFY-164]
 * 24/09/2021 - <Added by Duke Ho>:
 *    - Add functions change_password_changed_email to change password changed confirmation email content
 * 
 * [INVESTIFY-206]
 * 27/01/2022 - <Added by Duke Ho>:
 *    - Add functions get_dynamic_copyright_year to get dynamic copyright message
 * 
 * 21/04/2022 - <Added by Ahmad Umar>:
 *    - Add functions edit_account_company_code & save_edit_account_company_name to update and save user company name
 */

/**
 * [REQ2020_0002]
 * Function name: register_all_scripts
 * Description: Fix error child theme couldn't get info style.css
 * Created by: Kenny Nguyen
 * Created date: N/A
 *
 * @return void
 */
function register_all_scripts() {
  wp_register_style(
    'childstyle', get_stylesheet_directory_uri() . '/style.css', array(),
    filemtime(get_stylesheet_directory() . '/style.css'), false
  );
}

add_action('wp_loaded', 'register_all_scripts');

/**
 * [REQ2020_0002]
 * Function name: wp_schools_enqueue_scripts
 * Description: Fix error child theme couldn't get info style.css
 * Created by: Duke Ho
 * Created date: N/A
 *
 * @return void
 */
function wp_schools_enqueue_scripts() {
  wp_enqueue_style('childstyle');
  wp_enqueue_script(
    'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js', array( 'jquery' ), null, true
  );
}

add_action('wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);

/**
 * Function name: loggedIn_menu_args
 * Description: Change menu when user logged in
 * Created by: Duke Ho
 * Created date: N/A
 *
 * @param string $args
 *
 * @return string
 */
function loggedIn_menu_args( $args = '' ) {
  //   $verified = get_user_meta(get_current_user_id(), 'alg_wc_ev_is_activated', true);
  if ( is_user_logged_in() ) {
    //     if ($verified != 0) {
    $args['menu'] = 'LoggedIn-Menu';
    //     }
  }
  else {
    $args['menu'] = 'Header';
  }

  return $args;
}

add_filter('wp_nav_menu_args', 'loggedIn_menu_args');

/**
 * Function name: auto_redirect_after_logout
 * Description: Redirect to Home page after log out
 * Created by: Duke Ho
 * Created date: N/A
 *
 * @return void
 */
function auto_redirect_after_logout() {
  wp_redirect(home_url());
  exit();
}

add_action('wp_logout', 'auto_redirect_after_logout');

/**
 * Function name: custom_registration_redirect
 * Description: After registration, logout the user and redirect to home page
 * Return: Sign up - Thank you page url
 * Created by: Vinod
 * Created date: N/A
 *
 * @return string
 */
function custom_registration_redirect() {
  return '../signup-thanks/';
}

add_action('woocommerce_registration_redirect', 'custom_registration_redirect', 9, 2);

/**
 * [REQ2020_0004 - Single Checkout]
 * Function names: custom_woocommerce_auto_complete_order
 * Description: Restrict 1 product at a time when checkout
 * Created by: Duke Ho
 * Created date: 15/08/2019
 *
 * @param $order_id
 *
 * @return void
 */
function custom_woocommerce_auto_complete_order( $order_id ) {
  global $woocommerce;
  if ( !$order_id ) {
    return;
  }
  $order = new WC_Order($order_id);
  $order->update_status('completed');
}

add_action('woocommerce_thankyou', 'custom_woocommerce_auto_complete_order');

/**
 * [REQ2020_0004 - Single Checkout]
 * Function name: woo_custom_add_to_cart
 * Description: Restrict 1 product at a time when checkout
 * Created by: Duke Ho
 * Created date: N/A
 *
 * @param $cart_item_data
 *
 * @return mixed
 */
function woo_custom_add_to_cart( $cart_item_data ) {
  global $woocommerce;
  $woocommerce->cart->empty_cart();

  return $cart_item_data;
}

add_filter('woocommerce_add_cart_item_data', 'woo_custom_add_to_cart');

/**
 * [REQ2020_0004 - Single Checkout]
 * Function name: bbloomer_only_one_in_cart
 * Description: Restrict 1 product at a time when checkout
 * Created by: Duke Ho
 * Created date: N/A
 *
 * @param $passed
 * @param $added_product_id
 *
 * @return mixed
 */
function bbloomer_only_one_in_cart( $passed, $added_product_id ) {
  // empty cart first: new item will replace previous
  wc_empty_cart();

  return $passed;
}

add_filter('woocommerce_add_to_cart_validation', 'bbloomer_only_one_in_cart', 99, 2);

/**
 * Function name: ns_google_analytics
 * Description: Disable Google Analytics on DEV2 & TEST sites
 * Created by: Kenny Nguyen
 * Created date: 15/09/2020
 *
 * @return void
 */
function ns_google_analytics() { ?>
  <!-- Prevent Search Engine -->
  <meta name="googlebot" content="noindex">
  <meta name="robots" content="noindex">
  <?php
}

add_action('wp_head', 'ns_google_analytics', 10);

/**
 * Function name: cart_product_cannot_be_purchased_message
 * Description: Replace error message if user already has purchased same plan
 * Return: New error message
 * Created by: Vinod
 * Created date: N/A
 *
 * @param $message
 * @param $product_data
 *
 * @return string|void
 */
function cart_product_cannot_be_purchased_message( $message, $product_data ) {
  $message = '';
  if ( !$product_data->is_purchasable() ) {
    $message = __(
      'Hi, You already have an active subscription. Please click on My Account on menu to view your subscriptions.',
      'woocommerce'
    );
  }

  return $message;
}

add_filter('woocommerce_cart_product_cannot_be_purchased_message', 'cart_product_cannot_be_purchased_message', 99, 2);

/**
 * Function name: availability_filter_func
 * Description: Replace out of stock with coming soon on product page
 * Created by: Vinod
 * Created date: N/A
 *
 * @param $availability
 *
 * @return mixed|string
 */
function availability_filter_func( $availability ) {
  $availability['availability'] = str_ireplace('Out of stock', 'Coming Soon!', $availability['availability']);

  return $availability;
}

add_filter('woocommerce_get_availability', 'availability_filter_func');

/**
 * Function name: woocommerce_template_loop_stock
 * Description: Display an 'Out of Stock' label on archive / shop pages
 * Created by: Vinod
 * Created date: N/A
 *
 * @return void
 */
function woocommerce_template_loop_stock() {
  global $product;
  if ( !$product->managing_stock() && !$product->is_in_stock() ) {
    echo '<p class="stock out-of-stock" style="color:#cc0000;">Coming Soon - please check back!</p>';
  }
}

add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 10);

/**
 * Function name: custom_ajax_spinner
 * Description: Change the style of ajax spinner
 * Created by: Duke Ho
 * Created date: 16/11/2020
 *
 * @return void
 */
function custom_ajax_spinner() {
  ?>
  <style>
    .woocommerce .blockUI.blockOverlay:before,
    .woocommerce .loader:before {
      height              : 1em;
      width               : 1em;
      position            : fixed;
      top                 : 50%;
      left                : 50%;
      margin-left         : -.5em;
      margin-top          : -.5em;
      display             : block;
      content             : "";
      background-position : center center;
      background-size     : cover;
      line-height         : 1;
      text-align          : center;
      font-size           : 2em;
    }
  </style>
  <?php
}

add_action('wp_head', 'custom_ajax_spinner', 1000);

/**
 * Function name: create_user_subscription_info
 * Description: Insert user subscription info to db invedev2_user_subscription_info
 * Created by: Duke Ho
 * Created date: 25/12/2020
 * Modified date: 12/07/2021
 *
 * @return void
 */
function create_user_subscription_info() {
  if ( is_user_logged_in() ) {
    include_once $_SERVER['DOCUMENT_ROOT'] .
      '/wp-content/themes/hello-elementor-child/investify-functions/user-subscription/handle-user-subscription-info.php';
    include_once $_SERVER['DOCUMENT_ROOT'] .
      '/wp-content/themes/hello-elementor-child/investify-functions/common-functions.php';

    $user = wp_get_current_user();
    $user_type = get_current_user_subscript_type($user->ID);
    if ( $user_type['UserType'] === 'Essential Monthly' || $user_type['UserType'] === 'Starter Monthly' ) {
      insert_user_subscription($user);
    }
  }
}

add_action('wp_head', 'create_user_subscription_info', 9);

/**
 * Function name: set_token_cookie
 * Description: Create Token
 * Created by: Duke Ho
 * Created date: 12/28/2020
 *
 * @return void
 * @throws Exception
 */
function set_token_cookie() {
  if ( is_user_logged_in() ) {
    $user = wp_get_current_user();
    // Check if cookie is already set
    if ( !isset($_COOKIE['inves_logged_in_' . md5($user->user_email)]) ) {
      include_once $_SERVER['DOCUMENT_ROOT'] .
        '/wp-content/themes/hello-elementor-child/investify-functions/token-management/generate-token.php';

      $token_info = json_decode(generateToken($user));
      $current_time = new DateTime("now", new DateTimeZone('Pacific/Auckland'));

      if ( $token_info->status == 105 || $token_info->status == 106 || $token_info->status == 107 ) {
        setcookie(
          'inves_logged_in_' . md5($user->user_email), '', $current_time->getTimestamp() + 1800, COOKIEPATH, COOKIE_DOMAIN,
          true, true
        );
      }
      else {
        $encrypted_cookie = base64_encode($token_info->jwt);
        setcookie(
          'inves_logged_in_' . md5($user->user_email), $encrypted_cookie, $current_time->getTimestamp() + 1800, COOKIEPATH,
          COOKIE_DOMAIN, true, true
        );
      }
    }
  }
}

add_action('init', 'set_token_cookie');

/**
 * Function name: deactivate_pass_strength_meter
 * Description: Remove the password strength meter script from the scripts queue
 * Created by: Duke Ho
 * Created date: 2/8/2020
 *
 * @return void
 */
function deactivate_pass_strength_meter() {
  wp_dequeue_script('wc-password-strength-meter');
}

add_action('wp_enqueue_scripts', 'deactivate_pass_strength_meter', 10);

/**
 * Function name: reduce_woocommerce_min_strength_requirement
 * Description: Reduce the strength requirement on the woocommerce password
 * Created by: Duke Ho
 * Created date: 2/8/2020
 *
 * @param $strength
 *
 * @return int
 */
function reduce_woocommerce_min_strength_requirement( $strength ) {
  return 2;
}

add_filter('woocommerce_min_password_strength', 'reduce_woocommerce_min_strength_requirement');

/**
 * Function name: validateRegistrationForm
 * Description: Validate Registration Form
 * Created by: Duke Ho
 * Created date: 2/8/2020
 * Modified date: 22/09/2021
 *
 * @param $errors
 *
 * @return mixed|string
 */
function validateRegistrationForm( $errors ) {
  $name_Reg = "/^[A-Za-z\s'-]{1,100}$/";
  $email_Reg = "/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9_%+-]+(\.[A-Za-z]{2,64}){1,3}$/";

  if (
    $_POST['email'] == '' || $_POST['sr_lastname'] == '' || $_POST['sr_firstname'] == ''
  ) {
    $errors->add('woocommerce_empty_field_error', __('Required fields cannot be empty.', "woocommerce"));
  }
  else {
    if (
      !preg_match($name_Reg, $_POST['sr_firstname']) || !preg_match($name_Reg, $_POST['sr_lastname']) ||
      !preg_match($email_Reg, $_POST['email'])
    ) {
      $errors->add('woocommerce_input_field_error', __("Please enter valid inputs", "woocommerce"));
    }
  }

  /** Change Error Message when email exists - 11/26/2020 */
  // Email exists
  if ( email_exists($_POST['email']) ) {
    $errors->add(
      'registration-error-email-exists', __(
        'An account is already registered with your email address. <a href="' . get_page_link(1310) .
        '" style="color: #F06A5E;">Please log in.</a>', 'woocommerce'
      )
    );
  }

  return $errors;
}

add_action('woocommerce_process_registration_errors', 'validateRegistrationForm', 10, 2);

/**
 * Function name: real_time_registration_validation
 * Description: Real-time Validation First name, Last name, Email and Password in Sign up page
 * Created by: Duke Ho
 * Created date: 2/8/2020
 * Modified date: 23/08/2021
 *
 * @return void
 */
function real_time_registration_validation() {
  /* Bail if name field is disabled. */
  if ( !apply_filters('woocommerce_simple_registration_name_fields', true) ) {
    return;
  }
  ?>
  <script src="/wp-content/themes/hello-elementor-child/dist/js/appBundle.bundle.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function ($) {
      $('#reg_sr_lastname, #reg_sr_firstname').attr('maxlength', '100')
      $('#reg_email').attr('maxlength', '200')
      $('#reg_email').prop('required', true)
      $('#mailchimp_woocommerce_newsletter').prop('required', true)
      $('label[for="mailchimp_woocommerce_newsletter"] > span > a')
        .css({ 'text-decoration': 'underline', 'color': '#A1A1A1' })

      appBundle.validateSignUpInput()
    })
  </script>
  <?php
}

add_action('woocommerce_register_form_start', 'real_time_registration_validation');

/**
 * Function name: get_custom_coupon_code_to_session
 * Description: Create a url to attach coupon code
 * Created by: Duke Ho
 * Created date: 10/03/2021
 *
 * @return void
 */
function get_custom_coupon_code_to_session() {
  if ( isset($_GET['coupon']) ) {
    // Ensure that customer session is started
    if ( isset(WC()->session) && !WC()->session->has_session() ) {
      WC()->session->set_customer_session_cookie(true);
    }

    // Check and register coupon code in a custom session variable
    $coupon_code = WC()->session->get('coupon');
    if ( empty($coupon_code) ) {
      $coupon_code = esc_attr($_GET['coupon']);
      WC()->session->set('coupon', $coupon_code); // Set the coupon code in session
    }
  }
}

add_action('init', 'get_custom_coupon_code_to_session');

/**
 * Function name: add_discount_to_checkout
 * Description: Apply coupon when check out
 * Created by: Duke Ho
 * Created date: 10/03/2021
 *
 * @return void
 */
function add_discount_to_checkout() {
  // Set coupon code
  $coupon_code = WC()->session->get('coupon');
  if ( !empty($coupon_code) && !WC()->cart->has_discount($coupon_code) ) {
    WC()->cart->add_discount($coupon_code); // apply the coupon discount
    WC()->session->__unset('coupon');       // remove coupon code from session
  }
}

add_action('woocommerce_before_checkout_form', 'add_discount_to_checkout', 10, 0);

/**
 * Function name: add_recurring_fees
 * Description: Create custom message for order details table - Checkout page
 * Created by: Duke Ho
 * Created date: 13/03/2021
 *
 * @param $cart
 *
 * @return void
 */
function add_recurring_fees( $cart ) {
  if ( !empty($cart->recurring_cart_key) ) {
    remove_action('eael_display_recurring_total_total', array( 'WC_Subscriptions_Cart', 'display_recurring_totals' ), 10);
  }
}

add_filter('woocommerce_cart_calculate_fees', 'add_recurring_fees', 10, 1);

/**
 * Function name: custom_display_order
 * Description: Customize order table display - Checkout page
 * Created by: Duke Ho
 * Created date: 13/03/2021
 *
 * @param $order
 *
 * @return void
 */
function custom_display_order( $order ) {
  foreach ( WC()->cart->recurring_carts as $recurring_cart_key => $recurring_cart ) {
    if ( 0 !== $recurring_cart->next_payment_date ) {
      $first_renewal_date =
        date_i18n(wc_date_format(), wcs_date_to_time(get_date_from_gmt($recurring_cart->next_payment_date)));
      echo '<small>All Prices in NZD</small>';
      echo '<p style="font-family: helvetica, Helvetica-custom; font-size: 16px; margin-top: 20px; margin-bottom: 0;font-weight:500;">Subscription will be auto renewed on a monthly basis. Next renewal date is ' .
        $first_renewal_date . '</p>';
    }
  }
}

add_action('eael_display_recurring_total_total', 'custom_display_order', 10);

/**
 * Function name: filter_woocommerce_coupon_message
 * Description: Create custom message for adding coupon successfully - Checkout page
 * Created by: Duke Ho
 * Created date: 14/03/2021
 * Modified date: 08/09/2021
 *
 * @param $msg
 * @param $msg_code
 * @param $coupon
 *
 * @return mixed|string
 */
function filter_woocommerce_coupon_message( $msg, $msg_code, $coupon ) {
  if ( $msg === __('Coupon code applied successfully.', 'woocommerce') ) {
    $msg = sprintf(
      __(
        "<p>%s</p><p>The discount is valid for only the first three months of your subscription. From the fourth month, unless cancelled before the renewal date, you will be charged the standard subscription fee (mentioned on the %s page)</p>",
        "woocommerce"
      ), 'Coupon code applied successfully.',
      '<a style="color:#f06a5e;text-decoration:underline;" href="' . get_page_link(4521) . '" target="_blank">Pricing</a>'
    );
  }

  return $msg;
}

add_filter('woocommerce_coupon_message', 'filter_woocommerce_coupon_message', 10, 3);

/**
 * Function name: real_time_billing_address_validation
 * Description: Validate Billing Address Form
 * Created by: Duke Ho
 * Created date: 15/3/2021
 *
 * @return void
 */
function real_time_billing_address_validation() {
  ?>
  <script src="/wp-content/themes/hello-elementor-child/dist/js/appBundle.bundle.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function ($) {
      $('#billing_first_name, #billing_last_name, #billing_address_1').prop('required', true)
      $('#billing_first_name, #billing_last_name').attr('maxlength', '100')
      $('#billing_city, #billing_postcode, #billing_email').prop('required', true)

      appBundle.validateBillingInput()
    })
  </script>
  <?php
}

add_action('woocommerce_before_checkout_billing_form', 'real_time_billing_address_validation');

/**
 * Function name: validate_Billing_Address_Form
 * Description: Validate Billing Address form
 * Created by: Duke Ho
 * Created date: 15/3/2021
 *
 * @return void
 */
function validate_Billing_Address_Form() {
  $name_Reg = "/^[A-Za-z\s'-]{1,100}$/";
  $email_Reg = "/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9_%+-]+(\.[A-Za-z]{2,64}){1,3}$/";

  if ( !preg_match($name_Reg, $_POST['billing_first_name']) ) {
    wc_add_notice(
      __(
        "First name should at least 1 character long and at most 100 characters long. Only characters and ', hyphen and space accepted."
      ), "error"
    );
  }

  if ( !preg_match($name_Reg, $_POST['billing_last_name']) ) {
    wc_add_notice(
      __(
        "Last name should at least 1 character long and at most 100 characters long. Only characters and ', hyphen and space accepted."
      ), "error"
    );
  }

  if ( !preg_match($email_Reg, $_POST['billing_email']) ) {
    wc_add_notice(__("The email entered is wrong format. Please try again"), "error");
  }
}

add_action('woocommerce_checkout_process', 'validate_Billing_Address_Form', 10);
add_action("woocommerce_after_save_address_validation", 'validate_Billing_Address_Form', 10);

/**
 * Function name: validate_Edit_Account_Form
 * Description: Validate Edit Account form
 * Created by: Duke Ho
 * Created date: 15/03/2021
 * Modified date: 17/09/2021
 *
 * @param $errors
 *
 * @return mixed|string
 */
function validate_Edit_Account_Form( $errors ) {
  $name_Reg = "/^[A-Za-z\s'-]{1,100}$/";
  $email_Reg = "/^[A-Z0-9a-z._%+-]+@[A-Za-z0-9_%+-]+(\.[A-Za-z]{2,64}){1,3}$/";
  $password_Reg = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$/";

  if ( !preg_match($name_Reg, $_POST['account_first_name']) ) {
    $errors->add(
      'woocommerce_edit_firstname_error', __(
        "First name should at least 1 character long and at most 100 characters long. Only characters and ', hyphen and space accepted.",
        "woocommerce"
      )
    );
  }

  if ( !preg_match($name_Reg, $_POST['account_last_name']) ) {
    $errors->add(
      'woocommerce_edit_lastname_error', __(
        "Last name should at least 1 character long and at most 100 characters long. Only characters and ', hyphen and space accepted.",
        "woocommerce"
      )
    );
  }

  if ( !preg_match($email_Reg, $_POST['account_email']) ) {
    $errors->add(
      'woocommerce_edit_email_error', __("The email entered is wrong format. Please try again", "woocommerce")
    );
  }

  if ( strlen($_POST['password_1']) > 0 ) {
    if ( !preg_match($password_Reg, $_POST['password_1']) ) {
      $errors->add(
        'woocommerce_new_password_error', __(
          'New Password requires lower case letter, upper case letter, digit, at least 8 characters long, and no spaces.',
          "woocommerce"
        )
      );
    }
  }

  return $errors;
}

add_action('woocommerce_save_account_details_errors', 'validate_Edit_Account_Form', 10);

/**
 * Function name: add_hotjar
 * Description: Add Hotjar
 * Created by: Duke Ho
 * Created date: 03/05/2021
 *
 * @return void
 */
function add_hotjar() {
  ?>
  <script>
    (function (h, o, t, j, a, r) {
      h.hj = h.hj || function () {(h.hj.q = h.hj.q || []).push(arguments)}
      h._hjSettings = { hjid: 2313187, hjsv: 6 }
      a = o.getElementsByTagName('head')[0]
      r = o.createElement('script')
      r.async = 1
      r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv
      a.appendChild(r)
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=')
  </script>
  <?php
}

// add_action('wp_head', 'add_hotjar', 1000);

/*[INVESTIFY-89 - Start]*/
/**
 * Function name: woocommerce_banhammer_validation
 * Description: Add error message when validate email domain using Ban Hammer plugin
 * Created by: Duke Ho
 * Created date: 17/05/2021
 *
 * @param $validation_errors
 * @param $username
 * @param $email
 *
 * @return mixed|WP_Error
 */
function woocommerce_banhammer_validation( $validation_errors, $username, $email ) {
  if ( ( new BanHammer )->banhammer_drop($username, $email, $validation_errors) ) {
    return new WP_Error('registration-error-bad-email', ( new BanHammer )->options['message']);
  }

  return $validation_errors;
}

/**
 * Function name: mydomain_plugin_checks
 * Description: Add function woocommerce_banhammer_validation to validate email domain using Ban Hammer plugin
 * Created by: Duke Ho
 * Created date: 17/05/2021
 *
 * @return void
 */
function mydomain_plugin_checks() {
  if ( class_exists('BanHammer') ) {
    add_filter('woocommerce_registration_errors', 'woocommerce_banhammer_validation', 10, 3);
  }
}

add_action('init', 'mydomain_plugin_checks');
/*[INVESTIFY-89 - End]*/

/**
 * Function name: register_custom_api
 * Description: Add custom rest api
 * Created by: Duke Ho
 * Created date: 28/05/2021
 * Updated date: 09/06/2021
 *
 * @return void
 */
function register_custom_api() {
  include_once $_SERVER['DOCUMENT_ROOT'] .
    '/wp-content/themes/hello-elementor-child/investify-functions/get-ai-commentary.php';
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/wp-content/themes/hello-elementor-child/investify-functions/api/gofc-client-solution/query-advisor-gofc.php';

  register_rest_route('ai-commentary', '/get', array(
    'methods'             => WP_REST_Server::CREATABLE, 'callback' => 'get_ai_commentary',
    'permission_callback' => 'check_user_permission'
  ));
	
	register_rest_route( 'client-solution', '/advisor', array(
    'methods'             => WP_REST_Server::CREATABLE,
    'callback'            => 'get_advisor_gofc',
    'permission_callback' => '__return_true'
  ) );
}

add_action('rest_api_init', 'register_custom_api');

/**
 * Function name: cancel_previous_active_subscription
 * Description: Cancel previous active subscription after purchasing new subscription
 * Created by: Duke Ho
 * Created date: 02/07/2021
 *
 * @return void
 */
function cancel_previous_active_subscription() {

  $no_of_loops = 0;
  $user_id = get_current_user_id();

  // Get all customer subscriptions
  $args = array(
    'subscription_status' => 'active', 'subscriptions_per_page' => -1, 'customer_id' => $user_id, 'orderby' => 'ID',
    'order'               => 'DESC'
  );
  $subscriptions = wcs_get_subscriptions($args);

  foreach ( $subscriptions as $subscription ) {
    $no_of_loops = $no_of_loops + 1;

    if ( $no_of_loops > 1 ) {
      $subscription->update_status('cancelled');
    }
  }
}

add_action('woocommerce_thankyou', 'cancel_previous_active_subscription');

/**
 * Function name: delete_user_subscription_info
 * Description: Delete old stocks viewed after purchasing or renewing new subscription
 * Created by: Duke Ho
 * Created date: 05/07/2021
 *
 * @param $subscription
 */
function delete_user_subscription_info( $subscription ) {
  include_once $_SERVER['DOCUMENT_ROOT'] .
    '/wp-content/themes/hello-elementor-child/investify-functions/user-subscription/handle-user-subscription-info.php';
  $user_id = $subscription->get_user_id();
  $current_order = $subscription->get_last_order('all', 'any');
  $current_order->update_status('completed');
  delete_stock_viewed($user_id);
}

add_action('woocommerce_subscription_payment_complete', 'delete_user_subscription_info');

/**
 * Function name: custom_remove_user
 * Description: Delete user subscription info when deleting a user
 * Created by: Duke Ho
 * Created date: 05/07/2021
 * Modified date: 12/07/2021
 *
 * @param $user_id
 */
function custom_remove_user( $user_id ) {
  include_once $_SERVER['DOCUMENT_ROOT'] .
    '/wp-content/themes/hello-elementor-child/investify-functions/user-subscription/handle-user-subscription-info.php';
  include_once $_SERVER['DOCUMENT_ROOT'] .
    '/wp-content/themes/hello-elementor-child/investify-functions/user-watchlist/handle-user-watchlist.php';
  include_once $_SERVER['DOCUMENT_ROOT'] .
    '/wp-content/themes/hello-elementor-child/investify-functions/user-portfolio/handle-user-portfolio.php';

  delete_stock_viewed($user_id);
  delete_watchlist($user_id);
  delete_portfolio($user_id);
}

add_action('delete_user', 'custom_remove_user', 10);

/**
 * Function name: create_user_watchlist
 * Description: Insert user watchlist to db invedev2_user_stock_watchlist
 * Created by: Duke Ho
 * Created date: 12/07/2021
 *
 * @return void
 */
function create_user_watchlist() {
  if ( is_user_logged_in() ) {
    include_once $_SERVER['DOCUMENT_ROOT'] .
      '/wp-content/themes/hello-elementor-child/investify-functions/user-watchlist/handle-user-watchlist.php';

    $user = wp_get_current_user();
    insert_user_watchlist($user->ID);
  }
}

add_action('wp_head', 'create_user_watchlist', 9);

/**
 * Function name: add_google_tag_manager
 * Description: Add google tag manager tracking code
 * Created by: Duke Ho
 * Created date: 27/08/2021
 *
 * @return void
 */
function add_google_tag_manager() {
  ?>
  <script>(function (w, d, s, l, i) {
      w[l] = w[l] || []
      w[l].push({
        'gtm.start':
          new Date().getTime(), event: 'gtm.js'
      })
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : ''
      j.async = true
      j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl
      f.parentNode.insertBefore(j, f)
    })(window, document, 'script', 'dataLayer', 'GTM-KFJPNKQ')</script>

  <?php
}

add_action('wp_head', 'add_google_tag_manager', 1000);

/**
 * Function name: change_renewal_method_before_confirmation_msg
 * Description: Change renewal method before confirmation message
 * Created by: Duke Ho
 * Created date: 07/09/2021
 *
 * @param $returnData
 * @param $form
 * @param $confirmation
 *
 * @return mixed
 */
function change_renewal_method_before_confirmation_msg( $returnData, $form, $confirmation ) {
  if ( $form->id != 1 ) {
    return $returnData;
  }
  include_once $_SERVER['DOCUMENT_ROOT'] .
    '/wp-content/themes/hello-elementor-child/investify-functions/common-functions.php';
  $return_data = json_encode(get_current_user_subscript_type(get_current_user_id()));
  $subscription_id = '';

  if ( is_array($return_data) ) {
    if ( count($return_data) > 0 ) {
      foreach ( $return_data as $data ) {
        $subscription_id = $data['subscription_id'];
      }
    }
  }
  else {
    $json_data = json_decode($return_data, true);
    $subscription_id = $json_data['subscription_id'];
  }

  global $wpdb;
  $sql = "SELECT meta_value FROM " . $wpdb->postmeta;
  $sql .= " WHERE post_id =" . $subscription_id . " AND meta_key = '_requires_manual_renewal' LIMIT 1";
  $post = $wpdb->get_results($sql);

  if ( count($post) > 0 ) {
    $update_sql = "UPDATE " . $wpdb->postmeta . " SET meta_value ='true' WHERE post_id =" . $subscription_id .
      " AND meta_key = '_requires_manual_renewal'";
    $result = $wpdb->query($update_sql);

  }
  else {
    $result = $wpdb->insert($wpdb->postmeta, array(
      'post_id' => $subscription_id, 'meta_key' => '_requires_manual_renewal', 'meta_value' => 'true'
    ), array( '%d', '%s', '%s' ));
  }

  return $returnData;
}

add_filter('fluentform_submission_confirmation', 'change_renewal_method_before_confirmation_msg', 10, 3);

/**
 * Function name: change_subscription_before_confirmation_msg
 * Description: Change subscription before confirmation message
 * Created by: Duke Ho
 * Created date: 17/09/2021
 *
 * @param $entryId
 * @param $formData
 * @param $form
 */
function change_subscription_before_confirmation_msg( $entryId, $formData, $form ) {
  if ( $form->id != 4 ) {
    return;
  }

  $users_subscriptions = wcs_get_users_subscriptions(get_current_user_id());
  foreach ( $users_subscriptions as $subscription ) {
    if ( $subscription->has_status(array( 'active' )) ) {
      /** Add note to trigger the flow */
      if ( $formData['dropdown'] === 'Starter' ) {
        $subscription->add_order_note('subscription change to Starter');
      }
      else {
        $subscription->add_order_note('subscription change to Essential');
      }
    }
  }
}

add_action('fluentform_before_submission_confirmation', 'change_subscription_before_confirmation_msg', 10, 3);

/**
 * Function name: add_registration_referral_code
 * Description: Add referral code when creating a user
 * Created by: Duke Ho
 * Created date: 18/09/2021
 */
function add_registration_referral_code() {
  woocommerce_form_field('reg_hear_from', array(
    'type'        => 'checkbox', 'class' => array( 'form-row' ),
    'label_class' => array( 'woocommerce-form__label woocommerce-form__label-for-checkbox checkbox' ),
    'input_class' => array( 'woocommerce-form__input woocommerce-form__input-checkbox input-checkbox' ), 'required' => true,
    'label'       => 'Where did you hear about us?',
  ));

  include_once $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/hello-elementor-child/investify-functions/libs/constant.php';
  ?>
  <select style="display:none; margin-bottom:15px;" id="hear_from" name="hear_from">
    <option value="">---</option>
    <?php
    foreach ( $hear_from as $key => $value ) {
      echo "<option value='{$key}'>{$value}</option>";
    }
    ?>
  </select>
  <input style="display:none; margin-bottom:15px;" type="text" class="woocommerce-Input woocommerce-Input--text input-text"
         name="reg_from_other" id="reg_from_other"/>
  <?php
}

add_action('woocommerce_register_form', 'add_registration_referral_code', 11);

/**
 * Function name: save_registration_referral_code
 * Description: Save referral code when creating a user
 * Created by: Duke Ho
 * Created date: 18/09/2021
 *
 * @param $customer_id
 */
function save_registration_referral_code( $customer_id ) {
  if ( isset($_POST['hear_from']) && !empty($_POST['hear_from']) ) {
    if ( $_POST['hear_from'] === 'other' && !empty($_POST['reg_from_other']) ) {
      update_user_meta($customer_id, 'referral_code', sanitize_text_field($_POST['reg_from_other']));
    }
    else {
      update_user_meta($customer_id, 'referral_code', sanitize_text_field($_POST['hear_from']));
    }
  }
}

add_action('woocommerce_created_customer', 'save_registration_referral_code');

/**
 * Function name: edit_account_referral_code
 * Description: Edit referral code when editing a user
 * Created by: Duke Ho
 * Created date: 18/09/2021
 *
 * @param $user
 */
function edit_account_referral_code( $user ) {
  $user_id = $user->ID ?? get_current_user_id();
  $referral_code = get_user_meta($user_id, 'referral_code', true);
  ?>
  <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="account_referral_code"><?php
      esc_html_e('Referral Code', 'woocommerce'); ?></label>
    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_referral_code"
           id="account_referral_code" value="<?php
    echo esc_attr($referral_code ?: ''); ?>"/>
  </p>
  <?php
}

add_action('woocommerce_edit_account_form', 'edit_account_referral_code', 30);

/**
 * Function name: save_edit_account_referral_code
 * Description: Save referral code after editing a user
 * Created by: Duke Ho
 * Created date: 18/09/2021
 *
 * @param $customer_id
 */
function save_edit_account_referral_code( $customer_id ) {
  if ( isset($_POST['account_referral_code']) ) {
    if ( !empty($_POST['account_referral_code']) ) {
      update_user_meta($customer_id, 'referral_code', $_POST['account_referral_code']);
    }
    else {
      delete_user_meta($customer_id, 'referral_code');
    }
  }
}

add_action('woocommerce_save_account_details', 'save_edit_account_referral_code');

function wpse27856_set_content_type() {
  return "text/html";
}

add_filter('wp_mail_content_type', 'wpse27856_set_content_type');

/**
 * Function name: change_password_changed_email
 * Description: Change password changed confirmation email content
 * Created by: Duke Ho
 * Created date: 24/09/2021
 *
 * @param $pass_change_mail
 * @param $user
 * @param $userdata
 *
 * @return mixed
 */
function change_password_changed_email( $pass_change_mail, $user, $userdata ) {
  $new_message_txt = <<<EOD
  <div style="background-color: #ffffff;margin: 0;padding: 70px 0;width: 100%;">
    <table
    style="color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: 'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; background-color: transparent; margin-left: auto; margin-right: auto;border: 1px solid #e5e5e5;"
    border="0" width="600" cellspacing="0" cellpadding="0">
      <tbody>
      <tr>
        <td style="display: block; padding: 0;">
          <img
            style="border: none; display: inline-block; font-size: 14px; font-weight: bold; height: auto; outline: none; text-decoration: none; text-transform: capitalize; vertical-align: middle; max-width: 100%;"
            tabindex="0"
            src="###SITEURL###/wp-content/uploads/2021/07/Mailchimp-header-white-background.png"
            alt="Email-Header"
          />
        </td>
      </tr>
      <tr>
        <td style="padding: 30px 20px 30px;" valign="top">
          <div
            style="color: #67597c; font-family: 'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; font-size: 14px; line-height: 150%; text-align: left; font-weight: 400;">
            Hi {$userdata["first_name"]},
            <br/><br/>
            This notice confirms that your password was changed on Investify.
            <br/><br/>If you did not change your password, please <a href="###SITEURL###/contact-us/" 
            style="color:#48beac;font-weight:normal;text-decoration:underline" target="_blank">contact us</a>
          </div>
          <div
            style="color: #67597c; font-family: 'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; font-size: 14px; line-height: 150%; text-align: left; font-weight: 400;">
            <br/>Regards,<br/>Team Investify
          </div>
        </td>
      </tr>
      <tr>
        <td style="padding: 0;"><img
            style="border: none; display: inline-block; font-size: 14px; font-weight: bold; height: auto; outline: none; text-decoration: none; text-transform: capitalize; vertical-align: middle; max-width: 100%;"
            tabindex="0" src="###SITEURL###/wp-content/uploads/2021/07/Mailchimp-footerwhite-background.png"
            alt="Email-Footer"/></td>
      </tr>
      </tbody>
    </table>
  </div>
  EOD;
  $pass_change_mail['subject'] = 'Password Changed';
  $pass_change_mail['message'] = $new_message_txt;
  $pass_change_mail['headers'] = array( 'Content-Type: text/html; charset=UTF-8' );
  return $pass_change_mail;
}

add_filter( 'password_change_email', 'change_password_changed_email', 10, 3 );


function mathCaptcha_start_session() {
  session_start();
}

add_action( 'init', 'mathCaptcha_start_session' );

add_action( 'elementor_pro/forms/new_record', function ( $record, $handler ) {
  include_once $_SERVER['DOCUMENT_ROOT'] .
    '/wp-content/themes/hello-elementor-child/investify-functions/api/gofc-client-solution/query-user-gofc.php';

  $form_name = $record->get_form_settings( 'form_name' );
  if ( 'demo_register' !== $form_name ) {
    return;
  }

  $raw_fields = $record->get( 'fields' );
  $fields = [];
  foreach ( $raw_fields as $id => $field ) {
    $fields[$id] = $field['value'];
  }

  $output['result'] = $fields['result'];

  $user_gofc = get_user_gofc();

  $username = explode( '@', $user_gofc["result"]["verifiedEmail"] )[0];
  $password = wp_generate_password( absint( 15 ), true, false );

  $username = sanitize_user( $username, true );

  $user_id = wp_create_user( $username, $password, $user_gofc["result"]["verifiedEmail"] );

  if ( is_wp_error( $user_id ) ) {
    $code = $user_id->get_error_code();
    $error_message = $user_id->get_error_message( $code );
    
    if ($code === 'existing_user_login') {
      $exist_user_id = username_exists($username); 
       if ($exist_user_id !== false) {
         wp_set_current_user( $exist_user_id );
         wp_set_auth_cookie( $exist_user_id );
         $output['result'] = "<meta http-equiv='refresh' content='0;url=" . get_permalink( 5537 ) . "'>";
       } else {
         $output['result'] = $error_message;
       }
    } else {
      $output['result'] = $error_message;
    }
  } else {
    wp_set_current_user( $user_id );
    wp_set_auth_cookie( $user_id );

    $output['result'] = "<meta http-equiv='refresh' content='0;url=" . get_permalink( 5537 ) . "'>";
  }

  $handler->add_response_data( true, $output );
}, 10, 2 );

function advisorportal_shortcode() { 
    return '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="/wp-content/themes/hello-elementor-child/dist/build/favicon.png" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="Web site created using create-react-app"
    />
    <link rel="apple-touch-icon" href="/logo192.png" />
    <link rel="manifest" href="/manifest.json" />
    <title>Investify</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer="defer" src="/wp-content/themes/hello-elementor-child/dist/build/static/js/main.b001c317.js"></script>
    <link href="/wp-content/themes/hello-elementor-child/dist/build/static/css/main.bda31114.css" rel="stylesheet" />
  </head>
  <body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
  </body>
</html>';
}

add_shortcode('advisorportal_shortcode', 'advisorportal_shortcode');

/**
 * Function name: get_dynamic_copyright_year
 * Description: Get dynamic copyright message
 * Created by: Duke Ho
 * Created date: 27/01/2022
 *
 * @return string
 */
function get_dynamic_copyright_year() {
  return '<p style="color: #ffffff; font-size: 11px;">&copy; ' . date('Y') . ' Investify Limited, New Zealand</p>';
}

add_shortcode( 'get_dynamic_copyright_year', 'get_dynamic_copyright_year' );

/**
 * Function name: get_user_wp_meta_info
 * Description: Get user info for Adviser Contact
 * Created by: Kenny Nguyen
 * Created date: 15/03/2022
 *
 * @return string
 */
function get_adviser_info() {
	if ( is_user_logged_in() ) {
		$user_id = get_current_user_id();
    $user_first_name = get_user_meta( $user_id, 'first_name', true );
    $user_last_name = get_user_meta( $user_id, 'last_name', true );
    $user_email = get_user_meta( $user_id, 'billing_email', true );
    $user_phone = get_user_meta( $user_id, 'billing_phone', true );
    $html_text = "";
    $html_text = $html_text . "<span id='adviser-name'>" . $user_first_name . " " . $user_last_name . "</span><br/>";
    $html_text = $html_text . "<span id='adviser-email'>" . $user_email . "</span><br/>";
    $html_text = $html_text . "<span id='adviser-phone'>" . $user_phone . "</span><br/>";
	} else {
    $html_text = "";
  }
	return $html_text;
}

add_shortcode( 'get_adviser_info', 'get_adviser_info' );

/**
 * Function name: print_adviser_report_disclaimer_content
 * Description: Generate report disclaimer for printing
 * Created by: Kenny Nguyen
 * Created date: 25/03/2022
 *
 * @return string
 */
function print_adviser_report_disclaimer_content() {
	$html_text = "";
	$html_text = $html_text . "<span id='adviser-report-disclaimer'>";
	$html_text = $html_text . "Comments in this report are general advice only and have been prepared without considering your objectives, financial situation or needs. ";
	$html_text = $html_text . "Before making any investment decision we recommend that you consider whether it is appropriate for your situation and seek appropriate financial, taxation and legal advice. ";
	$html_text = $html_text . "For all the analytical insights generated by Investify, the data source can be traced to the raw data supplied by the data suppliers such as Factset UK Limited and company annual reports. ";
	$html_text = $html_text . "This publication has been prepared in good faith based on information obtained from sources believed to be reliable and accurate. ";
	$html_text = $html_text . "Past performance is not indicative of future performance. Estimates of future performance are based on assumptions that may not be realised. ";
	$html_text = $html_text . "If provided, and unless otherwise stated, the closing price provided is that of the primary exchange for the issuer's securities or investments. &copy; " . date('Y') . " Investify Limited, New Zealand
";
	$html_text = $html_text . "</span>";
	
	return $html_text;
}

add_shortcode( 'print_adviser_report_disclaimer_content', 'print_adviser_report_disclaimer_content' );

/**
 * Function name: edit_account_company_code
 * Description: Edit company name when editing user details
 * Created by: Ahmad Umar
 * Created date: 21/04/2022
 *
 * @param $user
 */
function edit_account_company_code( $user ) {
  $user_id = $user->ID ?? get_current_user_id();
  $company_name = get_user_meta($user_id, 'company_name', true);
  ?>
  <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    <label for="account_company_name"><?php
      esc_html_e('Company Name', 'woocommerce'); ?></label>
    <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_company_name"
           id="account_company_name" value="<?php
    echo esc_attr($company_name ?: ''); ?>"/>
  </p>
  <?php
}

add_action('woocommerce_edit_account_form', 'edit_account_company_code', 10, 1);

/**
 * Function name: save_edit_account_company_name
 * Description: Save company name after editing user details
 * Created by: Ahmad Umar
 * Created date: 21/04/2022
 *
 * @param $customer_id
 */
function save_edit_account_company_name( $customer_id ) {
  if ( isset($_POST['account_company_name']) ) {
    if ( !empty($_POST['account_company_name']) ) {
      update_user_meta($customer_id, 'company_name', $_POST['account_company_name']);
    }
    else {
      delete_user_meta($customer_id, 'company_name');
    }
  }
}

add_action('woocommerce_save_account_details', 'save_edit_account_company_name', 10, 1);