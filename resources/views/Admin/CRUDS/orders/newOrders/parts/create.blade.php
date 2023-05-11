<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('orders.store')}}">
    @csrf
    <div class="row g-4">


        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="code" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Code</span>
            </label>
            <!--end::Label-->
            <input id="code" required type="text" class="form-control form-control-solid" placeholder="" name="code"
                   value=""/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="date_order" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Order Date</span>
            </label>
            <!--end::Label-->
            <input id="date_order" required type="date" class="form-control form-control-solid" placeholder=""
                   name="date_order" value=""/>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-4">
            <!--begin::Label-->
            <label for="client_id" class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">Client</span>
            </label>
            <select id="client_id" class="form-control" name="client_id">
                <option selected disabled>choice Client</option>

                @foreach($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}} </option>

                @endforeach

            </select>
        </div>


        <div class="col-md-12 my-4">
            <label for="notes"> Notes </label>

            <div class="form-floating ">

                            <textarea class="form-control " name="notes" placeholder=""
                                      id="notes"></textarea>
            </div>
        </div>


        <table id="table-sub" class="table table-bordered dt-responsive nowrap table-striped align-middle"
               style="width:100%">
            <thead>
            <tr>
                {{--                <th>#</th>--}}
                <th> Item</th>
                <th> Type</th>
                <th> Stage</th>
                <th>Amount</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody id="details-container">
            <tr id="tr-1">
                {{--                <th>1</th>--}}
                <th>
                    <select required  class="form-control" name="item_id[]">
                        <option selected disabled>choice Item</option>

                        @foreach($items as $item)
                            <option value="{{$item->id}}">{{$item->title}} </option>

                        @endforeach

                    </select>
                </th>
                <th>
                    <select required  class="form-control" name="type_id[]">
                        <option selected disabled>choice Type</option>

                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->title}} </option>

                        @endforeach

                    </select>
                </th>
                <th>
                    <select required  class="form-control" name="stage_id[]">
                        <option selected disabled>choice Stage</option>

                        @foreach($stages as $stage)
                            <option value="{{$stage->id}}">{{$stage->title}} </option>

                        @endforeach

                    </select>
                </th>
                <th>
                    <input name="amount[]" type="number" class="form-control" min="1" value="1">
                </th>
                <th>
                    <button class="btn rounded-pill btn-danger waves-effect waves-light delete-sup"
                            data-id="1">
                    <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </span>
                    </button>
                </th>
            </tr>
            </tbody>
        </table>


        <div class="d-flex justify-content-end">
            <button id="addNewDetails" class="btn btn-primary">Add  Item <i class="fa fa-plus mx-2"></i>

            </button>
        </div>


    </div>
</form>


