@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($carts as $cart)
                <div class="col-md-9 mb-5">
                    <div class="card">
                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart->items as $item)
                                <tr>
                                    <th>{{$item['title']}}</th>
                                    <td>{{$item['price']}}</td>
                                    <td>{{$item['qty']}}</td>
                                    <td>Paid</td>
                                </tr>

                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="thead-dark">
                                    <th>Totals</th>
                                    <th>{{$cart->totalPrice}}</th>
                                    <th colspan="2">{{$cart->totalQty}}</th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
