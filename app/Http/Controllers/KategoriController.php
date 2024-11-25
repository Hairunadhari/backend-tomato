<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class KategoriController extends Controller
{
     
    public function index(){
        if (request()->ajax()) {
            $data = Kategori::all();
            return DataTables::of($data)->make(true);
        }
        return view('kategori.index');
    }

    public function submit(Request $request){
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png',
        ]);
        
        if($validator->fails()){
            $messages = $validator->messages();
            $alertMessage = $messages->first(); 
            return back()->with(['error' => $alertMessage]);
        }

        $image = $request->file('image');
        $image->storeAs('public/image', $image->hashName());
        Kategori::create([
            'kategori' => $request->kategori,
            'image' => $image->hashName(),
        ]);

        return redirect('/kategori')->with('success', 'data dah masukk');
    }

    public function edit($id){
        $data = Kategori::find($id);
        return view('kategori.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'kategori' => 'string',
            'image' => 'image|mimes:jpeg,jpg,png',
        ]);
        
        if($validator->fails()){
            $messages = $validator->messages();
            $alertMessage = $messages->first(); 
            return back()->with(['error' => $alertMessage]);
        }

        $destinasi = Kategori::find($id);
        $data = [
            'kategori' => $request->kategori,
        ];
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = $image->hashName();
            $image->storeAs('public/image', $data['image']);
        }    

        $destinasi->update($data);

        return redirect('/kategori')->with('success', 'data dah di update');
    }
    
    public function delete($id){
        $data = Kategori::find($id);
        $data->delete();
        return redirect('/kategori')->with('success', 'data dah di hapuss');
    }
}
