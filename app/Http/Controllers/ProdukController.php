<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdukController extends Controller
{
    public function index(){
        $kategori = Kategori::all();
        if (request()->ajax()) {
            $data = Produk::all();
            return DataTables::of($data)->make(true);
        }
        return view('produk.index',compact('kategori'));
    }

    public function submit(Request $request){
        

        $image = $request->file('image');
        $image->storeAs('public/image', $image->hashName());
        Produk::create([
            'kategori_id' => $request->kategori_id,
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
            'image' => $image->hashName(),
        ]);

        return redirect('/produk')->with('success', 'data dah masukk');
    }

    public function edit($id){
        $kategori = Kategori::all();
        $data = Produk::find($id);
        return view('produk.edit', compact('data','kategori'));
    }

    public function update(Request $request, $id){
        
        $dataX = Produk::find($id);
        $data = [
            'kategori_id' => $request->kategori_id,
            'name' => $request->name,
            'price' => $request->price,
            'desc' => $request->desc,
        ];
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = $image->hashName();
            $image->storeAs('public/image', $data['image']);
        }    

        $dataX->update($data);

        return redirect('/produk')->with('success', 'data dah di update');
    }
    
    public function delete($id){
        $data = Produk::find($id);
        $data->delete();
        return redirect('/produk')->with('success', 'data dah di hapuss');
    }
}
