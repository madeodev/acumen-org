<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Field Type Settings
    |--------------------------------------------------------------------------
    |
    | Here you can set default field group and field type configuration that
    | is then merged with your field groups when they are composed.
    |
    | This allows you to avoid the repetitive process of setting common field
    | configuration such as `ui` on every `trueFalse` field or your
    | preferred `instruction_placement` on every `fieldGroup`.
    |
    | wpml_cf_preferences values:
    |   Ignore: 0
    |   Copy: 1
    |   Translate: 2
    |   Copy once: 3
    */

    'defaults' => [
        'trueFalse' => [
            'ui' => 1,
            'wpml_cf_preferences' => 3,
        ],
        'select' => [
            'ui' => 1,
            'wpml_cf_preferences' => 3,
        ],
        'repeater' => [
            'layout' => 'block',
            'acfe_repeater_stylised_button' => 1,
            'wpml_cf_preferences' => 3,
        ],
        'radio' => [
            'layout' => 'horizontal',
            'wpml_cf_preferences' => 3,
        ],
        'image' => [
            'return_format' => 'id',
            'wpml_cf_preferences' => 3,
        ],
        'gallery' => [
            'return_format' => 'id',
            'wpml_cf_preferences' => 3,
        ],
        'taxonomy' => [
            'field_type' => 'select',
            'allow_null' => 1,
            'save_terms' => 1,
            'load_terms' => 1,
            'wpml_cf_preferences' => 3,
        ],
        'wysiwyg' => [
            'media_upload' => 0,
            'wpml_cf_preferences' => 2,
        ],
        'textarea' => [
            'new_lines' => 'br',
            'rows' => 2,
            'wpml_cf_preferences' => 2,
        ],
        'relationship' => [
            'wpml_cf_preferences' => 3,
        ],
        'text' => [
            'wpml_cf_preferences' => 2,
        ],
        'number' => [
            'wpml_cf_preferences' => 3,
        ],
        'range' => [
            'wpml_cf_preferences' => 3,
        ],
        'email' => [
            'wpml_cf_preferences' => 3,
        ],
        'url' => [
            'wpml_cf_preferences' => 3,
        ],
        'password' => [
            'wpml_cf_preferences' => 3,
        ],
        'omebed' => [
            'wpml_cf_preferences' => 3,
        ],
        'file' => [
            'wpml_cf_preferences' => 3,
        ],
        'checkbox' => [
            'wpml_cf_preferences' => 3,
        ],
        'link' => [
            'wpml_cf_preferences' => 3,
        ],
        'postObject' => [
            'wpml_cf_preferences' => 3,
        ],
        'pageLink' => [
            'wpml_cf_preferences' => 3,
        ],
        'user' => [
            'wpml_cf_preferences' => 3,
        ],
        'googleMap' => [
            'wpml_cf_preferences' => 3,
        ],
        'datePicker' => [
            'wpml_cf_preferences' => 3,
        ],
        'dateTimePicker' => [
            'wpml_cf_preferences' => 3,
        ],
        'timePicker' => [
            'wpml_cf_preferences' => 3,
        ],
        'colorPicker' => [
            'wpml_cf_preferences' => 3,
        ],
        'message' => [
            'wpml_cf_preferences' => 2,
        ],
        'accordion' => [
            'wpml_cf_preferences' => 3,
        ],
        'tab' => [
            'wpml_cf_preferences' => 3,
        ],
        'group' => [
            'wpml_cf_preferences' => 3,
        ],
        'flexibleContent' => [
            'wpml_cf_preferences' => 3,
        ],
    ],
];
