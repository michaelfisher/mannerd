<?php

	function theme_styles() {
		wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
	}
	add_action( 'wp_enqueue_scripts', 'theme_styles' );

	function theme_js() {
		global $wp_scripts;

		wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );
		wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );
		
		$wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' );
		$wp_scripts->add_data( 'respond_js', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
	}
	add_action( 'wp_enqueue_scripts', 'theme_js' );

	add_theme_support( 'menus' );

	function register_theme_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu')
			)
		);
	}
	add_action( 'init', 'register_theme_menus' );

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
?>