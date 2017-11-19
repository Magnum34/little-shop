<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2017-11-11
 * Time: 17:58
 */

class SubItemDetailsForm extends  GridFieldDetailForm  {

}

class SubItemDetailsForm_ItemRequest extends GridFieldDetailForm_ItemRequest {

    private static $allowed_actions = array(
        'edit',
        'view',
        'ItemEditForm'
    );

    /**
     *
     * @param GridFIeld $gridField
     * @param GridField_URLHandler $component
     * @param DataObject $record
     * @param Controller $popupController
     * @param string $popupFormName
     */
    public function __construct($gridField, $component, $record, $popupController, $popupFormName)
    {
        parent::__construct(
            $gridField,
            $component,
            $record,
            $popupController,
            $popupFormName
        );
    }

    /**
     * Overload default edit form
     *
     * @return Form
     */
    public  function ItemEditForm() {
        $form = parent::ItemEditForm();

        return $form;
    }

}