<?php get_header(); ?>

<?php

    $current_language = strtolower(get_bloginfo('language'));
    $site_lang = substr($current_language, 0,2);

    if ($current_language != ''){
        $current_language = '_' . $current_language;
    }

    $level2 = "level2";

    if(is_plugin_active('multi-language-framework/multi-language-framework.php'))
        $level2 .= $current_language;

?>
	<div class="top_sidebar">
		<div id="nav_menu-2" class="widget widget_nav_menu">
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</div>
		<div class="widget_search">
			<?php get_search_form(); ?>	
		</div>
	</div>
	<div class="column column_1">
		<section id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<header class="page-header">
					<a class="link-to-home" href="<?php echo get_bloginfo( 'url' )?>">Home</a> / 
					<strong class="page-title"><?php $thetitle = $post->post_title; echo substr($thetitle, 0, 26) . ' ...';  ?></strong>
				</header><!-- .page-header -->
			</main>
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-meta">
							<time class="published" datetime="<?php echo get_the_time(); ?>"><?php the_time('j \d\e F \d\e Y');?> - <?php the_time('H:i'); ?></time>
						</div>
						<?php if ( comments_open() ) : ?>
							<div class="comments-link">
								<i class="fa fa-comment reply-icn"></i> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'bvsnoticias' ) . '</span>', __( '1 Reply', 'bvsnoticias' ), __( '% Replies', 'bvsnoticias' ) ); ?> 
							</div><!-- .comments-link -->
						<?php endif; // comments_open() ?>
						<div class="spacer"></div>
						<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
						<div class="featured-post">
							<?php _e( 'Featured post', 'bvsnoticias' ); ?>
						</div>
						<?php endif; ?>
						<header class="entry-header">
							<?php if ( is_single() ) : ?>
							<strong class="entry-title"><?php the_title(); ?></strong>
							<?php else : ?>
							<strong class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bvsnoticias' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
							</strong	>
							<?php endif; // is_single() ?>
						</header><!-- .entry-header -->

						<!-- displays child items -->
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
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
				                <div class="storycontent">
				                        <?php //the_content(__('(more...)')); ?>
				                </div>
					        </div>
						<?php if ( is_search() ) : // Only display Excerpts for Search ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
						<?php else : ?>
						<div class="entry-content">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="news-thumb-img">
									<?php the_post_thumbnail (); ?>
									<span class="img-caption">
										<?php $thumb_img = get_post( get_post_thumbnail_id() ); // Get post by ID
											echo $thumb_img->post_excerpt; // Display Caption
										?>
									</span>
								</div>
							<? endif; ?>
						    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'bvsnoticias' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'bvsnoticias' ), 'after' => '</div>' ) ); ?>
				 		        <div class="childPages">
				                    <ul>
				                    <?php
				                        global $id;
				                        $post_type = get_post_type( $id );
				                        $pages = get_pages( 'post_type=' . $post_type . '&child_of=' . $id . '&parent=' . $id . '&sort_column=' . $order_by );

				                        if ($pages) {
				                            foreach ( $pages as $page ) { ?>

				                                <?php $meta = get_post_meta( $page->ID ); ?>

				                                <li>
				                                    <a href="<?php echo get_permalink( $page->ID ) ?>" rel="bookmark" title="Permanent Link to <?php echo esc_attr(strip_tags($page->post_title)); ?>"><?php echo $page->post_title; ?></a>
				                                    <?php if ($page->post_excerpt) { ?>
				                        				<div class="excerpt">
				                        				    <?php echo '<p>' . $page->post_excerpt;
				                                                if ($meta['_links_to'] && $page->post_content) { ?>
				                        			                <br />
				                                                    <span class="read_more"><a href="javascript:void(0)">[ Read More &rarr; ]</a></span>
				                                                <?php } ?>
				                                            <?php echo '</p>'; ?>
				                        				</div>
				    			                    <?php } ?>
				                                    <?php if ($page->post_content) { ?>
				                    			        <div class="desc <?php echo $single; ?>">
				                    				        <?php echo html_tidy(wpautop($page->post_content)); ?>
				                                            <span class="show_excerpt"><a href="javascript:void(0)">[ &larr; Show Excerpt ]</a></span>
				                    				    </div>
				                			        <?php } ?>
				                                </li>

				                            <?php }
				                        }
				                    ?>
				                    </ul>
				                </div>
						</div><!-- .entry-content -->
						<?php endif; ?>

					</article>






					<?php comments_template( '', true ); ?>
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</section>
	</div>
	
	<div class="column column_2">
		<?php dynamic_sidebar( $level2 ); ?>
	</div>
	
<?php get_footer(); ?>