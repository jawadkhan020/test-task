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
              <h5 class="mb-0 ">Car Categories</h5>
                    </div>
              <div class="col-md-6 text-end" >
                <div class="my-auto mt-lg-0 mt-4">

                  <div class="ms-auto my-auto">
                    <a href="#" class="btn bg-gradient-dark btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modal-form">Create New Category</a>

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
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                  <tr>
                    <td class="text-sm font-weight-normal">{{$loop->iteration}}</td>
                    <td class="text-sm font-weight-normal">{{$item->name}}</td>
                    <td class="text-sm font-weight-normal">{{date('d-m-Y', strtotime($item->created_at));}}</td>
                    <td class="text-sm font-weight-normal">
                        <a class="btn btn-warning"  onclick="assingtemp(this)" data-all="{{$item}}"> Edit</a>
                 
                        <form style="float: left;padding-right:20px;" action="{{route('admin.category.delete', $item->id)}}" method="POST">
                          @csrf
                          
                          <button type="submit" class="btn btn-danger" onclick="return catDelete()">Delete</button>
                        </form>
                      
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
 <div class="modal fade" id="edit-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card card-plain">
            <div class="card-header pb-0 text-left">
              <h5 class="">Edit Category</h5>
            </div>
            <div class="card-body">
              <form role="form text-left" action="{{route('admin.category.update')}}" method="POST">
                @csrf
                <input type="hidden" id="edit-cat-id" name="cat_id" >
                
                <div class="input-group input-group-outline my-3">
                  <label class="form-label">Category Name</label>
                  <input type="text" class="form-control" id="edit-cat-name" name="name" required onfocus="focused(this)" onfocusout="defocused(this)">
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
    {{-- Add Modal --}}
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
          <div class="modal-content">
            <div class="modal-body p-0">
              <div class="card card-plain">
                <div class="card-header pb-0 text-left">
                  <h5 class="">Add Category</h5>
                </div>
                <div class="card-body">
                  <form role="form text-left" action="{{route('admin.category.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <div class="input-group input-group-outline my-3">
                      <label class="form-label">Category Name</label>
                      <input type="text" class="form-control" name="name" required onfocus="focused(this)" onfocusout="defocused(this)">
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
{{-- Show edit model --}}
<script>
     function assingtemp(val){
        data = $(val).attr('data-all');
        data = JSON.parse(data);
        $('#edit-cat-id').val(data.id);
        $('#edit-cat-name').val(data.name);
        $('#edit-model').modal('show');
    };
</script>
<script>
  function catDelete() {
  if (confirm("Are you sure want to delete?")) {
      return true;
  }
  return false;
}
</script>
@endsection