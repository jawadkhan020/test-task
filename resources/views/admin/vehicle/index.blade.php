@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid py-4">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-lg-flex justify-content-between">
                    <div>
              <h5 class="mb-0 ">Vehicles</h5>
                    </div>
              <div class="col-md-6 text-end" >
                <div class="my-auto mt-lg-0 mt-4">

                  <div class="ms-auto my-auto">
                    <a href="#" class="btn bg-gradient-dark btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modal-form">Add new  Vehicle</a>

                  </div>
                </div>
              </div>
                </div>
            </div>
            <div class="table-responsive">
              <table class="table table-flush" id="datatable-search">
                <thead class="thead-light">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Color</th>
                    <th>Registration No</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($vehicle as $item)
                  <tr>
                    <td class="text-sm font-weight-normal">{{$loop->iteration}}</td>
                    <td class="text-sm font-weight-normal">{{$item->name}}</td>
                    <td class="text-sm font-weight-normal">{{$item->category->name}}</td>
                    <td class="text-sm font-weight-normal">{{$item->model}}</td>
                    <td class="text-sm font-weight-normal">{{$item->model}}</td>
                    <td class="text-sm font-weight-normal">{{$item->color}}</td>
                    <td class="text-sm font-weight-normal">{{$item->registration_no}}</td>
                    <td class="text-sm font-weight-normal">{{date('d-m-Y', strtotime($item->created_at));}}</td>
                    <td class="text-sm font-weight-normal">
                        <a class="btn btn-warning"  onclick="assingtemp(this)" data-all="{{$item}}"> Edit</a>
                        
                          <button type="submit" class="btn btn-danger remove-use" data-id="{{ $item->id }}" data-action="{{ route('admin.vehicle.delete',$item->id) }}" onclick="deleteConfirmation({{$item->id}})">Delete</button>
                
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>  
 {{-- Edit Modal --}}
 <div class="modal fade" id="edit-model" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card card-plain">
            <div class="card-header pb-0 text-left">
              <h5 class="">Edit Vehicle</h5>
            </div>
            <div class="card-body">
              <form role="form text-left" action="{{route('admin.vehicle.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" id="edit-id" name="id">
                <div class="input-group input-group-outline my-3">
                    <select name="cat_id" id=""  class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                        <option value="" selected disabled>Select Category</option>
                        @foreach ($data as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>     
                        @endforeach
                    </select>
                  </div>
                <div class="input-group input-group-outline my-3">
                  {{-- <label class="form-label"> Name</label> --}}
                  <input type="text" id="edit-name" class="form-control" name="name" required onfocus="focused(this)" onfocusout="defocused(this)">
                </div>
                <div class="input-group input-group-outline my-3">
                    {{-- <label class="form-label"> Image</label> --}}
                    <input type="file" class="form-control" name="images" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                <div class="input-group input-group-outline my-3">
                    {{-- <label class="form-label"> Brand</label> --}}
                    <input type="text" id="edit-brand" class="form-control" name="brand" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    {{-- <label class="form-label"> Model</label> --}}
                    <input type="text" id="edit-vmodel" class="form-control" name="model" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    {{-- <label class="form-label"> Color</label> --}}
                    <input type="text" id="edit-color" class="form-control" name="color" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <div class="input-group input-group-outline my-3">
                    {{-- <label class="form-label"> Registration No</label> --}}
                    <input type="text" id="edit-registration_no" class="form-control" name="registration_no" required onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-round bg-gradient-info btn-md mt-4 mb-0 "> Edit Now</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    {{-- Add Modal --}}
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card card-plain">
                <div class="card-header pb-0 text-left">
                  <h5 class="">Add Vehicle</h5>
                </div>
                <div class="card-body">
                  <form role="form text-left" action="{{route('admin.vehicle.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="input-group input-group-outline my-3">
                        <select name="cat_id" id="" required  class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                            <option value="" selected disabled>Select Category</option>
                            @foreach ($data as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>     
                            @endforeach
                        </select>
                      </div>
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label"> Name</label>
                      <input type="text" class="form-control" name="name" required onfocus="focused(this)" onfocusout="defocused(this)">
                    </div>
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label"> Image</label>
                        <input type="file" class="form-control" name="images" required onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                    <div class="input-group input-group-outline my-3">
                        <label class="form-label"> Brand</label>
                        <input type="text" class="form-control" name="brand" required onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label"> Model</label>
                        <input type="text" class="form-control" name="model" required onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label"> Color</label>
                        <input type="text" class="form-control" name="color" required onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label"> Registration No</label>
                        <input type="text" class="form-control" name="registration_no" required onfocus="focused(this)" onfocusout="defocused(this)">
                      </div>
                    <div class="text-end">
                      <button type="submit" class="btn btn-round bg-gradient-info btn-md mt-4 mb-0 "> Create Now</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script> 
  @if (session('status'))
               
                      swal({
                            title: '{{ session('status') }}',
                            icon: "success",
                          });
                @endif
</script>

<script>
     function assingtemp(val){
        data = $(val).attr('data-all');
        data = JSON.parse(data);
        $('#edit-id').val(data.id);
        // $('#edit-cat-id').val(data.id);
        $('#edit-name').val(data.name);
        $('#edit-brand').val(data.brand);
        $('#edit-vmodel').val(data.model);
        $('#edit-color').val(data.color);
        $('#edit-registration_no').val(data.registration_no);
        $('#edit-model').modal('show');
    };
</script>
<script type="text/javascript">
  function deleteConfirmation(id) {
      swal({
          title: "Delete?",
          text: "Please ensure and then confirm!",
          type: "warning",
          showCancelButton: !0,
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          reverseButtons: !0
      }).then(function (e) {
  
          if (e === true) {
         
              var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     
              $.ajax({
                  type: 'POST',
                  url: "{{url('/admin/dashboard/vehicle-delete')}}/" + id,
                  data: {_token: CSRF_TOKEN},
                  dataType: 'JSON',
                  success: function (results) {

                      if (results.success === true) {
                          swal("Done!", results.message, "success");
                          fetchcategory();
                      } else {
                          swal("Error!", results.message, "error");
                      }
                  }
              });

          } else {
              e.dismiss;
          }

      }, function (dismiss) {
          return false;
      })
  }
</script>
@endsection