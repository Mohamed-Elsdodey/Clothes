<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('roles.store')}}">
    @csrf
    <div class="row">


        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Name</span>
            </label>
            <!--end::Label-->
            <input id="name" required type="text" class="form-control form-control-solid" placeholder="" name="name"
                   value=""/>
        </div>

        <div class="d-flex justify-content-center my-2">
            <h2>Permissions</h2>
        </div>



        <div class="row my-4">
            @foreach($permission as $row)

                <span class="form-check col-md-4  ">
                  <input class="form-check-input " type="checkbox" name="permission[]"  value="{{$row->id}}" id="flexCheckDefault{{$row->id}}">
                  <label class="form-check-label mx-1" for="flexCheckDefault{{$row->id}}">
                   {{$row->name}}
                  </label>
                </span>
            @endforeach
        </div>


    </div>
</form>

