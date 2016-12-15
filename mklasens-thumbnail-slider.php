<?php
defined( 'ABSPATH' ) or die( 'You can\'t access this file directly!');
/**
 * Plugin Name: mklasen's Thumbnail Slider
 * Plugin URI: https://mklasen.com
 * Description: A solution to show your customers product images without them having to go to the product detail page.
 * Version: 1.0
 * Author: Marinus Klasen
 * Author URI: https://mklasen.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 Copyright 2015  Marinus Klasen  (email : marinus@mklasen.nl)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

add_action('wp_enqueue_scripts', 'mk_thumbnail_slider_enqueue_scripts');

function mk_thumbnail_slider_enqueue_scripts() {
	wp_enqueue_style('mk-thumbnail-slider', plugin_dir_url(__FILE__).'css/mklasens-thumbnail-slider.css');
	wp_enqueue_script('mk-thumbnail-slider', plugin_dir_url(__FILE__).'js/mklasens-thumbnail-slider.js', array('jquery'));
}

add_action('woocommerce_before_shop_loop_item', 'mk_alter_thumbnail');

function mk_alter_thumbnail() {
	add_action('woocommerce_before_shop_loop_item_title', 'mk_product_thumbnails');

	// Remove usual thumbnail
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
}

function mk_product_thumbnails() {
	global $product;

	$size = 'shop_catalog';

	$ids = [];

	$image = get_post_thumbnail_id($product->ID);
	$thumbs = $product->get_gallery_attachment_ids();

	if (!$thumbs)
		return false;


	// Push main image to IDS
	array_push($ids, $image);

	// Merge thumbs to IDS
	$merged = array_merge($ids, $thumbs);

	$output = '';

	$output .= '<div class="mk-thumbnail-slider">';
		$output .= '<ul>';
			$output .= '<span class="mk-thumb-nav prev"><</span>';
			foreach($merged as $id) {
				$output .= '<li data-id="'.$id.'">'.wp_get_attachment_image($id, $size).'</li>';
			}
		$output .= '<span class="mk-thumb-nav next">></span>';
			$output .= '</ul>';
	$output .= '</div>';

	echo $output;
}
