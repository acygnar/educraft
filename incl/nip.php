<?php
function add_nip_if_b2b()
{

    $cat_check = false;
    // check each cart item for our category
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

        $product = $cart_item['data'];
        if (has_term('b2b', 'product_cat', $product->id)) {
            $cat_check = true;
            break;
        }
    }
    if ($cat_check) {
        add_filter('woocommerce_checkout_fields', 'custom_woocommerce_checkout_fields', 999);
    }
}
add_action('woocommerce_before_checkout_form', 'add_nip_if_b2b');

function custom_woocommerce_checkout_fields($fields)
{
    $fields['billing']['billing_nip'] = array(
        'type'        => 'text',
        'label'       => __('NIP', 'woocommerce'),
        'placeholder' => _x('Wpisz polski numer NIP', 'placeholder', 'woocommerce'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'clear'       => true
    );
    return $fields;
}
/**
 * Update the order meta with field value
 */
add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');

function custom_checkout_field_update_order_meta($order_id)
{
    if (! empty($_POST['billing_nip'])) {
        $order = wc_get_order($order_id);
        $order->update_meta_data('NIP', sanitize_text_field($_POST['billing_nip']));
        $order->save_meta_data();
    }
}
/**
 * Display field value on the order edit page
 */
add_action('woocommerce_admin_order_data_after_billing_address', 'custom_checkout_field_display_admin_order_meta', 10, 1);

function custom_checkout_field_display_admin_order_meta($order)
{
    echo '<p><strong>' . esc_html__('NIP') . ':</strong> ' . esc_html($order->get_meta('NIP', true)) . '</p>';
}
/**
 * Process the checkout
 */
add_action('woocommerce_checkout_process', 'custom_checkout_field_process');

function custom_checkout_field_process()
{
    $valid = false;
    $field_label = __('NIP', 'woocommerce');
    $weights = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
    if (!empty($_POST['billing_nip'])) {
        $value = sanitize_text_field($_POST['billing_nip']);
        $nip = preg_replace('/^PL/', '', $value);
        if (strlen($nip) == 10 && is_numeric($nip)) {
            $sum = 0;

            for ($i = 0; $i < 9; $i++)
                $sum += $nip[$i] * $weights[$i];

            $valid = ($sum % 11) == (int) $nip[9];
        }
        if ($valid === false) {
            wc_add_notice(sprintf(__('Pole %s jest wypełnione niepoprawnie. Wpisz polski numer NIP bez spacji i myślników.', 'woocommerce'), '<strong>' . $field_label . '</strong>'), 'error', array(
                'id' => 'billing_nip'
            ));
        }
    }
}
