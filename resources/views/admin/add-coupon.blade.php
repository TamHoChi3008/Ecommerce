@extends('admin.dashboard')
@section('content')


                    <form action="/handle-add-coupon" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
  <label class="col-sm-2 col-form-label">Giftcode Name</label>
  <div class="col-sm-10">
    <input type="text" name="giftcode_name" class="form-control" required>
  </div>
</div>

<div class="row mb-3">
  <label class="col-sm-2 col-form-label">Giftcode Time</label>
  <div class="col-sm-10">
    <input type="text" name="giftcode_times" class="form-control" required>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Select Category</label>
    <div class="col-sm-10">
      <select name="giftcode_condidtion" class="form-control input-sm m-bot15">
        <option value="1">Discount by percent</option>
        <option value="2">Direct discount</option>
      </select>
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label">Discount</label>
    <div class="col-sm-10">
      <input type="text" name="giftcode_discount" class="form-control" required>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-sm-12">
        <button type="submit" name="add_product" class="btn btn-primary">Submit Form</button>
    </div>
</div>

</form>
@endsection