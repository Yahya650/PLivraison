<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Http\Traits\HasAttachment;

class CommandProduct extends Model
{
    use HasFactory, HasAttachment;

    protected $fillable = [
        'command_id',
        'product_id',
        'magasin_id',
        'category_id',
        'product_category_id',
        'quantity',
        'remise',
        'prix_remise',
        'unit_price',
        'total',
        'total_remise',
    ];

    // Relations
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'command_id');
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class, 'product_id');
    }

    public function magasin()
    {
        return $this->belongsTo(Magasin::class, 'magasin_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
