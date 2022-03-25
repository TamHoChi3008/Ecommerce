@extends('layout')
@section('content')
<main>

  <!-- Template Main CSS File -->
  <link href="./back-end/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="./back-end/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./back-end/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./back-end/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./back-end/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="./back-end/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="./front-end/css/carousel.css" rel="stylesheet">
  <!-- Hero banner -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(./back-end/img/slide/1.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Green</span></h2>
              <p class="animate__animated animate__fadeInUp">New Generation Furniture</p>
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a> -->
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(./back-end/img/slide/2.jpg)">
          <div class="carousel-container">
            <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Green</span></h2>
              <p class="animate__animated animate__fadeInUp">New Generation Furniture</p>
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a> -->
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(./back-end/img/slide/3.jpg)">
          <div class="carousel-container">
            <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Green</span></h2>
              <p class="animate__animated animate__fadeInUp">New Generation Furniture</p>
              <!-- <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a> -->
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section>

  <!-- Category -->
  <section class="section category">
    <h2 class="title">The Luxury style</h2>
    <div class="category-center container">

      <div class="category-box">
        <img src="./front-end/banner/banner_3.jpg" alt="">
        <div class="content">
          <h2>Ghế bán chạy nhất</h2>
          <span>{{$count_Ghe_items}}Sản phẩm </span>
          <a href="/Ghe">Lựa chọn ngay</a>
        </div>
      </div>

      <div class="category-box">
        <img src="./front-end/banner/banner_1.jpg" alt="">
        <div class="content">
          <h2>Bàn cao cấp của green </h2>
          <span>{{$count_Ban_items}} Sản phẩm </span>
          <a href="/Ban">Lựa chọn ngay</a>
        </div>
      </div>

      <div class="category-box">
        <img src="./front-end/banner/banner_4.jpg" alt="">
        <div class="content">
          <h2>SOFA Cao Cấp</h2>
          <span>{{$count_SOFA_items}}Sản phẩm </span>
          <a href="/SOFA">Lựa chọn ngay</a>
        </div>
      </div>

    </div>
  </section>

  <!-- Trending Products -->
  <section class="section sort-category" id="load_product">
    <div class="title-container ">
      <div class="section-titles">
        <div class="section-title active filter-btn" data-id="trend">
          <span class="dot"></span>
          <h1 class="primary-title">Sản phẩm bán chạy</h1>
        </div>
      </div>
    </div>

    <div class="product-center container">
      @foreach($trending as $key => $value)
      <div class="product">
        <div class="product-header">
          <img src="./uploads/{{$value->detail_product_image}}" class="small" alt="product">
        </div>
        <div class="product-footer">
          <h3>{{$value->detail_product_name}}</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
          </div>
          <br>
          <div class="product-price">
            <h4>{{number_format($value->detail_product_price).' '. 'VND'}}</h4>
          </div>
        </div>
        <ul>
          <li>
            <a href="/product-detail?id={{$value->detail_product_id}}/{{Str::slug($value->detail_product_name)}}">
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

  <!-- discount product -->
  <section class="section sort-category" id="load_product_sale">
    <div class="title-container ">
      <div class="section-titles">
        <div class="section-title active filter-btn" data-id="trend">
          <span class="dot"></span>
          <h1 class="primary-title">Đang giảm giá</h1>
        </div>
      </div>
    </div>

    <div class="product-center container">

      @foreach($saleoff as $key => $value)
      <div class="product">
        <div class="product-header">
          <img src="./uploads/{{$value->product_image_link}}" class="small" alt="product">
        </div>
        <div class="product-footer">
          <h3>{{$value->product_name}}</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
          </div>
          <br>
          <div class="product-price">
            <h4>{{number_format($value->product_price).' '. 'VND'}}</h4>
          </div>
        </div>
        <ul>
          <li>
            <a href="/product-detail?id={{$value->product_id}}/{{Str::slug($value->product_name)}}">
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
    <br>
    <div class="container" id="removed_row_sale">
      <div class="row">
        <div class="col-md-12">
          <center>
            <button type="button" id="load_more_sale" data-id="{{$value->product_id}}" class="btn btn-dark" style="font-size: large;">Load more</button>
          </center>
        </div>
      </div>
    </div>
  </section>

  <!-- Latest product -->
  <section class="section sort-category" id="load_product_lastest">
    <div class="title-container ">
      <div class="section-titles">
        <div class="section-title active filter-btn" data-id="trend">
          <span class="dot"></span>
          <h1 class="primary-title">Sản phẩm mới nhất của GREEN</h1>
        </div>
      </div>
    </div>

    <div class="product-center container">

      @foreach($lastest as $key => $value)
      <div class="product">
        <div class="product-header">
          <img src="./uploads/{{$value->product_image_link}}" class="small" alt="product">
        </div>
        <div class="product-footer">
          <h3>{{$value->product_name}}</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
          </div>
          <br>
          <div class="product-price">
            <h4>{{number_format($value->product_price).' '. 'VND'}}</h4>
          </div>
        </div>
        <ul>
          <li>
            <a href="/product-detail?id={{$value->product_id}}/{{Str::slug($value->product_name)}}">
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
    <br>
    <div class="container" id="removed_row_lastest">
      <div class="row">
        <div class="col-md-12">
          <center>
            <button type="button" id="load_more_lastest" data-id="{{$value->product_id}}" class="btn btn-dark" style="font-size: large;">Load more</button>
          </center>
        </div>
      </div>
    </div>
  </section>

  <!-- blog -->
  <!-- <section class="section blog" id="blog">
    <div class="title-container">
      <div class="section-titles">
        <div class="section-title active">
          <span class="dot"></span>
          <h1 class="primary-title">Latest News</h1>
        </div>
      </div>
    </div>

    <div class="blog-container container">
      <div class="glide" id="glide3">
        <div class="glide__track" data-glide-el="track">
          <ul class="glide__slides">
            <li class="glide__slide">
              <div class="blog-card">
                <div class="card-header">
                  <img src="./front-end/banner/blog_1.jpg" alt="" width="100%" height="350px">
                </div>
                <div class="card-footer">
                  <h3>Styling White Shirts After A Cool Day</h3>
                  <span>By Admin</span>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non
                    provident rem sed minus natus unde vel modi!</p>
                  <a href="#"><button>Read More</button></a>
                </div>
              </div>
            </li>
            <li class="glide__slide">
              <div class="blog-card">
                <div class="card-header">
                  <img src="./front-end/banner/blog_2.jpg" alt="" width="100%" height="350px">
                </div>
                <div class="card-footer">
                  <h3>Styling White Shirts After A Cool Day</h3>
                  <span>By Admin</span>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non
                    provident rem sed minus natus unde vel modi!</p>
                  <a href="#"><button>Read More</button></a>
                </div>
              </div>
            </li>
            <li class="glide__slide">
              <div class="blog-card">
                <div class="card-header">
                  <img src="./front-end/banner/blog_3.jpg" alt="" width="100%" height="350px">
                </div>
                <div class="card-footer">
                  <h3>Styling White Shirts After A Cool Day</h3>
                  <span>By Admin</span>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non
                    provident rem sed minus natus unde vel modi!</p>
                  <a href="#"><button>Read More</button></a>
                </div>
              </div>
            </li>
            <li class="glide__slide">
              <div class="blog-card">
                <div class="card-header">
                  <img src="./front-end/banner/blog_4.jpg" alt="" width="100%" height="350px">
                </div>
                <div class="card-footer">
                  <h3>Styling White Shirts After A Cool Day</h3>
                  <span>By Admin</span>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non
                    provident rem sed minus natus unde vel modi!</p>
                  <a href="#"><button>Read More</button></a>
                </div>
              </div>
            </li>
            <li class="glide__slide">
              <div class="blog-card">
                <div class="card-header">
                  <img src="./front-end/banner/blog_5.jpg" alt="" width="100%" height="350px">
                </div>
                <div class="card-footer">
                  <h3>Styling White Shirts After A Cool Day</h3>
                  <span>By Admin</span>
                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo praesentium, numquam non
                    provident rem sed minus natus unde vel modi!</p>
                  <a href="#"><button>Read More</button></a>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section> -->

  <!-- Facility -->
  <section class="facility section" id="facility">
    <div class="facility-contianer container">
      <div class="facility-box">
        <div class="facility-icon">
          <i class="fas fa-plane"></i>
        </div>
        <p>FREE SHIPPING WORLD WIDE</p>
      </div>

      <div class="facility-box">
        <div class="facility-icon">
          <i class="fas fa-credit-card"></i>
        </div>
        <p>100% MONEY BACK GUARANTEE</p>
      </div>

      <div class="facility-box">
        <div class="facility-icon">
          <i class="far fa-credit-card"></i>
        </div>
        <p>MANY PAYMENT GATWAYS</p>
      </div>

      <div class="facility-box">
        <div class="facility-icon">
          <i class="fas fa-headset"></i>
        </div>
        <p>24/7 ONLINE SUPPORT</p>
      </div>
    </div>
  </section>

</main>
@endsection