<?php
add_action('wp_enqueue_scripts', 'styles');
function styles()
{
  wp_register_style('main', DIST_URL.'/main.css');
  wp_enqueue_style('main');
  wp_register_style('typo', 'https://fonts.googleapis.com/css?family=Heebo:100,400,700&display=swap');
  wp_enqueue_style('typo');
}