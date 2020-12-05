<?php

/*
  Plugin Name: Display Price Free
  Description:  Display FREE if Price Zero or Empty - WooCommerce Single Product
  Version:     0.0.1
  Author:            Renzo Tejada
  Author URI:        https://renzotejada.com/
 */

add_filter( 'woocommerce_get_price_html', 'rt_display_price_free_zero_empty', 9999, 2 );
   
function rt_display_price_free_zero_empty( $price, $product ){
    if ( '' === $product->get_price() || 0 == $product->get_price() ) {
        $price = '<span class="woocommerce-Price-amount amount">Gratis</span>';
    }  
    return $price;
}