@extends('layouts.app')
@section('content')
<div class="section-header">
    <h1 style="width:87%">Edit Kategori</h1>
</div>
<div class="section-body">

    <div class="card">
        <div class="card-header">
            <h5>Form Edit Kategori</h5>
        </div>
        <div class="card-body">
            <form action="/kategori/update/{{$data->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label>kategori <span style="color: red">*</span></label>
                    <input type="text" value="{{$data->kategori}}" class="form-control" name="kategori">
                </div>
                <div class="form-group">
                    <label>Image <span style="color: red">*</span></label><br>
                    <img src="{{ Storage::url('image/' . $data->image) }}" alt=""
                        style="width: 150px; margin-bottom: 10px;">
                    <input type="file" accept=".jpg, .jpeg, .png" class="form-control" name="image">
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
