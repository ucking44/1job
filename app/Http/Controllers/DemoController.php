<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = DB::table('products')->whereUserId(Auth::user()->usertype == 'admin')->get();
        // return view('products.index',compact('products'));
        $products = Product::all();
        //$products = Product::whereUserId(Auth::id())->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        // return redirect('products.show'); //->with('success', 'Product Created Successfully');

        // $product = Product::create($request->all());
        // return view('products.index', compact('product'));
        //dd($request);
        // $request->validate([
        //     'user_id',
        //     'name'   => 'required',
        //     'detail' => 'required'
        // ]);

        //Auth()->user()->Product::save()->create($request->all());

        // $product = new Product($request->all());
        // //dd($product);
        // $product->user_id = Auth::user();
        // $product->user_id = $request->user()->id;

        //$product->save();

        // $product = new Product();
        // $product->name = $request->input('name');
        // $product->detail = $request->input('detail');
        // //dd($product);
        // $product->save();

        //Product::create($request->all());
        //return redirect()->route('products.index')->with('success', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = DB::table('products')->where('id', $id)->first();
        return view('edit', compact('products', 'id'));

        //return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
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
        // if($request->id === 0) {
        //     //return redirect()->back('post');
        // }
        //return redirect('postview');
        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //$product = Product::findOrFail($product);
        // $product->delete();
        // return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }
}
