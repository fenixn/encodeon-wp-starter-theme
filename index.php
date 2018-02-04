<?php get_header(); ?>

    <main class="container-fluid">
        <div id="content">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class='page-title-container'>
                    <h1><?php the_title(); ?></h1>
                </div>
                <div class='page-content'>
                    <?php the_content(__('(more...)')); ?>
                </div>
            <?php endwhile; else: ?>
                <p><?php _e('The page you are requesting cannot be found.'); ?></p>
            <?php endif; ?>
        </div>
    </div>

<?php get_footer(); ?>
