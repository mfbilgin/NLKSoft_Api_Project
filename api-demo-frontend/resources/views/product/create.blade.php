@extends('layouts.app')
@section('content'))
    <div class="text-center mb-5">
        <h1>Yeni Ürün Oluştur</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <form action="{{route('product.store')}}" method="post" >
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name"
                               value="{{ old('name') }}" placeholder="" required>
                        <label for="name">Ürün Adı</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="price" name="price"
                               value="{{ old('price') }}" placeholder="" required>
                        <label for="price">Adet Fiyatı</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="description" name="description" placeholder=""
                                  required>{{ old('description') }}</textarea>
                        <label for="description">Ürün Açıklaması</label>
                    </div>
                    <button type="submit" class="btn btn-primary float-end"><i class="bi bi-plus-circle-dotted"></i>
                        Ürünü Ekle
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
