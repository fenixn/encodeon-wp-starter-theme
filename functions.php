<?php

/**
 * Encodeon Starter Theme
 */
class ThemeFunctions
{
    /**
     * Set development mode to true to prevent caching CSS and JS caching
     * issues when developing the theme.
     * @var bool $development_mode
     */
    public $development_mode = true;

    /**
     * Variables used for the theme settings in WordPress appearance menu.
     * @var string $logo_section_name 
     * @var string $logo_setting_name
     * @var string $favicon_setting_name
     */
    public $logo_section_name, $logo_setting_name, $favicon_setting_name;

    /**
     * The slug for the theme
     * @var string $theme_slug 
     */
    public $theme_slug = "starter_theme";
    
    /**
     * The current version for the theme
     * @var string $theme_version 
     */
    public $theme_version = "0.1.0";
    
    public function __construct() 
    {
        $this->set_setting_names();
    }
    
    /**
     * Set the setting names for the WordPress appearance menu
     */
    private function set_setting_names()
    {
        $this->logo_section_name    = $this->theme_slug . "_logo_section";
        $this->logo_setting_name    = $this->theme_slug . "_logo";
        $this->favicon_setting_name = $this->theme_slug . "_favicon";
    }
    
    /**
     * Basic WordPress setup. Add some theme supports and register the nav menus.
     */
    public function theme_setup()
    {
        /**
         * Enable support for post thumbnails and featured images.
         */
        add_theme_support("post-thumbnails");

        /**
         * Add support for custom navigation menus.
         */
        register_nav_menus(
            array(
                "top-nav"       => __("Top Navigation",     $this->theme_slug),
                "footer-nav"    => __("Footer Naviation",   $this->theme_slug)
            ) 
        );

        /**
         * Enable support for the following post formats:
         * aside, gallery, quote, image, and video
         */
        add_theme_support("post-formats", array("aside", "gallery", "quote", "image", "video"));
        
        /**
         * Set content width for media files
         * The upper limit of the medium size for Bootstrap is 992
         */
        if (!isset($content_width)) $content_width = 992;
    }
    
    /**
     * Add logo controls for the WordPress appearance menu
     */
    public function add_logo_controls($wp_customize)
    {
        $wp_customize->add_section(
            $this->logo_section_name,
            array(
                "title"       => __("Logo & Icons", $this->theme_slug),
                "priority"    => 30,
                "description" => "Set Logo & Icons here",
            )
       );

        $wp_customize->add_setting($this->logo_setting_name);
        $wp_customize->add_setting($this->favicon_setting_name);
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 
                $this->logo_setting_name, 
                array(
                    "label"    => __("Logo", $this->theme_slug),
                    "section"  => $this->logo_section_name,
                    "settings" => $this->logo_setting_name,
                ) 
            ) 
        );
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 
                $this->favicon_setting_name, 
                array(
                    "label"    => __("Favicon", $this->theme_slug),
                    "section"  => $this->logo_section_name,
                    "settings" => $this->favicon_setting_name,
                ) 
            ) 
        );
    }
    
    /**
     * Add the favicon to the page
     */
    public function activate_favicon()
    {
        if (get_theme_mod($this->favicon_setting_name)) 
        {
            echo "<link rel='Shortcut Icon' type='image/x-icon' href='" .
                esc_url(get_theme_mod($this->favicon_setting_name)) . "' />";
        }
    }

    /** 
     * Change frontend to use the version of jQuery stored in node_modules
     */
    public function modify_jquery_version() {
        if (!is_admin()) {
            wp_deregister_script("jquery");
            wp_register_script("jquery",
            get_template_directory_uri() . "/node_modules/jquery/dist/jquery.min.js", false, "3.3.1");
            wp_enqueue_script("jquery");
        }
    }
    
    /** 
     * Enqueue the CSS and JS
     */
    public function enqueue_scripts()
    {
        /**
         * If development mode is on, set the version to the current time.
         * This prevents caching errors when developing.
         */
        if ($this->development_mode) {
            $version = date('mdyGis');
        } else {
            $version = $this->theme_version;
        }

        /** Enqueue Popper */
        wp_enqueue_script(
            "popper",
            get_template_directory_uri() . "/node_modules/popper.js/dist/umd/popper.min.js",
            array(), $version, true
        );

        /** Enqueue Bootstrap */
        wp_enqueue_style(
            "bootstrap",
            get_template_directory_uri() . "/node_modules/bootstrap/dist/css/bootstrap.min.css",
            array(), $version, "all"
        );

        wp_enqueue_script(
            "bootstrap",
            get_template_directory_uri() . "/node_modules/bootstrap/dist/js/bootstrap.min.js",
            array("popper"), $version, true
        );

        /** Enqueue the CSS files */
        wp_enqueue_style(
            "style",
            get_stylesheet_uri(),
            array(), $version, "all"
        );
        wp_enqueue_style(
            "theme-style",
            get_template_directory_uri() . "/dist/css/theme.min.css",
            array(), $version, "all"
        );
        
        /** Enqueue the Javascript files */
        wp_enqueue_script(
            "theme-js",
            get_template_directory_uri() . "/dist/js/theme.min.js",
            array("jquery"), $version, true
        );
    }
    
    /**
     * Remove the css push down caused by the admin bar.
     * This prevents conflict when absolute positioning is used in the theme.
     */
    public function remove_admin_login_header()
    {
        remove_action("wp_head", "_admin_bar_bump_cb");
    }
    
    /** 
     * Remove the WordPress Logo in admin
     */
    public function remove_wp_logo( $wp_admin_bar ) 
    {
        $wp_admin_bar->remove_node('wp-logo');
    }
    
    /**
     * Display the logo set in the WordPress appearances menu on the login page.
     * If the logo has not been set, this method does nothing and the logo will 
     * default to the WordPress logo.
     */
    public function change_login_logo()
    {
        $logo_url = esc_url(get_theme_mod($this->logo_setting_name));
        if (get_theme_mod($this->logo_setting_name)): 
        ?>
            <style type="text/css">
                #login h1 a, .login h1 a {
                    background-image: url(<?php echo $logo_url; ?>);
                    width: 200px;
                    height: 150px;
                    background-size: 200px;
                    padding-bottom: 30px;
                }
            </style>
        <?php 
        endif;
    }
    
    /**
     * Change the login logo to redirect to the home page.
     * Without this, the login logo will redirect to wordpress.org
     */
    public function change_login_logo_url()
    {
        return get_home_url();
    }
    
    /**
     * Change the login logo title to the blog name.
     * Wihtout this, the title will display "Powered by WordPress"
     */
    public function change_login_logo_title() 
    {
        return get_bloginfo("name");
    }
    
    /**
     * All WordPress actions used by the theme
     */
    public function add_actions()
    {
        add_action("init", array($this, "modify_jquery_version"));
        add_action("customize_register", array($this, "add_logo_controls"));
        add_action("wp_head", array($this, "activate_favicon"));
        add_action("login_head", array($this, "activate_favicon"));
        add_action("admin_head", array($this, "activate_favicon"));
        add_action("wp_enqueue_scripts", array($this, "enqueue_scripts"));
        add_action('admin_bar_menu', array($this, 'remove_wp_logo'), 999);
        add_action('login_enqueue_scripts', array($this, 'change_login_logo'));
        add_filter('login_headerurl', array($this, 'change_login_logo_url'));
        add_filter('login_headertitle', array($this, 'change_login_logo_title'));
    }
    
}
$theme_functions = new ThemeFunctions;
$theme_functions->theme_setup();
$theme_functions->add_actions();
