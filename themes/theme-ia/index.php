<?php
/**
 * O template principal
 *
 * @package Theme_IA
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                get_template_part('template-parts/content', get_post_type());
            endwhile;

            the_posts_pagination(array(
                'prev_text' => esc_html__('Anterior', 'theme-ia'),
                'next_text' => esc_html__('Próximo', 'theme-ia'),
            ));
        else :
            get_template_part('template-parts/content', 'none');
        endif;
        ?>
    </div>
</main>

<?php
get_sidebar();
get_footer(); 