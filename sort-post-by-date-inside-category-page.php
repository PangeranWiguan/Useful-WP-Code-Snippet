<?php
/*
	Sort Categorie's Post by Date
	by Pangeran Wiguan
	https://pangeranwiguan.com
	Since 31 August 2023

	I use this to sort the posts of category page to be sorted by date, ascending, my use case scenario, to sort TV Series by Episode 1 ~ Episode 10, where it shows the first episode first.
	WordPress default sort is to show the newest post first.

	To be used with WP Code Snippets plugin.
	https://wpcode.com/
	Free version will do.

	OR

	Inside custom plugin.

	OR

	Inside theme function.php files.

*/

// Function to modify default WordPress query
function wpb_custom_query( $query ) {

// Make sure we only modify the main query on category page.
	if( $query->is_main_query() && ! is_admin() && $query->is_category() ) {
   
		// Set parameters to modify the query
		$query->set( 'orderby', 'date' );
		$query->set( 'order', 'ASC' );
	}
}
   
// Hook our custom query function to the pre_get_posts 
add_action( 'pre_get_posts', 'wpb_custom_query' );