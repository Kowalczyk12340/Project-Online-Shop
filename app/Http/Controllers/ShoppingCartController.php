<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShoppingCartProduct\StoreProductShoppingCartRequest;
use App\Http\Requests\ShoppingCartProduct\UpdateProductShoppingCartRequest;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ProductShoppingCart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use DataTables;
use Hamcrest\Core\AllOf;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class ShoppingCartController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $shoppingCarts = ShoppingCart::where('status_cart_id', 2)->get();

            return DataTablesDataTables::of($shoppingCarts)
                ->editColumn('name', function($shoppingCart){
                    return $shoppingCart->user->name .' '. $shoppingCart->user->surname . ' ('.$shoppingCart->user->email.')';
                })
                ->editColumn('status_name', function($shoppingCart){
                    return $shoppingCart->statusCart->status_name;
                })
                ->editColumn('created_at', function ($shoppingCart) {
                    return $shoppingCart->created_at;
                })
                ->editColumn('updated_at', function ($shoppingCart) {
                    return $shoppingCart->updated_at;
                })
                ->addColumn('details', function ($shoppingCart) {
                    $button = '';
                    $button .= '<a class="btn btn-info text-white"  href="';
                    $button .= route('shoppingCart.product_details', $shoppingCart);
                    $button .= '">' . ('Szczegóły') . '</a>';
                    return $button;
                })
                ->addColumn('delete', function ($shoppingCart) {
                    $button = '';
                    if (!$shoppingCart->deleted_at) {
                        $button .= '<a data-delete-href="';
                            $button .=  route('shoppingCart.delete', $shoppingCart);
                            $button .=   '"';
                        $button .= 'class="btn btn-danger text-white"> ';
                        $button .= __('translations.shoppingCarts.index.delete') . '</a>';
                    }
                    else 
                    {
                        // przycisk przywracania usuniętego elementu
                        $button .= '<a class="btn btn-success btn-sm"';
                        $button .= ' href="' . route('product.restore', $shoppingCart->id) .'"';
                        $button .= 'data-toggle="tooltip"
                                    data-placement="top"';
                        $button .= 'data-title="' . __('translations.buttons.restore') . '"';
                        $button .= '>Przywróć</a>';
                    }
                    return $button;
                })
                ->rawColumns(['details', 'delete'])
                ->make(true);
        }   
        return view('shoppingCart.shoppingCarts');
    }

    public function indexOrders(Request $request)
    {

        if($request->ajax())
        {
            $shoppingCarts = ShoppingCart::where('status_cart_id', 1)->get();

            
            return FacadesDataTables::of($shoppingCarts)
                ->editColumn('name', function($shoppingCart){
                    return $shoppingCart->user->name .' '. $shoppingCart->user->surname . ' ('.$shoppingCart->user->email.')';
                })
                ->editColumn('status_name', function($shoppingCart){
                    return $shoppingCart->statusCart->status_name;
                })
                ->editColumn('created_at', function ($shoppingCart) {
                    return $shoppingCart->created_at;
                })
                ->addColumn('details', function ($shoppingCart) {
                    $button = '';
                    $button .= '<a class="btn btn-info text-white"  href="';
                    $button .= route('shoppingCart.show', $shoppingCart);
                    $button .= '">' . ('Szczegóły') . '</a>';
                    return $button;
                })
                ->rawColumns(['details'])
                ->make(true);
        }
        return view('order.orders');
    }

    public function indexOrdersClient()
    {
        $shoppingCarts = ShoppingCart::where('status_cart_id', 1)->where('user_id',Auth::user()->id)->get();
        return view('orderHome.orders', compact('shoppingCarts'));
    }

    public function indexClient()
    {
        $shoppingCarts = ShoppingCart::where('status_cart_id', 2)->where('user_id',Auth::user()->id)->first();
        return view('shoppingCartHome.shoppingCart', compact('shoppingCarts'));
    }

    public function show(ShoppingCart $shoppingCart)
    {
        $shoppingCartProd = ProductShoppingCart::where('shopping_cart_id', $shoppingCart->id)->get();
        if (count($shoppingCartProd) != 0) {
            $shoppingCartProd = $shoppingCartProd[0];
        }
        return view('shoppingCart.details', compact('shoppingCart', 'shoppingCartProd'));
    }

    public function create()
    {
        return view('shoppingCart.shoppingCarts');
    }

    public function store(Request $r)
    {
        $shoppingCart = new ShoppingCart();

        $shoppingCart->user_id = Auth::user()->id;
        $shoppingCart->submission_date = Carbon::now();
        $shoppingCart->implementation_date = Carbon::now();
        $shoppingCart->total_price = $r->total_price;
        $shoppingCart->status_cart_id = $r->status_cart_id;
        $shoppingCart->save();

        return redirect()->route('shoppingCart.index');
    }

    public function edit(ShoppingCart $shoppingCart)
    {
        return view('shoppingCart.shoppingCarts', compact('shoppingCart'));
    }

    public function update(Request $r, ShoppingCart $shoppingCart)
    {
        $shoppingCart = $shoppingCart->findOrFail($shoppingCart->id);

        $shoppingCart->user_id = Auth::user()->id;
        $shoppingCart->submission_date = Carbon::now();
        $shoppingCart->implementation_date = Carbon::now();
        $shoppingCart->total_price = $r->total_price;
        $shoppingCart->status_cart_id = $r->status_cart_id;
        $shoppingCart->save();

        return redirect()->route('shoppingCart.index');
    }

    public function delete(ShoppingCart $shoppingCart)
    {
        try 
        {
            $product = $shoppingCart->findOrFail($shoppingCart->id);
            $product->delete();
            return response()->json(['status'=>'success'], 200);
        }
        catch(Exception $ex)
        {
            return response()->json(['status'=>'fail'], 404);
        }
    }

    public function restore(int $id)
    {
        $shoppingCart = ShoppingCart::onlyTrashed()->findOrFail($id);
        $shoppingCart->restore();
        return redirect()->route('shoppingCart.index')
        ->with('success', __('translations.products.flashes.success.restore',[
            'name' => $shoppingCart->name
            ])
        );
    }

    public function productDetails(Product $product)
    {
        return view('shoppingCart.productDetails', compact('product'));
    }

    public function editProduct(Product $product, ShoppingCart $shoppingCart, $q)
    {
        $edit = true;
        $shoppingCartProd = ProductShoppingCart::where([
            ['shopping_cart_id', $shoppingCart->id],
            ['product_id', $product->id],
        ])->get();
        return view('shoppingCart.editProduct', compact('product', 'edit', 'shoppingCart', 'q','shoppingCartProd'));
    }

    public function updateProduct(ProductShoppingCart $shoppingCartProd, UpdateProductShoppingCartRequest $r)
    {
        $shoppingCartProd = ProductShoppingCart::findOrFail($shoppingCartProd->id);
        $product = Product::where('id',$shoppingCartProd->product_id)->first();
        $product->stock_status += $shoppingCartProd->quantity;
        $shoppingCartProd->quantity = 0;
        if($r->quantity > $product->stock_status)
        {
            $shoppingCartProd->quantity = $product->stock_status;
            $product->stock_status -= $shoppingCartProd->quantity;
        }else{
            $shoppingCartProd->quantity = $r->quantity;
            $product->stock_status -= $shoppingCartProd->quantity;
        }
        $shoppingCartProd->sell_price = $shoppingCartProd->quantity * $product->unit_price;
        $product->save();
        $shoppingCartProd->save();

        $shoppingCart = ShoppingCart::findOrFail($shoppingCartProd->shopping_cart_id);
        $shoppingCartProducts = ProductShoppingCart::where('shopping_cart_id', $shoppingCart->id)->get();
        $shoppingCart->total_price = 0;
        foreach($shoppingCartProducts as $product)
        {
            $shoppingCart->total_price += $product->sell_price;
        }
        $shoppingCart->save();
        return redirect()->route('shoppingCart.show',['shoppingCart' => $shoppingCart]);
    }

    public function deleteProduct(ShoppingCart $shoppingCart, Product $product)
    {
        $shoppingCartProd = ProductShoppingCart::where([
            ['shopping_cart_id', $shoppingCart->id],
            ['product_id', $product->id],
        ])->get();
        $product->stock_status += $shoppingCartProd[0]->quantity;
        $shoppingCartProd = ProductShoppingCart::findOrFail($shoppingCartProd[0]->id);
        $shoppingCart = ShoppingCart::findOrFail($shoppingCartProd->shopping_cart_id);  
        $shoppingCart->total_price -= $shoppingCartProd->sell_price;
        $product->save();
        $shoppingCart->save();
        $shoppingCartProd->delete();
        
        
        return redirect()->route('shoppingCart.show',['shoppingCart' => $shoppingCart]);
    }

    public function createProduct(ShoppingCart $shoppingCart)
    { 
        $selectedProductsIds = ProductShoppingCart::where([
            ['shopping_cart_id', $shoppingCart->id]])->get();
            foreach($selectedProductsIds as $key => $selectProduct)
            {
                $array[$key] = $selectProduct->product_id;
            }
            if(isset($array)){
                $products = Product::whereNotIn('id', $array)->where('stock_status', '!=',0)->get();
            }else
            {
                $products = Product::all();
            }
            Log::debug('Wyświetlono tworzenie produktu');
        $edit = false;
        return view('shoppingCart.createProduct', compact('shoppingCart', 'products', 'edit'));
    }

    public function storeProduct(ShoppingCart $shoppingCart, StoreProductShoppingCartRequest $r)
    {
        $p = Product::findOrFail($r->product_id);
        $product = new ProductShoppingCart();
        $product->shopping_cart_id = $shoppingCart->id;
        if($r->quantity > $p->stock_status)
        {
            $product->quantity = $p->stock_status;
            $product->sell_price = $product->quantity * $p->unit_price;
            $p->stock_status -= $product->quantity;
        }else{
            $product->quantity = $r->quantity;
            $p->stock_status -= $product->quantity;
            $product->sell_price = $r->quantity * $p->unit_price;
        }
        $product->product_id = $r->product_id;
        $product->save();
        $shoppingCart->total_price += $product->sell_price;
        $shoppingCart->save();
        $p->save();

        return redirect()->route('shoppingCart.show',['shoppingCart' => $shoppingCart]);
    }

    public function storeProductClient(Request $r)
    {
        $p = Product::findOrFail($r->product_id);
        $shoppingCart = ShoppingCart::where('user_id', Auth::user()->id)->where('status_cart_id', 2)->first();
        if(count(ProductShoppingCart::where('shopping_cart_id',$shoppingCart->id)->where('product_id',$r->product_id)->get()) != 0)
        {
            $product = ProductShoppingCart::where('shopping_cart_id',$shoppingCart->id)->where('product_id',$r->product_id)->first();
            if($r->quantity > $p->stock_status)
            {
                $product->quantity += $p->stock_status;
                $product->sell_price += $p->stock_status * $p->unit_price;
                $p->stock_status = 0;
                
            }else{
                $product->quantity = $product->quantity + $r->quantity;
                $p->stock_status -= $r->quantity;
                $product->sell_price += $r->quantity * $p->unit_price;
            }
        }else{
            $product = new ProductShoppingCart();
            $product->shopping_cart_id = $shoppingCart->id;
            $product->product_id = $r->product_id;
            if($r->quantity > $p->stock_status)
            {
                $product->quantity = $p->stock_status;
                $product->sell_price += $p->stock_status * $p->unit_price;
                $p->stock_status = 0;
            }else{
                $product->quantity = $r->quantity;
                $p->stock_status -= $r->quantity;
                $product->sell_price += $r->quantity * $p->unit_price;
            }
            
        }
        $p->save();
        $product->save();
        $shoppingCartProducts = ProductShoppingCart::where('shopping_cart_id', $shoppingCart->id)->get();
        $shoppingCart->total_price = 0;
        foreach($shoppingCartProducts as $product)
        {
            $shoppingCart->total_price += $product->sell_price;
        }
        $shoppingCart->save();
        

        return redirect()->route('shoppingCart.indexClient');
    }

    public function editProductClient(Product $product, $q)
    {
        $edit = true;
        $shoppingCart = ShoppingCart::where('user_id', Auth::user()->id)->where('status_cart_id', 2)->first();
        $shoppingCartProd = ProductShoppingCart::where([
            ['shopping_cart_id', $shoppingCart->id],
            ['product_id', $product->id],
        ])->get();
        return view('shoppingCartHome.editProduct', compact('product', 'edit', 'shoppingCart', 'q','shoppingCartProd'));
    }

    public function updateProductClient(ProductShoppingCart $shoppingCartProd, UpdateProductShoppingCartRequest $r)
    {
        $edit = true;
        $shoppingCartProd = ProductShoppingCart::findOrFail($shoppingCartProd->id);
        $product = Product::where('id',$shoppingCartProd->product_id)->first();
        $product->stock_status += $shoppingCartProd->quantity;
        $shoppingCartProd->quantity = 0;
        if($r->quantity > $product->stock_status)
        {
            $shoppingCartProd->quantity += $product->stock_status;
            $shoppingCartProd->sell_price = $product->stock_status * $product->unit_price;
            $product->stock_status = 0;
        }else{
            $shoppingCartProd->quantity = $r->quantity;
            $product->stock_status -= $shoppingCartProd->quantity;
            $shoppingCartProd->sell_price = $r->quantity * $product->unit_price;
        }
        $shoppingCartProd->save();
        $product->save();
        $shoppingCarts = ShoppingCart::findOrFail($shoppingCartProd->shopping_cart_id);
        $shoppingCartProducts = ProductShoppingCart::where('shopping_cart_id', $shoppingCarts->id)->get();
        $shoppingCarts->total_price = 0;
        foreach($shoppingCartProducts as $product)
        {
            $shoppingCarts->total_price += $product->sell_price;
        }
        $shoppingCarts->save();
        return view('shoppingCartHome.shoppingCart', compact('shoppingCarts', 'edit'));
    }

    public function deleteProductClient(ShoppingCart $shoppingCart, ProductShoppingCart $product)
    {
        $shoppingCart = $shoppingCart->findOrFail($shoppingCart->id);

        $shoppingCartProduct = ProductShoppingCart::where('shopping_cart_id', $shoppingCart->id)
                            ->where('product_id', $product->id)->first();
        $product = Product::where('id', $shoppingCartProduct->product_id)->first();
        $shoppingCart->total_price -= $shoppingCartProduct->sell_price;
        $product->stock_status += $shoppingCartProduct->quantity;
        $product->save();
        $shoppingCart->save();
        $shoppingCartProduct->delete();

        return redirect()->route('shoppingCart.indexClient');
    }

    public function pay(ShoppingCart $shoppingCart)
    {
        $shoppingCart = $shoppingCart->findOrFail($shoppingCart->id);
        $shoppingCart->status_cart_id = 1; //opłacony
        $shoppingCart->save();

        $shoppingCart2 = new ShoppingCart();
        $shoppingCart2->user_id = Auth::user()->id;
        $shoppingCart2->status_cart_id = 2; //nieopłacony
        $shoppingCart2->save();

        return redirect()->route('shoppingCart.indexClient');
    }

    public function showClientCart(ShoppingCart $shoppingCart)
    {
        $shoppingCartProd = ProductShoppingCart::where('shopping_cart_id', $shoppingCart->id)->get();
        if (count($shoppingCartProd) != 0) {
            $shoppingCartProd = $shoppingCartProd[0];
        }
        return view('shoppingCartHome.details', compact('shoppingCart', 'shoppingCartProd'));
    }
}
