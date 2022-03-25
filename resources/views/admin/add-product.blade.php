@extends('admin.dashboard')
@section('content')

<form action="/handle-add-product" method="post" enctype="multipart/form-data">
               @csrf
               <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                  <input type="text" name="product_name" class="form-control" placeholder="Product Name">
                </div>
              </div>

              <div class="row mb-3">
              <label class="col-sm-2 col-form-label">Select Category</label>
              <div class="col-sm-10">
                <select class="form-control input-sm m-bot15" aria-label="Default select example"
                name="category_id">
                    @foreach($catalog as $key => $option)
                    <option value="{{$option->catalog_id}}">{{$option->catalog_name}}</option>
                    @endforeach
                </select>
              </div>
            </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Product image</label>
                <div class="col-sm-10">
                 <input type="file" name="product_image" class="form-control" placeholder="Product Image">
               </div>

              



              <div class="row mb-3">
                <label  class="col-sm-2 col-form-label">Quantity</label>
                <div class="col-sm-10">
                  <input type="text" name="product_quantity" class="form-control" placeholder="Product Quantity">
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Price</label>
                <div class="col-sm-10">
                 <input type="text" name="product_price" class="form-control" placeholder="Product Price" required>
               </div>
             </div>

             <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Discount</label>
              <div class="col-sm-10">
                <input type="number" name="product_discount" class="form-control" placeholder="Discount" required>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">product Content</label>
              <div class="col-sm-10">
                <textarea style="resize: none;" rows="5" class="form-control" name="product_content" placeholder="Product Content" required></textarea>
              </div>
            </div>

            <div class="row mb-3">
              <label for="inputNumber" class="col-sm-2 col-form-label">Product Description</label>
              <div class="col-sm-10">
                <textarea style="resize: none;" rows="5" class="form-control" name="product_discription" placeholder="Product Description" required></textarea>
              </div>
            </div>


           

            <div class="row mb-3">
              <div class="col-sm-12">
                <button type="submit" name="add_product" class="btn btn-primary">Submit Form</button>
              </div>
            </div>

          </form>
@endsection