<?php

function child_after_setup_theme() {
	set_post_thumbnail_size( 1040, 270, true );
}

add_action( 'after_setup_theme', 'child_after_setup_theme', 11 );

function remove_google_fonts() {
	wp_dequeue_style( 'twentythirteen-fonts' );
}

add_action( 'wp_enqueue_scripts', 'remove_google_fonts', 11 );

function change_image_box() {
	if ( $thumbnail_support )
		remove_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', null, 'side', 'low');
		add_meta_box('postimagediv', __('Featured Image (min. 1040px wide)'), 'post_thumbnail_meta_box', null, 'side', 'low');
}

add_action( 'do_meta_boxes', 'change_image_box', 11 );

?>