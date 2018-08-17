<?php
/*
 * This file adds ACF controlled fields on pages.
 * 
 */

 // support page attributes
// Don't die if ACF isn't installed
if ( function_exists( 'acf_add_local_field_group' ) ) {
    add_action( 'acf/init', 'registerFields' );
}

function registerFields(){

    // ACF Group: Page Details
    acf_add_local_field_group( array (
        'key'      => 'group_page_details',
        'title'    => 'Page Details',
        'location' => array (
            array (
                array (
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'page',
                )
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
    ) );

    // Image
    acf_add_local_field( array(
        'key'           => 'header_image',
        'label'         => 'Header Image',
        'name'          => 'header_image',
        'type'          => 'image',
        'parent'        => 'group_page_details',
        'instructions'  => '',
        'required'      => 0,
        'return_format' => 'array',
        'preview_size'  => 'large',
        'library'       => 'all',
        'min_width'     => 0,
        'min_height'    => 0,
        'max_width'     => 0,
        'max_height'    => 0,
    ) );

    // Headline
    acf_add_local_field( array(
        'key'          => 'headline',
        'label'        => 'Headline',
        'name'         => 'headline',
        'type'         => 'text',
        'parent'       => 'group_page_details',
        'instructions' => '',
        'required'     => 0,
    ) );

    // Content Image
    acf_add_local_field( array(
        'key'           => 'content_image',
        'label'         => 'Featured Content Image',
        'name'          => 'content_image',
        'type'          => 'image',
        'parent'        => 'group_page_details',
        'instructions'  => '',
        'required'      => 0,
        'return_format' => 'array',
        'preview_size'  => 'medium',
        'library'       => 'all',
        'min_width'     => 0,
        'min_height'    => 0,
        'max_width'     => 0,
        'max_height'    => 0,
        'location' => array (
            array (
                array (
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'page',
                ),
                array (
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                )
            ),
        ),
    ) );

    // ACF Group: Home Page Feature Box1
    acf_add_local_field_group( array (
        'key'      => 'group_feat_box_1',
        'title'    => 'Feature Box 1',
        'location' => array (
            array (
                array (
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                )
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
    ) );

    // Feature Box 1 Headline
    acf_add_local_field( array(
        'key'          => 'feat_1_headline',
        'label'        => 'Headline',
        'name'         => 'feat_1_headline',
        'type'         => 'text',
        'parent'       => 'group_feat_box_1',
        'instructions' => '',
        'required'     => 0,
    ) );

    // Feature Box 1 Content
    acf_add_local_field( array(
        'key'          => 'feat_1_text',
        'label'        => 'Content',
        'name'         => 'feat_1_text',
        'type'         => 'textarea',
        'parent'       => 'group_feat_box_1',
        'instructions' => '',
        'required'     => 0,
    ) );

    // Feature Box 1 Link
    acf_add_local_field( array(
        'key'          => 'feat_1_link',
        'label'        => 'Link',
        'name'         => 'feat_1_link',
        'type'         => 'link',
        'parent'       => 'group_feat_box_1',
        'instructions' => '',
        'required'     => 0,
    ) );

    // ACF Group: Home Page Feature Box 2
    acf_add_local_field_group( array (
        'key'      => 'group_feat_box_2',
        'title'    => 'Feature Box 2',
        'location' => array (
            array (
                array (
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                )
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
    ) );

    // Feature Box 1 Headline
    acf_add_local_field( array(
        'key'          => 'feat_2_headline',
        'label'        => 'Headline',
        'name'         => 'feat_2_headline',
        'type'         => 'text',
        'parent'       => 'group_feat_box_2',
        'instructions' => '',
        'required'     => 0,
    ) );

    // Feature Box 2 Content
    acf_add_local_field( array(
        'key'          => 'feat_2_text',
        'label'        => 'Content',
        'name'         => 'feat_2_text',
        'type'         => 'textarea',
        'parent'       => 'group_feat_box_2',
        'instructions' => '',
        'required'     => 0,
    ) );

    // Feature Box 2 Link
    acf_add_local_field( array(
        'key'          => 'feat_2_link',
        'label'        => 'Link',
        'name'         => 'feat_2_link',
        'type'         => 'link',
        'parent'       => 'group_feat_box_2',
        'instructions' => '',
        'required'     => 0,
    ) );

    // ACF Group: Home Page Feature Box 3
    acf_add_local_field_group( array (
        'key'      => 'group_feat_box_3',
        'title'    => 'Feature Box 3',
        'location' => array (
            array (
                array (
                    'param'    => 'page_type',
                    'operator' => '==',
                    'value'    => 'front_page',
                )
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
    ) );

    // Feature Box 3 Headline
    acf_add_local_field( array(
        'key'          => 'feat_3_headline',
        'label'        => 'Headline',
        'name'         => 'feat_3_headline',
        'type'         => 'text',
        'parent'       => 'group_feat_box_3',
        'instructions' => '',
        'required'     => 0,
    ) );

    // Feature Box 3 Content
    acf_add_local_field( array(
        'key'          => 'feat_3_text',
        'label'        => 'Content',
        'name'         => 'feat_3_text',
        'type'         => 'textarea',
        'parent'       => 'group_feat_box_3',
        'instructions' => '',
        'required'     => 0,
    ) );

    // Feature Box 3 Link
    acf_add_local_field( array(
        'key'          => 'feat_3_link',
        'label'        => 'Link',
        'name'         => 'feat_3_link',
        'type'         => 'link',
        'parent'       => 'group_feat_box_3',
        'instructions' => '',
        'required'     => 0,
    ) );
}
