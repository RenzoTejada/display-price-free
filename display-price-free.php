<?php

/*
  Plugin Name: Display Price Free
  Description:  Display FREE if Price Zero or Empty - WooCommerce Single Product
  Version:     0.0.1
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       rt-price-free
 * Domain Path:       /language
 */

add_filter( 'woocommerce_get_price_html', 'rt_display_price_free_zero_empty', 9999, 2 );
   
function rt_display_price_free_zero_empty( $price, $product ){
    if ( '' === $product->get_price() || 0 == $product->get_price() ) {
        $price = '<span class="woocommerce-Price-amount amount">Gratis</span>';
    }  
    return $price;
}