<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * List Order By User.
     */
    public function orderByUser(){
        $userId = Auth::user()->id;
        $data = Order::with('order_detail')->where('user_id',$userId)->first();

        return response()->json([
            'success'=>true,
            'data'=>$data,
        ]);
    }

     /**
     * Create Order.
     */
    public function submitOrder(Request $request){
        // dd($request);
        try {
            DB::beginTransaction();
            
            $order = Order::create([
                'user_id'=>$request->user_id,
                'name_order'=>$request->name_order,
                'status_order'=>'pending',
                'status_payment'=>'pending',
                'total_price'=>$request->total_price,
            ]);
            
            foreach ($request->order_details as $value) {
                OrderDetail::create([
                    'order_id'=>$order->id,
                    'produk_id'=>$value['produk_id'],
                    'qty'=>$value['qty'],
                    'price'=>$value['price'],
                    'sub_total'=>$value['sub_total']
                ]);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            //throw $th;
            return response()->json([
                'success'=>false,
                'message'=>$th->getMessage()
            ],500);
        }

        return response()->json([
            'success'=>true,
            'message'=>'create order successfuly'
        ]);

    }
}
