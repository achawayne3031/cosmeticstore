@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-lg-8 col-md-8 col-xl-8 col-sm-12 col-12">
        <div id="address-info">
            
            <form id="target" action="" method="POST">
                <h4 id="personal-info">Personal Information</h4>
                <hr>
                <!---------------====== for detail display=========--------->
                <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12 col-12">
                <table class="table table-borderless">
                    <tr>
                        <th class="transit-table-text">Full Name</th>
                        <td class="transit-table-text">{{Auth::user()->name}}</td>
                    </tr>
                     <tr>
                        <th class="transit-table-text">Email Address</th>
                        <td class="transit-table-text">{{Auth::user()->email}}</td>
                    </tr>
                </table>
            </div>
            <!---=========== end of detail display==========--------->

                <div class="form-group d-none">
                    <label for="" class="transit-personal-info">Name</label>
                    <input type="text" id="name" name="full-name" value="{{Auth::user()->name}}" disabled class="form-control transit-personal-info">
                </div>
                <span class="d-none" id="user-id">{{Auth::user()->id}}</span>
                <div class="form-group d-none">
                    <label for="" class="transit-personal-info">Email Address</label>
                    <input type="text" name="email" id="email" value="{{Auth::user()->email}}" disabled class="form-control transit-personal-info">
                </div>

                <h4 id="address-text" class="transit-personal-info">Address Information</h4>
                <hr>

                @if(Auth::user()->phone != '' || Auth::user()->phone != null)

                    <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="" class="transit-personal-info">Phone Number</label>
                            <input type="number" class="form-control transit-personal-info" id="phone" disabled value="@php echo Auth::user()->phone; @endphp">
                        </div>

                        <div class="form-group">
                            <label for="" class="transit-personal-info">State Of Resident</label>
                            <select class="form-control transit-personal-info" id="state-select" disabled>
                                <option>{{Auth::user()->state}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="transit-personal-info">Local Govt</label>
                            <select id="local-select" class="form-control transit-personal-info">
                                <option>{{Auth::user()->local}}</option>
                            </select>
                        </div>
                    </div>

                    @else

                    <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12 col-12">
                        <div class="form-group">
                            <label for="" class="transit-personal-info">Phone Number</label>
                            <input type="number" value="" class="form-control transit-personal-info" id="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="transit-personal-info">State Of Resident</label>
                            <select class="form-control transit-personal-info" id="state-select" required>
                                <option></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="transit-personal-info">Local Govt</label>
                            <select id="local-select" class="form-control transit-personal-info" required>
                                <option></option>
                            </select>
                        </div>
                    </div>
                    @endif
            </div>

        <div id="delivery-con">
            <h5 class="transit-personal-info" style="font-weight: bold; color: violet">Select Delivery Method</h5>
            <hr>
        
            <div class="col-lg-6 col-md-6 col-xl-6 col-sm-12 col-12">
                <div class="delivery-panel" style="">
                    <div class="form-check">
                        <label class="form-check-label delivery-text">
                        <input type="radio" class="form-check-input" name="delivery" value="2000" onclick="handleClick(this.value)">Door Delivery
                        </label>
                        <br>
                        <small class="delivery-text">Door Delivery for <span style="font-weight: bold">NGN 2,000</span></small>
                    </div>
                </div>

                <div class="delivery-panel mt-2">
                    <div class="form-check">
                        <label class="form-check-label delivery-text">
                            <input id="pick_up_station" type="radio" class="form-check-input" name="delivery" value="800" onclick="handleClick(this.value)">Pick Up Station (commerical will-bill)
                        </label>
                    </div>
                </div>
            </div>


        </div>


        <div id="shipping-body-con">
            <h5 id="shipping-text">Shipping Details</h5>
            <hr>
            <div class="row">
                 <table class="table table-borderless">
                    <tr>
                        <th class="shipping-detail-table-text">Quantity</th>
                        <th class="shipping-detail-table-text">Name</th>
                        <th class="shipping-detail-table-text">Price</th>
                    </tr>
                    @foreach (session('cart') as $item => $value)
                        <tr>
                            <td class="shipping-detail-table-text">{{$value['quantity']}}x</td>
                            <td class="shipping-detail-table-text">{{$value['name']}}</td>
                            <td class="shipping-detail-table-text">₦ 
                                <?php echo number_format($value['price'], 2); ?>
                            </td>
                        </tr>
                    @endforeach
                 </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6 col-6">
                        <h6 class="total-text">Total Item</h6>
                        <h6 class="delivery-partten-text total-text">Delivery Fee: </h6>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6 col-6">
                        @php
                            $total_item = 0;
                        @endphp
                        @if(session('cart'))
                            @foreach (session('cart') as $item => $value)
                                @php
                                    $each_item_price = intval($value['price']) * intval($value['quantity']);
                                    $total_item += $each_item_price;
                                @endphp
                            @endforeach
                        @else

                        @endif

                        <h6 class="text-bold total-text">₦ <?php echo number_format($total_item, 2); ?></h6>
                        <h6 class="total-text delivery-partten-price">₦ 0</h6>
                    </div>
                </div>
                <hr>
                <div class="row" style="margin-top: 20px">
                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6 col-6">
                        <h6 class="total-text">Total</h6>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6 col-sm-6 col-6">
                        <span id="total-price" class="total-text"></span>
                        <span id="cal-total">@php echo $total_item; @endphp</span>
                        <span class="total-text"></span>
                        <h6 class="text-bold total-text" id='dynamic-total'>
                            @php
                                $total = $total_item;
                                echo "₦ ". number_format($total, 2);
                            @endphp
                        </h6>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-4">
            <span class="d-none" id="balance">{{$balance}}</span>
            
            <button id="pay-card" class="btn btn-success" onclick="transit('card')">
                <span id="pay-with-card-text">Pay Using Card</span>
                <div id="pay-using-card-loader">
                    <span class="spinner-border spinner-border-sm"></span>
                </div>
            </button>

            <button id="pay-from-account" class="btn btn-secondary" onclick="transit('account')">
                <span id="pay-from-account-text">Pay From Account</span>
                 <div id="pay-from-account-loader">
                    <span class="spinner-border spinner-border-sm"></span>
                </div>
            </button>

            <!---------
            <button id="pay-bitcoin" class="btn btn-primary" disabled>
                <span id="pay-using-bitcoin-text">Pay Using Bitcoin</span>
            </button>
            ------------->
            
        </div>
    </form>

    
    </div>
</div>
</div>

<script>

    

   

</script>

@endsection

<!----
<div class="container-fluid">
    <div id="cover_background" class="row">

    </div>
</div>
--->





