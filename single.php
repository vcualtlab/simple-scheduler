<?php get_header(); ?>

			<div class="content">

				<div class="inner-content">

					<main class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

			                <header class="article-header entry-header">

			                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
								<?php
									if ( function_exists('get_field') ){
										$global_max_quota = get_field('max_quota', 'option');
										$specific_max_quota = get_field('max_quota');

										if ( $specific_max_quota ){
											$max_quota = $specific_max_quota;
										} elseif ( $global_max_quota ){
											$max_quota = $global_max_quota;
										} else {
											$max_quota = 1;
										}

									} else {
										$max_quota = 1;
									}

									$comments_number = get_comments_number();
									$available_spots = $max_quota - $comments_number;

									if ( $available_spots <= 0 ){
										$message = "0 of ".$max_quota." available";
									} else {
										$message = $available_spots." of ".$max_quota." available";
									}
								?>

			                  <p><?php echo $message;?></p>
			                </header> <?php // end article header ?>

			                <section class="entry-content cf" itemprop="articleBody">
			                  <?php
			                    // the content (pretty self explanatory huh)
			                    the_content();

			                  ?>
			                </section> <?php // end article section ?>

			                <?php comments_template(); ?>

			                <a href="<?php echo get_site_url(); ?>">Back to full list.</a>
			              </article> <?php // end article ?>


						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
