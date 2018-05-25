<?php
/**
 * Template Name: Page with Sidebar
 *
 * Template Post Type: page, post
 */
?>

<?php get_header() ?>
    <div class="general__page-with-sidebar">
        <?php echo Pupuga\Libs\Files\Files::getTemplatePupuga('main',true) ?>
        <?php echo Pupuga\Libs\Files\Files::getTemplatePupuga('sidebar',true) ?>
    </div>
<?php get_footer() ?>