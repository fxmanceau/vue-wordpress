<?php

define('THEME_PATH', get_template_directory());

define('THEME_URL', get_template_directory_uri());
define('DIST_URL', THEME_URL . '/dist');
add_theme_support( 'post-thumbnails' ); 
add_filter('jpeg_quality', function($arg){return 100;});

foreach ( glob( THEME_PATH . "/inc/*.php" ) as $file ) {
    include_once $file;
}

function wpdocs_my_search_form( $form ) {
    $form = '<form role="search" method="get" class="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input type="text" value="' . get_search_query() . '" name="s" class="search-box" placeholder="Rechercher" />
    <input type="submit" class="search-submit" value="&#x203A;" />
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'wpdocs_my_search_form' );

function add_meta_tags() {
    echo '<meta name="viewport" content="width=device-width,initial-scale=1">';
  }
  add_action('wp_head', 'add_meta_tags');