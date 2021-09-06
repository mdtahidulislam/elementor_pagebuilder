<?php
class Elementor_Test_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return "TestWidget";
    }

    public function get_title()
    {
        return __("TestWidget", "elementortestplugin");
    }

    public function get_icon()
    {
        return "far fa-image";
    }

    public function get_categories()
    {
        return ['general', 'testcategory'];
    }

    public function get_script_depends()
    {
    }

    public function get_style_depends()
    {
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementortestplugin'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => __('Type Something: ', 'elementortestplugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Hello World', 'elementortestplugin'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'position_section',
            [
                'label' => __('Position', 'elementortestplugin'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __('Alignment', 'elementortestplugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => __('Left', 'elementortestplugin'),
                    'right' => __('Right', 'elementortestplugin'),
                    'center' => __('Center', 'elementortestplugin'),
                ],
            ]
        );
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $heading = $settings['heading'];
        $alignment = $settings['alignment'];
        echo "<h1 style='text-align:" . esc_attr($alignment) . "'>" . esc_html($heading) . "</h1>";
    }

    protected function _content_template()
    {
    }
}
