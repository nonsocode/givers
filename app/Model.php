<?php 

namespace App;



use App\Repositories\Money\Money;
use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
* 
*/
class Model extends EloquentModel
{
	
	public function makeMoneyAttribute($money)
	{
		if (isset($this->attributes[$money])) {
			if (is_object($this->attributes[$money]) && get_class($this->attributes['$money']) == Money::class) {
			}
			else{
				$this->attributes[$money] = isset($this->attributes[$money]) ? new Money($this->attributes[$money]) : new Money();
			}
		} else {
				$this->attributes[$money] = isset($this->attributes[$money]) ? new Money($this->attributes[$money]) : new Money();
		}
		
	}
	public function __get($prop)
	{
		if (property_exists($this, 'money') && in_array($prop, $this->money)) {
			$money = parent::__get($prop);
				if (!(is_object($this->attributes[$prop]) && get_class($this->attributes[$prop]) == Money::class) && !empty($this->attributes[$prop])) {
					return $this->attributes[$prop] = new Money($this->attributes[$prop]);
				}
				 else {
					return $this->attributes[$prop] = new Money() ;
			}
		}
		return parent::__get($prop);
	}
	function __set($prop,$value){
		if (property_exists($this, 'money') && in_array($prop, $this->money)) {
			if (isset($this->attributes[$prop])) {
				if (!(is_object($this->attributes[$prop]) && get_class($this->attributes['$prop']) == Money::class)) {
					$this->attributes[$prop] = new Money($value);
				}
				else{
					$this->attributes[$prop]->amount = $value;
				}
			} else {
					$this->attributes[$prop] = new Money($value) ;
			}
		return $this->attributes[$prop];
		} else {
			return parent::__set($prop,$value);
		}
		
	}
}