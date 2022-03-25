@extends('layout')
@section('content')
<style type="text/css">
    .box {
        margin-top: 120px;
    }

    /* .ipt-ma {
        margin: 0px 0px 20px 0px;
        height: 50px;
        border-radius: none;
        border-color: black;
    }

    .ipt-em {
        margin: 20x 0px 0px 0px;
        height: 50px;
        border-radius: none;
        border-color: black;
    } */

    input[type="text"] {
        font-size: 16px;
        padding-left: 10px;
        width: 20%;
        height: 50px;
        border-radius: none;
        border-color: black;
        margin: 5px;
    }

    .btn-check {
        margin: 20px 0px 0px 0px;
        width: 10%;
        border-radius: none;
        height: 50px;
        font-size: 16px;
        border-color: black;
        background-color: black;
        color: white;
    }

    .btn-check:hover {
        background-color: white;
        color: black;
    }

    .fas {
        margin-left: 5px;
    }
</style>
<!-- All Products -->
<center>
    <div class="box">
        <h1>ORDER TRACKER</h1><br>
        <pre>Track your order by entering the details below.
    We'll need your email address and order number for security reasons.</pre>
    @if(Session()->has('error'))
            <div class="alert alert-danger" style="font-size: 18px;font-weight: bold;">
                {!! Session()->get('error') !!}
            </div>
        @endif
        <pre>
  <form method="POST" action="/view-order">
  @csrf
  {{@method_field('POST')}}
   <input type="text" name="order-code" placeholder=" * ORDER CODE" class="ipt-ma" required>
   <input type="text" name="order-email" placeholder=" * YOUR EMAIL" class="ipt-em" required>
   <button type="submit" class="btn-check">VIEW ORDER<i class="fas fa-chevron-circle-right"></i></button>
   </form>
 </pre>
    </div>
</center>
@endsection