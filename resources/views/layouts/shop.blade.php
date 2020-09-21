@extends('layouts.app')

@section('content')

    @if(isset($totalAmount))
        <script>
            window.init_top_card_props = {
                totalAmount: parseInt('{{ $totalAmount }}')
            };
        </script>

        @if(isset($cardProducts) && isset($cardCounts))
            <script>
                window.init_order_card_props = {
                    cardProducts: {!! json_encode($cardProducts) !!},
                    cardCounts: {!! json_encode($cardCounts) !!},
                    totalAmount: parseInt('{{ $totalAmount }}')
                };
            </script>
        @endif
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-2 offset-md-1">
            <div class="card">
                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <li class="list-group-item">
                            <a href="{{ route('category_products', ['alias' => $category->alias]) }}">{{ $category->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-8">
            @yield('body')
        </div>
    </div>

@endsection
