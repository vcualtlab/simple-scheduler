<?php get_header(); ?>

			<div class="content">

				<div class="inner-content">

					<main class="main" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : ?>

							<ul>

						<?php while (have_posts()) : the_post();

						$comments_number = get_comments_number('0', '1', '1');
						$available = ( $comments_number == '0' ? true : false );

						if ($available){ ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <small><?php edit_post_link('<i class="fa fa-pencil"></i>');?></small></li>
						<?php } else { ?>
							<li><del><?php the_title(); ?></del> <small><?php edit_post_link('<i class="fa fa-pencil"></i>');?></small></li>
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
