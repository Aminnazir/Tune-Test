<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProductsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(){

        $products = Product::all();
        return view('home', compact('products'));

    }

}
