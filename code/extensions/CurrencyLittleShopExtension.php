<?php 

/**
* Add calculating tax and brutto.
* Configuration Currency. 
* Example: app.yml
* Currency:
*  tax: 0.20
*  currency_symbol: $
*  currency_symbol_right: false
*  dec_point: '.'
*  thousands_sep: ','
*
**/
class CurrencyLittleShopExtension extends DataExtension {

    private static $tax = 0.20;

    private static $currency_symbol_right = false;

    private static $dec_point = '.';

    private static $thousands_sep = ',';

    /**
    * Tax price
    */
    public function getTax($quantity = 1){
        $netto = $this->owner->value;
        $rate = $this->owner->config()->tax;
        $tax = floatval($netto) * ( $rate );
  
        $result = $quantity * $tax;     
        $output = Currency::create(); 
        $output ->setValue($result);
        return $output; 
        
    }

    /**
    * Modification function Nice
    * Change left or right currency symbol.
    * Sets the separator for the decimal point.
    * Sets the thousands separator.
    **/
    public function NiceModifer(){
        $dec_point = $this->owner->config()->dec_point;
        $thousands_sep = $this->owner->config()->thousands_sep;
        if($this->owner->config()->currency_symbol_right){
            $val = number_format(abs($this->owner->value), 2,$dec_point,$thousands_sep).$this->owner->config()->currency_symbol;
        }else{
            $val = $this->owner->config()->currency_symbol.number_format(abs($this->owner->value), 2,$dec_point,$thousands_sep);
        }
		if($this->owner->value < 0) return "($val)";
		else return $val;
    }


    /**
    * Total gross fee
    */
    public function getBruttoTotal($quantity = 1) {
        
        $netto = $this->owner->value;
        $rate =  $this->owner->config()->tax;
        $brutto = floatval($netto) * ( 1 + $rate );
  
        $result = $quantity * $brutto;     
        $output = Currency::create(); 
        $output ->setValue($result);
        return $output; 
        
    }
    
    public function getTaxRate(){
        
        $rate = $this->owner->config()->tax;
        return ($rate*100)."%"; 
          
    }
    
    public function getSymbolCurrency(){
        return  $this->owner->config()->currency_symbol;
    }
    


}