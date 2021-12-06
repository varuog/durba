<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay with Stripe</title>
</head>
<body>
    @if (Session::has('success'))
    <div class="alert alert-success text-center">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <p>{{ Session::get('success') }}</p>
    </div>
    @endif
    <form action="{{ route('stripe.post') }}" id="payment-form" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-12 form-group">
                <label>Name on Card</label>
                <input class="form-control" size="4" type="text"  name="name">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 form-group">
                <label>Card Number</label>
                <input autocomplete="off"  class="form-control" size="20" type="text" name="card_no" maxlength="16" size="16">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 form-group">
                <label>CVC</label>
                <input autocomplete="off"  class="form-control" minlength="3" maxlength="3" placeholder="ex. 311" size="3" type="text"
                    name="cvv">
            </div>
            <div class="col-lg-4 form-group">
                <label>Expiration</label>
                <input class="form-control"  placeholder="MM" size="2" minlength="2" maxlength="2" type="text" name="expiry_month">
            </div>
            <div class="col-lg-4 form-group">
                <label>Year </label>
                <input class="form-control"  placeholder="YYYY" size="4" type="text" minlength="4" maxlength="4" name="expiry_year">
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12 form-group">
                <input type="hidden" name="amount" value="100">
                <button class="form-control btn btn-success submit-button" type="submit"
                    style="margin-top: 10px;">Pay »</button>
            </div>
        </div>
    </form>
</body>
</html>