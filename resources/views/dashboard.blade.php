@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
<div class="row">
  <div class="col-md-3"></div>
  @if(Session::get('fail'))
  <div class="col-md-6">
    <div class="alert bg-danger text-center" style="color: white;">
      {{Session::get('fail')}}
    </div>
  </div>
  @endif
  @if(Session::get('success'))
  <div class="col-md-6">
    <div class="alert bg-success text-center" style=" color: white;">
      {{Session::get('success')}}
    </div>
  </div>
  @endif 
  <div class="col-md-3"></div>
</div>
<br>
 @if(\Illuminate\Support\Facades\Auth::user()->type == 'beta')
<div class="row">
       
       
       
        <div class=" col-lg-4">
            <div class="btn card card-chart">
           
                <a href="{{ route('getTransactions') }}">
                <div class="card-header">
                 
                    <h5 class="card-category text-warning">Total Transections</h5>
                    <h3 class="card-title counter"><i class="tim-icons icon-chart-bar-32 text-warning"></i>{{$Transection}}</h3>
                 
                </div>
                </a>
            </div>
        </div>
  		<div class="col-lg-4">
          <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#requestModal">Request New Member Token</a>
  		</div>
    </div>
<div class="row">
  <div class="col-lg-4">
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">Change Password</a>
  </div>
</div>
@endif
 @if(\Illuminate\Support\Facades\Auth::user()->type == 'gamma')
<div class="row">
        <div class="col-lg-4">
            <div class="btn card card-chart">
                
                <div class="card-header">
                <a href="{{route('getTransactionsalpha')}}">
                    <h5 class="card-category text-success">Total Transections</h5>
                    <h3 class="card-title counter"><i class="tim-icons icon-chart-bar-32 text-success"></i> {{$merchant_Transection ?? ''}}</h3>
                </a>
                </div>
            </div>
        </div>
  
  		<div class="col-lg-4">
          <a href="" class="btn btn-primary float-right" data-toggle="modal" data-target="#requestModal">Request New Member Token</a>
  		</div>
    </div>
<div class="row">
  <div class="col-lg-4">
    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">Change Password</a>
  </div>
</div>
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Would you like to proceed?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">This is a request for a new Member Token.  Doing so will require you to re-register in the client app.</div>
    <div class="modal-footer">
        <button class="btn btn-secondary float-end" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="{{url('client/requestNewMemberToken')}}">Yes</a>
    </div>
</div>
</div>
</div>

<div class="modal fade" id="verifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">2fa Code has been sent to your mail.</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
  	<form method="post" action="{{url('client/verify2faCode')}}" enctype="multipart/form-data">
        @csrf
    <div class="modal-body">
      	<h5 style="color:black;">Verify 2fa Code</h5>
        <input type="text" name="code" class="form-control form-control-user" style="color:black;" placeholder="2fa Code" required="">
        
  	</div>
    <div class="modal-footer">
        <button class="btn btn-secondary float-end" type="button" data-dismiss="modal">Cancel</button>
      	<input type="submit" name="upload" id="upload" class="btn btn-primary" value="Verify">
    </div>
    </form>
</div>
</div>
</div>



<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Client Backend Password</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
  	<form method="post" action="{{url('client/changePassword')}}" enctype="multipart/form-data">
        @csrf
    <div class="modal-body">
      	<h5 style="color:black;">Old Password : </h5>
        <input type="password" name="old" class="form-control form-control-user" style="color:black;" placeholder="Old Password" required=""><br>
      	<h5 style="color:black;">New Password : </h5>
        <input type="password" name="new" class="form-control form-control-user" style="color:black;" placeholder="New Password" required=""><br>
      	<h5 style="color:black;">Confirm New Password : </h5>
        <input type="password" name="confirm" class="form-control form-control-user" style="color:black;" placeholder="Confirm New Password" required="">
        
  	</div>
    <div class="modal-footer">
        <button class="btn btn-secondary float-end" type="button" data-dismiss="modal">Cancel</button>
      	<input type="submit" name="upload" id="upload" class="btn btn-primary" value="Proceed">
    </div>
    </form>
</div>
</div>
</div>

@endif
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
        $(document).ready(function() {demo.initDashboardPageCharts();});
        
        
        
//      const counters = document.querySelectorAll('.counter');
// const speed = 2; // The lower the slower

// counters.forEach(counter => {
//     const updateCount = () => {
//         const target = +counter.getAttribute('data-target');
//         const count = +counter.innerText;

//         // Lower inc to slow and higher to slow
//         const inc = target / speed;

//         console.log(inc);
//         console.log(count);

//         // Check if target is reached
//         if (count < target) {
//             // Add inc to count and output in counter
//             counter.innerText = count + inc;
//             // Call function every ms
//             setTimeout(updateCount, 1);
//         } else {
//             counter.innerText = target;
//         }
//     };

//     updateCount();
// });
      
        
    </script>
<script type="text/javascript">
    $(document).ready(function(){
        if({{Session::get('sent')!=NULL}})
        {
          console.log("asdf");
          $('#verifyModal').modal('show');
        }
    });
</script>
@endpush
