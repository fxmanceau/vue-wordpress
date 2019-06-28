<search-articles>
    <div class="search-all-articles">
        <h3 class="all-articles-title">Résultat de la recherche pour <?php echo get_search_query(); ?></h3>
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
                        <h2 class="search-article-title"><?php the_title(); ?></h2>
                        <div class="text-bottom">
                            <?php the_excerpt(); ?>
                            <a href="<?= get_permalink() ?>" class="search-article-link">Lire</a>
                        </div>
                    </div>
                </article>
            <?php
            }
            }
            else {
            ?>
            <span class="search-article-none">Nous n'avons pas trouvé d'article répondant à votre recherche 😢</span>
            <?php
            }
            ?>  
        </div>
    </div>
</search-articles>