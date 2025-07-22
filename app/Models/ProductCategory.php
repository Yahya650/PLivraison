<?php

namespace App\Models;

use App\Http\Traits\HasAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, HasAttachment, SoftDeletes;


    protected $table = 'product_categories';


    public function products()
    {
        return $this->hasMany(Produit::class, 'category_id');
    }
}
