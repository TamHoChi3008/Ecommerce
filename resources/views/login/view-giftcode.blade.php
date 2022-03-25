@extends('layout')
@section('content')
<style>
    .container {
        margin-top: 130px;
        margin-bottom: 30px;
    }

    .link:hover {
        text-transform: uppercase;
        background-color: white;
        color: black;
        text-align: justify;
        font-weight: 700;
    }

    .link {
        text-transform: uppercase;
        background-color: black;
        color: white;
        font-weight: 700;
        text-align: justify;
        letter-spacing: 3px;
    }

    .row {
        margin-bottom: 15px;
    }

    h1 {
        text-transform: uppercase;
        font-weight: 700;
    }

    ul li {
        margin-bottom: 30px;
        text-align: right;
    }

    ul li a {
        text-transform: uppercase;
        text-align: justify;
        letter-spacing: 2px;
    }

    ul li a:hover {
        background-color: black;
        color: white;
        font-weight: 700;
    }

    .fa-chevron-circle-right {
        margin-left: 10px;
    }

    label {
        text-decoration: underline;
        font-size: 20px;
    }

    .coupon {
        border: 5px dotted #bbb;
        width: 80%;
        border-radius: 15px;
        margin: 0 auto;
        max-width: 600px;
    }

    .promo {
        background: #ccc;
        padding: 3px;
    }

    .expire {
        color: red;
    }

    p {
        margin-left: 10px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Your giftcode :</h1>
            <br>
            <div class="coupon">
                <div class="container" style="background-color:white">
                    <h2><b>15% OFF YOUR PURCHASE</b></h2>
                    <p>Hot deals for new customers!</p>
                </div>
                <p>Use Promo Code: <span class="promo">{{$view_giftcode->user_giftcode}}</span></p>
                @if($view_giftcode->user_timesCode == 1)
                <p class="expire">Status: Not use</p>
                <p class="expire">Expires: Once</p>
                @else
                <p class="expire">Status: Used</p>
                <p class="expire">Expires: Was Expired</p>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <ul>
                <li><a href="/my-account?id={{Session::get('user_id')}}">Details information</a></li>
                <li><a href="/view-cart?id={{Session::get('user_id')}}">List items on your cart</a></li>
                <li><a href="/view-history?id={{Session::get('user_id')}}">order history</a></li>
                <li><a href="/view-giftcode?id={{Session::get('user_id')}}">gift code</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection