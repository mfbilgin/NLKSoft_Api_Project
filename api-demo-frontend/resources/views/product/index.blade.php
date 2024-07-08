@extends('layouts.app')
@section('styles')
    <style>
        .card-title:hover {
            text-decoration: underline;
        }

        .card {
            cursor: pointer;
            width: 18rem;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }

        .card-body {
            height: 125px;
            overflow: hidden;
            display: flex;
            flex-direction: column; /* İçerikleri dikey hizala */
            justify-content: space-between; /* İçerikleri aralarında boşluk bırakarak dikey hizala */
        }

        .card-body .card-title {
            margin-bottom: 0; /* Card başlığının altındaki boşluğu kaldır */
        }

        .card-body .card-text {
            margin-top: auto; /* Fiyat metnini alt sınırda hizala */
        }

        .card-footer {
            padding-top: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <a href="{{route('product.create')}}" class="btn btn-primary"><i class="bi bi-plus-circle-dotted"></i> Yeni Ürün</a>
        <a href="{{route('logout')}}" class="btn btn-secondary float-end"><i class="bi bi-box-arrow-right"></i> Çıkış Yap</a>
        <div class="text-center mb-5">
            <h1>Ürünler</h1>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @foreach($api_response['data'] as $product)
                        <div class="col-lg-4 col-md-6 mb-4 center">
                            <div class="card mx-auto">
                                <div class="card-body text-center">
                                    <a href="{{route('product.show',$product['id'])}}">{{$product['name']}}</a>
                                    <p class="card-text fs-5 text-success-emphasis"> {{$product["price"]}} ₺</p>
                                    <p class="card-text fs-5 text-success-emphasis"> {{$product["description"]}}</p>
                                </div>
                                <div class="card-footer text-center">
                                    <a class="bi bi-pencil-square w-100 btn btn-warning text-decoration-none" href="{{route('product.edit',$product['id'])}}">
                                        Güncelle
                                    </a>
                                    <form action="{{route('product.destroy',$product['id'])}}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger text-decoration-none w-100 mt-2">
                                            <i class="bi bi-trash3-fill"> Sil</i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
