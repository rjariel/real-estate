<?php
/**
 * Archive Properties Template
 */
get_header(); ?>

<main id="content" role="main" class="container py-5">
	<header class="archive-header mb-5">
		<?php the_archive_title( '<h1 class="archive-title display-4">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="archive-description lead text-muted">', '</div>' ); ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="row g-4">
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="col-lg-4 col-md-6">
					<article class="card h-100 shadow-sm border-0 hover-shadow">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="card-img-top-link">
								<?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top' ) ); ?>
							</a>
						<?php endif; ?>

						<div class="card-body d-flex flex-column">
							<h2 class="card-title h5 mb-2">
								<a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
									<?php the_title(); ?>
								</a>
							</h2>

							<div class="card-text text-muted mb-3 flex-grow-1">
								<?php the_excerpt(); ?>
							</div>

							<a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm align-self-start">
								View Property &rarr;
							</a>
						</div>
					</article>
				</div>
			<?php endwhile; ?>
		</div>

		<?php get_template_part( 'nav-below' ); ?>
	<?php else : ?>
		<article class="alert alert-info">
			<h2><?php esc_html_e( 'No Properties Found', 'blankslate' ); ?></h2>
			<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help?', 'blankslate' ); ?></p>
			<?php get_search_form(); ?>
		</article>
	<?php endif; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer();
