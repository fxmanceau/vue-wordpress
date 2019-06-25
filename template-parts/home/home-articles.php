<home-articles>
    <h2 class="home-intro-articles">L’accessibilité des transports</h2>
    <div class="home-last-articles">
        <h3 class="last-articles-title">Les derniers articles</h3>
        <div class="last-articles-container">
            <?php
            $the_query = new WP_Query( array(
                'posts_per_page' => 3,
            )); 
            if ($the_query->have_posts()){
                while ($the_query->have_posts()){
                    $the_query->the_post();
                ?>
                <article class="articles-item">
                    <div class="item-image">
                        <?=get_the_post_thumbnail($post_id, 'thumbnail'); ?>
                    </div>

                    <div class="item-text">
                        <h2 class="home-article-title"><?php the_title(); ?></h2>
                        <div class="text-bottom">
                            <?php the_excerpt(); ?>
                            <a href="<?= get_permalink() ?>" class="home-article-link">Lire</a>
                        </div>
                    </div>
                </article>
            <?php
            }
            }
            else {
            ?>
            <span class="home-article-none"> Nous n'avons pas trouvé d'article répondant à votre recherche </span>
            <?php
            }
            ?>
        </div>
    </div>
    
    <div class="home-all-articles">
        <h3 class="all-articles-title">L'ensemble des articles</h3>
        <div class="all-articles-container">
        <?php
            if (have_posts()){
                while (have_posts()){
                    the_post();
                ?>
                <article class="articles-item">
                    <div class="item-image">
                        <?=get_the_post_thumbnail($post_id, 'thumbnail'); ?>
                    </div>
                    <div class="item-text">
                        <h2 class="home-article-title"><?php the_title(); ?></h2>
                        <div class="text-bottom">
                            <?php the_excerpt(); ?>
                            <a href="<?= get_permalink() ?>" class="home-article-link">Lire</a>
                        </div>
                    </div>
                </article>
            <?php
            }
            }
            else {
            ?>
            <span class="home-article-none"> Nous n'avons pas trouvé d'article répondant à votre recherche </span>
            <?php
            }
            ?>  
        </div>
    </div>
</home-articles>