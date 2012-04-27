<?php
/**
 * FormbuilderX
 *
 * Copyright 2012 by Andrew Smith <a.smith@silentworks.co.uk>
 *
 * @package FormbuilderX
 */
/**
 * The base class for FormbuilderX.
 *
 * @package FormbuilderX
 */
class fbxFields {
    /** @var \modX $modx */
    public $modx;

    function __construct(FormbuilderX &$fbx) {
        $this->fbx =& $fbx;
        $this->modx =& $fbx->modx;
    }

    public function form_input($data ='') {
        $defaults = array('type' => 'text', 'name' => ( ! is_array($data) ? $data : ''), 'value' => $value);
        return '<input ' . $this->_parse_field_attributes($data, $defaults) . '>';
    }

    public function form_textarea($data = '', $value = '', $extra = '') {
        $defaults = array('name' => ( ! is_array($data) ? $data : ''), 'cols' => '40', 'rows' => '10');

        if ( ! is_array($data) OR ! isset($data['value'])) {
            $val = $value;
        } else {
            $val = $data['value'];
            unset($data['value']); // textareas don't use the value attribute
        }

        $name = is_array($data) ? $data['name'] : $data;
        return '<textarea ' . $this->_parse_field_attributes($data, $defaults).'>' . $val . "</textarea>";
    }

    public function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '') {
        // If name is really an array then we'll call the function again using the array
        if (is_array($name) && isset($name['name'])) {
            isset($name['options']) OR $name['options'] = array();
            isset($name['selected']) OR $name['selected'] = array();
            isset($name['extra']) OR $name['extra'] = array();

            return $this->form_dropdown($name['name'], $name['options'], $name['selected'], $name['extra']);
        }

        if ( ! is_array($selected)) {
            $selected = array($selected);
        }

        // If no selected state was submitted we will attempt to set it automatically
        if (count($selected) === 0 && isset($_POST[$name])) {
            $selected = array($_POST[$name]);
        }

        if ($extra != '') $extra = ' '.$extra;

        $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

        $form = '<select name="'.$name.'"'.$extra.$multiple.">\n";

        foreach ($options as $key => $val) {
            $key = (string) $key;

            if (is_array($val) && ! empty($val)) {
                $form .= '<optgroup label="'.$key."\">\n";

                foreach ($val as $optgroup_key => $optgroup_val) {
                    $sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
                    $form .= '<option value="'.$optgroup_key.'"'.$sel.'>'.(string) $optgroup_val."</option>\n";
                }

                $form .= "</optgroup>\n";
            } else {
                $form .= '<option value="'.$key.'"'.(in_array($key, $selected) ? ' selected="selected"' : '').'>'.(string) $val."</option>\n";
        }
    }

    return $form."</select>\n";
    }

    public function form_checkbox($data = '', $value = '', $checked = FALSE, $extra = '') {
        $defaults = array('type' => 'checkbox', 'name' => ( ! is_array($data) ? $data : ''), 'value' => $value);

        if (is_array($data) && array_key_exists('checked', $data)) {
            $checked = $data['checked'];

            if ($checked == FALSE) {
                unset($data['checked']);
            } else {
                $data['checked'] = 'checked';
            }
        }

        if ($checked == TRUE) {
            $defaults['checked'] = 'checked';
        } else {
            unset($defaults['checked']);
        }

        return '<input ' . $this->_parse_field_attributes($data, $defaults) .">";
    }

    private function _parse_field_attributes($attributes, $default = array()) {
        if (is_array($attributes)) {
            foreach ($default as $key => $val) {
                if (isset($attributes[$key])) {
                    $default[$key] = $attributes[$key];
                    unset($attributes[$key]);
                }
            }

            if (count($attributes) > 0) {
                $default = array_merge($default, $attributes);
            }
        }

        $att = '';
        foreach ($default as $key => $val)  {
            $att .= $key.'="'.$val.'" ';
        }

        return rtrim($att);
    }
}
