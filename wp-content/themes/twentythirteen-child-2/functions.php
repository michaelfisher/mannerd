<?php

add_action( 'after_setup_theme', 'child_after_setup_theme', 11 );

function child_after_setup_theme() {
	set_post_thumbnail_size( 1040, 270, true );
}

?>