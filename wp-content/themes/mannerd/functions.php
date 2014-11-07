<?php

// Set custom branding icons (favicon, apple-touch-icon, and OpenGraph image)
function custom_favicons() {
   $favicon_path = get_stylesheet_directory_uri() . '/images/favicon.ico' . '?v=1.0';
   $apple_icon_path = get_stylesheet_directory_uri() . '/images/apple-touch-icon.png' . '?v=1.0';
   $og_image_path =  get_stylesheet_directory_uri() . '/images/ogimage.png' . '?v=1.0';
   echo '<link rel="shortcut icon" href="' . $favicon_path . '" />';
   echo '<link rel="apple-touch-icon" href="' . $apple_icon_path . '" />';
   echo '<meta property="og:image" content="' . $og_image_path . '" />';
}

add_action( 'wp_head', 'custom_favicons' ); //front end
add_action( 'admin_head', 'custom_favicons' ); //admin end

// Set custom logo on login page
function custom_login_logo() { ?>
	<style type="text/css">
		body.login div#login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/mannerd-login.png);
			padding-bottom: 30px;
		}
	</style>
<?php }

add_action( 'login_enqueue_scripts', 'custom_login_logo' );

// Set URL for custom logo on login page (defaults to wordpress.org)
function custom_login_logo_url() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_login_logo' );

function custom_login_logo_url_title() {
	return get_bloginfo( 'title' );
}
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );

// Set the post thumbnail size to 1040px x 270px
function child_after_setup_theme() {
	set_post_thumbnail_size( 1040, 270, true );
}

add_action( 'after_setup_theme', 'child_after_setup_theme', 11 );

// Remove support for Gogle Fonts
function remove_google_fonts() {
	wp_dequeue_style( 'twentythirteen-fonts' );
}

add_action( 'wp_enqueue_scripts', 'remove_google_fonts', 11 );

// Update text on Featured Image box to guide user when uploading an image
function change_image_box() {
	if ( $thumbnail_support )
		remove_meta_box('postimagediv', __('Featured Image'), 'post_thumbnail_meta_box', null, 'side', 'low');
		add_meta_box('postimagediv', __('Featured Image (min. 1040px wide)'), 'post_thumbnail_meta_box', 'post', 'side', 'low');
		add_meta_box('postimagediv', __('Featured Image (min. 1040px wide)'), 'post_thumbnail_meta_box', 'page', 'side', 'low');
}

add_action( 'do_meta_boxes', 'change_image_box', 11 );

// Set up custom post meta
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ' ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author (tests for registered author signature or guest author name/signature)
	$author_signature_path = get_stylesheet_directory() . '/images/' . get_the_author_meta('user_login') . '-signature.png';
	$author_signature_image = get_stylesheet_directory_uri() . '/images/' . get_the_author_meta('user_login') . '-signature.png';
	$guest_author = get_post_meta( get_the_ID(), 'Guest Author Name', true );
	$guest_author_signature_path = get_stylesheet_directory() . '/images/' . strtolower( $guest_author ) . '-signature.png';
	$guest_author_signature_image = get_stylesheet_directory_uri() . '/images/' . strtolower( $guest_author ) . '-signature.png';
	if ( 'post' == get_post_type() ) {
		if ( ! empty( $guest_author ) ) {
			if ( file_exists( $guest_author_signature_path ) ) {
				printf( '<span class="author vcard">Posted by: <img class="%1$s-signature" src="%2$s" title="Guest Author: %3$s"></span>',
					strtolower( $guest_author ),
					esc_url( $guest_author_signature_image ),
					$guest_author
				);
			}
			else {
				printf( '<span class="author vcard">Posted by: <span title="Guest Author: %1$s">%1$s</span></span>',
				$guest_author
				);
			}
		}
		elseif ( file_exists( $author_signature_path ) ) {
			printf( '<span class="author vcard">Posted by: <a class="url fn n" href="%1$s" title="%2$s" rel="author"><img class="%3$s-signature" src="%4$s"></a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
				get_the_author_meta('user_login'),
				esc_url( $author_signature_image )
			);
		}
		else {
			printf( '<span class="author vcard">Posted by: <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
				get_the_author()
			);
		}
	}
}

// Change date in footer copyright to Roman numerals
function number_to_roman($num) {
	$n = intval($num);
	$result = "";
	$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

	foreach ($lookup as $roman => $value) {
		$matches = intval($n / $value);
		$result .= str_repeat($roman, $matches);
		$n = $n % $value;
	}

return $result;

}

// Change size of page header image
function remove_twentythirteen_custom_header_setup() {
	wp_dequeue_style( 'twentythirteen_custom_header_setup' );
}

add_action( 'wp_enqueue_scripts', 'remove_twentythirteen_custom_header_setup', 11 );

function modify_twentythirteen_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '220e10',
		'default-image'          => '%s/images/headers/circle.png',

		// Set height and width, with a maximum value for the width.
		'height'                 => 350,
		'width'                  => 1600,

		// Callbacks for styling the header and the admin preview.
		'wp-head-callback'       => 'twentythirteen_header_style',
		'admin-head-callback'    => 'twentythirteen_admin_header_style',
		'admin-preview-callback' => 'twentythirteen_admin_header_image',
	);

	add_theme_support( 'custom-header', $args );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'circle' => array(
			'url'           => '%s/images/headers/circle.png',
			'thumbnail_url' => '%s/images/headers/circle-thumbnail.png',
			'description'   => _x( 'Circle', 'header image description', 'twentythirteen' )
		),
		'diamond' => array(
			'url'           => '%s/images/headers/diamond.png',
			'thumbnail_url' => '%s/images/headers/diamond-thumbnail.png',
			'description'   => _x( 'Diamond', 'header image description', 'twentythirteen' )
		),
		'star' => array(
			'url'           => '%s/images/headers/star.png',
			'thumbnail_url' => '%s/images/headers/star-thumbnail.png',
			'description'   => _x( 'Star', 'header image description', 'twentythirteen' )
		),
	) );
}
add_action( 'after_setup_theme', 'modify_twentythirteen_custom_header_setup', 11 );

// Define the default OpenGraph image
function jeherve_custom_image( $media, $post_id, $args ) {
    if ( $media ) {
        return $media;
    } else {
        $permalink = get_permalink( $post_id );
        $url = apply_filters( 'jetpack_photon_url', 'mannerd.com/ogimage.png' );
     
        return array( array(
            'type'  => 'image',
            'from'  => 'custom_fallback',
            'src'   => esc_url( $url ),
            'href'  => $permalink,
        ) );
    }
}
add_filter( 'jetpack_images_get_images', 'jeherve_custom_image', 10, 3 );

// Remove custom post formats
function remove_post_formats() {
	remove_theme_support('post-formats');
}

add_action ('after_setup_theme', 'remove_post_formats', 11);


?>