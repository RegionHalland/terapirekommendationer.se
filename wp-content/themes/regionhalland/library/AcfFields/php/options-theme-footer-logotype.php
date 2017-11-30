<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_56c5d41852a31',
    'title' => 'Footer logotype',
    'fields' => array(
        0 => array(
            'layout' => 'vertical',
            'choices' => array(
                'standard' => __('Standard', 'regionhalland'),
                'negative' => __('Negative', 'regionhalland'),
                'hide' => __('Hide logotype in footer', 'regionhalland'),
            ),
            'default_value' => 'standard',
            'other_choice' => 0,
            'save_other_choice' => 0,
            'allow_null' => 0,
            'return_format' => 'value',
            'key' => 'field_56c5d41ed3f9f',
            'label' => __('Logotype to use in footer', 'regionhalland'),
            'name' => 'footer_logotype',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
        ),
        1 => array(
            'layout' => 'vertical',
            'choices' => array(
                'top' => __('Above footer content', 'regionhalland'),
                'bottom' => __('Below footer content', 'regionhalland'),
            ),
            'default_value' => 'top',
            'other_choice' => 0,
            'save_other_choice' => 0,
            'allow_null' => 0,
            'return_format' => 'value',
            'key' => 'field_56c5d57ae8167',
            'label' => __('Vertical position', 'regionhalland'),
            'name' => 'footer_logotype_vertical_position',
            'type' => 'radio',
            'instructions' => '',
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
    'menu_order' => 0,
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