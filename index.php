<?php get_header(); ?>

			<div class="content">

				<div class="inner-content">

					<main class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : ?>

							<div class="slots">

						<?php while (have_posts()) : the_post();



						if ( is_available() ){ ?>
							<a class="slot" href="<?php the_permalink(); ?>"><?php the_title(); ?><span><?php echo get_availability(); ?></span></a>
						<?php } else { ?>
							<a class="slot unavailable" href="<?php the_permalink(); ?>"><del><?php the_title(); ?></del><span><?php echo get_availability(); ?></span></a>
						<?php }


						endwhile; ?>

							</div>

							<?php else : ?>

									<article id="post-not-found" class="hentry">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the index.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>


						</main>

				</div>

			</div>


<?php get_footer(); ?>
