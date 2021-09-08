## Topic-1
### Create New Category

* add action hook into init function
* create hook function
[see doc](https://developers.elementor.com/widget-categories/)

### Add Control Section

* start section
* add controls
* end section
[see doc](https://developers.elementor.com/add-control-section-to-widgets/)

### Option Selectors (for styling)

### Add Inline Edting Options

* $this->add_inline_editing_attributes('uniquekey', 'none');
* $this->add_render_attribute('uniquekey', [
    'class' => 'classname'
]);
* $this->get_render_attribute_string('uniquekey')   ---> use into render


* view.addInlineEditingAttributes('uniquekey', 'none' ); 
* view.addRenderAttribute('uniquekey', {'class' : 'heading' });
* {{{view.getRenderAttributeString('uniquekey')}}} ---> content template

## Topic-2: Elementor Controls

### Image Control and Image size:
* add section
* render callback
* content template
[media control](https://developers.elementor.com/elementor-controls/media-control/)
[group-contol: Image-size contol](https://developers.elementor.com/elementor-controls/image-size-control/)