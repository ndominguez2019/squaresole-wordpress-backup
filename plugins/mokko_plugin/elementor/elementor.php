<?php

class Plugin {

    protected static $instance = null;

    public static function get_instance() {
        if ( ! isset( static::$instance ) ) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    private function include_widgets_files() {
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_image.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_posts.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_sidebar.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_hero_style.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_slider.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_contact_form.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_projects_showcase.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_animated_headline.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_button.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_video_button.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_gallery.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_accordion.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_services.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_skill_bar.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_team_member.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_blockquote.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_google_map.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_pricing_table.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_social_icons.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_text_ticker.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_template.php';
        require_once ms_helper_plugin()->plugin_path . 'blocks/block_simple_link.php';
        
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
    }

    public function register_widgets() {
        $this->include_widgets_files();

        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Animated_Headline() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Image() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Posts() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Sidebar() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Hero_Style() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Slider() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Contact_Form() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Projects() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Button() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Simple_Link() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Video_Button() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Gallery() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Accordion() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Services() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Skill() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Team() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Blockquote() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Google_Map() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Pricing_Table() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Social_Icons() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Text_Ticker() );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Elementor\Widget_MS_Template() );
    }

    public function register_categories( $elements_manager ) {
        $elements_manager->add_category(
            'ms-elements',
            array(
                'title' => esc_html__( 'Mad Sparrow Elements', 'madsparrow' )
            )
        );
        $elements_manager->add_category(
            'ms-showcase',
            array(
                'title' => esc_html__( 'Mad Sparrow Showcase', 'madsparrow' )
            )
        );
        $elements_manager->add_category(
            'ms-site',
            array(
                'title' => esc_html__( 'Mad Sparrow Site', 'madsparrow' )
            )
        );
    }

    public function register_elementor_locations( $elementor_theme_manager ) {
        $elementor_theme_manager->register_location( 'header' );
        $elementor_theme_manager->register_location( 'footer' );
        $elementor_theme_manager->register_location( 'single' );
        $elementor_theme_manager->register_location( 'archive' );
    }

    public function register_editor_styles() {
        wp_enqueue_style( 'ms-elementor-style', plugin_dir_url( __FILE__ ) . '/assets/css/elementor.css', array(), ms_helper_plugin()->plugin_version );
    }

    public function __construct() {
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'register_editor_styles' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
        add_action( 'elementor/theme/register_locations', [ $this, 'register_elementor_locations' ] );
    }

}

// Instantiate Plugin Class
Plugin::get_instance();