<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package gccwp-2018
 */

if ( ! function_exists( 'gcc_wp_2018_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function gcc_wp_2018_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';


		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )

		);

		$posted_on = sprintf (
			/* translators: %s: post date. */
			 esc_html_x( ' %s', 'post date', 'gcc-wp-2018' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'gcc_wp_2018_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function gcc_wp_2018_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'gcc-wp-2018' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<strong><span class="cat-links">' . esc_html__( 'Posted in %1$s', 'gcc-wp-2018' ) . '</span></strong> ', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'gcc-wp-2018' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'gcc-wp-2018' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( '| Edit Page <span class="screen-reader-text">%s</span>', 'gcc-wp-2018' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'gcc_wp_2018_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function gcc_wp_2018_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
		?>
	</a>

	<?php endif; // End is_singular().
}
endif;

// Replaces the excerpt "Read More" text by a link
function new_read_more($more) {
       global $post;
	return '...<br/>
	  <a class="moretag" href="'. get_permalink($post->ID) . '">Read the full article</a>';
}
add_filter('excerpt_more', 'new_read_more');

//custom previous/next links
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="button hollow rounded"';
}