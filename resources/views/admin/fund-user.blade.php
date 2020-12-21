@extends('admin.layouts.app')
@section('content')

    <div class="row" style="">
        <div class="col-lg-8"></div>
        <div class="col-lg-4 admin-alert-box" id="admin-alert">
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="text-center">User has been credited</h6>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <table class="table table-striped">
                <tr class="thead-dark">
                    <th><span class="table-text">Full Name</span></th>
                    <th><span class="table-text">Email Address</span></th>
                    <th><span class="table-text">Registered Date</span></th>
                    <th><span class="table-text">Action</span></th>
                </tr>

                
                @if(count($user) > 0)
                    @foreach($user as $value)
                        <tr>
                            <td><span class="table-text">{{ $value->name }}</span></td>
                            <td><span class="table-text" id="email">{{ $value->email }}</span></td>
                            <td><span class="table-text">{{ $value->created_at }}</span></td>
                             <td>
                                <input type="number" class="form-control table-text mb-1" id="amount">
                                <span class="d-none" id="user-id">@php echo $value->userID; @endphp</span>
                                <button class="btn btn-danger btn-item table-text" id="fund-btn" onclick="fundUser()">
                                <span id="fund-text">Fund</span>
                                <div id="fund-loader">
                                     <span class="spinner-border spinner-border-sm"></span>
                                </div>
                               
                                </button>
                                <button class="btn btn-danger btn-item table-text" disabled>Defund</button>
                            </td>
                        </tr>
                    @endforeach

                @endif

            </table>
         
            
            
        
        
        
        </div>
    </div>



@endsection


