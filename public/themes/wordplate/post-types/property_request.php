<?php

/**
 * Registers the `property_request` post type.
 */
function property_request_init() {
	register_post_type( 'property_request', array(
		'labels'                => array(
			'name'                  => __( 'Management Requests', 'wordplate' ),
			'singular_name'         => __( 'Management Request', 'wordplate' ),
			'all_items'             => __( 'All Management Requests', 'wordplate' ),
			'archives'              => __( 'Management Request Archives', 'wordplate' ),
			'attributes'            => __( 'Management Request Attributes', 'wordplate' ),
			'insert_into_item'      => __( 'Insert into Management Request', 'wordplate' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Management Request', 'wordplate' ),
			'featured_image'        => _x( 'Featured Image', 'property_request', 'wordplate' ),
			'set_featured_image'    => _x( 'Set featured image', 'property_request', 'wordplate' ),
			'remove_featured_image' => _x( 'Remove featured image', 'property_request', 'wordplate' ),
			'use_featured_image'    => _x( 'Use as featured image', 'property_request', 'wordplate' ),
			'filter_items_list'     => __( 'Filter Management Requests list', 'wordplate' ),
			'items_list_navigation' => __( 'Management Requests list navigation', 'wordplate' ),
			'items_list'            => __( 'Management Requests list', 'wordplate' ),
			'new_item'              => __( 'New Management Request', 'wordplate' ),
			'add_new'               => __( 'Add New', 'wordplate' ),
			'add_new_item'          => __( 'Add New Management Request', 'wordplate' ),
			'edit_item'             => __( 'Edit Management Request', 'wordplate' ),
			'view_item'             => __( 'View Management Request', 'wordplate' ),
			'view_items'            => __( 'View Management Requests', 'wordplate' ),
			'search_items'          => __( 'Search Management Requests', 'wordplate' ),
			'not_found'             => __( 'No Management Requests found', 'wordplate' ),
			'not_found_in_trash'    => __( 'No Management Requests found in trash', 'wordplate' ),
			'parent_item_colon'     => __( 'Parent Management Request:', 'wordplate' ),
			'menu_name'             => __( 'Management Requests', 'wordplate' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-building',
		'show_in_rest'          => true,
		'rest_base'             => 'property_request',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}

add_action( 'init', 'property_request_init' );
add_action('init', 'init_remove_support', 100);
add_action('add_meta_boxes', 'kma_add_property_meta_boxes');

function init_remove_support(){
    $post_type = 'property_request';
    remove_post_type_support( $post_type, 'editor' );

}

function kma_add_property_meta_boxes()
{

	add_meta_box(
		'first_name',
		'First Name',
		'kma_first_name_metabox',
		'property_request',
		'normal',
		'default'
	);

	add_meta_box(
		'last_name',
		'Last Name',
		'kma_last_name_metabox',
		'property_request',
		'normal',
		'default'
	);

	add_meta_box(
		'email',
		'Email',
		'kma_email_metabox',
		'property_request',
		'normal',
		'default'
	);

	add_meta_box(
		'phone',
		'Phone',
		'kma_phone_metabox',
		'property_request',
		'normal',
		'default'
	);

	add_meta_box(
		'address',
		'Address',
		'kma_address_metabox',
		'property_request',
		'normal',
		'default'
	);

	add_meta_box(
		'comments',
		'Comments',
		'kma_comments_metabox',
		'property_request',
		'normal',
		'default'
	);
}

function kma_first_name_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $first = get_post_meta($post->ID, 'first_name', true);
	// Output the field
	echo '<p>' . $first .'</p>';
}

function kma_last_name_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $last = get_post_meta($post->ID, 'last_name', true);
	// Output the field
	echo '<p>' . $last .'</p>';
}

function kma_phone_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $phone = get_post_meta($post->ID, 'phone', true);
	// Output the field
	echo '<p>' . $phone .'</p>';
}

function kma_address_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $address = get_post_meta($post->ID, 'address', true);
	// Output the field
	echo '<p>' . $address .'</p>';
}

function kma_email_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $email = get_post_meta($post->ID, 'email', true);
	// Output the field
	echo '<a href="mailto:' . $email . '">' . $email .'</a>';
}


function kma_comments_metabox()
{
	global $post;
	// Get the location data if it's already been entered
    $comments = get_post_meta($post->ID, 'comments', true);
	// Output the field
	echo '<p>'. $comments . '</p>';
}

/**
 * Sets the post updated messages for the `property_request` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `property_request` post type.
 */
function property_request_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['property_request'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Management Request updated. <a target="_blank" href="%s">View Management Request</a>', 'wordplate' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'wordplate' ),
		3  => __( 'Custom field deleted.', 'wordplate' ),
		4  => __( 'Management Request updated.', 'wordplate' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Management Request restored to revision from %s', 'wordplate' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Management Request published. <a href="%s">View Management Request</a>', 'wordplate' ), esc_url( $permalink ) ),
		7  => __( 'Management Request saved.', 'wordplate' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Management Request submitted. <a target="_blank" href="%s">Preview Management Request</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Management Request scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Management Request</a>', 'wordplate' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Management Request draft updated. <a target="_blank" href="%s">Preview Management Request</a>', 'wordplate' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'property_request_updated_messages' );
