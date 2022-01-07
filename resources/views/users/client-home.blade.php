@extends('layouts.app', ['page' => __('User Profile'), 'pageSlug' => 'profile'])

@section('content')
<style>

.sidebar .sidebar-wrapper>.nav [data-toggle="collapse"]~div>ul>li>a i, .sidebar .sidebar-wrapper .user .info [data-toggle="collapse"]~div>ul>li>a i, .off-canvas-sidebar .sidebar-wrapper>.nav [data-toggle="collapse"]~div>ul>li>a i, .off-canvas-sidebar .sidebar-wrapper .user .info [data-toggle="collapse"]~div>ul>li>a i {
  line-height: 32px;
}
.custom_color , .sorting_1 , table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.odd {
    background: #27293d !important;
}
.dataTables_wrapper .dataTables_length select {
    color: #fff !important;
}
.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
    color: #fff !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    color: #e7e4e4 !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button , .dataTables_wrapper .dataTables_filter input {
    color: #fff !important;
}
.card-body {
    overflow-x: scroll;
    overflow-y: hidden;
}
</style>
<div class="content">
    <div class="row">
    @if(Session::has('message'))
        <p class="alert alert-success">{{ Session::get('message') }}</p>
    @endif
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">Clients</h4>
                </div>
{{--                            <div class="col-4 text-right">--}}
{{--                                <a href="{{route('addClient')}}" class="btn btn-sm btn-primary">Add Client</a>--}}
{{--                            </div>--}}
            </div>
        </div>
        <div class="card-body">

    <div class="">
        <table id="myTable" class="text-primary display table tablesorter">
            <thead class="text-primary">
            <tr><th scope="col">Client Name</th>
                <th scope="col">status</th>
                <th scope="col">client_id</th>
                <th scope="col">national_id</th>
                <th scope="col">address</th>
                <th scope="col">Email</th>
                <th scope="col">dob</th>
                <th scope="col">maxboost_limit</th>
                <th scope="col">client image</th>
                <th scope="col">NIC Image</th>
                <!--<th scope="col">Creation Date</th>-->
                <th scope="col">Action</th>
            </tr></thead>
            <tbody>
            @foreach($data as $datum)
                <tr class="custom_color" >
                    <td>{{$datum->client_name}}</td>

                    <td><?php
                    if($datum->is_active == ''){
                        $status='';
                    }
                    if($datum->is_active == '1'){
                        $status='Active';
                    }
                    if($datum->is_active == '0'){
                        $status='De-Active';
                    }
                    echo $status;
                    ?></td>


                    <td>{{$datum->client_id}}</td>
                    <td >{{$datum->national_id}}</td>
                    <td>{{$datum->address}}</td>
                    <td>{{$datum->email}}</td>
                    <td>{{ \Carbon\Carbon::parse($datum->dob)->format('M-D-Y / H:m:s') }}</td>
                    <td>{{$datum->maxboost_limit}}</td>

                    <!--client image id-->
                    <td><a href="#" data-toggle="modal" data-target="#abc{{$datum->id}}"><i class="fa fa-eye"></i></a></td>
            <div id="abc{{$datum->id}}" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
               <div class="modal-content">
                    <div class="modal-body">
                        <div class="modal_image">
                            <img src="{{asset('/black/img/'.$datum->client_image_id)}}" alt="" class="img-fluid w-100">
                          </div>
                        </div>
                   </div>

                </div>
            </div>
                                      
        <td><a href="#" data-toggle="modal" data-target="#def{{$datum->id}}"><i class="fa fa-eye"></i></a></td>
                <div id="def{{$datum->id}}" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <!--<p>Some text in the modal.</p>-->
            <div class="modal_image">
                <img src="{{asset('/black/img/'.$datum->card_image_id)}}" alt="" class="img-fluid w-100">
            </div>
          </div>
        </div>

      </div>
    </div>
                                        <!--End card_image id-->

        <td class="text-right">
            <div class="dropdown">
                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="{{route('clientEdit',[$datum->id])}}">Edit</a>
                    <a class="dropdown-item" href="{{route('clientDelete',[$datum->id])}}">Delete</a>
                </div>
            </div>
        </td>

        </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
        <div class="card-footer py-4">
            <nav class="d-flex justify-content-end" aria-label="...">

            </nav>
        </div>
    </div>
   </div>
  </div>
</div>


@endsection
