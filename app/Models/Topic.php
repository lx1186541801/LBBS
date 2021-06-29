<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];



    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    // 本地作用域
    public function scopeWithOrder($query, $order)
    {
    	switch ($order) {
    		case 'recent':
    			$query->recent();
    			break;
    		
    		default:
    			$query->recentReplied();
    			break;
    	}
    }

    public function scopeRecentReplied($query)
    {
    	return $this->orderBy('updated_at', 'desc');
    }
    public function scopeRecent($query)
    {
    	return $query->orderBy('created_at', 'desc');
    }
}
