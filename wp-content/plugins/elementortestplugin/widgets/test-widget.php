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
                'label' => __('Heading: ', 'elementortestplugin'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Hello World', 'elementortestplugin'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description: ', 'elementortestplugin'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Description', 'elementortestplugin'),
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
            'heading_alignment',
            [
                'label' => __('Heading Alignment', 'elementortestplugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => __('Left', 'elementortestplugin'),
                    'right' => __('Right', 'elementortestplugin'),
                    'center' => __('Center', 'elementortestplugin'),
                ],
                'selectors' => [
                    '{{WRAPPER}} h1.heading' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'description_alignment',
            [
                'label' => __('Description Alignment', 'elementortestplugin'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left'  => __('Left', 'elementortestplugin'),
                    'right' => __('Right', 'elementortestplugin'),
                    'center' => __('Center', 'elementortestplugin'),
                ],
                'selectors' => [
                    '{{WRAPPER}} p.description' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_section();

        // start color section
        $this->start_controls_section(
            'color_section',
            [
                'label' => __('Color', 'elementortestplugin'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => __('Heading: ', 'elementortestplugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#224400',
                'selectors' => [
                    '{{WRAPPER}} h1.heading' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => __('Description: ', 'elementortestplugin'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#888888',
                'selectors' => [
                    '{{WRAPPER}} p.description' => 'color: {{VALUE}}'
                ]
            ]
        );
        // end color section
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $heading = $settings['heading'];
        $description = $settings['description'];
        // for inline editing
        $this->add_inline_editing_attributes('heading', 'none');
        $this->add_render_attribute('heading', [
            'class' => 'heading'
        ]);

        $this->add_inline_editing_attributes('description', 'none');
        $this->add_render_attribute('description', [
            'class' => 'description'
        ]);

        echo "<h1 " . $this->get_render_attribute_string('heading') . ">" . esc_html($heading) . "</h1>";
        echo "<p " . $this->get_render_attribute_string('description') . ">" . wp_kses_post($description) . "</p>";
    }

    protected function _content_template()
    {
?>
        <# console.log(settings); #>
            <# view.addInlineEditingAttributes('heading', 'none' ); view.addRenderAttribute('heading', {'class' : 'heading' }); #>
                <# view.addInlineEditingAttributes('description', 'none' ); view.addRenderAttribute('description', {'class' : 'description' }); #>
                    <h1 {{{view.getRenderAttributeString('heading')}}}>{{{settings.heading}}}</h1>
                    <p {{{view.getRenderAttributeString('description')}}}>{{{settings.description}}}</p>
            <?php
        }
    }
