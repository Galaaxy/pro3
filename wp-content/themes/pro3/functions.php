<?php

function add_to_context($data) {

	$data["url"] = get_site_url();

	$data["menu"] = new TimberMenu("new-menu");
	$data["menuFooter"] = new TimberMenu("footer-menu");


	return $data;

}
add_filter('timber_context', 'add_to_context');

function register_my_menu() {
	register_nav_menu('new-menu',__( 'New Menu' ));
}
add_action( 'init', 'register_my_menu' );


function register_my_menus() {
	register_nav_menus(
		array(
			'new-menu' => __( 'Haupt Menu' ),
			'footer-menu' => __( 'Footer Menu' )
		)
	);
}
add_action( 'init', 'register_my_menus' );

/**
 * Customizer additions
 */
require_once get_template_directory() . '/inc/customizer.php';

function my_excerpt_protected( $excerpt ) {
	if ( post_password_required() )
		$excerpt = '<em>[This is password-protected.]</em>';
	return $excerpt;
}

add_filter( 'the_excerpt', 'my_excerpt_protected' );

function my_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "To view this protected post, enter the password below:" ) . '
    <label for="' . $label . '">' . __( "Password:" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
	return $o;
}
add_filter( 'the_password_form', 'my_password_form' );

/**
 * Thumbnail Specifications
 */
add_theme_support( 'post-thumbnails' );
add_image_size('thumbnail-crop', '500', '360', true);

