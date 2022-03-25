<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="./front-end/images/favicon.ico" type="image/x-icon" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;900&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Glidejs StyleSheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/css/glide.core.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    <!-- StyleSheet -->
    <link rel="stylesheet" href="./front-end/css/styles.css" />
    <link rel="stylesheet" href="./front-end/css/navbar.css" />
    <link rel="stylesheet" href="./front-end/css/sweetalert.css" />

    <title>Green</title>

</head>

<body>
    <!-- navbar -->
    @include('pages.navigation')

    <!-- Main content-->
    @yield('content')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0" nonce="2oOJVTd0"></script>

    <!-- Footer -->
    @include('pages.footer')

    <!-- Glidejs Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.4.1/glide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Custom Script -->
    <script src="./front-end/js/slider.js"></script>
    <script src="./front-end/js/index.js"></script>
    <script src="./front-end/js/sweetalert.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart').click(function() {
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_size = $('.cart_product_size_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var cart_product_discount = $('.cart_product_discount_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '/add-to-cart',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_size: cart_product_size,
                        cart_product_qty: cart_product_qty,
                        cart_product_discount: cart_product_discount,
                        cart_product_quantity: cart_product_quantity,
                        _token: _token
                    },
                    success: function() {
                        swal({
                                title: "The product has been added to the store",
                                text: "You can continue to purchase or go to the shopping cart to proceed to checkout",
                                showCancelButton: true,
                                cancelButtonText: "Watch more",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Go to cart",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "/view-cart";
                            });
                    }
                });
            })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'province') {
                    result = 'district';
                }
                $.ajax({
                    url: '/handle-province',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            load_data('');

            function load_data(id = "") {
                $.ajax({
                    url: "/load-data",
                    method: "GET",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('#removed_row').remove();
                        $('#load_product').append(data);
                    }
                })
            }
            $(document).on('click', '#load_more', function() {
                var id = $(this).data('id');
                $('#load_more').html('<b>Loading...</b>');
                load_data(id);
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            load_data('');

            function load_data(id = "") {
                $.ajax({
                    url: "/load-data-sale",
                    method: "GET",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('#removed_row_sale').remove();
                        $('#load_product_sale').append(data);
                    }
                })
            }
            $(document).on('click', '#load_more_sale', function() {
                var id = $(this).data('id');
                $('#load_more_sale').html('<b>Loading...</b>');
                load_data(id);
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            load_data('');

            function load_data(id = "") {
                $.ajax({
                    url: "/load-data-lastest",
                    method: "GET",
                    data: {
                        id: id,
                    },
                    success: function(data) {
                        $('#removed_row_lastest').remove();
                        $('#load_product_lastest').append(data);
                    }
                })
            }
            $(document).on('click', '#load_more_lastest', function() {
                var id = $(this).data('id');
                $('#load_more_lastest').html('<b>Loading...</b>');
                load_data(id);
            });

        });
    </script>

</body>

</html>