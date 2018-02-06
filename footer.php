

        <div id="footer">
            <?php wp_nav_menu(array(
                    'theme_location' => 'footer-nav',
                    'container_class' => 'footer-nav-container'
            )); ?>
        </div>

    <?php wp_footer(); ?>

    <?php $theme_functions = new ThemeFunctions; ?>
    <?php if ($theme_functions->development_mode): ?>
        <?php /** This allows for live reload with grunt watch */ ?>
        <script src="//localhost:35729/livereload.js"></script>
    <?php endif; ?>
    </body>
</html>
