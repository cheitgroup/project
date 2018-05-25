<aside class="general__sidebar">
    <?php
    $params['sidebar'] = Pupuga\Core\Posts\GetPostMeta::app()->getPostMetaFlex('custom_sidebar');
    if ($params['sidebar'] == '') {
        $params['sidebar'] = 'default';
    }
    Pupuga\Core\Load\Widget::getWidget($params['sidebar'], true, array('class' => 'wrapper-widget wrapper-widget--sidebar'));
    ?>
</aside>