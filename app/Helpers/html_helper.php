<?php
helper('html');
if (! function_exists('link_tag')) {
    /**
     * Link
     *
     * Generates link tag
     *
     * @param array<string, bool|string>|string $href      Stylesheet href or an array
     * @param bool                              $indexPage should indexPage be added to the CSS path.
     */
    function link_tag(
        $href = '',
        string $rel = 'stylesheet',
        string $type = 'text/css',
        string $title = '',
        string $media = '',
        bool $indexPage = false,
        string $hreflang = ''
    ): string {
        $attributes = [];
        $class = '';

        if (is_array($href)) {

            $rel       = $href['rel'] ?? $rel;
            $type      = $href['type'] ?? $type;
            $title     = $href['title'] ?? $title;
            $media     = $href['media'] ?? $media;
            $hreflang  = $href['hreflang'] ?? '';
            $indexPage = $href['indexPage'] ?? $indexPage;
            $class      = $href['class'] !== NULL ? 'class="'.$href["class"].'"' : '';

            $href      = $href['href'] ?? '';

        }


        if (! preg_match('#^([a-z]+:)?//#i', $href)) {
            $attributes['href'] = $indexPage ? site_url($href) : slash_item('baseURL') . $href;
        } else {
            $attributes['href'] = $href;
        }

        if ($hreflang !== '') {
            $attributes['hreflang'] = $hreflang;
        }

        $attributes['rel'] = $rel;

        if ($type !== '' && $rel !== 'canonical' && $hreflang === '' && ! ($rel === 'alternate' && $media !== '')) {
            $attributes['type'] = $type;
        }

        if ($media !== '') {
            $attributes['media'] = $media;
        }

        if ($title !== '') {
            $attributes['title'] = $title;
        }


        return '<link '. $class . stringify_attributes($attributes) . _solidus() . '>';
    }
}

if (! function_exists('site_load_css')) {
    function site_load_css():string{
        helper('html'); helper('filesystem');
        $link_tag = '';
        $file_path = base_url('public/assets/');
        $json_file = file_get_contents(ROOTPATH . 'public/assets/config/site-css.json');
        $css_array = json_decode(trim($json_file));
        foreach ($css_array as $css){
            $url_css = $file_path.$css->href;
            if(!empty(parse_url($css->href)['scheme'])){
                $url_css = $css->href;
            }

            $link_tag .= link_tag([
                'href' => $url_css,
                'class' => $css->class
            ]);

        }

        return $link_tag;
    }
}


if (! function_exists('site_render_faq')) {
    function site_render_faq($path_dataset = ''):string{
        $html = '';
        $json_file = file_get_contents(APPPATH . 'Config/dataset/'.$path_dataset);
        $item_array = json_decode(trim($json_file));
        foreach ($item_array as $index => $item){
            $accordion_id = 'accordion-home-faq-'.$index;
            $btn_collapse = form_button([
                'content' => $item->question,
                'class' => 'accordion-button',
                'type' => 'button',
                'data-bs-toggle' => 'collapse',
                'data-bs-target' => '#' . $accordion_id,
                'aria-expanded' => 'true',
                'aria-controls' => $accordion_id
            ]);

            $html .= '<div class="card accordion-item">
                <h2 class="accordion-header">'.$btn_collapse.'</h2>
                <div id="'.$accordion_id.'" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">'.$item->answer.'</div>
                </div>
            </div>';

        }

        return $html;
    }
}

if (! function_exists('site_load_meta_tag')) {
    function site_load_meta_tag():string{
        return "";
    }
}

if (! function_exists('site_load_js')) {
    function site_load_js():string{
        helper('html');
        $link_tag = '';
        $file_path = base_url('public/assets/');
        $json_file = file_get_contents(ROOTPATH . 'public/assets/config/site-js.json');

        $js_array = json_decode(trim($json_file));
        foreach ($js_array as $js){
            $js_data = [
                'src' => $file_path.$js->src,
            ];

            if(!empty(parse_url($js->src)['scheme'])){
                $js_data = ['src' => $js->src];
            }

            if(isset($js->type) && !empty($js->type)){
                $js_data['type'] = $js->type;
            }

            $link_tag .= script_tag($js_data);

        }

        return $link_tag;
    }
}

if (! function_exists('load_single_js_frontend')) {
    function load_single_js_frontend($path_file_js):string{
        helper('html');
        $app_assets_path = base_url('public/assets/js/frontend/' . $path_file_js);
        return script_tag([
            'src' => $app_assets_path,
            "defer" => 'defer'
        ]);
    }
}

if (! function_exists('load_single_js')) {
    function load_single_js($path_file_js):string{
        return script_tag([
            'src' => base_url('public/assets/js/' . $path_file_js),
            "defer" => 'defer'
        ]);
    }
}

if (! function_exists('html_alert_icon')) {
    function html_alert_icon($text = '', $icon='ti ti-check ti-xs', $class_color = 'alert-primary'):string{
        return '<div class="alert '.$class_color.' d-flex align-items-center" role="alert"><span class="alert-icon text-primary me-2"><i class="'.$icon.'"></i></span>'.$text.'</div>';
    }
}
if (! function_exists('small_tag')) {
    function small_tag($content, $attributes):string{
        return '<small '.stringify_attributes($attributes).'> '.$content.'</small>';
    }
}


if (! function_exists('form_custom_option_content')) {
    function form_custom_option_content($text = '', $value='', $attributes = []):string{
        helper('form');
        $radio_tag = form_radio($attributes, $value, $attributes['checked'],);
        $radio_tag .= '<span class="custom-option-header"><span class="h6 mb-0">'.$text.'</span></span>';

        return form_label($radio_tag,$attributes['id'], [
            'class' => 'form-check-label custom-option-content',
        ]);
    }
}

if (! function_exists('mega_dropdown')) {
    function mega_dropdown($text = '', $value='', $attributes = []):string{

    }
}

if (! function_exists('ui_tabs_pills')) {
    function ui_tabs_pills($data = []):string{
        $template = "version1";

        if(isset($data['template'])){
            $template = $data['template'];
        }

        return view('\Modules\Backend\Views\user\\' . $template, [
            'list_header' => $data['list_header'],
            'list_body' => $data['list_body']
        ]);
    }
}

if (! function_exists('ui_tabs_pills')) {
    function nav_item_dropdown_user($data = []):string{
        $template = "version1";

        if(isset($data['template'])){
            $template = $data['template'];
        }

        return view('\Modules\Backend\Views\user\\' . $template, [
            'list_header' => $data['list_header'],
            'list_body' => $data['list_body']
        ]);
    }
}

if (! function_exists('form_switch_checkbox')) {
    function form_switch_checkbox($data = []):string{
        $form_checkbox = form_checkbox([
            'class' => 'switch-input ' . (isset($data['class']) ? $data['class'] : ''),
            'name' => isset($data['name']) ? $data['name'] : '',
            'id' => isset($data['id']) ? $data['id'] : '',
            'vaue' => isset($data['value']) ? $data['value'] : ''
        ]);

        return '<label class="switch switch-primary">
                    '.$form_checkbox.'
                    <span class="switch-toggle-slider">
                          <span class="switch-on">
                            <i class="ti ti-check"></i>
                          </span>
                          <span class="switch-off">
                            <i class="ti ti-x"></i>
                          </span>
                    </span>
                    <span class="switch-label">'.(isset($data["content"]) ? $data["content"] : "").'</span>
                </label>';
    }
}

