@extends('admin.layouts.app')
@section('content')


    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-4 col-xl-4 col-md-4">
                <table class="table table-responsive">
                        <tr class="thead-dark">
                            <th colspan="2"><span class="table-text">Payment Detail</span><th>
                        </tr>
                @if(count($payments) > 0)
                    @foreach($payments as $key => $value)
                        <tr>
                            <th><span class="table-text">Name</span></th>
                            <td><span class="table-text">{{$value->name}}</span></td>
                        </tr>

                        <tr>
                            <th><span class="table-text">Total Amount</span></th>
                            <td>
                                <span class="naira-text">NGN</span>
                                <span class="table-text">
                                    @php echo number_format($value->total_payment, 2); @endphp
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th><span class="table-text">State Of Residence</span></th>
                            <td>
                                <span class="table-text">{{ $value->state }}</span>
                            </td>
                        </tr>

                        <tr>
                            <th><span class="table-text">LGA</span></th>
                            <td>
                                <span class="table-text">{{ $value->local }}</span>
                            </td>
                        </tr>

                        <tr>
                            <th><span class="table-text">Delivery method<span class="table-text"></th>
                            <td>
                                <span class="table-text">{{ $value->delivery_method }}</span>
                            </td>
                        </tr>

                        <tr>
                            <th><span class="table-text">Date</span></th>
                            <td>
                                <span class="table-text">{{ $value->date_of_payment }}</span>
                            </td>
                        </tr>
     
                    @endforeach
                @endif
                </table>
            </div>
        
            <div class="col-lg-6 col-xl-6 col-md-6" id="admin-product-detail-body">
                <table class="table table-responsive">
                    <tr class="thead-dark">
                        <th colspan="2"><span class="table-text">Product Details</span></th>
                        <td></td>
                    </tr>

                    @if(count($ordered) > 0)
                        @foreach($ordered as $key => $value)
                            <tr>
                                <td colspan="2">
                                    @php
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($value->image) . '" alt="" class="img-fluid see-detail-img">';
                                    @endphp
                                </td>
                            </tr>

                            <tr>
                                <th><span class="table-text">Name</span></th>
                                <td><span class="table-text">{{$value->name}}</span></td>
                            </tr>

                            <tr>
                                <th><span class="table-text">Price</span></th>
                                <td>
                                 <span class="naira-text">NGN</span>
                                 <span class="table-text">
                                    @php echo number_format($value->price, 2); @endphp
                                </span>
                                </td>
                            </tr>

                            <tr>
                                <th><span class="table-text">Quantity</span></th>
                                <td><span class="table-text">{{$value->quantity}}</span></td>
                            </tr>
                        @endforeach
                        
                    @endif

                </table>
            
            </div>
        
        </div>
    </div>



@endsection


