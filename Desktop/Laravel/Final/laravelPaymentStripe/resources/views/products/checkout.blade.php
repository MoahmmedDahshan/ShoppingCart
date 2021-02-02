@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div class="container">

        <div class="section">
            <div class="jumbotron">
                <h1>Checkout</h1>
            </div>
        </div>

        <div class="section">
            <div class="row">
                <div class="col-md-9">
                    <p class="mb-4">
                        Total Amount is = {{$totalPrice}}
                    </p>
                    <form action="{{route('cart.charge')}}" method="post" id="payment-form">
                        @csrf
                        <div>
                            <input type="hidden" name="amount" value="{{$totalPrice}}">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        <button>Submit Payment</button>
                        <p id="progress" style="display: none;color: cyan;">Payment in progress</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        window.onload = function () {
            var stripe = Stripe('pk_test_51I88MUBTYd3k1zywWj98uLjFPRU5rdbsc2c3qaAchorpmPMJDLLwrYhC1WwPFwChpdZGFfeuTdzABbc9AKNX4Vof00PBBQWiWl');
            var elements = stripe.elements();
            // Custom styling can be passed to options when creating an Element.
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: 'red',
                    iconColor: 'red'
                }
            };

// Create an instance of the card Element.
            var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the customer that there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                var loading = document.getElementById('progress');
                loading.style.display = 'block';

                form.submit();
            }
        }

    </script>
@endsection
