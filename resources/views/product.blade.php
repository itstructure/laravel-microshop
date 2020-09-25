@extends('layouts.shop')

@section('body')

    <div class="row">
        <div class="col-12">
            <div class="media">
                <img src="/images/product{{ $model->catId }}.jpg" class="mr-3" alt="{{ $model->title }}">
                <div class="media-body">
                    <h5 class="mt-0">{{ $model->title }}</h5>
                    {{ $model->description }}
                </div>
            </div>
        </div>
    </div>

@endsection
