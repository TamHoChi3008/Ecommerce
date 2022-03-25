@extends('admin.dashboard')
@section('content')
<!-- End Page Title -->

  <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">General Form Elements</h5>

              <!-- General Form Elements -->
              <form action="/handle-add-catalog" method="post" enctype="multipart/form-data"action="/handle-add-catalog" method="post" enctype="multipart/form-data">
                 @csrf
                <div class="row mb-3">
                  <label for="Category_name" class="col-sm-2 col-form-label">Catalog Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="Category_name">
                  </div>
                </div>
                <div class="row mb-3">
                  <label  class="col-sm-2 col-form-label">Catalog Main</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="Category_main">
                  </div>
                </div>


                <div class="row mb-3">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit Form</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>  

      </div>
    </section>
@endsection