<?php
/*
Plugin Name: Elementor Test Plugin
Text Domain: elementortestplugin 
*/

use \Elementor\Plugin as Plugin;

// prevent direct access
if (!defined('ABSPATH')) {
    die(__('Direct access is not allowed', 'elementortestplugin'));
}


// plugin structure
final class ElementorTestExtension
{

    const VERSION = "1.0.0";
    const MINIMUM_ELEMENTOR_VERSION = "2.0.0";
    const MINIMUM_PHP_VERSION = "7.0";

    private static $_instance = null;
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        // plugin initial works
        add_action('plugins_loaded', [$this, 'init']);
    }
    //public function on_plugins_loaded() {}
    //public function is_compatible() {
    public function init()
    {
        // load text domain
        load_plugin_textdomain('elementor-test-extension');

        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            // return false;
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
            // return false;
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            // return false;
            return;
        }

        // Add Plugin actions
        add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
        add_action('elementor/elements/categories_registered', [$this, 'register_new_category']); // create category
    }

    public function register_new_category($manager)
    {
        $manager->add_category(
            'testcategory',
            [
                'title' => __('Test Category', 'elementortestplugin'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    public function init_widgets()
    {

        // Include Widget files
        require_once(__DIR__ . '/widgets/test-widget.php'); // create this directory

        // Register widget
        Plugin::instance()->widgets_manager->register_widget_type(new \Elementor_Test_Widget());
    }

    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementortestplugin'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementortestplugin') . '</strong>',
            '<strong>' . esc_html__('PHP', 'elementortestplugin') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function admin_notice_minimum_elementor_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementortestplugin'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementortestplugin') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementortestplugin') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function admin_notice_missing_main_plugin()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementortestplugin'),
            '<strong>' . esc_html__('Elementor Test Extension', 'elementortestplugin') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementortestplugin') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
    public function includes()
    {
    }
}
ElementorTestExtension::instance();
