@extends('Admin.layouts.inc.app')
@section('title')
     Order Details
@endsection
@section('css')
@endsection
@section('content')
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h5 class="card-title mb-0 flex-grow-1">  Order Details For Order {{$order->id}} </h5>



        </div>
        <div class="card-body">
            <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                   style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th> Type</th>
                    <th>Stage </th>
                    <th>amount</th>

                </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection
@section('js')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'item.title', name: 'item.title'},
            {data: 'type.title', name: 'type.title'},
            {data: 'stage.title', name: 'stage.title'},
            {data: 'amount', name: 'amount'},

        ];
    </script>
    @include('Admin.layouts.inc.ajax',['url'=>'ordersDetails'])

@endsection
