
@extends('user.layouts.app')
@section('content')



    <!---============ Small Screen Display ===========------------>

    <div class="container-fluid d-none d-sm-block d-block d-md-none d-lg-none d-xl-none">
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

       @if(count($order) > 0)
            @foreach($order as $key => $value)
                
                <div class="row">
                    <div class="col-sm-4 col-4">
                        @php
                             echo '<img src="data:image/jpeg;base64,' . base64_encode($value->image) . '" alt="" class="img-fluid">';
                        @endphp
                    </div>
                    <div class="col-sm-8 col-8">
                        <table class="table table-borderless">
                            <tr>
                                <th><span class="table-text">Name</span></th>
                                <td><span class="table-text">{{$value->name}}</span></td>
                            </tr>
                            <tr>
                                <th><span class="table-text">Quantity</span></th>
                                <td><span class="table-text">{{$value->quantity}}</span></td>
                            </tr>
                            <tr>
                                <th><span class="table-text">Price</span></th>
                                <td><span class="table-text">₦ {{$value->price}}</span></td>
                            </tr>
                            <tr>
                                <th><span class="table-text">Payment Ref</span></th>
                                <td><span class="table-text">{{$value->payment_ref}}</span></td>
                            </tr>
                            <tr>
                                <th><span class="table-text">Delivery Method</span></th>
                                <td><span class="table-text">{{$value->delivery_method}}</span></td>
                            </tr>
                            <tr>
                                <th><span class="table-text">Date</span></th>
                                <td><span class="table-text">{{$value->created_at}}</span></td>
                            </tr>

                        </table>
                    </div>
                </div>
                <hr>

            @endforeach

        @else



        @endif
    </div>



    <!---============== Large Screen dispaly ============--------------->
    <div class="row d-none d-md-block">
        <div class="col-lg-12 col-md-12">    
            <table class="table table-responsive-sm">
                <tr class="thead-dark">
                    <th><span class="table-text">S/N</span></th>
                    <th><span class="table-text">Image</span></th>
                    <th><span class="table-text">Name</span></th>
                    <th><span class="table-text">Quantity</span></th>
                    <th><span class="table-text">Price</span></th>
                    <th><span class="table-text">Delivery Method</span></th>
                    <th><span class="table-text">Payment Ref</span></th>
                    <th><span class="table-text">Date</span></th>
                </tr>

                @if(count($order) > 0)
                    @php $i = 0; @endphp
                    @foreach($order as $key => $value)
                        @php $i++; @endphp
                        <tr>
                            <td><span class="table-text">{{$i}}</span></td>
                            <td><img src="/storage/images/{{$value->image}}" class="img-fluid user-img-order"></td>
                            <td><span class="table-text">{{$value->name}}</span></td>
                            <td><span class="table-text">{{$value->quantity}}</span></td>
                             <td><span class="naira-text">NGN</span>
                             <span class="table-text">
                                @php echo number_format($value->price, 2); @endphp 
                            </span></td>
                            <td><span class="table-text">{{$value->delivery_method}}</span></td>
                            <td><span class="table-text">{{$value->payment_ref}}</span></td>
                             <td><span class="table-text">{{$value->created_at}}</span></td>
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



@endsection
