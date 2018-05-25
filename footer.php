</div><!-- general end -->
<footer class="general__footer">
    <div class="general__footer-top">
        <?php Pupuga\Core\Load\Widget::getWidget('Footer area', true, array('class' => 'wrapper-widget wrapper-widget--footer')) ?>
    </div>
    <div class="general__footer-bottom">
        <div class="block-columns skeleton">
            <div class="block-columns__left"><?php echo Pupuga\Libs\Data\Date::getCopyright('2017') ?></div>
            <div class="block-columns__right">
                <?php Pupuga\Libs\Files\Files::getTemplatePupuga('menu', true, array('slug' => 'Helping Pages', 'class' => 'general__menu general__menu--separators')) ?>
            </div>
        </div>
    </div>
</footer><!-- footer end -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
<?php wp_footer() ?>


</body>
</html>
