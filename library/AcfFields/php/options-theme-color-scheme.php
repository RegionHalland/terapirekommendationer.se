<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_56a0a7dcb5c09',
    'title' => __('Color scheme', 'regionhalland'),
    'fields' => array(
        0 => array(
            'key' => 'field_56a0a7e36365b',
            'label' => __('Color scheme', 'regionhalland'),
            'name' => 'color_scheme',
            'type' => 'radio',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'gray' => __('Gray', 'regionhalland'),
                'red' => __('Red', 'regionhalland'),
                'blue' => __('Blue', 'regionhalland'),
                'green' => __('Green', 'regionhalland'),
                'purple' => __('Purple', 'regionhalland'),
                'familjen' => __('Familjen helsingborg', 'regionhalland'),
                'astorp' => __('Åstorps kommun', 'regionhalland'),
                'hultsfred' => __('Hultsfreds kommun', 'regionhalland'),
            ),
            'allow_null' => 0,
            'other_choice' => 0,
            'save_other_choice' => 0,
            'default_value' => 'gray',
            'layout' => 'vertical',
            'return_format' => 'value',
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'acf-options-theme-options',
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
));
}