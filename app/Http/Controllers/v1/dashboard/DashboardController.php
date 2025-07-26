<?php

namespace App\Http\Controllers\v1\dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\Magasin;
use App\Models\Produit;

class DashboardController extends Controller
{
    public function index()
    {


        $categories = Category::all();
        $products = Produit::all();
        $magasins = Magasin::all();
        $commandesValid = Commande::where('is_valid', 1)->get();

        return view('v1.dashboard.pages.dashboard.index', compact('categories', 'products', 'magasins', 'commandesValid'));
    }
}
