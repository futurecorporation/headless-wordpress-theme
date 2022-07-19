<?php
/*
 *  Author: Nate Arnold<hello@natearnold.me>, Future Corporation <webmaster@iifuture.com>
 *  Custom functions, support, custom post types and more.
 */


define('HEADLESS_WP_THEME_VERSION', '1.0.0');

add_theme_support("post-thumbnails");

/**
 * Register and Enuque JS and CSS Scripts
 * TODO add timestamps for the last modfied date as their version numbers or figure out a better way to be sure the site is loading the most updated version is cached and we dont get old versions being loaded after purging caches
 */
function headless_wp_theme_enqueue_scripts_styles()
{
    // Register/enqueue core plugin styles
		$site_name = vm_get_current_site_name();

		switch ($site_name) {
			// case "VinylMaster":
			// 	$chosenstylesheet = "vinylmaster-gutenberg-front-end.css";
			// break;
			// case "USCutter";
			// 	$chosenstylesheet = "uscutter-gutenberg-front-end.css";
			// case "SignMaster";
			// 	$chosenstylesheet = "signmaster-gutenberg-front-end.css";
			default:
				$chosenstylesheet = "gutenberg-front-end.css";
				break;
		}
    // if (vm_get_current_site_name() === "VinylMaster")  {
    //     $chosenstylesheet = "mainvinylmaster.css";
    // }
    // else { //Us Cutter theme elsewise
    //     $chosenstylesheet = "uscutter.css";
    // }
    wp_register_style('headless-wp-editor-css', get_theme_file_uri() . '/assets/css/' . $chosenstylesheet, '', HEADLESS_WP_THEME_VERSION, 'screen');

    
    wp_enqueue_style('headless-wp-editor-css');

}

add_action('wp_enqueue_scripts', 'headless_wp_theme_enqueue_scripts_styles');

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

function headless_wp_theme_disable_feed() {
    wp_die( __('No feed available, please visit our <a href="'. get_bloginfo("url") .'">homepage</a>!') );
}

add_action("do_feed", "headless_wp_theme_disable_feed", 1);
add_action("do_feed_rdf", "headless_wp_theme_disable_feed", 1);
add_action("do_feed_rss", "headless_wp_theme_disable_feed", 1);
add_action("do_feed_rss2", "headless_wp_theme_disable_feed", 1);
add_action("do_feed_atom", "headless_wp_theme_disable_feed", 1);
add_action("do_feed_rss2_comments", "headless_wp_theme_disable_feed", 1);
add_action("do_feed_atom_comments", "headless_wp_theme_disable_feed", 1);

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
function headless_wp_theme_block_categories() {
	register_block_pattern_category(
		'future_corporation',
		array('label' => 'Future Corporation') 
	);
}   
add_action( 'init', 'headless_wp_theme_block_categories' );

function headless_wp_themer_block_patterns() {
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

add_action('init', 'headless_wp_theme_block_patterns');