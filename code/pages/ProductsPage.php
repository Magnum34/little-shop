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
	  '$Action/$product_url,$ID'
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

    public function index(SS_HTTPRequest $request){

        $this->products = Product::get();

        return $this;
    }
	
	public function details(SS_HTTPRequest $request){
		$product_url=  $request->param('product_url');
		$id = $request->param('ID');
		var_dump($id." , ".$product_url);
		
		//$product = Product::get()->filter();
		
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
