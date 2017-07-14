<?php 
namespace App\Traits;

trait StatusCollections{
    public function scopeIncomplete($query){
        return $query->where('status', '<', static::COMPLETED);
    }
    public function scopeComplete($query){
        return $query->where('status', static::COMPLETED);
    }
    public function scopeUnmatched($query){
        return $query->where('status', static::UNMATCHED);
    }
    public function scopePartiallyMatched($query){
        return $query->where('status', static::PARTIALLY_MATCHED);
    }
    public function scopeFullyMatched($query){
    	return $query->where('status', static::FULLY_MATCHED);
    }
}