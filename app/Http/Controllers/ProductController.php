<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $products = Product::withTrashed()->get();

            
            return DataTables::of($products)
                ->editColumn('category_name', function($product){
                    return $product->category->category_name;
                })
                ->editColumn('stock_status', function($product){
                    return (int) $product->stock_status;
                })
                ->editColumn('created_at', function ($product) {
                    return $product->created_at;
                })
                ->editColumn('deleted_at', function ($product) {
                    return $product->deleted_at;
                })
                ->addColumn('show', function ($product) {
                    $button = '';
                    $button .= '<a class="btn btn-info text-white"  href="';
                    $button .= route('product.show', $product);
                    $button .= '">' . ('Szczegóły') . '</a>';
                    return $button;
                })
                ->addColumn('edit', function ($product) {
                    $button = '';
                    if (!$product->deleted_at) {
                        $button .= '<a class="btn btn-warning text-dark" href="';
                        $button .= route('product.edit', $product);
                        $button .= '">' . __('translations.products.index.edit') . '</a>';
                    }
                    return $button;
                })
                ->addColumn('delete', function ($product) {
                    $button = '';
                    if (!$product->deleted_at) {
                        $button .= '<a class="btn btn-danger text-white">';
                        $button .= __('translations.products.index.delete') . '</a>';
                    }
                    return $button;
                })
                ->rawColumns(['show', 'edit', 'delete'])
                ->make(true);
        }
        return view('product.products');
    }

    public function indexAll()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('productHome.products', compact('products', 'categories'));
    }

    public function indexAllCategory($category)
    {
        $category = Category::where('category_name','like', $category)->first();
        $products = Product::where('category_id', $category->id)->get();
        $categories = Category::all();
        return view('productHome.products', compact('products', 'categories'));
    }

    public function productDetails(Product $product)
    {
        return view('productHome.productDetails', compact('product'));
    }

    public function show(Product $product)
    {
        return view('product.details', compact('product'));
    }

    public function create()
    {
        $categories = Category::all();
        $edit = false;
        return view('product.create', compact('categories', 'edit'));
    }

    public function store(ProductRequest $r)
    {
        $product = new Product();

        $product->name = $r->name;
        $product->category_id = $r->category_id;
        $product->unit_price = $r->unit_price;
        $product->stock_status = $r->stock_status;
        $product->description = $r->description;
        if($r->image != null){
            $file = $r->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/product/images', $filename);
            $product->image = '/storage/product/images/' . $filename;
        }
        $product->save();

        return redirect()->route('product.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $edit = true;
        return view('product.create', compact('product', 'edit', 'categories'));
    }

    public function update(ProductRequest $r, Product $product)
    {
        $product = $product->findOrFail($product->id);

        $product->name = $r->name;
        $product->category_id = $r->category_id;
        $product->unit_price = $r->unit_price;
        $product->stock_status = $r->stock_status;
        $product->description = $r->description;
        if($r->image != null){
            $file = $r->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('/public/product/images', $filename);
            $product->image = '/storage/product/images/' . $filename;
        }
        else{
            $product->image = $product->image;
        }
        $product->save();
        
        return redirect()->route('product.index');
    }

    public function delete(Product $product)
    {
        $product = $product->findOrFail($product->id);

        $product->delete();
        return redirect()->route('product.index');
    }
}
