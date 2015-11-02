<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Session as Session;

class ProductsController extends Controller
{
    //Show all Products
    public function index()
    {
        //Passed Data Array
        $passedData= array();

        //Categories Object
        $categories= Category::all();

        //Products Object
        $products= Product::all();

        //Each Category
        foreach($categories as $category)
        {
            //Store Each Category Details
            $passedData[$category->CategoryId]= array('category_id'=> $category->CategoryId,
                                                        'category_name'=> $category->Name);
        }

        //Each Product
        foreach($products as $product)
        {
            //Store Each Product in Specific Category
            $passedData[$product->ProductCategoryId]['products'][$product->ProductId]= array('product_id'=> $product->ProductId,
                                                                                                'product_name'=> $product->Name,
                                                                                                'product_price'=> $product->ProductPrice);
        }

        //Return View Product List
        return view('products.productlist')->with('passedData', $passedData);
    }

    public function categoryDisplay()
    {


    }

    //Show a Specific Product
    public function show($id)
    {
        $product = Product::find($id);
        $category = $product->category();
        dd($category);
    }

}
