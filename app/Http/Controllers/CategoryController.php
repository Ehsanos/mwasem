<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index(){

        $allCats=Category::with('media')->get();

        return $allCats;


    }

    public function show($id){

        if ($id !=null){

            $allProductInCategory=Product::where('category_id',$id)
                ->where('is_active',true)
                ->get();
            return $allProductInCategory;

        }


    }

}
