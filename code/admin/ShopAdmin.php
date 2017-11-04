<?php

class ShopAdmin extends ModelAdmin {

    private static $url_segment = 'e-commerce';

    private static $menu_title = 'Little Shop';

    private static $managed_models = array(
        'ProductPage',
        'Category',
        'ProductTag'
    );
}

