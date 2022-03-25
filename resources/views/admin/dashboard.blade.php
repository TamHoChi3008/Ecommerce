<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - GREEN Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">



  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="./back-end/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="./back-end/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="./back-end/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="./back-end/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="./back-end/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="./back-end/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="./back-end/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="./back-end/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="/dashboard" class="logo d-flex align-items-center">
        <img src="./back-end/img/slide/logo.png" alt="">
        <span class="d-none d-lg-block">Admin</span>
      </a>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="./back-end/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">
			<?php
				  $name = Session::get("admin_name");
				  if($name){
					  echo $name;
				  }
				?>
			</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>
			  	<?php
				  $name = Session::get("admin_name");
				  if($name){
					  echo $name;
				  }
				?>
			  </h6>
              <span>administrator</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="/logout">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="/dashboard">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Orders-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Orders-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/management-order">
              <i class="bi bi-circle"></i><span>Managements Order</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Coupons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Coupon</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Coupons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/add-coupon">
              <i class="bi bi-circle"></i><span>Add Coupon</span>
            </a>
          </li>
          <li>
            <a href="/show-coupon">
              <i class="bi bi-circle"></i><span>Show Coupon</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Categorys-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Categorys-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/add-category">
              <i class="bi bi-circle"></i><span>Add category</span>
            </a>
          </li>
          <li>
            <a href="/show-category">
              <i class="bi bi-circle"></i><span>Show category</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Products-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Products</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Products-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="/add-product">
              <i class="bi bi-circle"></i><span>Add products</span>
            </a>
          </li>
          <li>
            <a href="/show-product">
              <i class="bi bi-circle"></i><span>Show products</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->


      

    </ul>

  </aside>
		<!--sidebar end-->
		<!--main content start-->
		<main id="main" class="main">
				@yield('content')

		</main>
		<!--main content end-->
	</section>
	<script src="./back-end/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="./back-end/vendor/php-email-form/validate.js"></script>
  <script src="./back-end/vendor/quill/quill.min.js"></script>
  <script src="./back-end/vendor/tinymce/tinymce.min.js"></script>
  <script src="./back-end/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="./back-end/vendor/chart.js/chart.min.js"></script>
  <script src="./back-end/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="./back-end/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="./back-end/js/main.js"></script>
</body>

</html>