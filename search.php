<?php get_header(); ?>

<div id="content">
    <h1>Résultat de votre recherche</h1>
	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php _e( 'Search results for:'); ?>
				</h1>
				<div class="page-description"><?php echo get_search_query(); ?></div>
			</header>

			<?php
                while ( have_posts() ) :
			    	the_post();
			    	get_template_part( 'template-parts/content/content', 'excerpt' );
			    endwhile;

		        else :
		        	get_template_part( 'template-parts/content/content', 'none' );
                
		        endif;
		?>
		</main>
	</section>
</div>

<?php get_footer(); ?>