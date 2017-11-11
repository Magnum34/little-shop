<?php

class ShopAdmin extends ModelAdmin {

    private static $page_length = 25;
    private static $url_segment = 'e-commerce';

    private static $menu_title = 'Little Shop';

    private static $managed_models = array(
        'ProductPage',
        'ProductCategory',
        'ProductKind',
        'ProductTag'
    );


    public function getList(){
        $list = parent::getList();

        // Filter categories
        if ($this->modelClass == 'ProductCategory') {
            $list = $list->filter('ParentID', 0);
        }

        $this->extend('updateList', $list);

        return $list;
    }


    public function getEditForm($id = null, $fields = null){
        $form = parent::getEditForm($id, $fields);
        $gridField = $form->Fields()->fieldByName($this->modelClass);
        if ($this->modelClass == 'ProductCategory') {
            $gridField->setConfig(new GridFieldConfigCategory(
                $this->modelClass,
                $this->config()->page_length
            ));
        }

        $this->extend("updateEditForm", $form);

        return $form;
    }
}
