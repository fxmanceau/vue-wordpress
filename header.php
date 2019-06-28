<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="app">
            <header class="header">
                <div class="name">
                    <a href="<?=site_url();?>" class="home-link">Datify</a>
                </div>
                <?php get_search_form(); ?>
            </header>