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
        <main class="container-fluid">
            <div id="header" class="col-12 p-0">
                <div class='row mx-0 mt-2'>
                    <div class="col-md-6 mb-2">
                        <div class="row">
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
                                    <h1 class='site-title'>
                                        <a href='<?php echo esc_url(home_url('/')); ?>' title='<?php echo esc_attr(get_bloginfo('name', 'display')); ?>' rel='home'>
                                            <?php bloginfo('name'); ?>
                                        </a>
                                    </h1>
                                    <h2 class='site-description'><?php bloginfo('description'); ?></h2>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <div class='search-form float-md-right float-none'>
                            <?php get_search_form(); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row-fluid">
                <div id='category-menu-container'>
                    <?php wp_nav_menu(
                        array(
                            'theme_location' => 'top-category-menu',
                            'container_class' => 'top-category-menu-container'
                        )
                    ); ?>
                </div>
            </div>
