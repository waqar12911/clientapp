<div class="sidebar">
    <div class="sidebar-wrapper">
  @if(\Illuminate\Support\Facades\Auth::user()->type=='beta')
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Client App') }}</a>
        </div>
        <ul class="nav">
            <li @if (isset($pageSlug) && $pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
          
            
             <li>
                <a data-toggle="collapse" href="#admin-settings" aria-expanded="true">
                    <i class="tim-icons icon-atom" ></i>
                    <span class="nav-link-text" >{{ __('Admin Settings') }}</span>
                   <b class="caret mt-1"></b>
               </a>

                <div class="collapse show" id="admin-settings">
                    <ul class="nav pl-4">
                       <li @if (isset($pageSlug) && $pageSlug == 'fundinghome') class="active " @endif>
                            <a href="{{ route('fundingHomeView')  }}">
                               <i class="tim-icons icon-bullet-list-67"></i>
                               <p>{{ __('Shock Pay') }}</p>
                            </a>
                        </li>
                      
                    </ul>
                </div>
            </li>

            <li @if (isset($pageSlug) && $pageSlug == 'transactions') class="active " @endif>
                <a href="{{ route('getTransactions') }}">
                    <i class="tim-icons icon-bank"></i>
                    <p>{{ __('Transactions') }}</p>
                </a>
            </li>
           {{--  <li @if (isset($pageSlug) && $pageSlug == 'shockpay') class="active " @endif>
                <a href="{{ route('shockpay') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Shockpay') }}</p>
                </a>
            </li>
            <li @if (isset($pageSlug) && $pageSlug == 'channel') class="active " @endif>
                <a href="{{ route('shockpay') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ __('Channels') }}</p>
                </a>
            </li> --}}
            
            
            
           
    </ul>
     @endif

  @if(\Illuminate\Support\Facades\Auth::user()->type == 'gamma')
         <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('') }}</a>
            <a href="#" class="simple-text logo-normal">{{ auth()->user()->name }}</a>
        </div>
        <ul class="nav">
            <li @if (isset($pageSlug) && $pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li @if (isset($pageSlug) && $pageSlug == 'transactions alpha') class="active " @endif>
                <a href="{{ route('getTransactionsalpha') }}">
                    <i class="tim-icons icon-bank"></i>
                    <p>{{ __('Transactions') }}</p>
                </a>
            </li>
            <li @if (isset($pageSlug) && $pageSlug == 'shockpay') class="active " @endif>
                <a href="{{ route('shockpay') }}">
                    <i class="tim-icons icon-bullet-list-67"></i>
                    <p>{{ __('Shockpay') }}</p>
                </a>
            </li>
            <li @if (isset($pageSlug) && $pageSlug == 'channel') class="active " @endif>
                <a href="{{ route('channels') }}">
                    <i class="tim-icons icon-atom"></i>
                    <p>{{ __('Channels') }}</p>
                </a>
            </li>
        </ul>
  @endif
    
    </div>
</div>
