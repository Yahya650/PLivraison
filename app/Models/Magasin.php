<?php

namespace App\Models;

use App\Http\Traits\HasAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Magasin extends Model
{
    use HasFactory, HasAttachment, SoftDeletes;


    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class, 'magasin_id');
    }
    public function products()
    {
        return $this->hasMany(Produit::class, 'magasin_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
