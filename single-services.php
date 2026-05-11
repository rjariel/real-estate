<?php
/**
 * Single Service Template
 */
get_header(); ?>

<main id="content" role="main">
	<article <?php post_class( 'container py-5' ); ?>>
		<header class="entry-header mb-4">
			<h1 class="entry-title display-4"><?php the_title(); ?></h1>
			<div class="entry-meta text-muted">
				<?php blankslate_posted_on(); ?>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<figure class="entry-featured-image mb-4">
				<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid rounded' ) ); ?>
			</figure>
		<?php endif; ?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>

		<?php if ( is_user_logged_in() ) : ?>
			<footer class="entry-footer mt-4 pt-4 border-top">
				<small class="text-muted">
					<?php
					edit_post_link(
						sprintf(
							wp_kses_post( __( 'Edit <span class="screen-reader-text">%s</span>', 'blankslate' ) ),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</small>
			</footer>
		<?php endif; ?>
	</article>

	<?php comments_template(); ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer();
