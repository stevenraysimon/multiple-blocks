<?php
/**
 * Plugin Name:     Multiple Blocks
 * Description:     Example block written with ESNext standard and JSX support – build step required.
 * Version:         0.1.0
 * Author:          The WordPress Contributors
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     create-block
 *
 * @package         create-block
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */
function create_block_multiple_blocks_red_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/blocks/red/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/multiple-blocks/blocks/red" block first.'
		);
	}
	$index_js     = 'blocks/red/build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-multiple-blocks-red-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$editor_css = 'blocks/red/editor.css';
	wp_register_style(
		'create-block-multiple-blocks-red-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'blocks/red/style.css';
	wp_register_style(
		'create-block-multiple-blocks-red',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'multiple-blocks/red', array(
		'editor_script' => 'create-block-multiple-blocks-red-editor',
		'editor_style'  => 'create-block-multiple-blocks-red-editor',
		'style'         => 'create-block-multiple-blocks-red',
	) );
}
add_action( 'init', 'create_block_multiple_blocks_red_init' );


function create_block_multiple_blocks_blue_init() {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/blocks/blue/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/multiple-blocks/blocks/blue" block first.'
		);
	}
	$index_js     = 'blocks/blue/build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-block-multiple-blocks-blue-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$editor_css = 'blocks/blue/editor.css';
	wp_register_style(
		'create-block-multiple-blocks-blue-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'blocks/blue/style.css';
	wp_register_style(
		'create-block-multiple-blocks-blue',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'multiple-blocks/blue', array(
		'editor_script' => 'create-block-multiple-blocks-blue-editor',
		'editor_style'  => 'create-block-multiple-blocks-blue-editor',
		'style'         => 'create-block-multiple-blocks-blue',
	) );
}
add_action( 'init', 'create_block_multiple_blocks_blue_init' );



// "main": "blocks/red/build/index.js",
