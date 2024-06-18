<?php

namespace App\Http\Controllers;

use App\Models\Catalogue;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    
    public function index($category = null)
    {
        $categories = Category::all();
        if($category){
            $catalogues = Catalogue::where('category_id', $category)->get();
        }else{
            $catalogues = Catalogue::all();
        }
        return view('catalogue', compact('categories', 'catalogues'));
    }

}
