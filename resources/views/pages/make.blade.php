

@extends('layouts.app')
@section('content')

    <div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-xl-3"></div>
        <div class="col-lg-9 col-md-9 col-xl-9 col-sm-12 col-12 offset-lg-3 offset-md-3">
            <h6 class="text-center category-title">Make Up</h6>
            <hr class="category-hr">
            <div class="row">
                @if(count($makes) > 0)
                    @foreach ($makes as $item)
                        <div class="col-lg-3 col-md-4 col-xl-3 col-sm-6 col-6 category-body">
                            <a href="/item/{{$item->id}}" class="text-black">
                                <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-12 p-0">
                                     @php
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($item->images) . '" alt="" class="img-fluid category-img">';
                                    @endphp
                                </div>
                                <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-12 pt-2 pl-0 pr-0">
                                   @php
                                        if($item->discount_state == 'on'){
                                            echo "<li class='on-discount-name'>$item->name</li>";
                                        }
                                        if($item->discount_state == 'off'){
                                            echo "<li class='off-discount-name'>$item->name</li>";
                                        }

                                        if($item->discount_state == 'on'){
                                            $price = number_format($item->price, 2);
                                            echo "<small class='on-discount-price'><span class='naira-text'>₦ </span> $price</small>";

                                            $discount = ($item->price / $item->discount);
                                            $discount_price = $item->price - $discount;
                                            $discount_price_output = number_format($discount_price, 2);
                                            echo "<h6 class='text-bold'><span class='naira-text'>₦ </span> $discount_price_output</h6>";
                                        }else{
                                            $price = number_format($item->price, 2);
                                            echo "<h6 class='text-bold'><span class='naira-text'>₦ </span> $price</h6>";
                                        }
                                    @endphp
                                </div>
                            </a>
                        </div>
                    @endforeach

                @else
                    <div class="col-lg-12">
                        <h6 class="alert alert-success text-center category-no-item">No Item On Make Up</h6>
                    </div>
                @endif
            </div>


            <div class="row mt-3">
                <div class="col-lg-9 d-flex justify-content-center">
                    {{ $makes->links() }}
                </div>
            </div>

    </div>
    </div>
    </div>








@endsection
