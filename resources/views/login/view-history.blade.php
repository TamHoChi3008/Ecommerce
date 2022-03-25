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
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h1>Your Orders</h1>
            <br>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Date</th>
                        <th scope="col">Coupon</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order as $key => $values)
                    <tr>
                        <th scope="row"><a href="/view-details?code={{$values->ord_code}}">{{$values->ord_code}}</a></th>
                        <td>{{$values->ord_created}}</td>
                        <td>{{$values->ord_giftcode}}</td>
                        <td>{{number_format($values->ord_total).' '. 'VND'}}</td>
                        @if($values->ord_status == 1)
                        <td>Processing</td>
                        @else
                        <td>Confirmed</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
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