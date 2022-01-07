@extends('layouts.app', ['page' => __('transactions alpha'), 'pageSlug' => 'transactions alpha'])

@section('content')




<div class="row">
        <div class="col-md-6">

			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
			@if ( Session::get('success') )
				<div class="alert alert-success">
					<ul>
						<li>{{ Session::get('success') }}</li>
					</ul>
				</div>
			@endif


          <div class="tile">
            <h3 class="tile-title">Import Transcctions</h3>
            <div class="tile-body">
              <form action="{{ route( 'import_transections' )  }}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
			  	<input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                  <input class="form-control btn btn-primary" type="file" name="file">
				</div>
			
				
            </div>
            <div class="tile-footer">
              <button class="btn btn-primary" type="submit">
				  <i class="fa fa-fw fa-lg fa-check-circle"></i>Import</button>
				  &nbsp;&nbsp;&nbsp;
				  <a class="btn btn-secondary" href="{{ route('getTransactionsalpha') }}">
					  <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
					  &nbsp;&nbsp;&nbsp;
				
			</div>
			
			</form>
          </div>
        </div>
      
        <div class="clearix"></div>
        
      </div>
@endsection
