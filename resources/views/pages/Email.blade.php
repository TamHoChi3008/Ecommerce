<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Email</title>
</head>

<body>

    <div class="container">
        <center>
            <div class="row-2">
                <h4>Thank you {{$shipping_mail['user_name']}} for ordering at Green Furniture,</h4>
                <p>Green Furniture is pleased to announce that your order #{{$order_mail['order_code']}} has been received and is
                    in the process of
                    being
                    processed.
                    Green Furniture will notify you as soon as the goods are ready to be delivered.</p>
            </div>
        </center>
        <br>
        <?php

        use Carbon\Carbon;

        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $i = 0;
        ?>

        <h4 style="color:steelblue">ORDER INFORMATION #{{$order_mail['order_code']}} {{$now}}</h4>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Note</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="col">{{$shipping_mail['user_name']}}</td>
                        <td scope="col">{{$shipping_mail['trans_user_fullname']}}</td>
                        <td scope="col">{{$shipping_mail['trans_user_phone']}}</td>
                        <td scope="col">{{$shipping_mail['trans_user_address']}}</td>
                        <td scope="col">{{$shipping_mail['trans_note']}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>
        <div class="row-2">
            <h5>Estimate time for ship: next weeks</h5>
            <h5>shipping cost: free</h5>
        </div>
        <br>
        <h4 style="color:steelblue;">ORDER DETAILS</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantities</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart_mail as $cart)
                <tr>
                    <td>{{$i+=1}}</td>
                    <td>{{$cart['product_name']}}</td>
                    <td>{{$cart['product_price']}}</td>
                    <td>{{$cart['product_sales_quantity']}}</td>
                    <td>{{$cart['product_price']*$cart['product_sales_quantity']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <center>
            <a href="http://mysite.local:8000/"><button class="btn btn-success">DETAILS AT SHOP</button></a>
        </center>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>

</html>