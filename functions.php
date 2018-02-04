<?php

/**
 * Encodeon Starter Theme
 */

class EncodeonThemeFunctions
{
    private $theme_slug = "starter_theme";
    public $logo_section_name, $logo_setting_name, $favicon_setting_name;
    
    public function __construct() 
    {
        add_action("init", array($this, "modify_jquery_version"));
        $this->set_variables();
        $this->theme_setup();
        $this->add_actions();
    }
    
    private function set_variables()
    {
        $this->logo_section_name    = $this->theme_slug . "_logo_section";
        $this->logo_setting_name    = $this->theme_slug . "_logo";
        $this->favicon_setting_name = $this->theme_slug . "_favicon";
    }
    
    private function theme_setup()
    {
        /**
         * Make theme available for translation.
         * Translations can be placed in the /languages/ directory.
         */
        load_theme_textdomain($this->theme_slug, get_template_directory() . "/languages");

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
         */
        if (!isset($content_width)) $content_width = 992;
    }
    
    public function manage_logo_icons($wp_customize)
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
    function modify_jquery_version() {
        if (!is_admin()) {
            wp_deregister_script("jquery");
            wp_register_script("jquery",
            get_template_directory_uri() . "/node_modules/jquery/dist/jquery.min.js", false, "3.3.1");
            wp_enqueue_script("jquery");
        }
    }
    
    public function enqueue_scripts()
    {
        /** Enqueue the CSS files */
        wp_enqueue_style(
            "style",
            get_stylesheet_uri(),
            array(), "1.00", "all"
        );
        wp_enqueue_style(
            "theme_style",
            get_template_directory_uri() . "/css/style.css",
            array(), "1.079", "all"
        );
        wp_enqueue_style(
            "theme_responsive",
            get_template_directory_uri() . "/css/responsive.css",
            array(), "1.017", "all"
        );
        
        /** Enqueue the js files */
        wp_enqueue_script(
            "general-js",
            get_template_directory_uri() . "/js/general.js",
            array("jquery"),
            "1.010",
            true
        );
    }
    
    function remove_admin_login_header()
    {
        remove_action("wp_head", "_admin_bar_bump_cb");
    }
    
    private function add_actions()
    {
        add_action("customize_register", array($this, "manage_logo_icons"));
        add_action("wp_head", array($this, "activate_favicon"));
        add_action("login_head", array($this, "activate_favicon"));
        add_action("admin_head", array($this, "activate_favicon"));
        add_action("wp_enqueue_scripts", array($this, "enqueue_scripts"));
    }
    
}

$theme_functions = new EncodeonThemeFunctions;
