@extends('user.layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-lg-3 col-sm-3 col-4 offset-md-9 text-center">
                <h5><span class="fa fa-refresh fa-spin"></span> Refresh</h5>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-6">
                <div id="status-content">
                    <h6 class="user-dashboard-text">Total Fund</h6>
                    <small class="detail-dashboard-text"></small>
                    <small>₦ 
                     @if(count($fund) > 0)
                        @foreach($fund as $key => $value)
                           @php $amount =  $value['amount']; @endphp
                        @endforeach
                            @php echo number_format($amount, 2); @endphp
                    @else
                        0
                    @endif
                    </small>
                </div>
            </div>

             <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-6">
                <div id="status-content">
                    <h5 class="user-dashboard-text">Total Orders</h6>

                    @if(count($orders) > 0)
                       @php $i = 0; @endphp
                        @foreach($orders as $key => $value)
                           @php $i += $value['quantity']; @endphp
                        @endforeach
                        <h6>{{ $i }} <small class="detail-dashboard-text">Item</small></h6>
                    @else
                        <h6>0<small class="detail-dashboard-text">Item</small><h6>
                    @endif
                      
                </div>
            </div>

             <div class="col-md-3 col-lg-3 col-xl-3 col-sm-6 col-6">
                <div id="status-content">
                    <h6 class="user-dashboard-text">Wishlist</h6>
                    <h6><small class="detail-dashboard-text">Coming Soon</small><h6>
                </div>
            </div>
        
        
        
        </div>
    </div>



@endsection


