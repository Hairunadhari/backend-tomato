<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiKategoriController extends Controller
{
    /**
     * List Kategori.
     */
    public function index()
{
    $data = Kategori::paginate(10);

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
     * Get Produk By Kategori.
     */
    public function getProdukByKategori($id){
        $data = Kategori::with('produk')->where('id',$id)->paginate(10);
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
