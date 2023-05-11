<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('provinces.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Name</span>
            </label>
            <!--end::Label-->
            <input id="title" required type="text" class="form-control form-control-solid" placeholder="" name="title" value="{{$row->title}}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="from_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">governorate</span>
            </label>

            <select id="from_id"  name="from_id" class="form-control">

                <option selected disabled>Choose the governorate</option>

                @foreach($countries as $country)
                    <option @if($row->from_id==$country->id) selected @endif value="{{$country->id}}" > {{$country->title}}</option>

                @endforeach
            </select>


        </div>




    </div>
</form>

