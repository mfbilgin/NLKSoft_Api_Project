@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card mx-auto">
                    <div class="card-body text-center">
                        <h5 class="card-title">{{$product['name']}}</h5>
                        <p class="card-text fs-5 text-success-emphasis"> {{$product["price"]}} ₺</p>
                        <p class="card-text fs-5 text-success-emphasis"> {{$product["description"]}}</p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="bi bi-pencil-square btn btn-warning text-decoration-none" href="">
                            Güncelle
                        </a>
                        <a class="bi bi-trash3-fill  btn btn-danger text-decoration-none" href="">
                            Sil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
