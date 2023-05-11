<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('clients.store')}}">
    @csrf
    <div class="row g-4">


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="name" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Name</span>
            </label>
            <!--end::Label-->
            <input id="name" required type="text" class="form-control form-control-solid" name="name" value=""/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="code" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Code</span>
            </label>
            <!--end::Label-->
            <input id="code" required type="text" class="form-control form-control-solid" name="code" value=""/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="phone" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Phone</span>
            </label>
            <!--end::Label-->
            <input id="phone" required type="text" class="form-control form-control-solid" name="phone" value=""/>
        </div>



        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="governorate_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> Governorate</span>
            </label>

            <select id="governorate_id" name="governorate_id" class="form-control">
                <option selected disabled>Choose the Governorate</option>
                @foreach($governorates as $governorate)
                    <option value="{{$governorate->id}}"> {{$governorate->title}}</option>
                @endforeach
            </select>

        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="city_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1"> City</span>
            </label>

            <select id="city_id" name="city_id" class="form-control">
                <option selected disabled>Choose the Governorate first</option>
            </select>

        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="previous_indebtedness" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">previous indebtedness</span>
            </label>
            <!--end::Label-->
            <input id="previous_indebtedness" min="0" required type="number" class="form-control form-control-solid" name="previous_indebtedness" value=""/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="email" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Email</span>
            </label>
            <!--end::Label-->
            <input id="email" required type="email" class="form-control form-control-solid" name="email" value=""/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="website" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Website</span>
            </label>
            <!--end::Label-->
            <input id="website" required type="text" class="form-control form-control-solid" name="website" value=""/>
        </div>


        <div class="col-md-12 my-4">
            <label for="address">  Address  </label>

            <div class="form-floating ">

                            <textarea class="form-control " name="address" placeholder=""
                                      id="address"></textarea>
            </div>
        </div>





    </div>
</form>
