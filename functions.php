<?php

define('THEME_PATH', get_template_directory());

define('THEME_URL', get_template_directory_uri());
define('DIST_URL', THEME_URL . '/dist');
add_theme_support( 'post-thumbnails' ); 

foreach ( glob( THEME_PATH . "/inc/*.php" ) as $file ) {
    include_once $file;
}
