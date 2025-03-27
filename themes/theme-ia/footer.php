<?php
/**
 * O rodapé do tema
 *
 * @package Theme_IA
 */

?>

    <?php do_action('theme_ia_footer'); ?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="site-info">
                <div class="footer-widgets">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <div class="footer-widget">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <div class="footer-widget">
                            <?php dynamic_sidebar('footer-2'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <div class="footer-widget">
                            <?php dynamic_sidebar('footer-3'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="copyright">
                    <p>
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
                    </p>
                </div>
            </div><!-- .site-info -->
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html> 