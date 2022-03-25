@extends('layout')
@section('content')
<style>
    .container {
        margin-top: 200px;
        margin-bottom: 30px;
    }

    .link:hover {
        text-transform: uppercase;
        background-color: white;
        color: white;
        text-align: justify;
        font-weight: 700;
    }

    .link {
        text-transform: uppercase;
        background-color: black;
        color: white;
        font-weight: 700;
        text-align: justify;
        letter-spacing: 3px;
    }

    .row {
        margin-bottom: 15px;
    }

    h1 {
        text-transform: uppercase;
        font-weight: 700;
    }

    ul li {
        margin-bottom: 30px;
        text-align: right;
    }

    ul li a {
        text-transform: uppercase;
        text-align: justify;
        letter-spacing: 2px;
    }

    ul li a:hover {

        color: white;
        font-weight: 700;
    }

    .fa-chevron-circle-right {
        margin-left: 10px;
    }

    label {
        text-decoration: underline;
        font-size: 20px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="row-3">
                <h1>details</h1>
                <h3>{{$userData->user_name}}</h3>
                <h3>{{$userData->user_phone}}</h3>
            </div>
            <hr>

            <div class="row-4">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert" style="color: red">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <h1>Login details</h1>
                <label>Email</label>
                <h3>{{$userData->user_email}}</h3>
                <label>Password</label>
                <br>
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change password</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/update-password?id={{$userData->user_id}}" method="post">
                                    @csrf
                                    {{@method_field('post')}}
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">New password :</label>
                                        <input type="password" class="form-control" name="new-password" id="recipient-name" required>
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row-2">
                <h1>Logout from web browsers</h1>
                <p>This will log you out from all web browsers you have used to access the website.
                    To log in again, you'll have to enter your credentials.</p>
                <a href="/logout-user" class="link">Log me out</a><i class="fas fa-chevron-circle-right"></i>
            </div>
            <hr>

            <div class="row-2">
                <h1>delete account</h1>
                <p>By deleting your account you will no longer have access to the information stored in your GREEN account such as order history or your wishlist.</p>
                <a href="/del-account" class="link">Delete account</a><i class="fas fa-chevron-circle-right"></i>
            </div>
            <hr>

        </div>

        <div class="col-md-4">
            <ul>
                <li><a href="/my-account?id={{Session::get('user_id')}}">Details information</a></li>
                <li><a href="/view-cart?id={{Session::get('user_id')}}">List items on your cart</a></li>
                <li><a href="/view-history?id={{Session::get('user_id')}}">order history</a></li>
                <li><a href="/view-giftcode?id={{Session::get('user_id')}}">gift code</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection