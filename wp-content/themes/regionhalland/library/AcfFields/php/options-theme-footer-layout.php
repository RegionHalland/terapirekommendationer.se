<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_56e804931bd1e',
    'title' => 'Footer layout',
    'fields' => array(
        0 => array(
            'multiple' => 0,
            'allow_null' => 0,
            'choices' => array(
                'default' => __('Default style', 'regionhalland'),
                'compressed' => __('Compressed', 'regionhalland'),
            ),
            'default_value' => array(
                0 => 'default',
            ),
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',
            'return_format' => 'value',
            'key' => 'field_5710cd81d4a19',
            'label' => __('Footer layout', 'regionhalland'),
            'name' => 'footer_layout',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'disabled' => 0,
            'readonly' => 0,
        ),
        1 => array(
            'default_value' => 0,
            'message' => __('Enable footer signature', 'regionhalland'),
            'ui' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
            'key' => 'field_56e8050730333',
            'label' => __('Footer signature', 'regionhalland'),
            'name' => 'footer_signature_show',
            'type' => 'true_false',
            'instructions' => __('If enabled a predefined footer signature logo will be appended to the footer.', 'regionhalland'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'acf-options-footer',
            ),
        ),
    ),
    'menu_order' => -100,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
    'local' => 'php',
));
}