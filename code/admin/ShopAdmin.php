<?php

class ShopAdmin extends ModelAdmin {

    private static $page_length = 25;
    private static $url_segment = 'e-commerce';

    private static $menu_title = 'Little Shop';

    private static $menu_icon = './little-shop/images/shopping.png';

    private static $managed_models = array(
        "Product" => array("title" => "Products"),
        "ProductCategory" => array("title" => "Categories"),
        "ProductKind" => array("title"  => "Kinds"),
        "ProductTag" =>  array("title" => "Tags")
    );


    public function getList(){
        $list = parent::getList();

        // Filter categories
        if ($this->modelClass == 'ProductCategory' || $this->modelClass == 'ProductKind'  ) {
            $list = $list->filter('ParentID', 0);
        }

        $this->extend('updateList', $list);

        return $list;
    }


    public function getEditForm($id = null, $fields = null){
        $form = parent::getEditForm($id, $fields);
        $gridField = $form->Fields()->fieldByName($this->modelClass);
        if ($this->modelClass == 'ProductCategory') {
            $gridField->setConfig(new GridFieldConfigItem(
                $this->modelClass,
                $this->config()->page_length
            ));
        }

        if ($this->modelClass == 'ProductKind') {
            $gridField->setConfig(new GridFieldConfigItem(
                $this->modelClass,
                $this->config()->page_length
            ));
        }

        if($this->modelClass == 'Product' || $this->modelClass == 'ProductTag'){
            $gridField->getConfig()->addComponent(new GridFieldOrderableRows());
            $manager = new GridFieldBulkManager();
            $manager->removeBulkAction("unLink");
            $gridField->getConfig()->addComponent($manager);
        }

        $this->extend("updateEditForm", $form);

        return $form;
    }
}
