<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" >
    @csrf
    <div class="row">


            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-2 mt-2">
                <div class="form-group">
                    <label
                        for="summernote1">
                       {{trans('admin.content')}} </label>
                    <textarea data-validation="" rows="6" class="form-control "
                              name="message"
                              id="summernote1"
                              placeholder="   ">
                          {{$contact->message}}
                                                     </textarea>
                </div>
            </div>

    </div>
</form>

