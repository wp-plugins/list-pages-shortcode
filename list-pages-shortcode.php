<?php
/*
Plugin Name: List Pages Shortcode
Plugin URI: http://www.aaronharp.com/dev/list-pages-shortcode/
Description: Introduces the [list-pages] and [child-pages] <a href="http://codex.wordpress.org/Shortcode_API">shortcodes</a> for easily displaying a list of pages within a post or page.  Both shortcodes accept all parameters that you can pass to the <a href="http://codex.wordpress.org/Template_Tags/wp_list_pages">wp_list_pages()</a> function.  For example, to show a page's child pages sorted by title simply add [child-pages sort_column="post_title"] in the page's content.
Author: Aaron Harp
Version: 1.0
Author URI: http://www.aaronharp.com
*/ 

function shortcode_list_pages($atts, $content, $tag) {
	global $post;
		
	// set defaults
	$defaults = array(
	    'class'       => $tag,
	    'depth'       => 0,
	    'show_date'   => '',
	    'date_format' => get_option('date_format'),
	    'exclude'     => '',
	    'child_of'    => 0,
	    'title_li'    => '',
	    'authors'     => '',
	    'sort_column' => 'menu_order, post_title',
	    'link_before' => '',
	    'link_after'  => '',
	    'exclude_tree'=> ''
	);
	
	// merge user provided atts with defaults
	$atts = shortcode_atts($defaults, $atts);
	
	// set necessary params
	$atts['echo'] = 0;
	if($tag == 'child-pages')
		$atts['child_of'] = $post->ID;	

	// create output
	$out = wp_list_pages($atts);
	if(!empty($out))
		$out = '<ul class="'.$atts['class'].'">' . $out . '</ul>';
	
  return $out;
}

add_shortcode('child-pages', 'shortcode_list_pages');
add_shortcode('list-pages', 'shortcode_list_pages');

?>