<?php

/**
 * Description of ProductsPage
 *
 * @author Magnum34
 */
class ProductsPage extends Page {


    private static $allowed_children = array();

    private static $description = "Main Page Little Shop.";

    private static $icon = './little-shop/images/shopping.png';


	public function getCMSFields() {
		$fields = parent::getCMSFields();
		return $fields;
	}

}

class ProductsPage_Controller extends Page_Controller {

    private $products;

    private static $allowed_actions = array(
        'index', 'details'
    );
	
	private static $url_handlers = array(
        'search' => 'index',
        'details/$URL' => 'details'
	);

    public function getListCategories(){
        $parents = ProductCategory::get()->filter(array("ParentID" => 0));
        $list = array();
        if($parents) {
            foreach ($parents as $parent) {
                $list[] = $parent;
            }
        }
        return new ArrayList($list);
    }

    public function getListKinds(){
        $parents = ProductKind::get()->filter(array("ParentID" => 0));
        $list = array();
        if($parents) {
            foreach ($parents as $parent) {
                $list[] = $parent;
            }
        }
        return new ArrayList($list);
    }

    public function getListTags(){
        return ProductTag::get();
    }

    /**
    * Configuration Filter
    * 
    **/
    public function SearchArrayTo(array $requestSearch){
        $list = array();
        foreach($requestSearch as $key => $value){
            switch($key){
                case "url":
                    break;
                case "category":            
                    $children = DataObject::get_one("ProductCategory","URLSegment = '$value' ")->Children()->column("URLSegment");
                    if(!$children){
                        $children = array();
                    }
                    $children[] = $value;
                    $list["Categories.URLSegment"] = $children;
                default:
                    break;
            }
        }
        $this->extend("updateSearchArrayTo",$list);
        return $list;

    }

    public function index(SS_HTTPRequest $request){
        $searchArray = $this->SearchArrayTo($request->getVars());
        if(count($searchArray) > 0){
            $this->products = Product::get()->filter($searchArray);
        }else{
            $this->products = Product::get();
        }
        

        return $this;
    }
	
	public function details(SS_HTTPRequest $request){
		$URL = $request->param('URL');

        if(!$URL){
			$this->httpError(404);
        }
        $product = DataObject::get_one("Product","URLSegment = '$URL' ");
        if($product){	
		    $this->customise($product);
        }else{
            $this->httpError(404);
        }
		
		return $this->renderWith(array('ProductPage_Details','Page'));
	}

	public function getProducts(){

    }

    public function PaginatedList($limit = 10){
        $pages = new PaginatedList($this->products, $this->getRequest());
        $pages->setPageLength($limit);
        return $pages;
    }
	
}
