@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="section">
            <div class="jumbotron">
                <h1>Welcome To My Shopping Cart</h1>
            </div>
        </div>

        <div class="row">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="section">

            <div class="row">
                @if($cart)
                    <div class="col-md-8">
                        @foreach($cart->items as $product)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">{{$product['title']}}</h5>
                                    <div class="card-text">
                                        <p style="float: left;margin-right: 8px;margin-top: 5px">
                                            ${{$product['price']}}</p>

                                        <form action="{{route('cart.update',$product['id'])}}" method="post"
                                              style="float: left">
                                            @csrf
                                            <input type="text" name="qty" value="{{$product['qty']}}">
                                            <input type="submit" value="Change" class="btn btn-success">
                                        </form>

                                        <form action="{{route('cart.delete',$product['id'])}}" method="post"
                                              style="float: right">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Remove" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>

                            </div>
                        @endforeach

                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-info">
                                <h3 class="card-header">Your Card</h3>
                                <div class="card-text">
                                    <p>Total Price = {{$cart->totalPrice}}</p>
                                    <p>Total QTY = {{$cart->totalQty}}</p>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-success" href="{{route('cart.checkout',$cart->totalPrice)}}">CheckOut</a>
                                </div>


                            </div>
                        </div>

                        @else
                            <p>there are no product in shopping cart</p>
                        @endif
                    </div>
            </div>
        </div>

@endsection
