@extends('admin.dashboard')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                EDIT PRODUCT
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <?php
                    $message = Session::get('message');
                    if ($message) {
                        echo '<span class="text-alert" style="color: red">' . $message . '</span>';
                        Session::put('message', null);
                    }
                    ?>
                    <form action="/handle-edit-product?id={{$product->product_id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="{{$product->product_name}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Product main image</label>
                            <input type="file" name="product_image" class="form-control" value="{{$product->product_image_link}}">
                            <img src="uploads/{{$product->product_image_link}}" alt="" width="100px" height="100px">
                        </div>

                    
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Quantity</label>
                            <input type="text" name="product_quantity" class="form-control" value="{{$product->product_quantity}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Price</label>
                            <input type="text" name="product_price" class="form-control" value="{{$product->product_price}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Discount ( % )</label>
                            <input type="number" name="product_discount" class="form-control" value="{{$product->product_discount}}">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Content</label>
                            <textarea style="resize: none;" rows="5" class="form-control" name="product_content">{{$product->product_content}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Product Description</label>
                            <textarea style="resize: none;" rows="5" class="form-control" name="product_discription">{{$product->product_discription}}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Category</label>
                            <select name="category_id" class="form-control input-sm m-bot15">
                                @foreach($catalog as $key => $option)
                                @if($option->catalog_id == $product->product_catalog_id)
                                <option selected value="{{$option->catalog_id}}">{{$option->catalog_name}}</option>
                                @else
                                <option value="{{$option->catalog_id}}">{{$option->catalog_name}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Submit</button>

                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection