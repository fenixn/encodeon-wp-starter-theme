<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php bloginfo('name'); ?></title>

        <?php wp_head(); ?>
    </head>

    <?php $theme_functions = new ThemeFunctions; ?>
    
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <?php if (get_theme_mod($theme_functions->logo_setting_name)): ?>
                        <div class='site-logo col-6 col-md-5 col-lg-3 px-2'>
                            <a href='<?php echo esc_url(home_url('/')); ?>' 
                                title='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>' 
                                rel='home'>
                                <img class="col-12" src='<?php echo esc_url( get_theme_mod($theme_functions->logo_setting_name)); ?>' 
                                        alt='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>'>
                            </a>
                        </div>
                    <?php else : ?>
                        <div>
                            <h1 class='site-title d-inline'>
                                <a href='<?php echo esc_url(home_url('/')); ?>' title='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>' rel='home'>
                                    <?php bloginfo('name'); ?>
                                </a>
                            </h1>
                            <h2 class='site-description d-inline'><?php bloginfo('description'); ?></h2>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <div class='search-form float-md-right float-none mt-2'>
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <?php wp_nav_menu(array(
                    'theme_location' => 'top-nav',
                    'container_class' => 'navbar',
            )); ?>
        </div>
