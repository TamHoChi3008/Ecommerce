@extends('layout')
@section('content')
<style>
   .container{
        margin-top:150px;
    }
    .col-md-6 {
        margin-bottom: 100px;
        margin-top: 50px;
    }

    .user-name {
        margin: 0px 0px 20px 0px;
        height: 50px;
        border-radius: none;
        border-color: black;
    }

    .user-passwd {
        margin: 20x 0px 0px 0px;
        height: 50px;
        border-radius: none;
        border-color: black;
    }

    .btn-check {
        margin: 20px 0px 0px 0px;
        width: 100%;
        border-radius: none;
        height: 50px;
        font-size: 16px;
        border-color: black;
        background-color: black;
        color: white;
    }

    .user-register:hover,
    .btn-check:hover {
        background-color: white;
        color: black;
    }

    .user-register {
        margin: 20px 0px 0px 0px;
        width: 81%;
        border-radius: none;
        height: 50px;
        font-size: 16px;
        border-color: black;
        background-color: black;
        color: white;
    }

    .fa,
    .fas {
        margin-left: 5px;
    }

    h3 {
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    input[type="text"] {
        font-size: 16px;
        padding-left: 10px;
        width: 100%;
    }

    input[type="email"] {
        font-size: 16px;
        padding-left: 10px;
        width: 100%;
    }

    input[type="password"] {
        font-size: 16px;
        padding-left: 10px;
        width: 100%;
    }
</style>
</head>

<body>
    <!-- Main Home-->

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>REGISTER</h1><br>

                <?php //Hiển thị thông báo lỗi
                ?>
                @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                @endif
                <form action="/check-register-user" method="post" class="form-login">
                    @csrf
                    <h3>your name :</h3>
                    <input type="text" name="user_fullname" class="user-name" placeholder=" * YOUR NAME">
                    <h3>Your phone number :</h3>
                    <input type="text" name="user_phonenumber" class="user-name" placeholder=" * YOUR PHONE NUMBER">
                    <h3>Login detail :</h3>
                    <input type="text" name="user_email" class="user-name" placeholder=" * EMAIL">
                    <input type="password" name="user_password" class="user-passwd" placeholder=" * PASSWORD">
                    <br>
                    <button type="submit" class="btn-check">REGISTER ACCOUNT<i class="fas fa-chevron-circle-right"></i></button>
                </form><br>
            </div>
            <div class="col-md-6">
                <h1>CREATE AN ACCOUNT</h1>
                <p><i>Create an account is easy. Enter your email address and fill in the form on the next page and enjoy the benefits of having an account.</i></p>
                <i class="fa fa-check-circle"> Simple overview of your personal information</i><br>
                <i class="fa fa-check-circle"> Faster checkout</i>
                <i class="fa fa-check-circle"> A single global login to interact with adidas products and services</i>
                <i class="fa fa-check-circle"> Exclusive offers and promotions</i><br>
                <i class="fa fa-check-circle"> Latest products arrivals</i><br>
                <i class="fa fa-check-circle"> New season and limited collections</i><br>
                <i class="fa fa-check-circle"> Upcoming events</i><br>
            </div>
        </div>
    </div>

    @endsection