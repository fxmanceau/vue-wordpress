<?php
/***
 * Template Name: Home
 */
get_header();
?>
<div class="global-home">
    <?php get_template_part( 'template-parts/home/home', 'parallax' );?>
    <?php get_template_part( 'template-parts/home/home', 'articles' );?>
</div>
<?php get_footer(); ?>