<?php


class GridFieldConfigItem extends GridFieldConfig {



    /**
     * GridFieldConfigCategory constructor.
     * @param $className Object Parent, Which subcategory will be added to form
     */
    public function __construct($className,$itemsPerPage = 25){
        parent::__construct();

        $this->addComponent(new GridFieldButtonRow('before'));
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent(new GridFieldDataColumns());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction());
        $this->addComponent(new GridFieldOrderableRows());
        $this->addComponent($sort = new GridFieldSortableHeader());
        $this->addComponent($filter = new GridFieldFilterHeader());
        $this->addComponent(new GridFieldExportButton("buttons-before-right"));
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));


        // Setup Bulk manager
        $manager = new GridFieldBulkManager();
        $manager->removeBulkAction("unLink");


        $this->addComponent($manager);

        $addbutton = new GridFieldAddNewMultiClass("buttons-before-left");
        if(is_array($className)){
            $addbutton->setClasses($className);
            $this->addComponent(new SubItemDetailsForm());
            $addbutton->setItemRequestClass("SubItemDetailsForm_ItemRequest");

        }else {
            $addbutton->setClasses(array($className => $className));
            if($className == "ProductCategory" ){
                $this->addComponent(new SubItemDetailsForm());
                $addbutton->setItemRequestClass("SubItemDetailsForm_ItemRequest");
            }
        }


        $this->addComponent($addbutton);


        $sort->setThrowExceptionOnBadDataType(false);
        $filter->setThrowExceptionOnBadDataType(false);
        $pagination->setThrowExceptionOnBadDataType(false);

    }

}
