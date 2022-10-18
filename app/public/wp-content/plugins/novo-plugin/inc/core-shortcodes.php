<?php
/**
 *  Este arquivo contem os Shortcodes
 * 
 */

if (!defined('WPINC')) {
    die();
}

//[foobar]
function foobar_func($atts){
	return "foo and bar";
}

// [bartag foo="foo-value"]
function bartag_func($atts) {
	$a = shortcode_atts([
		'foo' => 'something',
		'bar' => 'something else',
    ], $atts );

	return "foo = {$a['foo']}";
}

// [caption]My Caption[/caption]
function caption_shortcode( $atts, $content = null ) {
    $text = get_option('np_home_text');
	return '<span class="caption">' . $content . $text . '</span>';
}

// Casos reais de exemplos

//[meu-insta]
function meu_instagram_func($atts){
	return "<a href='https://www.instagram.com/luiz.eduardo.fs/' target='_blank'>Siga meu Instagram</a>";
}

// [button cor="#000000"]
function button_func($atts) {
	$a = shortcode_atts([
		'cor' => '#000000',
        'text' => 'Click'
    ], $atts );

	return "<button class='btn' style='background-color: {$a['cor']}'>{$a['text']}</button>";
}


// Registro de todos os Shortcodes
function np_register_shortcodes() {
    add_shortcode( 'foobar', 'foobar_func' );
    add_shortcode( 'bartag', 'bartag_func' );
    add_shortcode( 'caption', 'caption_shortcode' );
    // Casos reais de exemplos
    add_shortcode( 'meu-insta', 'meu_instagram_func' );
    add_shortcode( 'button', 'button_func' );
}

add_action('init', 'np_register_shortcodes');