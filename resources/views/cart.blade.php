@extends('layout')
@section('content')
<!-- Cart Items -->
<style>
    /* Cart Items */
    .container-md {
        max-width: 100rem;
        
        padding: 0 3rem;
        margin-top: 130px;
    }

    .cart {
        margin: 20rem auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-info {
        display: flex;
        flex-wrap: wrap;
    }

    th {
        text-align: left;
        padding: 0.5rem;
        color: white;
        background-color: black;
        font-weight: bold;
    }

    td {
        padding: 1rem 0.5rem;
    }

    td select {
        width: 5rem;
        height: 3rem;
        padding: 0.5rem;
    }

    td a {
        color: orangered;
        font-size: 1.4rem;
    }

    td img {
        width: 8rem;
        height: 8rem;
        margin-right: 1rem;
    }

    .total-price {
        display: flex;
        justify-content: flex-end;
        align-items: end;
        flex-direction: column;
        margin-top: 2rem;
    }

    .total-price table {
        border-top: 3px solid black;
        width: 100%;
        max-width: 35rem;
    }

    td:last-child {
        text-align: right;
    }

    th:last-child {
        text-align: right;
    }

    .btn {
        display: inline-block;
        background-color: black;
        padding: 1.2rem 4rem;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        margin-top: 3rem;
    }

    .btn:hover {
        cursor: pointer;
        opacity: 0.8;
        background-color: white;
        border-color: black;
        color: black;
    }

    input[type="text"] {
        border-color: black;
        height: 40px;
    }

    @media only screen and (max-width: 567px) {
        .cart-info p {
            display: none;
        }
    }
</style>
<div class="container-md cart">
    @if(session()->has('message'))
    <div class="alert alert-success" style="font-size: 18px;font-weight: bold;">
        {!! session()->get('message') !!}
    </div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger" style="font-size: 18px;font-weight: bold;">
        {!! session()->get('error') !!}
    </div>
    @endif
    <table>
        @if(Session::get('cart'))
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        @php
        $total = 0;
        $tax = 0;
        $sum = 0;
        @endphp
        @foreach(Session::get('cart') as $key => $values)
        @php
        $subtotal = $values['product_price']*$values['product_qty'];
        $total+=$subtotal;
        $subtax = $values['product_price']*0.1;
        $tax+=$subtax;
        $sum = $total + $tax
        @endphp
        <tr>
            <td>
                <div class="cart-info">
                    <img src="./uploads/{{$values['product_image_link']}}" alt="">
                    <div>
                        <p>{{$values['product_name']}}</p>
                        <span>Price: {{number_format($values['product_price']).' '. 'VND'}}</span>
                        <br />
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter">Remove</button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle" style="font-weight: 800; font-size: 18px;">Notification</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    This action will delete the product from your shopping cart, do you want to continue?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="/remove?id={{$values['session_id']}}" class="btn btn-primary">Confirm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td>{{$values['product_qty']}}</td>
            <td>{{number_format($subtotal).' '. 'VND'}}</td>
        </tr>
        @endforeach
    </table>
    <div class="total-price">
        <table>
            <tr>
                <td>Total :</td>
                <td>{{number_format($total).' '. 'VND'}}</td>
            </tr>
            <!-- <tr>
                <td>Total</td>
                <td>{{number_format($sum).' '. 'VND'}}</td>
            </tr> -->
        </table>
        <a href="/checkout-form" class="checkout btn">Proceed To Checkout</a>
    </div>
    @else
    <div class="container-md cart">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </table>
        <br>
        <h1 style="text-align: center;">Your cart is empty!
            <br>
            <a href="/"><button type="button" class="btn">Back to shop</button></a>
        </h1>
    </div>
    @endif
</div>
@endsection