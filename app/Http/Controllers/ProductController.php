<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    static private $categories = array(
        'CPU',
        'Keyboard',
        'Monitor',
        'Mouse',
        'Printer',
        'Speaker',
    );

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create', ['categories' => ProductController::$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|decimal:0,2|between:2.50,99.99',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
        ], [
            'name.required' => 'Product name is required.',
            'category.required' => 'Product category is required.',
            'price.required' => 'Product price is required.',
            'price.decimal' => 'Product price must be decimal.',
            'price.between' => 'Product price must be between $2.50 to $99.99.',
            'stock.required' => 'Product stock is required.',
            'stock.integer' => 'Product stock must be an integer.',
            'description.required' => 'Product description is required.',
            'image.required' => 'Product image is required.',
            'image.mimes' => 'Product image file type is not allowed.',
            'image.max' => 'Product image file size is too large (max 2MB).',
        ]);

        // Upload image file
        $fileName = time() . '.' . $request['image']->extension();
        $request['image']->move(public_path('uploads'), $fileName);

        $product = new Product;
        
        $product->name = $validatedData['name'];
        $product->category = $validatedData['category'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->description = $validatedData['description'];
        $product->image = $fileName;

        $product->save();

        Session::flash('message-success', 'Product creation successful!');

        return Redirect::to('products');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            Session::flash('message-error', 'Product with ID '. $id . ' does not exist!');
            return Redirect::to('products');
        }

        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            Session::flash('message-error', 'Product with ID '. $id . ' does not exist!');
            return Redirect::to('products');
        }

        return view('products.edit', ['product' => $product, 'categories' => ProductController::$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            Session::flash('message-error', 'Product with ID ' . $id . ' does not exist.');
            return Redirect::to('products/');
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required|decimal:0,2|between:2.50,99.99',
            'stock' => 'required|integer',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ], [
            'name.required' => 'Product name is required.',
            'category.required' => 'Product category is required.',
            'price.required' => 'Product price is required.',
            'price.decimal' => 'Product price must be decimal.',
            'price.between' => 'Product price must be between $2.50 to $99.99.',
            'stock.required' => 'Product stock is required.',
            'stock.integer' => 'Product stock must be an integer.',
            'description.required' => 'Product description is required.',
            'image.mimes' => 'Product image file type is not allowed.',
            'image.max' => 'Product image file size is too large (max 2MB).',
        ]);

        // Update data
        $product->name = $validatedData['name'];
        $product->category = $validatedData['category'];
        $product->price = $validatedData['price'];
        $product->stock = $validatedData['stock'];
        $product->description = $validatedData['description'];

        // If the 'image' field is not empty, upload the image, and update
        // the product image URL
        if (!empty($request['image'])) {
            $fileName = time() . '.' . $request['image']->extension();
            $request['image']->move(public_path('uploads'), $fileName);

            $product->image = $fileName;
        }

        // Save the changes
        $product->save();

        Session::flash('message-success', 'Product with ID ' . $id . ' updated successfully.');
        
        return Redirect::to('products/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            Session::flash('message-error', 'Product with ID '. $id . ' does not exist!');
            return Redirect::to('products');
        }

        $product->delete();

        Session::flash('message-success', 'Product with ID ' . $id . 'deleted successfully.');
        return Redirect::to('products');
    }
}
