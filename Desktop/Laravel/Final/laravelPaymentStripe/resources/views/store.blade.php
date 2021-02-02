@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="section">
            <div class="jumbotron">
                <h1>Welcome To My First Store</h1>
                <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile-first
                    projects on the web.</p>
                <a class="btn btn-success" href="{{route('products.index')}}"> products</a>
            </div>
        </div>

        <div class="section">
            <div class="row">
                @foreach($latestProducts as $product)
                    <div class="col-md-4">
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
