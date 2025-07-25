<?php

namespace App\Models;

use App\Http\Traits\HasAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produit extends Model
{
    use HasFactory, SoftDeletes, HasAttachment;

    



    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
    public function magasin()
    {
        return $this->belongsTo(Magasin::class, 'magasin_id');
    }
}
