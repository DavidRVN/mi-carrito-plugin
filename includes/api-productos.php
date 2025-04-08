<?php
/**
 * API personalizada para obtener productos de WooCommerce.
 */

add_action('rest_api_init', function () {
    register_rest_route('mi-carrito/v1', '/productos', [
        'methods' => 'GET',
        'callback' => 'obtener_productos_woocommerce',
        'permission_callback' => '__return_true'
    ]);
});

function obtener_productos_woocommerce(WP_REST_Request $request) {
    $limit = $request->get_param('limit') ?: 10; // Permitir límite dinámico
    $args = [
        'status' => 'publish',
        'limit' => $limit
    ];

    $consumer_key = defined('WOOCOMMERCE_CONSUMER_KEY') ? WOOCOMMERCE_CONSUMER_KEY : '';
    $consumer_secret = defined('WOOCOMMERCE_CONSUMER_SECRET') ? WOOCOMMERCE_CONSUMER_SECRET : '';

    if (empty($consumer_key) || empty($consumer_secret)) {
        return new WP_Error('missing_keys', 'Las claves de WooCommerce no están configuradas.', ['status' => 500]);
    }

    $woocommerce = new \Automattic\WooCommerce\Client(
        get_site_url(),
        $consumer_key,
        $consumer_secret,
        [
            'version' => 'wc/v3',
            'verify_ssl' => false
        ]
    );

    try {
        $productos = $woocommerce->get('products', $args);
        return rest_ensure_response($productos);
    } catch (Exception $e) {
        return new WP_Error('woocommerce_error', $e->getMessage(), ['status' => 500]);
    }
}