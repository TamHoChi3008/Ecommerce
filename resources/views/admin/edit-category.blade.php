@extends('admin.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Update product catalog :
            </header>
            <div class="panel-body">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert" style="color: red">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <div class="position-center">
                    <form action="/handle-edit-catalog?id={{$catalog->catalog_id}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="Category_name">Catalog Name</label>
                            <input type="text" name="Category_name" value="{{$catalog->catalog_name}}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="Category_name">Catalog Main</label>
                            <input type="text" name="Category_main" value="{{$catalog->catalog_parent}}" class="form-control">
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Update</button>

                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection