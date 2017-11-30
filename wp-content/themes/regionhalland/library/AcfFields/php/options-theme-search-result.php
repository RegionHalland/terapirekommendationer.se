<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_586df81d53d0f',
    'title' => 'Search results',
    'fields' => array(
        0 => array(
            'layout' => 'horizontal',
            'choices' => array(
                'image' => __('Featured image', 'regionhalland'),
                'date' => __('Published date', 'regionhalland'),
                'lead' => __('Lead', 'regionhalland'),
                'url' => __('Url', 'regionhalland'),
            ),
            'default_value' => array(
                0 => 'date',
                1 => 'lead',
                2 => 'url',
            ),
            'allow_custom' => 0,
            'save_custom' => 0,
            'toggle' => 0,
            'return_format' => 'value',
            'key' => 'field_586df85ba787d',
            'label' => __('Display options', 'regionhalland'),
            'name' => 'search_result_display_options',
            'type' => 'checkbox',
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
            'layout' => 'horizontal',
            'choices' => array(
                'default' => __('Default (list)', 'regionhalland'),
                'grid' => __('Grid', 'regionhalland'),
            ),
            'default_value' => '',
            'other_choice' => 0,
            'save_other_choice' => 0,
            'allow_null' => 0,
            'return_format' => 'value',
            'key' => 'field_5885fd51fe1e4',
            'label' => __('Layout', 'regionhalland'),
            'name' => 'search_result_layout',
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
        2 => array(
            'multiple' => 0,
            'allow_null' => 0,
            'choices' => array(
                'grid-md-12' => __('1', 'regionhalland'),
                'grid-md-6' => __('2', 'regionhalland'),
                'grid-md-4' => __('3', 'regionhalland'),
                'grid-md-3' => __('4', 'regionhalland'),
            ),
            'default_value' => array(
                0 => 'grid-md-12',
            ),
            'ui' => 0,
            'ajax' => 0,
            'placeholder' => '',
            'return_format' => 'value',
            'key' => 'field_5885fd76fe1e5',
            'label' => __('Grid columns', 'regionhalland'),
            'name' => 'search_result_grid_columns',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_5885fd51fe1e4',
                        'operator' => '==',
                        'value' => 'grid',
                    ),
                ),
            ),
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
                'value' => 'acf-options-search',
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