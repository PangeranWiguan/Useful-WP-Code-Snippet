<?php
/*
	Show Category With New Post (No Repeat)
	by Pangeran Wiguan
	https://pangeranwiguan.com
	Since 22nd July 2023

	I use this for a website that show's TV Series.
    Each episode will be posted inside a category with the TV Series name.
    I want to pull the category which have latest new episode, and do not want to repeat showing the same category if it have more than 1 new episode.

	To be used with WP Code Snippets plugin.
	https://wpcode.com/
	Free version will do.

	OR

	Inside custom plugin.

	OR

	Inside theme function.php files.

*/

// Show recently modified posts
$recently_updated_posts = new WP_Query( array(
	'post_type'      => 'post',
	'posts_per_page' => 100, // not sure how to optimise this, might be expensive pulling 100 pages before sort it.
	'orderby'        => 'modified',
	'order'			 => 'DESC',
	'no_found_rows'  => true, // speed up query when we don't need pagination.
) );
	
	
$counter = 0;
$now_cat = "Now";
//$prev_cat = "Prev";
$the_cat = array();
	
if ( $recently_updated_posts->have_posts() ) :
	
	while( $recently_updated_posts->have_posts() ) : $recently_updated_posts->the_post(); ?>
		
		<?php
		$category = get_the_category();
		$now_cat = esc_html( $category[0]->name );
		
		if ( !in_array($now_cat, $the_cat) and $counter < 5 ) {
		?>
			
			<div class="updated-post" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(),'medium'); ?>);">
				<div class="updated-post-details">
					<a href="<?php the_permalink(); ?>" title="<?php esc_attr( get_the_title() ); ?>">
								
						<?php
						if ( ! empty( $category ) ) {
							
							echo '<h2><a class="card-body-category" href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_html( $category[0]->name ) . '</a></h2>';
							
							$the_cat[] = $now_cat;
						}
						?>
									
									
						<p><?php the_title(); ?></p>
						<p>Updated on: <?php the_modified_date(); ?> at <?php the_modified_time(); ?></p>
					</a>
				</div>
			</div>
			
			<?php
			$counter++;
		}
		
		else {
			// Do Nothing.
		}
		?>
					
	<?php endwhile; ?>
		
	<?php wp_reset_postdata(); ?>
		
<?php endif; ?>