@extends('layouts.app', ['page' => __('transactions'), 'pageSlug' => 'transactions'])

@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
.set_size {
        padding: 8px 14px;
}
.search_box input {
    padding: 5px 15px;
    border-radius: 6px;
    border: none;
    outline: none;
    background: #f8f8f8;
    color: #000;
}
.text-align {
    text-align: end;
}
#checkall {
    margin-left: -7px;
    margin-right: 5px;
}
.set_style {
    padding: 10px 15px;
}
#transection-data {
    overflow-x: scroll;
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
                            <div class="col-3">
                                <h4 class="card-title">Transactions</h4>
                            </div>
                              <div class="col-9 text-align">
                                <form action="{{route('filterTransections')}}" id="filtertransection" method="GET">
                                   <!--@scrf-->
                                    <div class="search_box">
                                        <input type="text" name="date_from" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <input type="text" name="date_to" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <button type="submit" class="btn set_size"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                       <div class="" id="transection-data">
                            @include("transaction._transactions",['data' => $data])
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
    
    <div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="align_checkbox">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Default checkbox
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Default checkbox
                  </label>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
            <button type="button" class="btn btn-primary">Send Mail</button>
          </div>
        </div>
      </div>
    </div>
    
    
@endsection
@push('js')
<script>
                                $('#checkall').change(function () {
                                    $('.cb-element').prop('checked',this.checked);
                                });
                                
                                $('.cb-element').change(function () {
                                 if ($('.cb-element:checked').length == $('.cb-element').length){
                                  $('#checkall').prop('checked',true);
                                 }
                                 else {
                                  $('#checkall').prop('checked',false);
                                 }
                                });
                            </script>

<script>
    $("#filtertransection").submit(function (e) {
        e.preventDefault();
        let url = $(this).attr("action");
        $.get(url,$(this).serialize(),function (response) {
            $("#transection-data").html(response)
    });
    });

</script>

<script type="text/javascript">
        $( "body" ).on( "click", ".delete", function () {
            var task_id = $( this ).attr( "data-id" );
            var form_data = {
                id: task_id
            };
            swal({
                title: "Are you sure?",
    		text: "You will not be able to recover this imaginary file!",
    		type: "warning",
    		showCancelButton: true,
    		confirmButtonColor: '#DD6B55',
    		confirmButtonText: 'Yes, delete it!',
    		closeOnConfirm: false,
            }).then( ( result ) => {
                if ( result.value == true ) {
                    $.ajax( {
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
                        },
                        url: '<?php echo url("users/delete"); ?>',
                        data: form_data,
                        success: function ( msg ) {
                            swal( "@lang('User Deleted Successfully')", '', 'success' )
                            setTimeout( function () {
                                location.reload();
                            }, 900 );
                        }
                    } );
                }
            } );
        } );
    </script>

@endpush
