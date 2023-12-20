<?php
function newshop_ecommerce_theme_setup()
{
  load_child_theme_textdomain('newshop-ecommerce', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'newshop_ecommerce_theme_setup');

function newshop_ecommerce_register_scripts()
{
  $parent_style = 'newstore-style';
  if (function_exists('newstore_get_google_fonts_url')) {
    wp_enqueue_style('newstore-google-font', newstore_get_google_fonts_url(array('Nunito:wght@400;800;900', 'Rubik:wght@400;700')));
  }
  wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
  wp_enqueue_style('newshop-ecommerce-style', get_stylesheet_uri(), array($parent_style));
}
add_action('wp_enqueue_scripts', 'newshop_ecommerce_register_scripts', 15);

function newshop_ecommerce_google_fonts($google_fonts)
{
  return array('Nunito:wght@400;800;900', 'Rubik:wght@400;700');
}
add_filter('newstore_google_fonts_array', 'newshop_ecommerce_google_fonts');

function fastshop_ecommerce_customize_register($wp_customize)
{
  if ($wp_customize->get_setting('newstore_theme_post_title_hover_color')) {
    $wp_customize->get_setting('newstore_theme_post_title_hover_color')->default = '#a9810b';
  }
  if ($wp_customize->get_setting('newstore_theme_post_meta_hover_color')) {
    $wp_customize->get_setting('newstore_theme_post_meta_hover_color')->default = '#a9810b';
  }
}
add_action('customize_register', 'fastshop_ecommerce_customize_register', 999);


function modificar_boton_agregar_al_carrito()
{
  // Reemplaza el siguiente enlace con tu enlace de WhatsApp
  $whatsapp_link = 'https://wa.me/573174865702';

  // Modifica el botón "Agregar al carrito" para que sea un enlace a WhatsApp
  echo '<a href="' . esc_url($whatsapp_link) . '" class="button product_type_simple add_to_cart_button">WhatsApp</a>';
}

// Remueve el gancho existente para el botón "Agregar al carrito"
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Agrega tu función personalizada al gancho
add_action('woocommerce_after_shop_loop_item', 'modificar_boton_agregar_al_carrito', 10);
