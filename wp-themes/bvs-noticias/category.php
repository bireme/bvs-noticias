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

$cat_obj = get_taxonomy( 'category' );
$cat_post_types = $cat_obj->object_type;
$formdata = array( 'post_type' => $cat_post_types );
$build_query = http_build_query($formdata);
$cat_link = get_category_link($cat);
$cat_feed_rss = $cat_link.'feed/?'.$build_query;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts( array( 'post_type' => 'any', 'cat' => $cat, 'paged' => $paged ) );

get_header(); ?>

	<div class="column column_1">
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<header class="page-header">
					<a class="link-to-home" href="<?php echo get_bloginfo( 'url' ); ?>">Home</a> / 
					<?php
						the_archive_title( '<strong class="page-title">', '</strong>' );
					?>
					<div class="rss-icn"><a href="<?php echo $cat_feed_rss; ?>"><i class="fa fa-rss-square"></i> RSS feed</a></div>
				</header><!-- .page-header -->
				<div class="article-list">
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
						            	<strong class="entry-source-label"><?php _e('Sources', 'bvs-noticias'); ?>:</strong>
						            	<span class="entry-source-list"><?php echo $sources; ?></span>
						            </div>
						        <?php endif; ?>
						        <?php
									$categories = get_the_term_list($post->ID, 'category', '', ', ');
									if ($categories) :
								?>
									<div class="entry-categories">
										<strong class="entry-cats-label"><?php _e('Categories', 'bvs-noticias'); ?>:</strong>
										<span class="entry-cats-list"><?php echo $categories; ?></span>
									</div>
								<?php endif; ?>

								<?php
									$tags = get_the_term_list($post->ID, 'post_tag', '', ', ');
									if ($tags) :
					            ?>
									<div class="entry-tags">
										<strong class="entry-tags-label"><?php _e('Tags', 'bvs-noticias'); ?>:</strong>
					                <span class="entry-tags-list"><?php echo $tags; ?></span>
					              </div>
					            <?php endif; ?>

						    </div>
							<footer>

		          			</footer>
						</article>
					<?php endwhile; ?>
				</div>
				
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

			</main><!-- .site-main -->
		</section><!-- .content-area -->
	</div>
	<div class="column column_2">
		<?php dynamic_sidebar( 'level2' ); ?>
	</div>
<?php get_footer(); ?>
