<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div class="top_sidebar">
		<div class="widget_search">
			<?php get_search_form(); ?>
		</div>
	</div>

	<div class="column column_1">
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<header class="page-header">
					<a class="link-to-home" href="<?php echo get_bloginfo( 'url' )?>">Home</a> / 
					<?php printf( __( 'Search Results for: %s', 'bvsnoticias' ), '<strong class="page-title">' . get_search_query() . '</strong>' ); ?>
				</header><!-- .page-header -->
				<div class="article-list">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<article>
								<header>
									<div class="entry-meta">
										<time class="published" datetime="<?php echo get_the_time(); ?>"><?php the_time('j \d\e F \d\e Y');?> - <?php the_time('H:i'); ?></time>
									</div>
									<h4 class="entry-title">
						                <a href="<?php the_permalink(); ?>" rel="bookmark">
						                  <?php the_title(); ?>
						                </a>
						            </h4>
								</header>
								<?php if (current_theme_supports('post-thumbnails') && has_post_thumbnail()) : ?>
									<div class="thumb-img">
				              			<div class="entry-image">
				                			<a href="<?php the_permalink(); ?>" rel="bookmark">
												<?php the_post_thumbnail('thumbnail', array('class' => 'list-img')); ?>
											</a>
										</div>
									</div>
								<?php endif ?>
								<div class="posttype-content">
									<div class="entry-summary">
										<p>
											<?php echo get_the_excerpt(); ?>
										</p>
									</div>
									<?php 
										$sources = get_the_term_list($post->ID, 'news-source', '', ', '); 
										if ($sources) : ?>
							            <div class="entry-news-sources">
							            	<strong class="entry-source-label"><?php _e('Sources', 'bvsnoticias'); ?>:</strong>
							            	<span class="entry-source-list"><?php echo $sources; ?></span>
							            </div>
							        <?php endif; ?>
							        <?php
										$categories = get_the_term_list($post->ID, 'category', '', ', ');
										if ($categories) :
									?>
										<div class="entry-categories">
											<strong class="entry-cats-label"><?php _e('Categories', 'bvsnoticias'); ?>:</strong>
											<span class="entry-cats-list"><?php echo $categories; ?></span>
										</div>
									<?php endif; ?>

									<?php
										$tags = get_the_term_list($post->ID, 'post_tag', '', ', ');
										if ($tags) :
						            ?>
										<div class="entry-tags">
											<strong class="entry-tags-label"><?php _e('Tags', 'bvsnoticias'); ?>:</strong>
						                <span class="entry-tags-list"><?php echo $tags; ?></span>
						              </div>
						            <?php endif; ?>

							    </div>
								<footer>

			          			</footer>
							</article>
						<?php endwhile; ?>
						<?php else : ?>
							<article id="post-0" class="post no-results not-found">
								<header class="entry-header">
									<h1 class="entry-title"><?php _e( 'Nothing Found', 'bvsnoticias' ); ?></h1>
								</header>

								<div class="entry-content">
									<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'bvsnoticias' ); ?></p>
								</div><!-- .entry-content -->

							</article><!-- #post-0 -->
					<?php endif; ?>
				</div>
			</main><!-- .site-main -->
		</section><!-- .content-area -->
	</div>
	<div class="column column_2">
		<?php dynamic_sidebar( 'level2' ); ?>
	</div>

<?php get_footer(); ?>
