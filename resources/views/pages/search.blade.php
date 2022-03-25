@extends('layout')
@section('content')
<!-- All Products -->
<br>
<section class="section sort-category">

    <div class="title-container ">
        <div class="section-titles">
            <div class="section-title active filter-btn" data-id="trend">
                <h1>Search for "{{$key}}"</h1>
            </div>
        </div>
    </div>
    @if(!$product->isEmpty())
    <div class="product-center container">
        @foreach($product as $key => $womans)
        <div class="product">
            <div class="product-header">
                <img src="./uploads/{{$womans->product_image_link}}" class='small' alt="{{$womans->product_name}}">
            </div>
            <div class="product-footer">
                <h3>{{$womans->product_name}}</h3>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="product-price">
                    <h4>{{number_format($womans->product_price).' '. 'VND'}}</h4>
                </div>
            </div>
            <ul>
                <li>
                    <a href="/product-detail?id={{$womans->product_id}}/{{Str::slug($womans->product_name)}}">
                        <i class="far fa-eye"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="far fa-heart"></i>
                    </a>
                </li>
            </ul>
        </div>
        @endforeach
        {{$product->links('pagination::bootstrap-4')}}
    </div>
    @else
    <center>
        <h1>Nothing to show</h1>
    </center>
    @endif
</section>
@endsection