<?php get_header(); ?>

			<div class="content">

				<div class="inner-content">

					<main class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					<h2>Claim your spot:</h2>

						<?php if (have_posts()) : ?>

							<ul>

						<?php while (have_posts()) : the_post();

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
						$available = ( $comments_number < $max_quota ? true : false );

						if ($available){ ?>
							<li><small class="editthis"><?php edit_post_link('<i class="fa fa-pencil"></i>');?></small><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php } else { ?>
							<li><small class="editthis"><?php edit_post_link('<i class="fa fa-pencil"></i>');?></small><del><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></del></li>
						<?php }


						endwhile; ?>

							</ul>

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
