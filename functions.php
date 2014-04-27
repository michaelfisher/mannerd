<?php

add_action( 'after_setup_theme', 'child_after_setup_theme', 11 );

function child_after_setup_theme() {
	set_post_thumbnail_size( 1040, 270, true );
}

add_action( 'do_meta_boxes', 'change_image_box', 11 );

function change_image_box() {
	remove_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', null, 'side', 'low');
	add_meta_box('postimagediv', __('Featured Image (min. 1040px wide)'), 'post_thumbnail_meta_box', null, 'side', 'low');
}
?>