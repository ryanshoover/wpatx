<?php

/**
 * Shortcodes
 *
 * This file creates all the shortcodes used throughout the site.
 *
 * @package      BE_Genesis_Child
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */
 
 
// Use shortcodes in widgets
add_filter('widget_text', 'do_shortcode');


add_shortcode('url','be_url_shortcode');
/**
 * URL Shortcode
 *
 * @param	null
 * @return	string	Site URL
 */
function be_url_shortcode($atts) {
	return get_bloginfo('url');
}

add_shortcode('wpurl','be_wpurl_shortcode');
/**
 * WP URL Shortcode
 *
 * @param	null
 * @return	string	WordPress URL
 */
function be_wpurl_shortcode($atts) {
	return get_bloginfo('wpurl');
}

add_shortcode('child', 'be_child_shortcode');
/**
 * Child Shortcode
 *
 * @param	null
 * @return	string	Child Theme URL
 */
function be_child_shortcode($atts) {
	return get_bloginfo('stylesheet_directory');
}

add_shortcode('link','link_shortcode');
function link_shortcode($atts) {
	extract(shortcode_atts(array('href' => '', 'class' => '' ), $atts));
	if ($href) $show_href = ' href="'.$href.'"';
	if ($class) $show_class = ' class="'.$class.'"';
	return '<a '.$show_href.$show_class.'>';
}
add_shortcode('close-link','close_link_shortcode');
function close_link_shortcode($atts) {
	return '</a>';
}
add_shortcode('img','img_shortcode');
function img_shortcode($atts) {
	extract(shortcode_atts(array('src' => '', 'alt' => '' ), $atts));
	if ($src) $show_src = ' src="'.$src.'"';
	if ($alt) $show_alt = ' alt="'.$alt.'"';
	return '<img '.$show_src.$show_alt.' />';
}

add_shortcode('span','span_shortcode');
function span_shortcode($atts) {
	extract(shortcode_atts(array( 'class' => '' ), $atts));
	if ($class) $show_class = ' class="'.$class.'"';
	return '<span '.$show_class.'>';
}
add_shortcode('close-span','close_span_shortcode');
function close_span_shortcode($atts) {
	return '</span>';
}

add_shortcode('hr','hr_shortcode');
function hr_shortcode($atts) {
	return '<hr />';
}

add_shortcode('copyright','copyright_shortcode');
function copyright_shortcode($atts) {
	extract(shortcode_atts(array('class' => '', 'id' => '' ), $atts));
	if ($class) $show_class = ' class="'.$class.'"';
	if ($id) $show_id = ' id="'.$id.'"';
	return '<span'.$show_class.$show_id.'>Copyright '.date('Y').' &copy; <a href="http://www.valentinehr.com/">Valentine HR</a></span>';
}

// USTREAM Shortcode
add_shortcode('ustream', 's25_ustream_shortcode');
function s25_ustream_shortcode($atts) {
	extract(shortcode_atts(array( 'src' => '','width' => '','height' => ''), $atts));
	
	if ($src) $show_src = esc_url(preg_replace('/recorded/','/embed/$0',$src), array('http'));
	if ($width) $show_width = ' width="'.$width.'"';
	if ($height) $show_height = ' height="'.$height.'"';
	
	return '<iframe src="'.$show_src.'" '.$show_width.$show_height.'  scrolling="no" frameborder="0" style="border: 0px none transparent;"></iframe>';
}

// Vimeo Shortcode
add_shortcode('vimeo', 's25_vimeo_shortcode');
function s25_vimeo_shortcode($atts) {
	extract(shortcode_atts(array( 'src' => '','width'  => '','height'  => ''), $atts));
	if ($src) $show_src = esc_url(str_replace('http://vimeo.com/','http://player.vimeo.com/video/',$src), array('http'));
	if ($width) $show_width = ' width="'.$width.'"';
	if ($height) $show_height = ' height="'.$height.'"';

	return '<iframe src="'.$show_src.'?title=0&amp;byline=0&amp;portrait=0" '.$show_width.$show_height.' frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
}

// Youtube Shortcode
add_shortcode('youtube', 's25_youtube_shortcode');
function s25_youtube_shortcode($atts) {
	extract(shortcode_atts(array( 'src' => '','width'  => '','height'  => ''), $atts));
	if ($src) $show_src = esc_url(str_replace('watch?v=','embed/',$src), array('http'));
	
	if ($width) $show_width = ' width="'.$width.'"';
	if ($height) $show_height = ' height="'.$height.'"';
	return '<iframe '.$show_width.$show_height.' src="'.$show_src.'" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>';
}

