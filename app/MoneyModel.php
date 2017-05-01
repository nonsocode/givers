<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyModel extends Model
{
    public function __get($prop)
    {
	    if (strpos($prop,'pretty')===0) {
	    	$matches = preg_split('/(?=[A-Z])/',$prop);
	    	$_ = count($matches) > 1 ? strtolower(implode('_',array_slice($matches,1))):'';
	    	if ($matches[0]=='pretty' && count($matches) > 1 && isset($this->money) && in_array($_, $this->money)) {
	    		return  "NGN ". number_format($this->{$_},2);
	    	}
    	}	
    	return parent::__get($prop);
    }
}
