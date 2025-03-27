<?php
/**
 * A barra lateral do tema
 *
 * @package Theme_IA
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <div class="container">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside><!-- #secondary --> 