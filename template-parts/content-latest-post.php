
  <?php

  $args =  array (

  'post_type' => 'post',
  'paged' => get_query_var('paged'),
  'posts_per_page'=>5,

  );
  ?>

  <?php

  $query = new WP_Query( $args ); ?>

  <?php if ( $query->have_posts() ) : ?>

  <?php while ( $query->have_posts() ) : $query->the_post();?>

    <?php if ( has_post_thumbnail() ) : ?>
      <div class="row latest-post">
      <div class="medium-12 columns">
      <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta float-right">
          <p><strong><span class="fa fa-calendar" aria-hidden="true"></span><?php
          gcc_wp_2018_posted_on();
          ?> </strong></p>
        </div><!-- .entry-meta -->
     <?php endif; ?>
      <p><?php the_excerpt(
        sprintf(
        			wp_kses(
        				/* translators: %s: Name of current post. Only visible to screen readers */
        				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'gcc-wp-2018' ),
        				array(
        					'span' => array(
        						'class' => array(),
        					),
        				)
        			),
        			get_the_title()
        		)

      ); ?></p>

      <?php gcc_wp_2018_entry_footer();  ?>


      </div>
      </div>

    <?php else: ?>

      <div class="row latest-post">
      <div class="medium-12 columns">
      <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta float-right">
          <p><strong><span class="fa fa-calendar" aria-hidden="true"></span><?php
          gcc_wp_2018_posted_on();
          ?> </strong></p>
        </div><!-- .entry-meta -->
    <?php endif; ?>
      <p><?php the_excerpt(

        sprintf(
        			wp_kses(
        				/* translators: %s: Name of current post. Only visible to screen readers */
        				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'gcc-wp-2018' ),
        				array(
        					'span' => array(
        						'class' => array(),
        					),
        				)
        			),
        			get_the_title()
        		)

      ); ?></p>

      </div>
      </div>

<?php endif; ?>

<?php endwhile; ?>

  <?php wp_reset_postdata(); ?>

<?php else : ?>

	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'gcc-wp-2018'); ?></p>

<?php endif; ?>
