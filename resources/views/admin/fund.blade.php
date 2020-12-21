@extends('admin.layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-lg-3 offset-md-9 text-center">
                <span class="fa fa-refresh" id="spin"></span><span class="badge badge-danger m-2 p-2" id="refresh" onclick="adminRefresh()">Refresh</span>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <table class="table table-striped">
                <tr class="thead-dark">
                    <th><span class="table-text">S/N</span></th>
                    <th><span class="table-text">Full Name</span></th>
                    <th><span class="table-text">Email Address</span></th>
                    <th><span class="table-text">Registered Date</span></th>
                    <th><span class="table-text">Action</span></th>
                </tr>

                @if(count($users) > 0)
                    @php
                        $i = 0;  
                    @endphp

                    @foreach($users as $value)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <td><span class="table-text">{{ $i }}</span></td>
                            <td><span class="table-text">{{ $value->name }}</span></td>
                            <td><span class="table-text">{{ $value->email }}</span></td>
                            <td><span class="table-text">{{ $value->created_at }}</span></td>
                             <td>
                                <a href="/admin/fund-user/{{$value->userID}}" class="btn btn-danger btn-item table-text">Fund</a>
                                <button class="btn btn-danger btn-item table-text" disabled>Defund</button>
                            </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td><h6>No user</h6></td>
                    </tr>
                @endif

            </table>
         
            
            
        
        
        
        </div>
    </div>



@endsection


