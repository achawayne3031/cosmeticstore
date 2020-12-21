
@extends('admin.layouts.app')
@section('content')

    <div class="row">
    <!----
        <div class="col-lg-2 col-md-2"></div>
        --->
        <div class="col-lg-12 col-md-12">
            <h5 class="text-center" id="add-title">Sales Details</h5>
    
                <table class="table table-responsive">
                    <tr class="thead-dark">
                        <th><span class="table-text">S/N</span></th>
                        <th><span class="table-text">Name</span></th>
                        <th><span class="table-text">Email Address</span></th>
                        <th><span class="table-text">Amount Paid</span></th>
                        <th><span class="table-text">Delivery Method</span></th>
                        <th><span class="table-text">Date</span></th>
                        <th><span class="table-text">Action</span></th>
                    </tr>

                    @if(count($payments) > 0)
                        @foreach($payments as $key => $value)
                            <tr>
                                <td><span class="table-text">{{ $value->id }}</span></td>
                                <td><span class="table-text">{{ $value->name }}</span></td>
                                <td><span class="table-text">{{ $value->email }}</span></td>
                                <td>
                                    <span class="naira-text">NGN</span>
                                    <span class="table-text">
                                    @php 
                                        echo number_format($value->total_payment, 2);
                                    @endphp
                                    </span>
                              
                                
                                </td>
                                <td><span class="delivery-text">{{ $value->delivery_method }}</span></td>
                                <td><span class="table-text">{{ $value->date_of_payment }}</span></td>
                                <td>
                                    <a href="/admin/see-detail/{{$value->ref}}" class="btn btn-secondary btn-item table-text">See Detail</a>
                                </td>
                            </tr>
                            
                        @endforeach
                        <tr>
                            <td colspan="7" class="text-center">{{ $payments->links() }}</td>
                        </tr>
                    @else

                    @endif
                
                </table>

        </div>

    </div>


        <script>
            $(document).ready(() => {



            });
        </script>


@endsection





