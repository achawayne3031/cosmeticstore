
@extends('user.layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-12 p-0">
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
            <h5 class="text-center" id="add-title">My Orders</h5>
            
            <!------------------ Large Screen display------------->
            <table class="table table-responsive-md table-responsive-sm">
                <tr class="thead-dark">
                    <th><span class="table-text">S/N</span></th>
                    <th><span class="table-text">Payment Ref</span></th>
                    <th><span class="table-text">Amount Paid</span></th>
                    <th><span class="table-text">Delivery Method</span></th>

                    <th class="d-none d-md-block"><span class="table-text">Date</span></th>
                    <th><span class="table-text">Action</span></th>
                </tr>

                @if(count($payment) > 0)
                    @php $i = 0; @endphp
                    @foreach($payment as $key => $value)
                        @php $i++; @endphp
                        <tr>
                            <td><span class="table-text">{{$i}}</span></td>
                            <td><span class="table-text">{{$value->ref}}</span></td>
                            <td><span class="table-text">₦ 
                                @php echo number_format($value->total_payment, 2); @endphp 
                            </span></td>
                            <td><span class="table-text">{{$value->delivery_method}}</span></td>
                            <td class="d-none d-md-block"><span class="table-text">{{$value->date_of_payment}}</span></td>
                            <td><a href="see-order/{{$value->ref}}" class="btn btn-primary btn-table">See Detail</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No data entry</td>
                    </tr>
                @endif
            </table>

        </div>
    </div>


            <div class="row mt-3">
                <div class="col-lg-9 d-flex justify-content-center user-admin-paginate">
                    {{ $payment->links() }}
                </div>
            </div>



@endsection
