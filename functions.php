<?php
/*
 *  Author: Nate Arnold<hello@natearnold.me>, Future Corporation <webmaster@iifuture.com>
 *  Custom functions, support, custom post types and more.
 */

add_theme_support( "post-thumbnails" );

function remove_menus() {
//     remove_menu_page( "index.php" ); //Dashboard
    remove_menu_page( "jetpack" ); //Jetpack*
    remove_menu_page( "edit-comments.php" ); //Comments
}

add_action( "admin_menu", "remove_menus" );

// Remove Admin bar
// function remove_admin_bar()
// {
//     return false;
// }

// include_once("functions/custom-post-types.php");
// include_once("functions/custom-shortcodes.php");
// include_once("functions/custom-taxonomies.php");

function headless_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    return array(
        "edit.php?post_type=page", // Pages
        "edit.php", // Posts
        "edit.php?post_type=products", // Products Custom Post Type
        "edit.php?post_type=industry", // industry Custom Post Type
        "separator1", // First separator

        "upload.php", // Media
        "themes.php", // Appearance
        "plugins.php", // Plugins
        "users.php", // Users
        "separator2", // Second separator

        "tools.php", // Tools
        "options-general.php", // Settings
        "separator-last", // Last separator
    );
}
// add_filter( "custom_menu_order", "headless_custom_menu_order", 10, 1 );
// add_filter( "menu_order", "headless_custom_menu_order", 10, 1 );

function headless_disable_feed() {
    wp_die( __('No feed available, please visit our <a href="'. get_bloginfo("url") .'">homepage</a>!') );
}

add_action("do_feed", "headless_disable_feed", 1);
add_action("do_feed_rdf", "headless_disable_feed", 1);
add_action("do_feed_rss", "headless_disable_feed", 1);
add_action("do_feed_rss2", "headless_disable_feed", 1);
add_action("do_feed_atom", "headless_disable_feed", 1);
add_action("do_feed_rss2_comments", "headless_disable_feed", 1);
add_action("do_feed_atom_comments", "headless_disable_feed", 1);

// Return `null` if an empty value is returned from ACF.
// if (!function_exists("acf_nullify_empty")) {
//   function acf_nullify_empty($value, $post_id, $field) {
//       if (empty($value)) {
//           return null;
//       }
//       return $value;
//   }
// }
// add_filter("acf/format_value", "acf_nullify_empty", 100, 3);
function vinylmaster_block_categories() {
	register_block_pattern_category(
		'future_corporation',
		array('label' => 'Future Corporation') 
	);
}   
add_action( 'init', 'vinylmaster_block_categories' );

function vinylmaster_block_patterns() {
	register_block_pattern(
		'tomlayouts/layout1',
		array(
			'title'       => 'Generic Layout 1',
			'description' => 'One Column Layout 1',
			'categories' => ['future_corporation'],
			'content'     => '<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"></p>
			<!-- /wp:paragraph -->			
			<!-- wp:heading {"textAlign":"left"} -->
			<h2 class="has-text-align-left"></h2>
			<!-- /wp:heading -->			
			<!-- wp:heading {"textAlign":"left","level":3} -->
			<h3 class="has-text-align-left"></h3>
			<!-- /wp:heading -->			
			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph -->			
			<!-- wp:heading {"textAlign":"left","level":3} -->
			<h3 class="has-text-align-left"></h3>
			<!-- /wp:heading -->			
			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph -->			
			<!-- wp:separator -->
			<hr class="wp-block-separator has-alpha-channel-opacity"/>
			<!-- /wp:separator -->'
		)
	);

	register_block_pattern(
		'tomlayouts/layout2',
		array(
			'title' => 'Generic Layout 2',
			'description' => 'Two Column Layout 1',
			'categories' => ['future_corporation'],
			'content' => '<!-- wp:paragraph {"align":"center"} -->
			<p class="has-text-align-center"></p>
			<!-- /wp:paragraph -->
			
			<!-- wp:columns {"verticalAlignment":"top"} -->
			<div class="wp-block-columns are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top"} -->
			<div class="wp-block-column is-vertically-aligned-top"><!-- wp:image -->
			<figure class="wp-block-image"><img alt=""/></figure>
			<!-- /wp:image -->
			
			<!-- wp:heading {"textAlign":"left"} -->
			<h2 class="has-text-align-left"></h2>
			<!-- /wp:heading -->
			
			<!-- wp:heading {"textAlign":"left","level":3} -->
			<h3 class="has-text-align-left"></h3>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph -->
			
			<!-- wp:heading {"textAlign":"left"} -->
			<h2 class="has-text-align-left"></h2>
			<!-- /wp:heading -->
			
			<!-- wp:heading {"textAlign":"left","level":3} -->
			<h3 class="has-text-align-left"></h3>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column -->
			
			<!-- wp:column {"verticalAlignment":"top"} -->
			<div class="wp-block-column is-vertically-aligned-top"><!-- wp:image -->
			<figure class="wp-block-image"><img alt=""/></figure>
			<!-- /wp:image -->
			
			<!-- wp:heading {"textAlign":"left"} -->
			<h2 class="has-text-align-left"></h2>
			<!-- /wp:heading -->
			
			<!-- wp:heading {"textAlign":"left","level":3} -->
			<h3 class="has-text-align-left"></h3>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph -->
			
			<!-- wp:heading {"textAlign":"left"} -->
			<h2 class="has-text-align-left"></h2>
			<!-- /wp:heading -->
			
			<!-- wp:heading {"textAlign":"left","level":3} -->
			<h3 class="has-text-align-left"></h3>
			<!-- /wp:heading -->
			
			<!-- wp:paragraph -->
			<p></p>
			<!-- /wp:paragraph --></div>
			<!-- /wp:column --></div>
			<!-- /wp:columns -->
			
			<!-- wp:separator -->
			<hr class="wp-block-separator has-alpha-channel-opacity"/>
			<!-- /wp:separator -->'
		)
	);
}

add_action('init', 'vinylmaster_block_patterns');