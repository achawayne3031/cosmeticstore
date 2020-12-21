
@extends('user.layouts.app')
@section('content')

     <div class="row" style="">
        <div class="col-lg-8"></div>
        <div class="col-lg-4 admin-alert-box" id="admin-alert">
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="text-center alert-text">Your Account has been Funded</h6>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-xl-8 col-sm-12 col-12 user-admin-main-fund-body">
                 <h6 class="text-right mb-4"><small>Balance: </small>
                    <small> ₦ 
                     @if(count($fund) > 0)
                        @foreach($fund as $key => $value)
                           @php $amount =  $value['amount']; @endphp
                        @endforeach
                            @php echo number_format($amount, 2); @endphp
                    @else
                        0
                    @endif
                    </small>
                </h6>
                <h5 class="text-center" id="instant-dep-text">Instant Deposit Cards</h5>
                <hr>

                <ul class="nav nav-tabs nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active fund-tab-links" data-toggle="tab" href="#paystack">Paystack</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fund-tab-links disabled" data-toggle="tab" href="#flutterwave">Flutterwave</a>
                    </li>
                </ul>

               <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane container active" id="paystack">
                        <div class="row mt-5">
                            <div class="col-lg-7 col-md-7 col-xl-7 col-sm-8 col-8 p-0">
                                <div class="form-group">
                                    <h6 id="deposit-amount-text">Deposit Amount(₦)</h6>
                                    <input type="number" class="form-control custom-number" id="amount" required>
                                </div>
                               
                                <div class="form-group">
                                    <span class="d-none" id="phone">{{Auth::user()->phone}}</span>
                                    <span class="d-none" id="user-id">{{Auth::user()->userID}}</span>
                                    <span id="email" class="d-none">{{ Auth::user()->email}}</span>
                                    <button class="btn btn-success" onclick="userCallFund()">
                                        <span id="fund-text">Forward Payment</span>
                                        <div id="fund-loader">
                                            <span class="spinner-border spinner-border-sm"></span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-xl-5 d-none d-md-block">
                                <h6 class="instant-text">Instant Paystack Deposit</h6>
                                <h6 class="instant-msg">There is no fee for deposits with this payment method. 
                                If your transaction is authorized, your account will be credited 
                                immediately.</h6>
                            </div>
                        </div>
                        
                    </div>
                    <div class="tab-pane container fade" id="flutterwave">...</div>
                </div>



            <div>
        </div>

        <div class="row">
                <div class="col-lg-12 col-xl-12 col-sm-12 col-12">

                    <h6 class="text-center user-admin-transact-title">Transaction History</h6>
                </div>

             <div class="col-lg-12 col-xl-12 col-sm-12 col-12" id="user-admin-transact-table">
                <table class="table table-responsive-sm table-responsive-md">
                    <tr class="thead-dark">
                        <th><span class="table-text">No</span></th>
                        <th><span class="table-text">Email</span></th>
                        <th><span class="table-text">Amount</span></th>
                        <th><span class="table-text">Desc</span></th>
                        <th><span class="table-text">Status</span></th>
                        <th><span class="table-text">Ref</span></th>
                        <th><span class="table-text">Date</span></th>
                    </tr>

                    @if($trans != "no data entry")
                        @if(count($trans) > 0)
                            @php
                                $i = 0;  
                            @endphp
                            @foreach($trans as $value)
                                @php
                                    $i++;
                                @endphp
                                <tr>
                                    <td><span class="table-text">{{ $i }}</span></td>
                                    <td><span class="table-text">{{ $value->email }}</span></td>
                                    <td><span class="table-text">
                                        ₦
                                        @php echo number_format($value->amount, 2); @endphp
                                    </span></td>
                                    <td><span class="table-text">{{ $value->desc }}</span></td>
                                    <td><span class="table-text">{{ $value->status }}</span></td>
                                    <td><span class="table-text">{{ $value->ref }}</span></td>
                                    <td><span class="table-text">{{ $value->date_of_payment }}</span></td>

                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td colspan="7"><h6 class="text-center no-data-entry-fund-text">No data entry</h6></td>
                            </tr>
                        @endif

                    @endif

                </table>
            </div>
        </div>


         <div class="row mt-3">
            <div class="col-lg-12 d-flex justify-content-center user-admin-fund-paginate">
                @if($trans != "no data entry")
                    {{ $trans->links() }}
                @endif
            </div>
        </div>

    </div>




@endsection
