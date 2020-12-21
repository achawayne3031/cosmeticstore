@extends('user.layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">

        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12 p-0">
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
            <h6 class="text-center user-profile-title-text">Personal Information</h6>
             
        </div>

            <div class="table-responsive col-lg-4 col-xl-4 col-md-6 col-sm-12 col-12 p-0">
                <table class="table table-borderless">
                    <tr>
                        <th><span class="table-text">Full Name</span></th>
                        <td><span class="table-text">{{ Auth::user()->name }}</span></td>
                    </tr>
                    <tr>
                        <th><span class="table-text">Email Address</th>
                        <td><span class="table-text" id="email">{{ Auth::user()->email }}</td>
                    </tr>

                    <tr class="mt-5">
                        <th colspan="2" class="text-center"><span class="table-text">Update Password</span></th>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="password" class="form-control" id="update-password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="btn btn-success btn-block" onclick="updatePassword()">
                                <span id="user-update-password-text">Update</span>
                                <div id="user-update-password-loader">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </div>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>


        
            <div class="col-lg-5 col-xl-5 col-md-6 col-sm-12 col-12 p-0">
                <table class="table table-borderless">
                    <tr>
                        <th><span class="table-text">Phone Number</span></th>
                        <td>
                            <span class="table-text">
                                @if(Auth::user()->phone != "")
                                    {{Auth::user()->phone}}
                                @endif
                            </span>
                        </td>
                    </tr>
                     <tr>
                        <th><span class="table-text">State Of residence</span></th>
                        <td>
                            <span class="table-text">
                                @if(Auth::user()->state != "")
                                    {{Auth::user()->state}}
                                @endif
                            </span>
                        </td>
                    </tr>

                     <tr>
                        <th><span class="table-text">Local Government</span></th>
                        <td>
                            <span class="table-text">
                                @if(Auth::user()->local != "")
                                    {{Auth::user()->local}}
                                @endif
                            </span>
                        
                        </td>
                    </tr>

                </table>
            </div>

            
        
        
        </div>
    </div>



@endsection


