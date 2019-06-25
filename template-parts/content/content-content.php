<article-page>
    <?php while(have_posts())
    {
        the_post();?>
    <h2 class="article-title"><?php the_title(); ?></h2>
    <div class="article-image">
        <?=get_the_post_thumbnail($post_id, 'thumbnail'); ?>
    </div>
    <div class="article-content">
    <?php the_content(); ?>
    </div>
    <?php } ?>
</article-page>