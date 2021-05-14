<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'cid';
    protected $fillable = ['cname', 'slug'];

    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'parent_category_id');
    }
}