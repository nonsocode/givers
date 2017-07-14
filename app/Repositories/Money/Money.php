<?php 

namespace App\Repositories\Money;

/**
* 
*/
class Money 
{
	protected $currency;
	protected $amount;
	protected $withDecimal = true;

	function __construct(float $amount = 0, $currency = "NGN")
	{
		$this->amount = $amount;
		$this->currency = $currency;
	}

	public function __get($item){
		if (property_exists($this, $item) && method_exists($this,'get'.ucfirst(strtolower($item)))) {
			
			return $this->{'get'.ucfirst(strtolower($item))}();
		}
		return null;
	}

	public function __set($item, $value)
	{
		if (property_exists($this,$item) && method_exists($this,'set'.ucfirst(strtolower($item)))) {
			return $this->{'get'.ucfirst(strtolower($item))}();
		}
	}
	public function getAmount()
	{
		if ($this->withDecimal) {
			return $this->amount;
		} else {
			return (int) round($this->amount);
		}
		
	}
	public function removeDecimal()
	{
		$this->withDecimal = false;
		return $this;
	}

	public function showDecimal()
	{
		$this->withDecimal = false;
		return $this;
	}
	public function format()
	{
		if ($this->withDecimal) {
			return $this->currency." ".number_format($this->amount, 2);
		} else {
			return $this->currency." ".$this->getAmount();
		}
		
	}

	public function add($v)
	{
		if (is_int($v) || is_float($v)) {
			$this->amount += $v;
			return $this;
		}
		elseif(is_object($v) && get_class($v) == static::class){
			$this->amount += $v->amount;
			return $this;
		}
	}


	public function subtract($v)
	{
		if (is_int($v) || is_float($v)) {
			$this->amount += $v;
		}
		elseif(is_object($v) && get_class($v) == static::class){
			$this->amount += $v->amount;
		}
	}
	public function increaseByPercent($percent)
	{
		$this->amount += $this*($percent/100);
		return $this;
	}
	public function __toString()
	{
		return $this->format();
	}

}

