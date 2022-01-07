@extends('layouts.app', ['page' => __('Channels'), 'pageSlug' => 'channel'])

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
    overflow-y: hidden;
}
.form-control
{
    color: black !important;
}
</style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
        </div>
<div class="col-md-12">
    <div class="card ">
        <div class="card-header">
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title">Channels</h4>
                </div>
                <div class="col-4 text-right">
                  <a href="#" data-toggle="modal" data-target="#shockpay" class="btn btn-sm btn-primary">Add Channel</a>
               </div>
            </div>
        </div>
        <div class="card-body">

    <div class="">
        <table id="myTable" class="text-primary display table tablesorter">
            <thead class="text-primary">
            <tr><th scope="col">Alias</th>
                <th scope="col">Channel ID</th>
                <th scope="col">Creation Date</th>
                <th scope="col">Action</th>
            </tr></thead>
          <tbody>
            @foreach($data as $datum)
                <tr class="custom_color" >
                    <td>{{$datum->alias}}</td>
                    <td>{{$datum->channel_id}}</td>
                    <td>{{ \Carbon\Carbon::parse($datum->created_at)->format('M-d-Y') }}</td>

                    <td >
                        <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#abc{{$datum->id}}">Edit</a>
                        <a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ?');" href="{{route('channelDelete',[$datum->id])}}">Delete</a>
                      

                    <div id="abc{{$datum->id}}" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                           <div class="modal-content">
                                <div class="modal-body">
                                     <form action="{{route('updatechannel',$datum->id)}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="">Alias</label>
                                            <input type="text" class="form-control" value="{{$datum->alias}}" required="" name="alias">
                                        </div>
                                        <input type="submit" value="Update" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>

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


<div id="shockpay" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <!--<p>Some text in the modal.</p>-->
        <div class="modal_image">
            <form action="{{route('createchannel')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Alias</label>
                    <input type="text" class="form-control" required="" name="alias">
                </div>
                <div class="form-group">
                    <label for="">Channel ID</label>
                    <input type="text" class="form-control" required="" name="channel_id">
                </div>
                <input type="submit" value="Save" class="btn btn-primary">
            </form>
        </div>
      </div>
    </div>

  </div>
</div>


@endsection
