

    @if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="row" style="">
            <div class="col-lg-8"></div>
            <div class="col-lg-4 alert-box">
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h6 class="text-center alert-msg">{{$error}}</h6>
                </div>
            </div>
        </div>
    @endforeach
@endif


@if(session('success'))
    <div class="row" style="">
        <div class="col-lg-8"></div>
        <div class="col-lg-4 alert-box">
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="text-center alert-msg">{{session('success')}}</h6>
            </div>
        </div>
    </div>

@endif



@if(session('error'))
    <div class="row" style="">
        <div class="col-lg-8"></div>
        <div class="col-lg-4 alert-box">
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="text-center alert-msg">{{session('error')}}</h6>
            </div>
        </div>
    </div>
@endif










