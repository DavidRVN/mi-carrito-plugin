<?php
/**
 * Aquí genero la consulta al API de Woo, para obtener precios y productos.
 * 
 */
add_action('rest_api_init', function () {
    register_rest_route('mi-carrito/v1', '/productos', [
        'methods' => 'GET',
        'callback' => 'obtener_productos_woocommerce',
        'permission_callback' => '__return_true'
    ]);
});

function obtener_productos_woocommerce() {
    $args = [
        'status' => 'publish',
        'limit' => 10
    ];

    $woocommerce = new \Automattic\WooCommerce\Client(
        get_site_url(),
        'TU_CONSUMER_KEY',
        'TU_CONSUMER_SECRET',
        [
            'version' => 'wc/v3',
            'verify_ssl' => false
        ]
    );

    try {
        $productos = $woocommerce->get('products', $args);
        return $productos;
    } catch (Exception $e) {
        return new WP_Error('woocommerce_error', $e->getMessage(), ['status' => 500]);
    }
}