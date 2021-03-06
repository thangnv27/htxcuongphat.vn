<?php 
/*
  Template Name: Videos
*/
get_header();
?>

<section class="media-page">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <div class="videos-container">
            <div class="row">
                <?php
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $loop = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 9,
                    'paged' => $paged,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field'    => 'slug',
                            'terms'    => array( 'post-format-video' ),
                        ),
                    ),
                ));
                while ($loop->have_posts()) : $loop->the_post();
                ?>
                <div class="col-sm-4 mb30">
                    <div class="item">
                        <a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                            <?php the_post_thumbnail('600x600') ?>
                        </a>
                        <h3>
                            <a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title(); ?></a>
                        </h3>
                    </div>
                </div>
                <?php
                endwhile;
                wp_reset_query();
                ?>
            </div>
        </div>
        <?php getpagenavi(array( 'query' => $loop )); ?>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>