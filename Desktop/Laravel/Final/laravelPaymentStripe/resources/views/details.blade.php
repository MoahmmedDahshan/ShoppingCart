@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="section">
            <div class="jumbotron">
                <h1>Welcome To My First Store</h1>
                <p>Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile-first
                    projects on the web.</p>
            </div>
        </div>

        <div class="section">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{$product->image}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->title}}</h5>
                            <p class="card-text" id="price">Price : {{$product->price}}$</p>
                            <a  href="{{route('cart.add',$product->id)}}" class="btn btn-primary">Buy</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="showPayForm"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
