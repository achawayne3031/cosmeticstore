

$(document).ready(function(){
   
    
    $("#side-navbar-switch").click(function(){
        $("#side-navbar-target").slideToggle();
    });



    
    $("#owl-example").owlCarousel({
        autoPlay: 3000,
        responsive:{ 
            200:{
                item: 2
            },
            480:{
                items:2
            },
            678:{
                items:3
            },
            960:{
                items: 5
            }

        }
    });

    /*
    
    $("#owl-example").owlCarousel({
        autoPlay: 3000,
        items: 4,
        loop: true,
        margin: 5,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        responsive:{ 
            200:{
                item: 2
            },
            480:{
                items:2
            },
            678:{
                items:3
            },
            960:{
                items:4
            }

        }
    });

    */
    

});



    function closeLocation(){
        $("#pick_up_option").hide();
        $("#cover_background").hide();
    }

    function closeReviewBody(){
        $(".review-con-body").hide();
        $('#star-count').val('');
        var allStars = document.getElementsByClassName('review-stars');
        for(var i = 0; i < allStars.length; i++){
            var attr = document.createAttribute('class');
            attr.value = 'fa fa-star review-stars';
            allStars[i].setAttributeNode(attr);
           
        }
    }

    function callReviewWrite(){
        $(".review-con-body").show();
    }

    function starOver(current){
       var allStars = document.getElementsByClassName('review-stars');
        for(var i = 0; i < allStars.length; i++){
            if(i <= current){
                allStars[i].style.color = 'yellow';
            }else{
                allStars[i].style.color = '';
            }
        }

    }

    function starOut(current){
       var allStars = document.getElementsByClassName('review-stars');
       for(var i = 0; i < allStars.length; i++){
           if(i <= current){
               allStars[i].style.color = '';
           }
       }
    }

    function starDown(current){
        var starCount = current + 1;
        $('#star-count').val(starCount);
        var allStars = document.getElementsByClassName('review-stars');
        for(var i = 0; i < allStars.length; i++){
            if(i <= current){
                allStars[i].style.color = 'orange';
                var attr = document.createAttribute('class');
                attr.value = 'fa fa-star review-stars active-star';
                allStars[i].setAttributeNode(attr);
            }else{
                var attr = document.createAttribute('class');
                attr.value = 'fa fa-star review-stars';
                allStars[i].setAttributeNode(attr);
            }
        }
       
    }


    function submitReview(){
        var star = $("#star-count").val();
        var name = $("#name").val();
        var review = $("#review").val();
        var date = new Date();
        var date1 = date.toString();
        var id = $("#itemId").html();

        if(name != ""){
            if(review != ""){
                if(star != ""){
                    $("#submit-text").hide();
                    $("#submit-loader").show();

                    $.ajax({
                        url: "/review/save",
                        type: "POST",
                        data: {name: name, review: review, star: star, id: id},
                        crossDomain: true,
                        dataType: "json",
                        timeout: 8000,
                        success: function (response) {
                            $("#star-count").val('');
                            $("#name").val('');
                            $("#review").val('');
                            var allStars = document.getElementsByClassName('review-stars');
                            for(var i = 0; i < allStars.length; i++){
                                var attr = document.createAttribute('class');
                                attr.value = 'fa fa-star review-stars';
                                allStars[i].setAttributeNode(attr);
                            }

                            if(response[0].success === true){
                                $("#submit-loader").hide();
                                $("#submit-text").show();
                                $(".review-con-body").hide();
                                $("#review-alert").slideDown(500);
                            }

                          
                        },
                        error: function (xhr, status) {
                            alert(status);
                            $("#submit-loader").hide();
                            $("#submit-text").show();
                        }
                    });
                    
                }else{
                    alert("pick your stars");
                }
            }else{
                alert("enter your review");
            }
        }else{
            alert("enter your name");
        }

    }



    function callImageBtn(){
        $("#image-btn-target").click();
       
    }

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $("#image-text-name").html(fileName);
        $("#image-msg").html("");
    });


    function callProManageBody(){
        $("#pro-management-dropdown-body").slideToggle();
        var current = $("#management-dropdown-icon").attr('class');
        if(current == "fa fa-angle-right"){
            $("#management-dropdown-icon").attr('class', 'fa fa-angle-down');
        }else{
            $("#management-dropdown-icon").attr('class', 'fa fa-angle-right');
        }

    }

    
function callStockDropdown(){
    $("#stock-management-dropdown").slideToggle();
    var current = $("#stock-management-dropdown-icon").attr('class');
    if(current == "fa fa-angle-right"){
        $("#stock-management-dropdown-icon").attr('class', 'fa fa-angle-down');
    }else{
        $("#stock-management-dropdown-icon").attr('class', 'fa fa-angle-right');

    }
}


function addToCart(){
    var itemId = document.getElementById('itemId').innerHTML;
    alert(itemId);

        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {   
                    document.getElementById("alert").innerHTML = xhttp.responseText;
                }
            };

        xhttp.open("GET", "pro.php?id=" + itemId, true);
        xhttp.send();

}


function send(){
    var proName = $("#pro-name").val();
    var price = $("#price").val();
    var imageFile = $("#image-text-name").html();

    $("#pro-name-msg").html('');
    $("#price-msg").html('');
    $("#image-msg").html("");

    
    if(imageFile != ""){
        return true;
    }else{
        $("#image-msg").html("Select your product image");
        return false;
    }
   
}




function send(){
    var proName = $("#pro-name").val();
    var price = $("#price").val();
    var imageFile = $("#image-text-name").html();

    $("#pro-name-msg").html('');
    $("#price-msg").html('');
    $("#image-msg").html("");
   
}


function delUser(id){
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: "/admin/reg-users",
        type:"POST",
        data:{
            id: id,
            _token: _token
        },
        success:function(response){
          console.log(response);
          if(response) {
              alert(response.success);
            //$('.success').text(response.success);
          }
        },
       });
}

function adminRefresh(){
    $("#spin").attr('class', 'fa fa-refresh fa-spin');
    $.ajax({
        url: "/admin/reg-users",
        type:"GET",
        success:function(response){
            $("body").html(response);
          if(response) {
              setTimeout(function(){
                $("#spin").attr('class', 'fa fa-refresh');
              }, 2000);
          }
        },
       });
       
}



 function callToGetState(){

    var check = $("input[type='radio'][name='delivery']:checked").val();
    if(check === undefined){
        handleClick('0.00');
    }else{
        handleClick(check);
    }
    
    $("#local-select").attr("disabled", true);
    $.ajax({
       url: '/state',
        type: "GET",
        crossDomain: true,
        dataType: "json",
        success: function (response) {
           var output = '';
            for(var i = 0; i < response.length; i++){   
                output += '<option onclick="callToGetLocal()">' + response[i].name + '</option>';
            }

            $("#state-select").append(output);
            
        },
        error: function (xhr, status) {
            console.log(status + " " + xhr);
          // alert("json parser failed on state retrival....");
        }
    });
 }


 $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });

 function callToGetLocal(){
    var selectedText = $("#state-select option:selected").html();
    $("#local-select").empty();
    var emptyOption = '<option></option>';
    $("#local-select").append(emptyOption);

    
    $.ajax({
         url: "/local",
         type: "GET",
         crossDomain: true,
         dataType: "json",
         success: function (response) {
             var output = '';
             for(var i = 0; i < response.length; i++){   
                 if(response[i].state == selectedText){
                     var local = response[i].lgas;
                     for(var l = 0; l < local.length; l++){
                         output += '<option>' + local[l] + '</option>';
                     }
                     
                 }
                
             }
             $("#local-select").append(output);
             $("#local-select").removeAttr("disabled");  
             
         },
         error: function (xhr, status) {
            alert("json parser failed on local...");
         }
     });
}






function handleClick(deliveryValue){
    $("#pay-card").removeAttr('disabled', true);
    $(".delivery-partten-price").html("₦ " + deliveryValue);
    
    var calTotal = parseInt($("#cal-total").html());
    var finalTotal = calTotal + parseInt(deliveryValue);

    $("#total-price").html(finalTotal);
    var n = finalTotal;
    var sho =  n.toLocaleString()
    var dynamicTotal = $("#dynamic-total").html("₦  " + sho);
    
}






var asign = setInterval(function(){
    var check = $("input[type='radio'][name='delivery']:checked").val();
    $(".delivery-partten-text").html("Delivery Fee: ");
    $(".delivery-partten-price").html("NGN " + check);

    var calTotal = parseInt($("#cal-total").html());
    var finalTotal = calTotal + parseInt(check);
    $("#total-price").html(finalTotal);

    var n = finalTotal;
  //  var sho =  n.toLocaleString()
    var dynamicTotal = $("#dynamic-total").html("NGN " + n);
    
    if(check == '2000'){
        var delMethod = 'door delivery'
    }else{
        var delMethod = 'pick-up';
    }
    
}, 100);


    if($(".delivery-partten-price").html() != ""){
        clearInterval(asign);
    }


    $( "#target" ).submit(function( event ) {
        event.preventDefault();
      });

      $( "#subscribe-form" ).submit(function( event ) {
        event.preventDefault();
      });


function transit(option){
   var balance = $("#balance").html();
    var id = $("#user-id").html();
    var name = $("#name").val();
    var amount = $("#total-price").html();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var state = $("#state-select option:selected").html();
    var local = $("#local-select option:selected").html();
    var totalPayment = $("#cal-total").html();
   // var totalPayment = $("#my-total").html();
   // var totalPrice = $("#total-price").html();
    var check = $("input[type='radio'][name='delivery']:checked").val();
    if(check == '2000'){
        var delMethod = 'door delivery'
        totalPayment = parseInt(totalPayment) + 2000;
    }else{
        var delMethod = 'pick-up';
        totalPayment = parseInt(totalPayment) + 800;
    }

    if(phone != ""){
       if(state != ""){
            if(local != ""){

            if(check != null){
            // alert(totalPayment);
                if(option == 'card'){
                    $("#pay-with-card-text").hide();
                    $("#pay-using-card-loader").show();
                    $("#pay-card").css({"width": "110px"});
                    payWithPaystack(id, name, email, totalPayment, phone, state, local, delMethod);
                }else{

                    $("#pay-from-account-text").hide();
                    $("#pay-from-account").css({"width": "110px"});
                    $("#pay-from-account-loader").show();
                    if(totalPayment > balance){
                        alert("your balance is low");
                        $("#pay-from-account-loader").hide();
                        $("#pay-from-account").css({"width": "auto"});
                        $("#pay-from-account-text").show();   
                    }else{
                    var newBalance = parseInt(balance) - parseInt(totalPayment);
                    paymentFromAccount(id, email, totalPayment, newBalance, phone, state, local, delMethod);
                    
                    }
                    
                }

            }else{

                alert('Select your delivery method');
                return false;
            }

        }else{
            alert("Select your local govt");
            return false;
        }

    }else{
        alert("Select your state");
        return false;
    }

}else{
    alert("Enter your phone number");
    return false;
}

       
   // return false;
}



function paymentFromAccount(id, email, totalPayment, newBalance, phone, state, local, delMethod){
    var date = new Date();
    var date1 = date.toUTCString();

   // alert(newBalance);
    
    $.ajax({
        url: "/store-payment-from-account",
        type: "POST",
        data: {
            id: id,
            email: email,
            phone: phone,
            state: state,
            local: local,
            payment: totalPayment,
            balance: newBalance,
            delMethod: delMethod,
            date: date1
        },
        crossDomain: true,
       // dataType: "json",
        success: function (response) { 
            $("#pay-from-account-loader").hide();
            $("#pay-from-account").css({"width": "auto"});
            $("#pay-from-account-text").show();   
           if(response === 'done'){
             window.location = '/cart/ordered';
           }
        },
        error: function (xhr, status) {
           alert("json parser failed on local...");
           $("#pay-from-account-loader").hide();
           $("#pay-from-account").css({"width": "auto"});
           $("#pay-from-account-text").show();   
        }
    });

    

}


function payWithPaystack(id, name, email, amount, phone, state, local, delMethod) {

var date = new Date();
var date1 = date.toUTCString();

var handler = PaystackPop.setup({ 
key: 'pk_test_0469a169b7c6b2aa7f64a9830eccdfbf791a3dd2', //put your public key here
email: email, //put your customer's email here
amount: amount + '00', //amount the customer is supposed to pay
metadata: {
    custom_fields: [
        {
            display_name: name,
            variable_name: 'mobile',
            value: phone //customer's mobile number
        }
    ]
},
callback: function (response) {
    //after the transaction have been completed
    //make post call  to the server with to verify payment 
    //using transaction reference as post data
    $.post('/paystack', {reference:response.reference}, function(status){
        if(status == 'success'){

            $.ajax({
                url: "/store-payment-details",
                type: "POST",
                data: {
                    id: id,
                    name: name,
                    email: email,
                    phone: phone,
                    state: state,
                    local: local,
                    amount: amount,
                    delMethod: delMethod,
                    date: date1,
                    ref: response.reference
                },
                crossDomain: true,
               // dataType: "json",
                success: function (response) { 
                    $("#pay-using-card-loader").hide();
                    $("#pay-with-card-text").show();
                    $("#pay-card").css({"width": "auto"});
                   if(response === 'done'){
                     window.location = '/cart/ordered';
                   }
                },
                error: function (xhr, status) {
                   alert("json parser failed on local...");
                   $("#pay-using-card-loader").hide();
                   $("#pay-with-card-text").show();
                   $("#pay-card").css({"width": "auto"});
                }
            });
         
        }
        else{
            //transaction failed
            alert(response);
            $("#pay-using-card-loader").hide();
            $("#pay-with-card-text").show();
            $("#pay-card").css({"width": "auto"});
        }
    });
},
onClose: function () {
    //when the user close the payment modal
    alert('Transaction cancelled');
    $("#pay-using-card-loader").hide();
    $("#pay-with-card-text").show();
    $("#pay-card").css({"width": "auto"});
}
});
handler.openIframe(); //open the paystack's payment modal

}


var currentTop = 212;
setInterval(function(){
    var content = $(".out-of-stock-text");
    content.animate({
        top: currentTop + 'px'
    }, 2000);

    currentTop = currentTop - 50;
    if(currentTop <= 140){
        currentTop = 212;
    }

    if(currentTop < 210){
        content.css({"box-shadow": "0px 0px 0px"});
    }else{
        content.css({"box-shadow": "2px 2px 3px black"});
    }

    content.animate({
        top: currentTop + 'px'
    }, 2000);
    
}, 1);





function savePayment(){
    $.ajax({
        url: "/store-payment-details",
        type: "POST",
        data: {
            name: name,
            email: email,
            phone: phone,
            state: state,
            local: local,
            amount: amount,
            delMethod: delMethod,
            date: date1,
            ref: response.reference
        },
        crossDomain: true,
       // dataType: "json",
        success: function (response) {
            window.location = '/';
        },
        error: function (xhr, status) {
           alert("json parser failed on local...");
        }
    });
}


function fundUser(){
    var date = new Date();
    var date1 = date.toUTCString();
    var userID = $("#user-id").html();
    var amount = $("#amount").val();
    var email = $("#email").html();
    if(amount != ""){
        if(isNaN(amount) == false){
            $("#fund-text").hide();
            $("#fund-btn").css({"width": "50px"});
            $("#fund-loader").show();

            $.ajax({
                url: "/admin/fund-user-account",
                type: "POST",
                data: {
                    amount: amount,
                    id: userID,
                    email: email,
                    myDate: date1
                },
                crossDomain: true,
               // dataType: "json",
                success: function (response) {
                    if(response == 'success'){
                        $("#fund-loader").hide();
                        $("#fund-text").show();
                        $("#amount").val('');
                        $("#admin-alert").show();
                    }
                
                },
                error: function (xhr, status) {
                    $("#fund-loader").hide();
                    $("#fund-text").show();
                   alert("json parser failed ...");
                }
            });
            
        }else{
            alert("only numbers allowed");
        }
    }else{
        alert("Enter an amount");
    }
}







function payWithPaystackFromUserToAccount(userID, amount, email, phone) {
    var date = new Date();
    var date1 = date.toUTCString();
    var handler = PaystackPop.setup({ 
    key: 'pk_test_0469a169b7c6b2aa7f64a9830eccdfbf791a3dd2', //put your public key here
    email: email, //put your customer's email here
    amount: amount + '00', //amount the customer is supposed to pay
    metadata: {
        custom_fields: [
            {
                display_name: name,
                variable_name: 'mobile',
                value: phone //customer's mobile number
            }
        ]
    },
    callback: function (response) {
        //after the transaction have been completed
        //make post call  to the server with to verify payment 
        //using transaction reference as post data
        $.post('/paystack', {reference:response.reference}, function(status){

            if(status == 'success'){
                    $.ajax({
                        url: "/user-fund-account",
                        type: "POST",
                        data: {
                            amount: amount,
                            id: userID,
                            email: email,
                            myDate: date1,
                            ref: response.reference
                        },
                        crossDomain: true,
                    // dataType: "json",
                        success: function (response) {
                            if(response == 'success'){
                                $("#fund-loader").hide();
                                $("#fund-text").show();
                                $("#amount").val(0);
                                $("#admin-alert").show();
                            }
                        
                        },
                        error: function (xhr, status) {
                          $("#fund-loader").hide();
                          $("#fund-text").show();
                        alert("json parser failed ...");
                        }
                    });
             
            }
            else{
                //transaction failed
                alert(response);
                $("#fund-loader").hide();
                $("#fund-text").show();
            }
        });
    },
    onClose: function () {
        //when the user close the payment modal
        alert('Transaction cancelled');
        $("#fund-loader").hide();
        $("#fund-text").show();
    }
    });
    handler.openIframe(); //open the paystack's payment modal
    
    }
    



function userCallFund(){
    var date = new Date();
    var date1 = date.toUTCString();
    var userID = $("#user-id").html();
    var amount = $("#amount").val();
    var email = $("#email").html();
    var phone = $("#phone").html();
    if(amount != ""){
        if(isNaN(amount) == false){
            if(amount > 100){
                $("#fund-text").hide();
                $("#fund-btn").css({"width": "50px"});
                $("#fund-loader").show();
                payWithPaystackFromUserToAccount(userID, amount, email, phone);
           
            }else{
                alert("only more than 100 naira and above is required");
            }
        }else{
            alert("only numbers allowed");
        }
    }else{
        alert("Enter an amount");
    }
}



function submitNewsletter(){
    var email = $("#newsletter-input").val();
    if(email != ""){
        $("#email-subscribe-loader").show();
        $("#email-subscribe-text").hide();
        $.ajax({
            url: "/newsletter-email",
            type: "POST",
            data: {
                email: email 
            },
            crossDomain: true,
        // dataType: "json",
            success: function (response) {
                if(response == 'invalid'){
                    alert("Invalid Email Address");
                    $("#newsletter-input").val('');
                    $("#email-subscribe-text").show();
                    $("#email-subscribe-loader").hide();

                }else if(response == 'registered'){
                    alert("Email has been subscribed");
                    $("#newsletter-input").val('');
                    $("#email-subscribe-text").show();
                    $("#email-subscribe-loader").hide();
                    
                }else{
                    alert("Email submitted");
                    $("#newsletter-input").val('');
                    $("#email-subscribe-text").show();
                    $("#email-subscribe-loader").hide();
                }
            
            },
            error: function (xhr, status) {
                alert("json parser failed ...");
            }
        });


    }else{
        alert("Enter your email address");
    }

}


function updatePassword(){
    var password = $("#update-password").val();
    var email = $("#email").html();

    if(password != ""){
        $("#user-update-password-text").hide();
        $("#user-update-password-loader").show();

        $.ajax({
            url: "/user-update-password",
            type: "POST",
            data: {
                password: password,
                email: email
            },
            crossDomain: true,
        // dataType: "json",
            success: function (response) {
                if(response === "success"){
                    alert("updated");
                    $("#update-password").val('');
                    $("#user-update-password-loader").hide();
                    $("#user-update-password-text").show();

                }else{
                    alert("something went wrong, try again");
                    $("#user-update-password-loader").hide();
                    $("#user-update-password-text").show();
    
                }
            
            },
            error: function (xhr, status) {
                alert("json parser failed ...");   
                $("#user-update-password-loader").hide();
                $("#user-update-password-text").show();
        
            }
        });

    }else{
        alert('Enter your password');
    }

}


////// call small screen dropdown /////
    function callSmallScreenDropDown(){
        $("#showSmallScreenAuthLink").slideToggle();
    }


    function callSmallScreenSideNavbar(){
        $("#side-nav-row").toggle();
    }

    function closeSmallScreenSideNavbar(){
        $("#side-nav-row").hide();
    }

    var input = document.getElementById("small-screen-search-field");
    input.addEventListener('keyup', function(event){
        if(event.key == 'Enter'){
            document.getElementById("small-screen-search-btn").click();
        }    
    });


    var date = new Date();
    var year = date.getFullYear();
    document.getElementById('year').innerHTML = year;

    function validate(){
        var searchInput = document.querySelector('#search-field').value;
        if(searchInput == ""){
            return false
        }
    }

    
    $('#navbarDropdown').click(() => {
        $("#showAuthLink").slideToggle();
    });

    
    function smallScreenValidate(){
        var searchInput = document.querySelector('#small-screen-search-field').value;
        if(searchInput == ""){
            return false
        }
    }



    
        /*
        
        var formData = new FormData();
        formData.append('file', file);
        formData.append('upload', cloud_UPLOAD);

        $.ajax({
            url: cloud_API,
            type: "POST",
            data: formData,
            crossDomain: true,
        // dataType: "json",
            success: function (response) {
                console.log(response);
                alert("done");
            },
            error: function (xhr, status) {

                alert("json parser failed ...");   
               
        
            }

            
        });

        */



       $( "#create-form" ).submit(function( event ) {
        event.preventDefault();
      });
        /////////// my 
        ///// check nin *346#
        ////
        ////////// Create product //////////
        function createProduct(){
            var name = $("#pro-name").val();
            var price = $("#price").val();
            var discount = $("#discount").val();
            var state = $("input[type='radio'][name='state']:checked").val(); //// empty == undefined;
            var volume = $("#volume").val();
            var brand = $("#brand-name").val();
            var category = $("#category option:selected").html(); //// empty === ""
            var image = $("#image-btn-target")[0].files[0];
            var imageVal = $("#image-btn-target").val();
            var desc = $("#desc-body").val();
            var sold = $("#sold").val();
            var stock = $("#stock").val();

            if(name != ""){
                if(price != ""){
                    if(discount != ""){
                        if(state != undefined){
                        if(volume != ""){
                            if(brand != ""){
                                if(category != ""){
                                    if(imageVal != ""){
                                        if(desc != ""){
                                            if(sold != ""){
                                                if(stock != ""){
                                                    var formData = new FormData();
                                                    formData.append('name', name);
                                                    formData.append('price', price);
                                                    formData.append('discount', discount);
                                                    formData.append('state', state);
                                                    formData.append('volume', volume);
                                                    formData.append('brand', brand);
                                                    formData.append('category', category);
                                                    formData.append('file', image);
                                                    formData.append('desc', desc);
                                                    formData.append('sold', sold);
                                                    formData.append('stock', stock);     
                                                    
                                                    $("#create-btn-text").hide();
                                                    $("#create-btn-loader").show();
                                                    $("#create-btn").css({"width": "100px"});
                                                    
                                                    $.ajax({
                                                        url: '/create-product',
                                                        type: "POST",
                                                        data: formData,
                                                        crossDomain: true,
                                                        contentType: false,
                                                        processData: false,
                                                    // dataType: "json",
                                                        success: function (response) {
                                                           // console.log(response);
                                                            
                                                            if(response == "done"){
                                                            $("#create-btn-loader").hide();
                                                            $("#create-btn-text").show();
                                                            $("#create-btn").css({"width": "auto"});
                                                            $("#pro-name").val('');
                                                            $("#price").val(0);
                                                            $("#discount").val(0);
                                                            $("input[type='radio'][name='state']:checked").val(); //// empty == undefined;
                                                            $("#volume").val(0);
                                                            $("#brand-name").val('');
                                                            $("#category option:selected").html(); //// empty === ""
                                                            $("#image-btn-target")[0].files[0];
                                                            $("#image-btn-target").val('');
                                                            $("#desc-body").val('');
                                                            $("#sold").val(0);
                                                            $("#stock").val(0);
                                                            $("#image-text-name").html('');
                                                            $("#create-alert-success").show();
                                                            }else{
                                                                $("#create-alert-error").show();
                                                            }
                                                            
                                                        },
                                                        error: function (xhr, status) {
                                                           // alert(xhr); 
                                                            console.log(xhr);
                                                            $("#create-btn-loader").hide();
                                                            $("#create-btn-text").show();
                                                            $("#create-btn").css({"width": "auto"});  
                                                        
                                                        }

                                                    });
                                                     

                                                }else{
                                                    alert("Enter the available item");
                                                    $("#stock").select();
                                                }
                                            }else{
                                                alert("Enter number of sold item");
                                                $("#sold").select();
                                            }
                                        }else{
                                            alert("Enter the product description");
                                            $("#desc-body").select();
                                        }
                                    }else{
                                        alert("Pick the products image");
                                    }
                                }else{
                                    alert("Select the category");
                                    $("#category").select();
                                }
                            }else{
                                alert('Enter the brand name');
                                $("#brand-name").select();
                            }
                        }else{
                            alert("Enter the volume");
                            $("#volume").select();
                        }
                    }else{
                        alert("Enable display discount switch label");
                    }
                    }else{
                        alert("Enter the discount rate");
                        $("#discount").select();
                    }
                }else{
                    alert("Enter the price");
                    $("#price").select();
                }
            }else{

                alert("Enter the product name");
                $("#pro-name").select();
            }


        }

       


    $('.bxslider').bxSlider({
        mode: 'fade',
        auto: true,
        speed: 3000

    });


    function closeAdminUserSmallScreenSideNavbar(){
        $("#small-screen-side-nav-row").hide();
    }

    function callAdminUserSideNav(){
        $("#small-screen-side-nav-row").show();
    }


    /*
    function updateProduct(){
        var name = $("#pro-name").val();
        var price = $("#price").val();
        var discount = $("#discount").val();
        var volume = $("#volume").val();

    }

    */

    

   $( "#change-password-form" ).submit(function( event ) {
    event.preventDefault();
  });




  function validateEmail1($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
  }


    function validateEmail(){
        var email = $("#email").val();
        if(email != ""){

        if(validateEmail1(email)){ 
            $("#password-submit-email-text").hide();
            $("#submit-email-loader").show();
            $.ajax({
                url: '/check-email',
                type: "POST",
                data: {
                    email: email
                },
                crossDomain: true,
            // dataType: "json",
                success: function (response) {
                    if(response.length === 0){
                        alert("Email Address not registered");
                        $("#submit-email-loader").hide();
                        $("#password-submit-email-text").show();
                     //   console.log("array empty");
                    }else{
                        $("#update-password-container").show();
                      //  console.log(response);  
                    }
                },
                error: function (xhr, status) {
                    console.log(xhr);
                }
            });
             
           /// alert("email");
            /* do stuff here */ 
        }

    }else{
        alert("Enter your email address");
    }
      
        
    }


    function closePasswordBody(){
        $("#update-password-container").hide();
        $("#user-login-email-text").show();
        $("#password-submit-email-text").show();
        $("#submit-email-loader").hide();

    }

    function changeUserPassword(){
        var password = $("#password").val();
        var email = $("#email").val();

        $("#change-password-text").hide();
        $("#update-submit-loader").show();

        if(password.length > 7){
            $.ajax({
                url: '/change-password',
                type: "POST",
                data: {
                    password: password,
                    email: email
                },
                crossDomain: true,
            // dataType: "json",
                success: function (response) {
                    console.log(response); 
                    if(response == 1){
                        $("#update-submit-loader").hide();
                        $("#change-password-text").show();
                        $("#password-update-alert").show();
                        $("#update-password-container").hide();
                        $("#user-login-email-text").show();
                        $("#submit-email-loader").hide();
                        $("#password-submit-email-text").show();
                        $("#email").val('');
                        $("#password").val('');
                    }else{
                        alert("Error Occured, Try again");
                    }
                    
                },
                error: function (xhr, status) {
                    console.log(xhr);
                    $("#update-submit-loader").hide();
                    $("#change-password-text").show();
                }
            });

    }else{
        alert("Password must be greater than 7");
    }

    

    }