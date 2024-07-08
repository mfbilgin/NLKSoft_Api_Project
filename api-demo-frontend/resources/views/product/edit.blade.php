@extends('layouts.app')
@section('content')
    <div class="text-center my-5">
        <h1>"{{$product["name"]}}" Ürününü Güncelle</h1>
    </div>
    <div class="container">
        <form action="{{route('product.update',$product["id"])}}" method="post" class="w-75 mx-auto">
        @csrf
        @method('PUT')
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ $product["name"]}}" placeholder="" required>
            <label for="name">Ürün Adı</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" id="description" name="description" placeholder=""
                      rows="4"
                      required>{{ $product["description"]}}</textarea>
            <label for="description">Ürün Açıklaması</label>
        </div>


        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="price" name="price"
                   value="{{ $product["price"]}}" placeholder="" required>
            <label for="price">Adet Fiyatı</label>
        </div>
        <button type="submit" class="btn btn-warning container-fluid float-end mt-auto"><i
                class="bi bi-pencil-square"></i> Ürünü Güncelle
        </button>

        </form>
    </div>
@endsection
