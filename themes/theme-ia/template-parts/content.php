<?php
/**
 * Template part para exibir posts
 *
 * @package Theme_IA
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
        if (is_singular()) :
            the_title('<h1 class="entry-title">', '</h1>');
        else :
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        endif;

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <span class="posted-on">
                    <?php echo esc_html__('Publicado em', 'theme-ia') . ' '; ?>
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                </span>
                <span class="byline">
                    <?php echo esc_html__('por', 'theme-ia') . ' '; ?>
                    <span class="author vcard"><?php the_author(); ?></span>
                </span>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php if (has_post_thumbnail() && !is_singular()) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large'); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if (is_singular()) :
            the_content();
        else :
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php esc_html_e('Continuar lendo', 'theme-ia'); ?>
            </a>
        <?php endif; ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
        if ('post' === get_post_type()) {
            $categories_list = get_the_category_list(', ');
            if ($categories_list) {
                printf('<span class="cat-links">' . esc_html__('Categorias: %1$s', 'theme-ia') . '</span>', $categories_list);
            }

            $tags_list = get_the_tag_list('', ', ');
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tags: %1$s', 'theme-ia') . '</span>', $tags_list);
            }
        }
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> --> 