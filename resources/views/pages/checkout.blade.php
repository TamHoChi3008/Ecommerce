@extends('layout')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');

    .display-5 {
        font-size: 20px;
    }

    .container {
        margin-top: 130px;
        margin-bottom: 30px;
    }

    p {
        text-align: right;
    }

    input[type="text"] {
        font-size: 18px;
        padding-left: 10px;
        width: 100%;
        height: 50px;
        border-radius: none;
        border-color: black;
    }

    select {
        width: 100%;
        height: 40px;
        border-radius: none;
        border-color: black;
        font-size: 15px;
    }

    label {
        font-size: 18px;
        margin-left: 5px;
    }

    .btn {
        width: 100%;
        height: 50px;
        background-color: black;
        color: white;
        font-size: 15px;
    }

    .btn:hover {
        background-color: white;
        color: black;
        border-color: black;
    }

    .h6 {
        font-size: 20px;
        font-weight: 700px;
    }

    .h6 a {
        text-decoration: none;
        font-size: 20px;
    }

    .item img {
        object-fit: cover;
        border-radius: 5px;
    }

    .item {
        position: relative;
    }

    .number {
        position: absolute;
        font-weight: 800;
        color: #fff;
        background-color: #0033ff;
        padding-left: 7px;
        border-radius: 50%;
        border: 1px solid #fff;
        width: 25px;
        height: 25px;
        top: -5px;
        right: -5px;
    }
</style>
<div class="container">
    <h1>CONFIRM ORDER</h1>
    <hr>
    <div class="row">
        <div class="col-lg-5 col-md-8 col-sm-10 offset-lg-0 offset-md-2 offset-sm-1">
            <form method="post" action="/handle-order">
                @csrf
                <div class="row">
                    <div class="col-lg-10">
                        <label>Full name :</label>
                        <div class="d-flex jusify-content-start align-items-center rounded p-2">
                            <input type="text" name="fullname" id="fullname" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5">
                        <label>City :</label>
                        <div class="d-flex jusify-content-start align-items-center rounded p-2">
                            <select name="province" id="province" class="checkbox choose province">
                                <option value="0">SELECT PROVINCE</option>
                                @foreach($province as $key => $option)
                                <option value="{{$option->matp}}">{{$option->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <label>District :</label>
                        <div class="d-flex jusify-content-start align-items-center rounded p-2">
                            <select name="district" id="district" class="checkbox district">
                                <option value="0">SELECT DISTRICT</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <label>Detail address :</label>
                        <div class="d-flex jusify-content-start align-items-center rounded p-2">
                            <input type="text" name="detail_address" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <label>Phone contact :</label>
                        <div class="d-flex jusify-content-start align-items-center rounded p-2">
                            <input type="text" name="phonenumber" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-10">
                        <label>Note :</label>
                        <div class="d-flex jusify-content-start align-items-center rounded p-2">
                            <input type="text" name="other_infor">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="d-flex jusify-content-start align-items-center rounded p-2">
                            <!-- <button type="submit" class="btn">CONFIRM ORDER</button> -->
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalCenter">CONFIRM ORDER</button>
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
                                            Please make sure that the information you fill in is correct,
                                            we will not be able to deliver to you if you provide the wrong information.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-secondary">Continue</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(Session::get('coupon'))
                @foreach(Session::get('coupon') as $key => $gift)
                <input type="hidden" name="giftcode" value="{{$gift['giftcode_name']}}">
                @endforeach
                @else
                <input type="hidden" name="giftcode" value="Don't have">
                @endif
        </div>

        <div class="col-lg-7 col-md-8 col-sm-10 offset-lg-0 offset-md-2 offset-sm-1 pt-lg-0 pt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="h6">ITEMS SUMMARY</div>
            </div>
            @php
            $total = 0;
            $tax = 0;
            $sum = 0;
            $discount = 0;
            $hasDiscountPrice = 0;
            $discountCoupon = 0;
            @endphp

            @foreach(Session::get('cart') as $key => $values)

            <?php
            if ($values['product_discount'] != 0) {
                $subtotal = $values['product_price'] * $values['product_qty'];
                $hasDiscountPrice = $subtotal - $subtotal * ($values['product_discount'] / 100);
                $total += $hasDiscountPrice;
                $subtax = $values['product_price'] * 0.1;
                $tax += $subtax;
                $sum = $total + $tax;
            } else {
                $subtotal = $values['product_price'] * $values['product_qty'];
                $total += $subtotal;
                $subtax = $values['product_price'] * 0.1;
                $tax += $subtax;
                $sum = $total + $tax;
            }
            ?>

            <div class="d-flex jusitfy-content-between align-items-center pt-3 pb-2 border-bottom">
                <div class="item pr-2">
                    <img src="./uploads/{{$values['product_image_link']}}" alt="" width="80" height="80">
                    <div class="number">{{$values['product_qty']}}</div>
                </div>
                <div class="d-flex flex-column px-3">
                    <b class="h4">{{$values['product_name']}}</b>
                    <b>{{number_format($values['product_price']).' '. 'VND'}}</b>
                    <b>- {{$values['product_discount']}}%</b>
                </div>
                <div class="ml-auto">
                    @if($values['product_discount'] != 0)
                    <b>{{number_format($hasDiscountPrice).' '. 'VND'}}</b>
                    @else
                    <b>{{number_format($subtotal).' '. 'VND'}}</b>
                    @endif
                </div>
            </div>
            @endforeach
            <br>
            <div class="d-flex align-items-center">
                <div class="display-5">Subtotal :</div>
                <div class="ml-auto font-weight-bold">{{number_format($total).' '. 'VND'}}</div>
            </div>
            <div class="d-flex align-items-center">
                <div class="display-5">Shipping :</div>
                <div class="ml-auto font-weight-bold">FREE</div>
            </div>

            @if (Session::get('coupon'))
            @foreach (Session::get('coupon') as $key => $codes)
            @if ($codes['giftcode_condidtion'] == 1)
            @php
            $discountCoupon = $total*($codes['giftcode_discount']/100);
            $sum-=$discountCoupon;
            @endphp

            <div class="d-flex align-items-center py-2 border-bottom">
                <div class="display-5">Giftcode :</div>
                <div class="ml-auto font-weight-bold">- {{$codes['giftcode_discount']}}%</div>
            </div>

            @else
            @php
            $discountCoupon = $codes['giftcode_discount'];
            $sum-=$discountCoupon;
            @endphp

            <div class="d-flex align-items-center py-2 border-bottom">
                <div class="display-5">Giftcode :</div>
                <div class="ml-auto font-weight-bold">- {{number_format($codes['giftcode_discount']).' '. 'VND'}}</div>
            </div>
            @endif
            @endforeach
            @endif
            <div class="d-flex align-items-center py-2">
                <div class="display-5">Total :</div>
                <div class="ml-auto d-flex">
                    <div class="font-weight-bold">{{number_format($sum).' '. 'VND'}}</div>
                </div>
            </div>
            <div class="d-flex align-items-center py-2">(Tax included {{number_format($tax).' '. 'VND'}})</div>
            <br>
            @if(session()->has('message'))
            <div class="alert alert-success" style="font-size: 18px;font-weight: bold;">
                {!! session()->get('message') !!}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger" style="font-size: 18px;font-weight: bold;">
                {!! session()->get('error') !!}
            </div>
            @endif
            <input type="hidden" name="total_price" value="{{$sum}}">
            </form>

            <form action="/handle-giftcode" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-9">
                        <input type="text" name="giftcode" id="giftcode" placeholder=" Put your giftcode here : *" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn">Apply</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <br>
    <p class="text-muted">Need help with an order?</p>
    <p class="text-muted"><a href="#" class="text-danger">Hotline:</a> +777971945 (International)</p>
</div>
@endsection