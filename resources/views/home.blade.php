@extends('layouts.app')

@section('content')

    <div class="row">
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card my-2">
                    <div class="product-logo cat-id-{{ $product->catId }}"></div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Price ${{ $product->price }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="javascript:void(0)" class="btn btn-secondary" onclick="window.top_card_adapter.putToCard('{{ $product->id }}')">Put to basket</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
