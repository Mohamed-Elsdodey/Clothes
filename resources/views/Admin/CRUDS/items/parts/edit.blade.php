<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('items.update',$row->id)}}">
    @csrf
    @method('PUT')
    <div class="row g-4">





        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="title" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Title</span>
            </label>
            <!--end::Label-->
            <input id="title" required type="text" class="form-control form-control-solid" placeholder="" name="title" value="{{$row->title}}"/>
        </div>


        <div class="d-flex flex-column mb-7 fv-row col-sm-6">
            <!--begin::Label-->
            <label for="category_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Category</span>
            </label>
            <select id="category_id" class="form-control" name="category_id">
                <option selected disabled>choice Category</option>

                @foreach($categories as $category)
                    <option @if($row->category_id==$category->id) selected @endif value="{{$category->id}}" >{{$category->title}} </option>

                @endforeach

            </select>
        </div>


        <div class="col-md-12 my-4">
            <label for="details">  details  </label>

            <div class="form-floating ">

                            <textarea class="form-control " name="details" placeholder=""
                                      id="details">{{$row->details}}</textarea>
            </div>
        </div>




    </div>
</form>

