<?php
/**
 * Standard ultimate posts widget template
 *
 * @version     2.0.0
 */

if(function_exists('wp_pagenavi')) {
  global $wp_query;
  $paged = ( isset($_POST['page']) ) ? $_POST['page'] : 1;
  $args = array_merge( $upw_query->query_vars, array( 'paged' => $paged ) );
  query_posts( $args );
  $upw_query = $wp_query;
}
?>

<?php if ($instance['before_posts']) : ?>
  <div class="upw-before">
    <?php echo wpautop($instance['before_posts']); ?>
  </div>
<?php endif; ?>

<div class="upw-posts hfeed">

  <?php if ($upw_query->have_posts()) : ?>

      <?php while ($upw_query->have_posts()) : $upw_query->the_post(); ?>

        <?php $current_post = ($post->ID == $current_post_id && is_single()) ? 'active' : ''; ?>

        <article <?php post_class($current_post); ?>>

          <header>

            <?php if ($instance['show_date'] || $instance['show_author'] || $instance['show_comments']) : ?>

              <div class="entry-meta">

                <?php if ($instance['show_date']) : ?>
                  <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_time($instance['date_format']); ?></time>
                <?php endif; ?>

                <?php if ($instance['show_date'] && $instance['show_author']) : ?>
                  <span class="sep"><?php _e('|', 'bvs-noticias'); ?></span>
                <?php endif; ?>

                <?php if ($instance['show_author']) : ?>
                  <span class="author vcard">
                    <?php echo __('By', 'bvs-noticias'); ?>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn">
                      <?php echo get_the_author(); ?>
                    </a>
                  </span>
                <?php endif; ?>

                <?php if ($instance['show_author'] && $instance['show_comments']) : ?>
                  <span class="sep"><?php _e('|', 'bvs-noticias'); ?></span>
                <?php endif; ?>

                <?php if ($instance['show_comments']) : ?>
                  <a class="comments" href="<?php comments_link(); ?>">
                    <?php comments_number(__('No comments', 'bvs-noticias'), __('One comment', 'bvs-noticias'), __('% comments', 'bvs-noticias')); ?>
                  </a>
                <?php endif; ?>

              </div>

            <?php endif; ?>

            <?php if (get_the_title() && $instance['show_title']) : ?>
              <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php the_title(); ?>
                </a>
              </h2>
            <?php endif; ?>

          </header>
          
          <?php if (current_theme_supports('post-thumbnails') && $instance['show_thumbnail'] && has_post_thumbnail()) : ?>
            <div class="thumb-img">
              <div class="entry-image">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                  <?php the_post_thumbnail($instance['thumb_size']); ?>
                </a>
              </div>
            </div>
          <?php endif; ?>

          <div class="posttype-content">
            <?php if ($instance['show_excerpt']) : ?>
              <div class="entry-summary">
                <p>
                  <?php echo get_the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>" class="more-link"><?php echo $instance['show_readmore'] ? $instance['excerpt_readmore'] : _e('Read more', 'bvs-noticias'); ?></a>
                </p>
              </div>
            <?php elseif ($instance['show_content']) : ?>
              <div class="entry-content">
                <?php the_content() ?>
              </div>
            <?php endif; ?>

            
            <?php
              $sources = get_the_term_list($post->ID, 'news-source', '', ', ');
              if ($instance['show_cats'] && $sources) :
            ?>
              <div class="entry-news-sources">
                <strong class="entry-source-label"><?php _e('Sources', 'bvs-noticias'); ?>:</strong>
                <span class="entry-source-list"><?php echo $sources; ?></span>
              </div>
            <?php endif; ?>

            <?php
            $categories = get_the_term_list($post->ID, 'category', '', ', ');
            if ($instance['show_cats'] && $categories) :
            ?>
              <div class="entry-categories">
                <strong class="entry-cats-label"><?php _e('Categories', 'bvs-noticias'); ?>:</strong>
                <span class="entry-cats-list"><?php echo $categories; ?></span>
              </div>
            <?php endif; ?>

            <?php
            $tags = get_the_term_list($post->ID, 'post_tag', '', ', ');
            if ($instance['show_tags'] && $tags) :
            ?>
              <div class="entry-tags">
                <strong class="entry-tags-label"><?php _e('Tags', 'bvs-noticias'); ?>:</strong>
                <span class="entry-tags-list"><?php echo $tags; ?></span>
              </div>
            <?php endif; ?>


            <?php if ($custom_fields) : ?>
              <?php $custom_field_name = explode(',', $custom_fields); ?>
              <div class="entry-custom-fields">
                <?php foreach ($custom_field_name as $name) :
                  $name = trim($name);
                  $custom_field_values = get_post_meta($post->ID, $name, true);
                  if ($custom_field_values) : ?>
                    <div class="custom-field custom-field-<?php echo $name; ?>">
                      <?php
                      if (!is_array($custom_field_values)) {
                        echo $custom_field_values;
                      } else {
                        $last_value = end($custom_field_values);
                        foreach ($custom_field_values as $value) {
                          echo $value;
                          if ($value != $last_value) echo ', ';
                        }
                      }
                      ?>
                    </div>
                  <?php endif;
                endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

        </article>

      <?php endwhile; ?>

      <?php if(function_exists('wp_pagenavi')) : ?>
        <div class="pagination_container">
          <?php wp_pagenavi( array( 'query' => $upw_query ) ); ?>
          <?php wp_reset_query(); ?>  
        </div>
      <?php endif; ?>

  <?php else : ?>

    <p class="upw-not-found">
      <?php _e('No posts found.', 'bvs-noticias'); ?>
    </p>

  <?php endif; ?>

</div>

<?php if ($instance['after_posts']) : ?>
  <div class="upw-after">
    <?php echo wpautop($instance['after_posts']); ?>
  </div>
<?php endif; ?>