<?php
/**
 * Plugin Name:     Multiple Blocks
 * Description:     Multiple blocks written with ESNext standard and JSX support – build step required.
 * Version:         0.1.0
 * Author:          Steven Simon - Wiley
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

//Enqueue Scripts Here
// function my_script() {
//     wp_enqueue_script(
//         'name',
//         plugins_url('js/file.js', __FILE__),
//         array('jquery'),
//         filemtime( plugin_dir_path( __FILE__ ) . 'js/file.js' ),
//         true
//     );
// }
//add_action('init', 'my_script');

//Register blocks
function create_multiple_blocks_init($blockName) {
	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/blocks/" . $blockName . "/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/multiple-blocks/blocks/' . $blockName . '" block first.'
		);
	}
	$index_js     = 'blocks/' . $blockName . '/build/index.js';
	$script_asset = require( $script_asset_path );
	wp_register_script(
		'create-multiple-blocks-' . $blockName . '-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version']
	);

	$editor_css = 'blocks/' . $blockName . '/editor.css';
	wp_register_style(
		'create-multiple-blocks-' . $blockName . '-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'blocks/' . $blockName . '/style.css';
	wp_register_style(
		'create-multiple-blocks-' . $blockName . '',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'multiple-blocks/' . $blockName . '', array(
		'editor_script' => 'create-multiple-blocks-' . $blockName . '-editor',
		'editor_style'  => 'create-multiple-blocks-' . $blockName . '-editor',
		'style'         => 'create-multiple-blocks-' . $blockName . '',
		'render_callback' => 'custom_gutenberg_render_html_multiple_blocks'
	) );

}
add_action('make_block', 'create_multiple_blocks_init');

//Callback to render content as html
function custom_gutenberg_render_html_multiple_blocks($attributes, $content){
	return html_entity_decode($content);
}

//Custom block category
function multiple_plugin_block_categories( $categories ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'multiple-blocks',
                'title' => __( 'Multiple Blocks', 'multiple-boilerplate' ),
            ],
        ]
    );
}
add_action( 'block_categories', 'multiple_plugin_block_categories');

//Add blocks
do_action('make_block', 'red');
do_action('make_block', 'blue');
