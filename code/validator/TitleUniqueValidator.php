<?php
/**
 * Created by PhpStorm.
 * User: Magnum
 * Date: 2017-11-25
 * Time: 16:42
 */

class TitleUniqueValidator extends RequiredFields {

    private $ClassNameValidator;

    private $objID;

    public function setClassNameValidator($ClassName = ''){
        $this->ClassNameValidator = $ClassName;

    }

    public function setObjID($id = null){
        $this->objID = $id;
    }

    public function php($data) {
        $required = parent::php($data);
        if(array_key_exists("Title",$data)){
            if (empty($data['Title'])) {
                $this->validationError('Title', 'Title is required !', "required");
                $required = false;
            }

            if(isset($data['Title']) && isset($this->ClassNameValidator) && isset($this->objID)){
                $title = $data['Title'];
                $obj = DataObject::get_one($this->ClassNameValidator,array("Title" => $title));
                if($obj){
                    if($obj->ID != $this->objID){
                        $this->validationError('Title', 'Title have to unique !', "required");
                        $required = false;
                    }
                }
            }
        }
        if(array_key_exists("Name",$data)) {
            if (empty($data['Name'])) {
                $this->validationError('Name', 'Name is required !', "required");
                $required = false;
            }

            if(isset($data['Name']) && isset($this->ClassNameValidator) && isset($this->objID)){
                $name = $data['Name'];
                $obj = DataObject::get_one($this->ClassNameValidator,array("Name" => $name));
                if($obj) {
                    if ($obj->ID != $this->objID) {
                        $this->validationError('Name', 'Name have to unique !', "required");
                        $required = false;
                    }
                }
            }
        }




        return $required;
    }

}