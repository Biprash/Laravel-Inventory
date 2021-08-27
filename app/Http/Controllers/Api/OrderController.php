<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(OrderResource::collection(Order::paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function store(OrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $order = Order::create([
                'customer_id' => $request->customer_id,
                'ordered_at' => Carbon::now()->toDateTimeString()
            ]);
            $orders = $request->orders;
            foreach ($orders as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($product->quantity <= $item['quantity']) {
                    DB::rollBack();
                    abort(401, 'Request is more than inventory quantity');
                } else {
                    $product->quantity = $product->quantity - $item['quantity'];
                    $product->save();
                }
                $order->products()->attach($product->id, ['price' => $item['price'], 'quantity' => $item['quantity']]);
            }

            DB::commit();
            return response()->json('Successfully Placed Order');
        } catch (\Exception $e)
        {
            DB::rollBack();
            return $e;
            return 'Error Occured';
        }
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
}
