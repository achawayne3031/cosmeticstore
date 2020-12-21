
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row mb-4">
        <div class="col-lg-3 col-xl-3 col-md-3"></div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    @if($item->stock == 0)
                        <h5 class="out-of-stock-text">Out Of Stock</h5>
                    @endif
                    @php
                        if($item->discount_state == 'on'){
                            echo "<small id='show-discount-on'>-$item->discount%</small>";
                        }
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($item->images) . '" alt="" class="img-fluid" id="show-full-image">';

                    @endphp
                    <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-12 d-none d-md-block mt-3 mb-2">
                        <span class="fa fa-facebook-square mr-2" id="show-facebook"></span>
                        <span class="fa fa-instagram mr-2" id="show-insta"></span>
                        <span class="fa fa-snapchat-square mr-2" id="show-snapchat"></span>
                        <span class="fa fa-twitter-square mr-2" id="show-twitter"></span>
                        <span class="fa fa-whatsapp mr-2" id="show-whatsapp"></span>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-xl-5 col-sm-12 col-12">
                    <h5 hidden id="itemId">{{$item->id}}</h5>
                    <small id="show-brand">{{$item->brand_name}}</small>
                    <h4 id="show-name">{{$item->name}}</h4>
                        @php 
                            if($item->volume != ""){
                                echo "<small>$item->volume ml</small>";
                            }
                        @endphp
                  
                    <h6 id="show-category">{{$item->category}}</h6>
                    @php
                        if($item->discount_state == 'on'){
                            $price = number_format($item->price, 2);
                            echo "<h6 class='show-discount-price'>₦ $price</h6>";

                            $discount = ($item->price / $item->discount);
                            $discount_price = $item->price - $discount;
                            $discount_price_output = number_format($discount_price, 2);
                            echo "<h6 class='show-dis-price'>₦ $discount_price_output</h6>";
                        }else{
                            $price = number_format($item->price, 2);
                            echo "<h6 class='show-dis-price'>₦ $price</h6>";
                        }
                    @endphp

                    <div class="col-lg-12 col-md-12 col-xl-12 col-sm-12 col-12" id="star-rating-con">

                        @if($item->star <= 20  && $item->star > 0)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        @elseif($item->star <= 40 && $item->star > 20)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        @elseif($item->star <= 60 && $item->star > 40)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        @elseif($item->star <= 80 && $item->star > 60)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star"></span>
                        @elseif($item->star <= 100 && $item->star > 60)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>

                        @else
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        @endif

                       
                    </div>
                    <small id="review-btn" onclick="callReviewWrite()">Write a review</small>
                        @if($item->stock == 0)
                            <button class="btn btn-dark btn-block small-screen-btn mt-5 pt-3 pb-3" disabled>Out Of Stock</button>
                        @else
                             {!! Form::open(['action' => ['cartControl@add', $item->id], 'method' => 'POST']) !!}
                                {{ Form::submit('Add To Cart', ['class' => 'btn btn-danger btn-block small-screen-btn mt-5 pt-3 pb-3'])}}
                            {!! Form::close() !!}
                        @endif
                </div>
    </div>



    <div class="row mt-4">

        <div class="col-xl-6 col-lg-3 col-md-6 mb-3">
            <h5 class="title-desc-customer">Description</h5>
            <hr class="show-hr">
            <li id="desc-text">{{$item->description}}</li>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-6">
            <h5 class="title-desc-customer">Customers Reviews (
                    @php echo count($reviews); @endphp
               )</h5>
            <hr>
            <h5></h5>
            
                @if(count($reviews) > 0)
                    @foreach($reviews as $review)
                        @if($review->star == 1)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>

                        @elseif($review->star == 2)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        @elseif($review->star == 3)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        @elseif($review->star == 4)
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star"></span>
                        @else
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                            <span class="fa fa-star active-star"></span>
                        @endif

                        <li class="review-text">{{$review->review}}</li>
                        <small class="review-date">{{$review->created_at}} by {{$review->name}}</small>
                        <hr>

                    @endforeach
                        

                    @else
                    <h6 class="alert alert-success text-center no-review">Not Review</h6>

                    @endif

             

                
        </div>

    </div>

    <div class="row mt-4">
        <div class="col-lg-4 col-xl-4 col-lg-4">
            <h5 class="pb-2" id="related">Related Products</h5>
        </div>
    </div>

    <div class="row">
        
     @foreach ($relatedPros as $relatedPro)
                <div class="col-lg-2 col-xl-2 col-md-2 col-sm-6 col-6">
                    <a href="/item/{{$relatedPro->id}}" class="related-link">
                    @php
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($relatedPro->images) . '" alt="" class="img-fluid related-img">';
                    @endphp
                        <li class="related-name">{{$relatedPro->name}}</li>
                        @php
                            
                            if($relatedPro->discount_state == 'on'){
                                $price = number_format($relatedPro->price, 2);
                                echo "<h6 class='show-discount-price'><span class='naira-text'>₦ </span>$price</h6>";

                                $discount = ($relatedPro->price / $relatedPro->discount);
                                $discount_price = $relatedPro->price - $discount;
                                $discount_price_output = number_format($discount_price, 2);
                                echo "<h6 class='show-dis-price'><span class='naira-text'>₦ </span>$discount_price_output</h6>";
                            }else{
                                $price = number_format($relatedPro->price, 2);
                                echo "<h6 class='show-dis-price'><span class='naira-text'>₦ </span>$price</h6>";
                            }
                            
                        @endphp
                       
                        @php
                          //  $price = number_format($relatedPro->price, 2);
                          //  echo "<h6 class='related-price'><span class='naira-text'>NGN </span>$price</h6>";
                        @endphp
                      
                    </a>
                </div>
        @endforeach
        
       
    </div>
</div>

       

        
    <div class="col-lg-4 alert-box" id="review-alert">
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6 class="text-center category-no-item">Review Submitted.....</h6>
        </div>
    </div>
        

    
         <!----------------- Review container --------------->
         <div class="container-fluid review-con-body">
            <div class="row">

                <div class="col-lg-4 col-md-4 col-xl-4 offset-md-4 mt-4 p-4" id="review-inner-body">
                    <span class="fa fa-close mb-3" id="close-review-btn" onclick="closeReviewBody()"></span>
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control review-text" placeholder="Your Name">
                    </div>
                    <input id="star" type="text" name="" hidden>
                    <div class="form-group">
                        <textarea class="form-control review-text" id="review" rows="10" placeholder="Review...."></textarea>
                    </div>
                    <div class="form-group">
                        <span id="star1" class="fa fa-star review-stars" onmouseover="starOver(0)" onmouseout="starOut(0)" onmousedown="starDown(0)"></span>
                        <span class="fa fa-star review-stars" onmouseover="starOver(1)" onmouseout="starOut(1)" onmousedown="starDown(1)"></span>
                        <span class="fa fa-star review-stars" onmouseover="starOver(2)" onmouseout="starOut(2)" onmousedown="starDown(2)"></span>
                        <span class="fa fa-star review-stars" onmouseover="starOver(3)" onmouseout="starOut(3)" onmousedown="starDown(3)"></span>
                        <span class="fa fa-star review-stars" onmouseover="starOver(4)" onmouseout="starOut(4)" onmousedown="starDown(4)"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" id="star-count" class="d-none">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-secondary review-btn" id="re-btn" onclick="submitReview()">
                        <span id="submit-text">Submit Review</span>
                         <div id="submit-loader">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        </button>
                    </div>
                </div>
            
            </div>
            </div>
        <!------------- end of reveiw ----------->



@endsection




