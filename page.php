<?php get_header() ?><?php Pupuga\Libs\Message\Message::app()->getMessage() ?><?php $template = (is_shop() || is_checkout() || is_product_category() || is_product() || is_cart() || is_account_page()) ? 'main-shop' : (is_home() ? 'blog-sidebar' : (is_single() ? 'single' : 'main')) ?><?php if ($template == 'single') : ?>    <?php Pupuga\Libs\Files\Files::getTemplatePupuga($template, true); ?><?php else : ?>    <div class="general__simple">        <?php Pupuga\Libs\Files\Files::getTemplatePupuga($template, true); ?>    </div><?php endif ?><?php get_footer() ?>