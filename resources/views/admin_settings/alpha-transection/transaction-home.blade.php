@extends('layouts.app', ['page' => __('transactions alpha'), 'pageSlug' => 'transactions alpha'])
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
.dataTables_wrapper {
    overflow-x: scroll;
}
.style_prevu_kit
{
    position: relative;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(1); 
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(1); 
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(1);
    transition: all 200ms ease-in;

}
.style_prevu_kit:hover
{
    box-shadow: 0px 0px 63px 50px #000000;
    z-index: 2;
    -webkit-transition: all 200ms ease-in;
    -webkit-transform: scale(1.5);
    -ms-transition: all 200ms ease-in;
    -ms-transform: scale(1.5);   
    -moz-transition: all 200ms ease-in;
    -moz-transform: scale(1.5);
    transition: all 200ms ease-in;
    transform: scale(1.9);
}
.add_bg {
        background: #27293d;
}
.align_input .mEmail  {
        padding: 0 !important;
    height: 33px;
    border: 1px solid;
    margin-right: 10px;
}
.align_input .sendEmail {
    padding: 8px 19px;
    text-align: center;
    display: flex;
    justify-content: center;
}
.divImportExport{
    
    display: flex;
    align-items: center;
    margin-top: -35px;
    
}
.dateRange{
        text-align: right;
         margin-right: 212px;
}
}
</style>
    <div class="content">
        <div class="row">
            @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
            @endif
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-2">
                                         <h4 class="card-title">Transactions</h4>
                                    </div>
                               <div class="col-5 divImportExport">
                               <a href="{{route('download_excel')}}" class="btn btn-warning"><i class="fa fa-table" aria-hidden="true"></i>  Export Excel  <i class="fa fa-download" aria-hidden="true"></i> </a>
                               <a href="{{route('upload_csv')}}" class="btn btn-warning"><i class="fa fa-table" aria-hidden="true"></i>  Import Excel  <i class="fa fa-upload" aria-hidden="true"></i></a>
                          
                            </div>
                               <div  class="col-3">
                                       <div class="form-check">
                                        <label class="form-check-label"> Daily
                                          <input class="form-check-input dailyCheckBox" name="dailyName" type="checkbox" value="daily" @if($status['0']->is_email == "auto") checked @endif>
                                          <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        </label>
                                         <label class="form-check-label"> Weekly
                                          <input class="form-check-input weeklyCheckBox" name="weeklyName" type="checkbox" value="weekly" value="daily" @if($status['1']->is_email == 'auto') checked @endif>
                                          <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        </label>
                                         <label class="form-check-label"> Monthly
                                          <input class="form-check-input monthlyCheckBox" name="monthlyName" type="checkbox" value="monthly" value="daily" @if($status['2']->is_email == 'auto') checked @endif>
                                          <span class="form-check-sign">
                                            <span class="check"></span>
                                          </span>
                                        </label>
                                      </div>
                                       
                                        <!--<label class="radio-inline">-->
                                        <!--    <input type="radio" class="radValue"  name="manualMail"  value="daily"> Daily-->
                                        <!--</label>-->
                                        <!--<label class="radio-inline">-->
                                        <!--    <input type="radio" class="radValue"  name="manualMail"  value="weekly"> Weekly-->
                                        <!--</label>-->
                                        <!-- <label class="radio-inline">-->
                                        <!--    <input type="radio" class="radValue"  name="manualMail"  value="monthly"> Monthly-->
                                        <!--</label>-->
                                        
                                        
                                    </div>
                                     <div  class="col-2"> 
                                            <!--<lable>Send Email To </lable>-->
                                            <!--<div class="align_input d-flex align-items-center">-->
                                            <!--    <input type="email" name="sendEmailto" class="mEmail form-control" />-->
                                            <!--    <input type="button" class="sendEmail btn btn-sm" value="Send" />-->
                                            <!--</div>-->
                                            
                                         <lable>Send Manual Email</lable>
                                         <button type="button" class="btn btn-sm" id="myBtn" data-toggle="modal" data-target="#myBtn">Go</button>
                                        
                                    </div>
                                    
                                    <!-- modal for mannual email modal start-->
                                    <!--Daily Modal-->
                                   <div class="modal fade in" id="dailyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <form method="POST" action="{{ route('dailyMail') }}">
                                               @csrf
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Custom Report</h5>
                                                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                                                <!--  <span aria-hidden="true">&times;</span>-->
                                                <!--</button>-->
                                              </div>
                                              <div class="modal-body">
                                                  <div>
                                                    <label class="" style="color: black;">Destination Email:</label>
                                                    <input type="hidden" name="searchIds[]" id="checkValues" />
                                                    <input type="email" name="dailyEmail" class="form-control"  style="color: black;"/>
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" onClick="closeModal(dailyModal)">Close</button>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                              </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                    <!--Weekly Modal-->
                                     <div class="modal fade in" id="weeklyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <form method="POST" action="{{ route('weeklyMail') }}">
                                             @csrf
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Custom Report</h5>
                                                <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
                                                <!--  <span aria-hidden="true">&times;</span>-->
                                                <!--</button>-->
                                              </div>
                                              <div class="modal-body">
                                                  <div>
                                                    <label class="" style="color: black;">Destination Email:</label>
                                                    <input type="email" name="weekMail" class="form-control"  style="color: black;"/ required>
                                                </div>
                                                <div class="mt-4">
                                                      <div>
                                                          <div>
                                                            <label class="" style="color: black;">From Data: </label>
                                                            <input type="date" class="weekValue form-control" name="weekStart"  style="color: black;"  max="<?php echo date("Y-m-d"); ?>"  required>
                                                          </div>
                                                          <div>
                                                            <label class="" style="color: black;">To Date: </label>
                                                             <input type="date" class="weekValue form-control" name="weekEnd"  style="color: black;"  max="<?php echo date("Y-m-d"); ?>" required>
                                                        </div>
                                                     </div>  
                                                </div>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" onClick="closeModal(weeklyModal)">Close</button>
                                                <button type="submit" name="weekbtn" class="btn btn-primary weeklyBtn">Send</button>
                                              </div>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                    
                            </div>
                            <div class="col-12  mt-3 text-right">
                                <form action="{{route('filterTransection')}}" id="filtertransection" method="GET">
                                   <!--@scrf-->
                                   <div class="dateRange">
                                       <lable>Select date range of tx's to display</lable>
                                   </div>
                                    <div class="search_box">
                                        <input type="text" name="date_from" placeholder="Start Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <input type="text" name="date_to" placeholder="End Date" onfocus="(this.type='date')" onblur="(this.type='text')">
                                        <button type="submit" class="btn set_size"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body add_bg">
                         <div class="" id="transection-data">
                            @include("admin_settings.alpha-transection._transactions",['data' => $data])
                         </div>
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
    
     <script>
     function closeModal(id){
         $(id).modal('hide'); 
        $('.modal-backdrop').remove();
     }
 </script>
    
<!--Script for data table multiple check box-->
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

<!--Script for datatable search-->
<script>
    $("#filtertransection").submit(function (e) {
        e.preventDefault();
        let url = $(this).attr("action");
        $.get(url,$(this).serialize(),function (response) {
            $("#transection-data").html(response)
    });
    });

</script>

<!--Script for data table entries increment-->
<script>
    $(document).ready(function() {
	  $('#myTable').DataTable({
      pageLength:25,
	  });
	});
</script>

<!--Controlling the auto email daily, weekly, monthly-->
<script>
    $(document).ready(function () {
        // daily auto email controlling
    $(".dailyCheckBox").click(function(){
         var dailyCheck =  $("input[name='dailyName']:checked").val();
         if(dailyCheck == 'daily'){
           var daily = 'auto';
         }else{
           var daily = 'manual';
         }
         
         $.ajax({
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                url: "/is-email-allow",
                data: {'type': 'daily', 'userType': 'alpha', 'emailStatus': daily},
                type: "POST",
                success: function (response) {
                     if(response == 'auto'){
                        alert('your daily automation is Activated');
                    }else{
                        alert('your daily automation is de-Activated');
                    }
                     if(response == 'no'){
                        alert('something wrong');
                    }
                    
              }
          });
         
         
    });
    // weekly auto email controlling
    $(".weeklyCheckBox").click(function(){
         var weeklyCheck =  $("input[name='weeklyName']:checked").val();
        if(weeklyCheck == 'weekly'){
           var weekly = 'auto';
         }else{
           var weekly = 'manual';
         }
         
         $.ajax({
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                url: "/is-email-allow",
                data: {'type': 'weekly', 'userType': 'alpha', 'emailStatus': weekly},
                type: "POST",
                success: function (response) {
                     if(response == 'auto'){
                        alert('your weekly automation is Activated');
                    }else{
                        alert('your weekly automation is de-Activated');
                    }
                     if(response == 'no'){
                        alert('something wrong');
                    }
                    
              }
          });
    });
    // monthly auto email controlling
     $(".monthlyCheckBox").click(function(){
         var monthlyCheck =  $("input[name='monthlyName']:checked").val();
         
          if(monthlyCheck == 'monthly'){
           var monthly = 'auto';
         }else{
           var monthly = 'manual';
         }
         
         $.ajax({
              headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                url: "/is-email-allow",
                data: {'type': 'monthly', 'userType': 'alpha', 'emailStatus': monthly},
                type: "POST",
                success: function (response) {
                     if(response == 'auto'){
                        alert('your monthly automation is Activated');
                    }else{
                        alert('your monthly automation is de-Activated');
                    }
                     if(response == 'no'){
                        alert('something wrong');
                    }
                    
              }
          });
    
    });
    }); 
</script>

<script>
        $(document).ready(function () {

     // Attach Button click event listener 
    $("#myBtn").click(function(){
        
          var searchIDs = $("#merchantBody input:checkbox:checked").map(function(){
                 return $(this).val();
               }).get();
               
          $('#checkValues').val(searchIDs);
          
         if(searchIDs.length !== 0){
           
            $('#dailyModal').modal('show');
            
         }else{
             $('#weeklyModal').modal('show');
         }
         
    });
});
</script>

<!--Script for controlling the radio buttons-->
<!--<script>-->
<!--     (function ($) {-->
<!--        $("input[type='radio']").click(function (e) {-->
            // e.preventDefault();
<!--            var radioValue = $("input[name='merchantEmail']:checked").val();-->
<!--            if(radioValue == 'auto'){-->
<!--                $('.hideAllCheckBox').hide();-->
<!--            }else{-->
<!--                 $('.hideAllCheckBox').show();-->
<!--            }-->
<!--            $.ajax({-->
<!--               headers: {-->
<!--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
<!--        },-->
<!--                url: "/is-email-allow",-->
<!--                data: {'emailStatus': radioValue},-->
<!--                type: "POST",-->

<!--                success: function (response) {-->
<!--                    console.log(response);-->
                    
<!--                     if(response == 'auto'){-->
<!--                        alert('your transactin are turned to AUTO email');-->
<!--                    }else{-->
<!--                        alert('your transactin are turned to MANUAL email');-->
<!--                    }-->
                   
<!--                }-->
<!--            });-->
<!--        });-->

<!--    })(jQuery);-->
    
<!--</script>-->

<!--Script for send the manual emails in alpha users-->
<!--<script type="text/javascript">-->
<!--    $(function () {-->
        //Assign Click event to Button.
<!--        $(".sendEmail").click(function (event) {-->
<!--             event.preventDefault();-->
<!--              var radioValue = $("input[name='merchantEmail']:checked").val();-->
<!--                if(typeof radioValue == 'undefined' || radioValue == 'auto'){-->
<!--                    alert('please choose manual first from radio button');-->
<!--                }else{-->
             
             
<!--                var mEmail = $('.mEmail').val();-->
<!--                if(mEmail){-->
<!--                var searchIDs = $("#merchantBody input:checkbox:checked").map(function(){-->
<!--                  return $(this).val();-->
<!--                }).get();-->
                
<!--                $.ajax({-->
<!--                headers: {-->
<!--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')-->
<!--                },-->
<!--                url: "/manual-email-alpha",-->
<!--                data: {'searchIDs': JSON.stringify(searchIDs), 'mEmail': mEmail},-->
<!--                method: "POST",-->

<!--                success: function (response) {-->
<!--                    console.log(response);-->
<!--                     if(response){-->
<!--                         alert('Your email has been sent to ' +mEmail );-->
<!--                            $('.mEmail').val(' ');-->
<!--                        }-->
<!--                }-->

<!--            });-->
            
<!--          }-->
<!--        }-->
<!--        });-->
        
<!--    });-->
<!--</script>-->
    

   
@endsection



