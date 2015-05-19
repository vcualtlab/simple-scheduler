<?php get_header(); ?>

			<div class="content">

				<div class="inner-content">

					<main class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : ?>

							<div id="searchable" class="slots">

							<input type="text" class="fuzzy-search" placeholder="search..."/>

								<ul class="list">
									<?php while (have_posts()) : the_post();

									if ( is_available() ){ ?>
										<li><a class="slot clearfix" href="<?php the_permalink(); ?>">
											<span class="slot-title"><?php the_title(); ?></span>
											<span class="slot-availability"><?php echo get_availability(); ?> available</span>
										</a></li>

									<?php } else { ?>
										<li><a class="slot unavailable clearfix" href="<?php the_permalink(); ?>">
											<span class="slot-title"><del><?php the_title(); ?></del></span>
											<span class="slot-availability"><?php echo get_availability(); ?> available</span>
										</a></li>
									<?php }

									endwhile; ?>
								</ul>


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
