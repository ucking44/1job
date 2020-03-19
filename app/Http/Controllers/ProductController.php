<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function index()
    {
        $products = DB::table('products')->get();
        return view('products.index',compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'detail' => 'required'
        ]);

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->get('name'),
            'detail' => $request->get('detail'),
        ]);

        // $products = new Product();
        // $products->user_id = $request->get('user_id');
        // $products->name = $request->get('name');
        // $products->detail = $request->get('detail');
        // $products->save();
        return redirect('products/front')->with('success', 'Product has been successfully submitted pending for approval');
    }

    public function edit($id)
    {
        $products = DB::table('products')->where('id', $id)->first();
        return view('products.edit', compact('products', 'id'));
    }

    public function update(Request $request, $id)
    {
        switch($request->get('approve'))
        {
            // case 0:
            //     Post::postpone($id);
            //     break;
            case 1:
                Product::approve($id);
                break;
            case 2:
                Product::reject($id);
                break;
            // case 3:
            //     Post::postpone($id);
            //     break;
            default:
                break;

        }
        if($request->id === 0) {
            //return redirect()->back('post');
        }
        //return redirect('postview');
        return redirect('products');
    }

    public function front()
    {
        return view('products.front');
    }
}
