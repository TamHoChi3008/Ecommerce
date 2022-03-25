@extends('layout')
@section('content')
<style>
    .container {
        margin-top: 200px;
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

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: white;">
                    <li class="breadcrumb-item"><a href="/view-history">View history</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View detail order</li>
                </ol>
            </nav>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach($view_details as $key => $values)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$values->detail_product_name}}</td>
                        <td>{{number_format($values->detail_product_price).' '. 'VND'}}</td>
                        <td>{{$values->detail_qty}}</td>
                        <td>{{$values->detail_product_discount}} %</td>
                        <td>{{number_format(($values->detail_product_price - $values->detail_product_price*($values->detail_product_discount)/100)*$values->detail_qty).' '. 'VND'}}</td>
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