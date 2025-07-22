<?php

namespace App\Models;

use App\Http\Traits\HasAttachment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasAttachment;


    public function magasins()
    {
        return $this->hasMany(Magasin::class, 'category_id');
    }
}
