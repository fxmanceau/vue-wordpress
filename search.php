<?php
/***
 * Template Name: Home
 */
get_header();
?>
<custom-cursor></custom-cursor>
<div class="global-search">
    <?php get_template_part( 'template-parts/search/search', 'articles' );?>
</div>
<?php get_footer(); ?>