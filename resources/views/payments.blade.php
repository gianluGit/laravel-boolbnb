@extends('layouts.app')
@section('content')

@auth
@if ($suite -> user_id == Auth::user() -> id)
<div class="container">
    <form method="post" id="payment-form" action="{{route('payment-checkout', $suite -> id)}}">
        @csrf
        @method('POST')
        <section>
            <label for="amount">
                <span class="input-label">Choose your plan</span>
                <div class="input-wrapper amount-wrapper">
                    <select id="amount" name="amount">
                        <option value="2.99">€2.99 for 24h</option>
                        <option value="5.99">€5.99 for 72h</option>
                        <option value="9.99">€9.99 for 144h</option>
                    </select>
                </div>
            </label>
            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </section>
        <input id="nonce" name="payment_method_nonce" type="hidden" />
        <button class="button btn btn-success" type="submit"><span>Proceed</span></button>
    </form>
</div>
@else
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">{{ __('Dashboard') }}</div>

                  <div class="card-body">

                      {{ __('Unauthorized!') }}
                      <br><br>

                      <a href="{{ route('welcome') }}">Back to Main page</a>

                  </div>
              </div>
          </div>
      </div>
  </div>
@endif
@endauth

<script src="https://js.braintreegateway.com/web/dropin/1.25.0/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#payment-form');
    var client_token = "{{$token}}";
    braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin'
        // paypal: {
        //   flow: 'vault'
        // }
    }, function(createErr, instance) {
        if (createErr) {
            console.log('Create Error', createErr);
            return;
        }
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            instance.requestPaymentMethod(function(err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }
                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>

@endsection
