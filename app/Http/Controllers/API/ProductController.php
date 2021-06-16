<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //inisialisasi api 
    public function all(Request $request){
        //input parameter ke API
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $categories = $request->input('categories');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        
    //memasukkan kondisi parameter untuk mengirimkan atau input ke model data product
    //buka file product.php di folder models
    //menambahkan fungsi yang ada di model Product 
    if($id){
        $product = Product::with(['category', 'galleries'])->find($id);

        //memeriksa data product 
        if($product){
            return ResponseFormatter::success($product, 'Data produk berhasil diambil');
        }
        else{
            return ResponseFormatter::error(null, 'Data produk tidak ada', 404);
        }
    }
    
    //mengambil semua data product
    $product = Product::with(['category', 'galleries']);

    if($name){
        $product->where('name', 'like', '%' . $name . '%');
    }

    if($description){
        $product->where('description', 'like', '%' . $description . '%');
    }

    if($tags){
        $product->where('tags', 'like', '%' . $tags . '%');
    }

    if($price_from){
        $product->where('price', '>=', $price_from);
    }

    if($price_to){
        $product->where('price', '<=', $price_to);
    }

    if($categories){
        $product->where('categories', $categories);
    }

    return ResponseFormatter::success($product->paginate($limit), 'Data produk berhasil diambil');
    }
}
