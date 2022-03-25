@extends('layout')
@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

    * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
    }

    body {
        line-height: 1.5;
        margin-top: 130px;
    }

    .card-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        margin-top: 30px;
        width: auto;
    }

    .imgs-display img {
        width: 100%;
        display: block;
    }

    .imgs-display {
        overflow: hidden;
    }

    .imgs-showcase {
        display: flex;
        width: 100%;
        transition: all 0.5s ease;
    }

    .imgs-showcase img {
        min-width: 100%;
    }

    .imgs-select {
        display: flex;
    }

    .imgs-item {
        margin: 0.3rem;
    }

    .imgs-item:nth-child(1),
    .imgs-item:nth-child(2),
    .imgs-item:nth-child(3) {
        margin-right: 0;
    }

    .imgs-item:hover {
        opacity: 0.8;
    }

    .product-content {
        padding: 2rem 1rem;
    }

    .product-title {
        font-size: 30px;
        text-transform: uppercase;
        font-weight: 900;
        
        color: #12263a;
        margin: 1rem 0;
    }

    .product-title::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 80px;
        background: #12263a;
    }

    .product-link {
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 500;
        font-size: 16px;
        display: inline-block;
        margin-bottom: 0.5rem;
        background: #256eff;
        color: #fff;
        padding: 0 0.3rem;
        transition: all 0.5s ease;
    }

    .product-link:hover {
        opacity: 0.9;
    }

    .product-rating {
        color: #ffc107;
    }

    .product-rating span {
        font-weight: 600;
        color: #252525;
    }

    .product-price {
        margin: 1rem 0;
        font-size: 15px;
        font-weight: 700;
    }

    .product-price span {
        font-weight: 500;
    }

    .last-price span {
        color: #f64749;
        text-decoration: line-through;
    }

    .new-price span {
        color: #256eff;
    }

    .product-detail h2 {
        text-transform: capitalize;
        color: #12263a;
        padding-bottom: 0.6rem;
        font-size: 19px;
        text-decoration: underline;
    }

    .product-detail p {
        font-size: 16px;
        padding: 0.3rem;
        opacity: 0.8;
    }

    .product-detail ul {
        margin: 1rem 0;
        font-size: 15px;
    }

    .product-detail ul li {
        margin: 0;
        list-style: none;
        background: url(./front-end/banner/checked.png) left center no-repeat;
        background-size: 18px;
        padding-left: 3rem;
        margin: 0.4rem 0;
        font-weight: 600;
        opacity: 0.9;
    }

    .product-detail ul li span {
        font-weight: 400;
    }

    .product-detail ul li select {
        width: 10%;
        height: 30px;
    }

    select {
        width: 100%;
        height: 40px;
        padding: 0.5rem;
        border-color: black;
        text-align: center;
    }

    button[type="button"] {
        width: 70%;
        height: 40px;
        background-color: black;
        color: white;
        text-transform: uppercase;
        border-color: black;
    }

    button[type="button"]:hover {
        background-color: white;
        color: black;
        border-color: black;
    }

    .social-links .fab {
        padding: 10px;
    }

    @media screen and (min-width: 992px) {
        .card {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5rem;
        }

        .card-wrapper {
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-imgs {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-content {
            padding-top: 0;
        }
    }
</style>
<div class="card-wrapper">
    <div class="card">
        <!-- card left -->
        <div class="product-imgs">
            <div class="imgs-display">
                <div class="imgs-showcase">
                    <img src="./uploads/{{$productData->product_image_link}}" alt="{{$productData->product_name}}">
                </div>
            </div>
        </div>
        <!-- card right -->
        <div class="product-content">
            <form action="" method="post">
                @csrf
                <h2 class="product-title">{{$productData->product_name}}</h2>
                <div class="product-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    <span>4.7(21)</span>
                </div>

                <div class="product-price">
                    <p class="new-price">New Price: <span>{{number_format($productData->product_price).' '. 'VND'}}</span></p>
                </div>

                <div class="product-detail">
                    <h2>about this item: </h2>
                    <p>{{$productData->product_content}}</p>
                    <ul>
                        <li>Available: <span>in stock ( {{$productData->product_quantity}} products )</span></li>
                        <li>Category: <span>{{$productData->catalog->catalog_name}}</span></li>
                        <li>Shipping Fee: <span>Free</span></li>
                        <!-- <li>Size:
                            <select name="size" id="size" class="cart_product_size_{{$productData->product_id}}">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                            </select>
                        </li> -->
                    </ul>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <select name="quantity" id="quantity" class="cart_product_qty_{{$productData->product_id}}">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <input type="hidden" value="{{$productData->product_id}}" class="cart_product_id_{{$productData->product_id}}">
                    <input type="hidden" value="{{$productData->product_name}}" class="cart_product_name_{{$productData->product_id}}">
                    <input type="hidden" value="{{$productData->product_image_link}}" class="cart_product_image_{{$productData->product_id}}">
                    <input type="hidden" value="{{$productData->product_price}}" class="cart_product_price_{{$productData->product_id}}">
                    <input type="hidden" value="{{$productData->product_quantity}}" class="cart_product_quantity_{{$productData->product_id}}">
                    <input type="hidden" value="{{$productData->product_discount}}" class="cart_product_discount_{{$productData->product_id}}">

                    <div class="col-md-10">
                        <button type="button" name="add-to-cart" data-id_product="{{$productData->product_id}}" class="add-to-cart">Add to cart<i class="fas fa-shopping-cart"></i></button>
                    </div>
                </div>
            </form>
            <br>
            <div class="social-links">
                <p>Share At: </p>
                <div class="fb-like" data-href="http://mysite.local:8000/product-detail?id={{$productData->product_id}}/{{Str::slug($productData->product_name)}}" data-width="" data-layout="button_count" data-action="like" data-size="large" data-share="true"></div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 style="text-decoration:underline ; text-transform:uppercase">Description items :</h2>
            <p>{{$productData->product_discription}}</p>
        </div>
        <div class="col-md-6">
            <div class="fb-comments" data-href="http://mysite.local:8000/product-detail?id={{$productData->product_id}}/{{Str::slug($productData->product_name)}}" data-width="100%" data-numposts="5"></div>
        </div>
    </div>
</div>

<section class="section sort-category">
    <div class="title-container ">
        <div class="section-titles">
            <div class="section-title active filter-btn" data-id="trend">
                <span class="dot"></span>
                <h1 class="primary-title">Related Products</h1>
            </div>
        </div>
    </div>

    <div class="product-center container">
        @foreach($product_related as $key => $related)
        <div class="product">
            <div class="product-header">
                <img src="./uploads/{{$related->product_image_link}}" class='small' alt="{{$related->product_name}}">
            </div>
            <div class="product-footer">
                <h3>{{$related->product_name}}</h3>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <div class="product-price">
                    <h4>{{number_format($related->product_price).' '. 'VND'}}</h4>
                </div>
            </div>
            <ul>
                <li>
                    <a href="/product-detail?id={{$related->product_id}}/{{Str::slug($related->product_name)}}">
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
    </div>
</section>

<script>
    const imgs = document.querySelectorAll('.imgs-select a');
    const imgBtns = [...imgs];
    let imgId = 1;

    imgBtns.forEach((imgItem) => {
        imgItem.addEventListener('click', (event) => {
            event.preventDefault();
            imgId = imgItem.dataset.id;
            slideImage();
        });
    });

    function slideImage() {
        const displayWidth = document.querySelector('.imgs-showcase img:first-child').clientWidth;

        document.querySelector('.imgs-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
    }

    window.addEventListener('resize', slideImage);
</script>

@endsection