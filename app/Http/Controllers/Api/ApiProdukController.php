<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiProdukController extends Controller
{
    /**
     * List Produk.
     * @unauthenticated
     */
    public function index()
    {
        $data = Produk::paginate(10);
    
        return response()->json([
            'success' => true,
            'data' => [
                'items' => $data->items(), // Hanya data item
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                    'last_page' => $data->lastPage(),
                    'next_page_url' => $data->nextPageUrl(),
                    'prev_page_url' => $data->previousPageUrl(),
                ],
            ],
        ]);
    }
    
    /**
     * Detail Produk.
     * @unauthenticated
     */
    public function detail($id){
        $data = Produk::where('id',$id)->paginate(10);
        return response()->json([
            'success'=>true,
            'data' => [
                'items' => $data->items(), // Hanya data item
                'pagination' => [
                    'current_page' => $data->currentPage(),
                    'per_page' => $data->perPage(),
                    'total' => $data->total(),
                    'last_page' => $data->lastPage(),
                    'next_page_url' => $data->nextPageUrl(),
                    'prev_page_url' => $data->previousPageUrl(),
                ],
            ],
        ]);
    }
}
