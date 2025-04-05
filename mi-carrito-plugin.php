<?php
/**
 * Plugin Name: Mi Carrito Plugin
 * Plugin URI: https://github.com/DavidRVN/mi-carrito-plugin
 * Description: Un plugin de carrito de compras simple para WordPress.
 * Version: 1.0.0
 * Author: David Rios
 * Author URI: https://github.com/DavidRVN/
 */

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}

// Registrar el shortcode [mi_carrito]
function mi_carrito_shortcode() {
    ob_start();
    ?>
    <div id="mi-carrito-container">
        <h2>Mi Carrito</h2>
        <ul id="mi-carrito-lista"></ul>
        <p>Total: <span id="mi-carrito-total">$0.00</span></p>
    </div>
    <script>
        var carritoData = [
            { "id": 1, "nombre": "Producto A", "precio": 10.00, "cantidad": 1 },
            { "id": 2, "nombre": "Producto B", "precio": 15.00, "cantidad": 2 }
        ];
    </script>
    <script src="<?php echo plugin_dir_url(__FILE__) . 'assets/carrito.js'; ?>"></script>
    <?php
    return ob_get_clean();
}
add_shortcode('mi_carrito', 'mi_carrito_shortcode');

// Cargar scripts y estilos
function mi_carrito_scripts() {
    wp_enqueue_style('mi-carrito-css', plugin_dir_url(__FILE__) . 'assets/styles.css');
    wp_enqueue_script('mi-carrito-js', plugin_dir_url(__FILE__) . 'assets/carrito.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mi_carrito_scripts');
