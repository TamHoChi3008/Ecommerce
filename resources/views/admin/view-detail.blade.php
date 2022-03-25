@extends('admin.Dashboard')
@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: white;">
                <li class="breadcrumb-item"><a href="/management-order">View genaral</a></li>
                <li class="breadcrumb-item active" aria-current="page">View detail order</li>
            </ol>
        </nav>
        <div class="panel-heading">
            CUSTOMER INFORMATION
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $key => $values)
                    <tr>
                        <td>{{$values->user_id}}</td>
                        <td>{{$values->user_name}}</td>
                        <td>{{$values->user_email}}</td>
                        <td>{{$values->user_phone}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            SHIPPING INFORMATION
        </div>
        <div class="table-responsive">

            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trans as $key => $values)
                    <tr>
                        <td>{{$values->trans_id }}</td>
                        <td>{{$values->trans_user_fullname}}</td>
                        <td>{{$values->trans_user_phone}}</td>
                        <td>{{$values->trans_user_address}}</td>
                        <td>{{$values->trans_note}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br><br>
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            ORDER LIST DETAILS
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID Product</th>
                        <th>Product Name</th>
                        <th>Product Size</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                        <th>Product discount</th>
                        <th>Product Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = 1; ?>
                    @foreach($order_details as $key => $values)
                    <tr>
                        <td>{{$stt++}}</td>
                        <td>{{$values->detail_product_id}}</td>
                        <td>{{$values->detail_product_name}}</td>
                        <td>{{number_format($values->detail_product_price).' '. 'VND'}}</td>
                        <td>{{$values->detail_qty}}</td>
                        <td>{{$values->detail_product_discount}} %</td>
                        @if($values->detail_product_discount != 0)
                        <td>{{number_format($values->detail_product_price-($values->detail_product_price*($values->detail_product_discount/100))*$values->detail_qty).' '. 'VND'}}</td>
                        @else
                        <td>{{number_format($values->detail_product_price*$values->detail_qty).' '. 'VND'}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="row-3" style="text-align: right; margin-right: 15px;">
                <div class="col-md-12">Total orders : {{number_format($total_price).' '. 'VND'}}</div>
                <div class="col-md-12">Shipping : FREE</div>
                <div class="col-md-12">Giftcode : {{$giftcode}}</div>
            </div>
        </div>
    </div>
</div>
@endsection