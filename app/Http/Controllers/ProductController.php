<?php

// CoronaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

   public function __construct()
    {

    $this->middleware('auth');

    }

    public function index()
    {
        $products = Product::all();

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
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'count' => 'required|numeric',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ]);
        
        if ($request->file('image')){
            $filename = time().'.'.$request->image->extension();
            $request->image->move(public_path('image'), $filename);
        }

        $upload = array(
              'name' => $data ['name'],
              'description' => $data ['description'],
              'count' => $data ['count'],
              'price' => $data ['price'],
              'image' => $filename
          );

        Product::create($upload);
        return redirect('/products')->with('success', 'Product has been successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'count' => 'required|numeric',
            'price' => 'required',
            
        ]);
        Product::whereId($id)->update($validatedData);

        return redirect('/products')->with('success', 'Product has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('/products')->with('success', 'Product has been successfully deleted');
    }
}