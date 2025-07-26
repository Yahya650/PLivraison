<?php

namespace App\Models;

use App\Http\Traits\HasAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use HasFactory, HasAttachment, SoftDeletes;

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    public function products()
    {
        return $this->belongsToMany(Produit::class, 'command_products', 'command_id', 'product_id')->withPivot('quantity', 'remise', 'prix_remise', 'total', 'total_remise', 'unit_price', 'magasin_id', 'category_id', 'product_category_id');
    }
    public function status()
    {
        return $this->is_valid ? '<i class="bx bxs-circle text-success me-1"></i>Validée' : '<i class="bx bxs-circle text-primary me-1"></i>Non Validée'; // return $this->is_valid ? 'Validée' : 'Non Validée';
    }
    public function subTotal()
    {
        return $this->products()->sum('total');
    }
    public function discount()
    {
        return $this->products()->sum('remise');
    }
    public function total()
    {
        return $this->products()->sum('total_remise') + $this->delivery_price;
    }
}
