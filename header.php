<!doctype html>
<html>
<head>
    <?php Pupuga\Libs\Files\Files::getTemplatePupuga('meta', true) ?>
    <?php wp_head() ?>
    <?php Pupuga\Libs\Files\Files::getCss(__DIRASSETS__ . 'skeleton.css', true) ?>
</head>
<body class="<?php if (is_front_page()) : ?>front-page<?php else : ?>no-front-page<?php endif ?>">

<div class="surface">
    <div class="veil"></div>
    <div class="spinner"></div>
    <div class="modal">
        <div class="modal__close"></div>
        <div class="modal__data"></div>
    </div>
</div>

<!-- spinner -->
<?php //Pupuga\Libs\Files\Files::getTemplatePupuga('spinner', true) ?>
<!-- spinner end -->
<!-- mobile -->
<?php //Pupuga\Libs\Files\Files::getTemplatePupuga('responsive', true) ?>
<!-- mobile end-->

<!-- general -->
<div class="general">
    <!-- header -->
    <header class="general__header">
        <div class="general__header--top">
            <?php Pupuga\Libs\Files\Files::getTemplatePupuga('menu', true, array('slug' => array('guest' => 'Main Pages', 'user' => 'Main Pages (User)'), 'class' => 'skeleton-narrow general__menu general__menu--right general__menu--purple')) ?>
            <div class="block-cart">
                <div class="cart">
                    <a class="cart-contents"></a>
                </div>
            </div>
        </div>
        <div class="block-columns general__header--bottom skeleton-narrow">
            <div class="block-columns__left">
                <?php Pupuga\Libs\Files\Files::getTemplatePupuga('logo', true, array('class' => 'general__logo')) ?>
            </div>
            <div class="block-columns__right">
                <?php if (wc_memberships_is_user_active_member()) : ?>
                    <?php Pupuga\Libs\Files\Files::getTemplatePupuga('menu', true, array('slug' => 'Services Pages (Members)', 'class' => 'general__menu general__menu--right')) ?>
                <?php else : ?>
                    <?php Pupuga\Libs\Files\Files::getTemplatePupuga('menu', true, array('slug' => 'Services Pages', 'class' => 'general__menu general__menu--right')) ?>
                <?php endif ?>
            </div>
        </div>
        <?php Pupuga\Core\Load\Widget::getWidget('Header area', true, array('class' => 'wrapper-widget general__header--under')) ?>
    </header><!-- header end -->
