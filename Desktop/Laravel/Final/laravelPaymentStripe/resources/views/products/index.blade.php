@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="section">
            @if(session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
            @endif
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{$product->image}}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->title}}</h5>
                                <p class="card-text">Price : {{$product->price}}$</p>
                                <a href="{{route('products.details',$product->id)}}" class="btn btn-primary">more</a>
                                <a href="{{route('cart.add',$product->id)}}" class="btn btn-primary">Buy</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
