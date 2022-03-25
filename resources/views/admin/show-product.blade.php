@extends('admin.dashboard')
@section('content')

<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            SHOW PRODUCT
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert" style="color: red">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Product Quantity</th>
                        <th>Product Price</th>
                        <th>Product Discount</th>
                        <th>Product Category</th>
                        <!-- <th>Date</th> -->
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product as $key => $products)
                    <tr>
                        <td>{{$products->product_id}}</td>
                        <td>{{$products->product_name}}</td>
                        <td><img src="uploads/{{$products->product_image_link}}" alt="" width="100px" height="100px"></td>
                        <td>{{$products->product_quantity}}</td>
                        <td>{{number_format($products->product_price).' '. 'VND'}}</td>
                        <td>{{$products->product_discount}} %</td>
                        <td>{{$products->catalog->catalog_name}}</td>
                        <td>
                            <a href="/edit-product?id={{$products->product_id}}" class="active styling_edit" ui-toggle-class=""><i class="fa fa-pencil-square text-success text-active"></i></a>
                            <form action="/delete-product?id={{$products->product_id}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{@method_field('DELETE')}}
                                <button type="submit" onclick="return confirm('Are you sure to delete?')" class="active"><i class="fa fa-trash text-success text"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection