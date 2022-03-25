<!DOCTYPE html>

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Custom CSS -->
    <link href="./back-end/css/style.css" rel='stylesheet' type='text/css' />
    <link href="./back-end/css/style-responsive.css" rel="stylesheet" />
    <!-- font CSS -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Sign Up Now</h2>
            <form action="/handle-register-admin" method="post">
                @csrf
                <input type="text" class="ggg" name="admin_name" placeholder=" * YOUR NAME">
                <input type="text" class="ggg" name="admin_email" placeholder=" * E-MAIL" required="">
                <input type="password" class="ggg" name="admin_password" placeholder=" * PASSWORD" required="">

                <h6><a href="/admin-login">Already an account?</a></h6>
                <div class="clearfix"></div>
                <input type="submit" value="Sign Up" name="register">
            </form>
        </div>
    </div>
</body>

</html>