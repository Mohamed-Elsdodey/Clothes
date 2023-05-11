@extends('Admin.layouts.inc.app')
@section('title')
     Orders
@endsection
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">  Orders </h5>

                <div>
                    <button id="addBtn" class="btn btn-primary"> Add Order</button>
                </div>

        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Order Code</th>
                    <th>Order Date</th>
                    <th>Details</th>
                    <th> Date created</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2><span id="operationType"></span> Order </h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <button class="btn btn-sm btn-icon btn-active-color-primary" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body py-4" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-2">
                            Cancel
                        </button>
                        <button form="form" type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">Ok</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

@endsection
@section('js')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'client.name', name: 'client.name'},
            {data: 'code', name: 'code'},
            {data: 'date_order', name: 'date_order'},
            {data: 'details', name: 'details'},
            {data: 'created_at', name: 'created_at'},
            {data: 'notes', name: 'notes'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('Admin.layouts.inc.ajax',['url'=>'orders'])
      <script>
          $(document).on('click','.delete-sup',function (){
              var rowId=$(this).attr('data-id');
              $(`#tr-${rowId}`).remove();
          })
      </script>
    <script>
        $(document).on('click','#addNewDetails',function (e){
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.makeRowDetailsForOrder')}}",

                success: function (res) {

                    $('#details-container').append(res.html);
                    $("#Modal").animate({ scrollTop: $(document).height() }, 1000);


                },
                error: function (data) {
                    // location.reload();
                }
            });

        })
    </script>

@endsection
