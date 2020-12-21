
@extends('layouts.app')
@section('content')

    @if(isset($msg))
          <div class="col-lg-4 alert-box">
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="text-center cart-msg">{{$msg}}</h6>
            </div>
        </div>
    @endif

@if(isset($cart_alert))

    <div class="col-lg-4 alert-box">
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6 class="text-center cart-msg">{{$cart_alert}}</h6>
        </div>
    </div>

@endif

    <!--------=============== Small Screen ===============----------------->
        
    <div class="container d-none d-sm-block d-block d-md-none d-lg-none d-xl-none">
        <div class="row">
          @if(session('cart'))
                @php
                    $item_total = 0;
                @endphp

                @foreach (session('cart') as $item => $value)
                    <div class="col-sm-12 col-12">
                        <div class="row">
                            <div class="col-sm-6 col-6">
                             @php
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($value['image']) . '" alt="" class="img-fluid cart-img">';
                            @endphp
                            
                            </div>

                            <div class="col-sm-6 col-6">
                                <h6 class="user-cart-table-text">{{$value['name']}}</h6>
                                <h6 class="user-cart-table-text">
                                    @php
                                        $actual_price = $value['price'];
                                        $actual_quantity = $value['quantity'];
                                        $each_item_total = $actual_price * $actual_quantity;
                                        $price = number_format($each_item_total, 2);
                                        echo "₦ " . $price;
                                        $item_total += $each_item_total;
                                    @endphp
                                </h6>
                                <h6 class="cart-total">Quantity: {{$value['quantity']}}</h6>
                               
                            </div>
                            </div>
                        <div class="col-sm-12 col-12">
                            <div class="row">
                                <div class="col-sm-6 col-6">
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['cartControl@remove', $value['id']], 'enctype' => 'multipart/form-data']) !!}
                                        {{ Form::text('id', $value['id'], ['class' => 'd-none'])}}
                                        {{ Form::submit('Remove Item', ['class' => 'btn btn-danger cart-btn'])}}
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-sm-6 col-6">
                                    {!! Form::open(['method' => 'PUT', 'action' => ['cartControl@update', $value['id']], 'enctype' => 'multipart/form-data']) !!}
                                    {{ Form::text('id', $value['id'], ['class' => 'd-none'])}}
            
                                    {{ Form::text('quantity', '', ['class' => 'update-quantity'])}}
                                    {{ Form::submit('Update', ['class' => 'btn btn-success cart-btn'])}}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>

                   </div>
                @endforeach
                     @php
                        $total = number_format($item_total, 2);
                    @endphp
                    <div class="col-sm-12 col-12 mt-4">
                        <div class="d-flex justify-content-center">
                            <h6 class="cart-total">Total: <span class="cart-total">₦ @php echo $total; @endphp</span></h6>
                        </div>
                    </div>    
                @else
                <div class="col-sm-12 col-12">
                    <h6 class="text-center no-item-cart">No Item in your Cart</h6>  
                </div>
            @endif
           
        </div>
        
        @if(session('cart'))
            <div class="row mt-4">
                <div class="col-sm-12 col-12 text-center">
                    <a href="/order" class="btn btn-success cart-btn" role="button">Place Order</a>
                </div>
            </div>
        @endif

    </div>

    <!-----================ End of Small Screen ==================->



<!------============= Large Screen =====------>

<div class="container d-none d-md-block">
    <div class="row">
        <div class="col-lg-3 col-xl-3 col-md-3"></div>
        <div class="col-lg-9 col-md-9 col-xl-9">
            <table class="table table-bordered table-responsive-md">
            <tr>
                <th class="user-cart-table-text">Image</td>
                <th class="user-cart-table-text">Name</th>
                <th class="user-cart-table-text">Price</td>
                <th class="user-cart-table-text">Quantity</th>
            </tr>

            @if(session('cart'))
                @php
                    $item_total = 0;
                @endphp

                @foreach (session('cart') as $item => $value)
                    <tr>
                        <td>
                         @php
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($value['image']) . '" alt="" class="img-fluid cart-img">';
                        @endphp
                            {!! Form::open(['method' => 'DELETE', 'action' => ['cartControl@remove', $value['id']], 'enctype' => 'multipart/form-data']) !!}
                                {{ Form::text('id', $value['id'], ['class' => 'd-none'])}}
                                {{ Form::submit('Remove Item', ['class' => 'btn btn-danger cart-btn'])}}
                            {!! Form::close() !!}
                        </td>
                        <td class="user-cart-table-text">{{$value['name']}}</td>
                        <td class="user-cart-table-text">
                            @php
                                $actual_price = $value['price'];
                                $actual_quantity = $value['quantity'];
                                $each_item_total = $actual_price * $actual_quantity;
                                $price = number_format($each_item_total, 2);
                                echo "₦ " . $price;
                                $item_total += $each_item_total;
                            @endphp
                        </td>
                        <td class="user-cart-table-text">
                            {{$value['quantity']}}
                            {!! Form::open(['method' => 'PUT', 'action' => ['cartControl@update', $value['id']], 'enctype' => 'multipart/form-data']) !!}
                                {{ Form::text('id', $value['id'], ['class' => 'd-none'])}}
                                {{ Form::text('quantity', '', [])}}
                                <br>
                                {{ Form::submit('Update', ['class' => 'btn btn-success cart-btn'])}}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach

                    <tr>
                        <td colspan="3"></td>
                        <td>
                            @php
                                $total = number_format($item_total, 2);
                            @endphp
                            <h5 class="cart-total">Total: <span class="cart-total">₦ @php echo $total; @endphp</span></h5>
                        </td>
                    </tr>

                @else
                <tr>
                    <td colspan="4" class="text-center no-item-cart">No Item in your Cart</td>
                </tr>
            @endif


        </table>


        @if(session('cart'))
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="/order" class="btn btn-success cart-btn" role="button">Place Order</a>
                </div>
            </div>
        @endif

        </div>
    </div>
    
</div>

    <!------=============== End of Large Screen =============----------->





@endsection
