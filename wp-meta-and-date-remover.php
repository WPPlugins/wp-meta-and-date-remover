<?php
/*
Plugin Name: WP Meta and Date Remover
Plugin URI: mailto:prasadkirpekar@outlook.com
Description: Remove Meta information such as Author and Date from posts and pages.
Version: 1.3.0
Author: Prasad Kirpekar
Author URI: http://twitter.com.com/kirpekarprasad
License: GPL v2
Copyright: Prasad Kirpekar

	This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function wpmdr_extra_links($links){
	$donate="<a href='https://paypal.me/prasadkirpekar'>Support Development</a>";
	$fiverr="<a href='http://bit.ly/2bzAUb6'>More Customization</a>";
$setting_link = '<a href="../wp-admin/options-general.php?page=wp-meta-and-date-remover.php">Settings</a>';
  
  array_unshift($links, $setting_link);
 
  array_unshift($links, $fiverr);
  array_unshift($links,$donate);
  return $links;
}
$plugin = plugin_basename(__FILE__);

//Removal using css

function wpmdr_inline_style(){
	if(get_option('wpmdr_disable_css')=="0"){
		echo "<style>/* CSS added by WP Meta and Date Remover*/".get_option('wpmdr_css')."</style>";
	}
}
function wpmdr_settings()
{
	$css=get_option('wpmdr_css');
	$disable_php=get_option('wpmdr_disable_php');
	$disable_css=get_option('wpmdr_disable_css');
	$from_=get_option('wpmdr_from_');
	if(isset($_POST['submitted']))
	{
		if(isset($_POST['wpmdr_from_home'])) $from_['home']="1";
		else $from_['home']="0";

		if(isset($_POST['wpmdr_css'])) $css=$_POST['wpmdr_css'];
		
		if(isset($_POST['wpmdr_disable_php'])) $disable_php="1";
		else $disable_php="0";

		if(isset($_POST['wpmdr_disable_css'])) $disable_css="1";
		else $disable_css="0";
		
		update_option('wpmdr_css',$css);
		update_option('wpmdr_disable_php',$disable_php);
		update_option('wpmdr_disable_css',$disable_css);
		update_option('wpmdr_from_',$from_);
		echo '<div class="updated fade"><p>Settings Saved! </p></div>';
	}
	$action_url = $_SERVER['REQUEST_URI'];
	include "admin/options.php";
}

function wpmdr_admin_settings()
{
			add_options_page('WP Meta and Date Remover', 'WP Meta and Date Remover', 'manage_options', basename(__FILE__), 'wpmdr_settings');
	
}
function wpmdr_init_option(){
	$css=".entry-meta {display:none !important;}.home .entry-meta { display: none; }.entry-footer {display:none !important;}.home .entry-footer { display: none; }";
	
	add_option('wpmdr_from_',array('home'=>'1'));
	add_option('wpmdr_css',$css);
	add_option('wpmdr_disable_php',"0");
	add_option('wpmdr_disable_css',"0");
}

function wpmdr_php_filter_option(){
	$from_=get_option('wpmdr_from_');
	if(is_front_page()||is_home()){
		if($from_['home']=="1") wpmdr_remove_meta_php();
		else return;
	}
	else wpmdr_remove_meta_php();
}


function wpmdr_css_filter_option(){
	$from_=get_option('wpmdr_from_');
	if(is_front_page()||is_home()){
		if($from_['home']=="1") wpmdr_inline_style();
		else return;
	}
	else wpmdr_inline_style();
}



// removal using php.
//some times css removal don't work for every theme.
function wpmdr_remove_meta_php() {
	
		if(get_option('wpmdr_disable_php')=="0"){
			add_filter('the_date', '__return_false');
			add_filter('the_author', '__return_false');
			add_filter('the_time', '__return_false');
			add_filter('the_modified_date', '__return_false');
			add_filter('get_the_date', '__return_false');
			add_filter('get_the_author', '__return_false');
			add_filter('get_the_title', '__return_false');
			add_filter('get_the_time', '__return_false');
			add_filter('get_the_modified_date', '__return_false');
		}
	
} 

//do everything 
register_activation_hook(__FILE__, 'wpmdr_init_option');
	
add_action('wp_head','wpmdr_inline_style');
add_filter("plugin_action_links_$plugin", 'wpmdr_extra_links' );
add_action('loop_start', 'wpmdr_php_filter_option');
add_action('admin_menu','wpmdr_admin_settings');