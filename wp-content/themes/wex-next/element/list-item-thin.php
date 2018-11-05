<article class="post post-type-normal" >
    <header class="post-header">
        <h1 class="post-title">
            <a class="post-title-link" href="<?php the_permalink(); ?>" itemprop="url">
                <span itemprop="name"><?php the_title();?></span>
            </a>

        </h1>

        <div class="post-meta">
            <time class="post-time" itemprop="dateCreated">
                <?php the_time('m-d');?>
            </time>
        </div>

    </header>
</article>