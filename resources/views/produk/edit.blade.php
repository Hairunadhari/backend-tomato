@extends('layouts.app')
@section('content')
<div class="section-header">
    <h1 style="width:87%">Edit produk</h1>
</div>
<div class="section-body">

    <div class="card">
        <div class="card-header">
            <h5>Form Edit produk</h5>
        </div>
        <div class="card-body">
            <form action="/produk/update/{{$data->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>Kategori <span style="color: red">*</span></label>
                    <select name="kategori_id" id="" class="form-control">
                        @foreach ($kategori as $item)
                        <option value="{{$item->id}}">{{$item->kategori}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Name <span style="color: red">*</span></label>
                    <input type="text"  class="form-control" name="name" value="{{$data->name}}">
                </div>
                <div class="form-group">
                    <label>Image <span style="color: red">*</span></label>
                    <img src="{{ Storage::url('image/' . $data->image) }}" alt=""
                        style="width: 150px; margin-bottom: 10px;">
                    <input type="file"  accept=".jpg, .jpeg, .png" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label>Price <span style="color: red">*</span></label>
                    <input type="number"  class="form-control" value="{{$data->price}}" name="price">
                </div>
                <div class="form-group">
                    <label>desc <span style="color: red">*</span></label>
                    <input type="text"  class="form-control" value="{{$data->desc}}" name="desc">
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
