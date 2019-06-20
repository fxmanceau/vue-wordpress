<?php
add_action('wp_enqueue_scripts', 'scripts');
function scripts () {
    wp_enqueue_script('scripts', DIST_URL . '/main.js', array(), '1.0.0', true);
}