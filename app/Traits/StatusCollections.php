<?php 
namespace App\Traits;

trait StatusCollections{
    public function scopeIncomplete($query){
        return $query->where('status', '<', static::COMPLETED)->get();
    }
    public function scopeComplete($query){
        return $query->where('status', static::COMPLETED)->get();
    }
    public function scopeUnmatched($query){
        return $query->where('status', static::UNMATCHED)->get();
    }
    public function scopePartiallyMatched($query){
        return $query->where('status', static::PARTIALLY_MATCHED)->get();
    }
    public function scopeFullyMatched($query){
    	return $query->where('status', static::FULLY_MATCHED)->get();
    }
}