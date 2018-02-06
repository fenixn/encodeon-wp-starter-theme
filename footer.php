

            <div id="footer">
                <?php wp_nav_menu(array(
                        'theme_location' => 'footer-nav',
                        'container_class' => 'footer-nav-container'
                )); ?>
            </div>
        </main>

    <?php wp_footer(); ?>

    <?php /** This allows for live reload with grunt watch */ ?>
    <script src="//localhost:35729/livereload.js"></script>
    </body>
</html>
