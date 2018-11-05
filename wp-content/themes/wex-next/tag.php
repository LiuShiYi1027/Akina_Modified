<?php get_header();?>
<main id="main" class="main">
    <div class="main-inner">
        <div id="content" class="content">
            <section id="posts" class="posts-collapse">
                <span class="archive-move-on"></span>

                <div class="post-tags top">
                    <a class="tag"><?php single_tag_title();?></a>
                </div>
                <?php// echo single_tag_title(); ?>

                <?php
                if (have_posts() ) {while (have_posts() ):the_post();
                    include 'element/list-item-thin.php';

                endwhile;}
                else{
                    if (is_category()){
                        echo '<h4 style="margin-top: 160px;">此处暂无文章</h4>';
                    }
                    if (is_search()){
                        echo '<h4 style="margin-top: 160px;">搜不到你要的东西啊亲</h4>';

                    }
                }
                ?>
            </section>
            <?php wex_pagenavi();?>
        </div>
    </div>
</main>
<?php get_sidebar();?>
<?php get_footer();?>

