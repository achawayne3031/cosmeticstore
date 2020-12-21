@extends('admin.layouts.app')
@section('content')


    
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-lg-3 offset-md-9 text-center">
                <h5><span class="fa fa-refresh fa-spin"></span> Refresh</h5>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-4">
        <div class="row">
             <div class="col-md-3 col-lg-3 col-xl-3">
                <div id="status-content">
                    <h5>Total Inventory</h5>
                    <h4>
                        @php 
                            echo count($total_pro);
                        @endphp
                        <small class="detail-dashboard-text">Items</small>
                    </h4>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3">
                <div id="status-content">
                    <h5>Total Sales</h5>
                    @if(count($total_payment) > 0)
                        <?php $output = 0; ?>
                        @foreach($total_payment as $key => $value)
                            @php
                            $output += $value['total_payment'];
                          
                            @endphp
                        @endforeach
                            <h4><small class="detail-dashboard-text">NGN</small><?php echo number_format($output);  ?></h4>
                       
                    @else
                         <h4>0</h4>
                    @endif
                </div>
            </div>

             <div class="col-md-3 col-lg-3 col-xl-3">
                <div id="status-content">
                    <h5>Total Orders</h5>
                      @if(count($total_orders) > 0)
                        <?php $output = 0; ?>
                        @foreach($total_orders as $key => $value)
                            @php
                            $output += $value['quantity'];
                          
                            @endphp
                        @endforeach
                            <h5><?php echo $output ?> <small class="detail-dashboard-text">Items Ordered</small></h5>
                       
                    @else
                         <h4>0</h4>
                    @endif
                </div>
            </div>

             <div class="col-md-3 col-lg-3 col-xl-3">
                <div id="status-content">
                    <h5>Registered Users</h5>
                    <h4>
                        @php 
                            echo count($total_user);
                        @endphp
                        <small class="detail-dashboard-text">Users</small>
                    </h4>
                </div>
            </div>


        </div><!---------- end of first row -------->


        <div class="row mt-4">
            <div class="col-lg-8 col-xl-8 col-md-8">
                <div class="col-lg-12 col-md-12 col-xl-12 p-3" id="sales-body-con">
                    <h6 id="overview-text">Overview</h6>
                    <h6 id="sales-value-text">Sales Value</h6>
                </div>
            </div>


            <div class="col-lg-4 col-md-4 col-xl-4">
                <div class="col-lg-12 col-md-12 col-xl-12 pt-4" id="most-order">
                    <h5 class="p-2" id="most-order-text">Most Orders</h5>
                    <a href="/admin/most-orders" class="btn btn-primary see-all-text">See all</a>
                    <hr class="hr-line">
                    <table class="table table-responsive my-table">
                        <tr class="thead-light">
                            <th class="most-order-title">Image</th>
                            <th class="most-order-title">Name</th>
                            <th class="most-order-title">Orders</th>
                            <th class="most-order-title">In Stock</th>
                        </tr>

                        @if(count($most_order) > 0)
                            @foreach($most_order as $key => $value)
                                <tr>
                                    <td>
                                    @php
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($value->images) . '" alt="" class="img-fluid">';
                                    @endphp
                                    </td>
                                    <td class="table-content-text">{{ $value->name }}</td>
                                    <td class="table-content-text">{{ $value->sold }}</td>
                                    <td class="table-content-text">{{ $value->stock }}</td>
                                </tr>
                            @endforeach
                        @endif
                        
                    </table>
                </div>  
            </div>

        </div><!------- End of 2nd row --------->


        
        <div class="row mt-4">
            <div class="col-lg-8 col-xl-8 col-md-8 page-visit-outer-con">
                <div class="col-lg-12 col-md-12 col-xl-12 p-3 page-visit-body">
                   <h5 id="page-visits-text">Page Visits</h5>
                    <a href="" class="btn btn-primary see-all-page-text">See all</a>
                    <hr class="hr-line">
                    <table class="table table-responsive my-table">
                        <tr class="thead-light">
                            <th class="most-order-title">Page name</th>
                            <th class="most-order-title">Url</th>
                            <th class="most-order-title">Visitors</th>
                            <th class="most-order-title">Users</th>
                        </tr>
                    </table>
                </div>
            </div>


            <div class="col-lg-4 col-md-4 col-xl-4">
                <div class="col-lg-12 col-md-12 col-xl-12 pt-4" id="most-order">
                    <h5 class="p-2" id="most-order-text">Most Viewed Items</h5>
                    <a href="/admin/top-view" class="btn btn-primary see-all-text">See all</a>
                    <hr class="hr-line">
                    <table class="table table-responsive my-table">
                        <tr class="thead-light">
                            <th class="most-order-title">Image</th>
                            <th class="most-order-title">Name</th>
                            <th class="most-order-title">Visitors</th>
                            <th class="most-order-title">Qty</th>
                        </tr>

                        @if(count($most_visited) > 0)
                            @foreach($most_visited as $key => $value)
                                <tr>
                                    <td>
                                    @php
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($value->images) . '" alt="" class="img-fluid">';
                                    @endphp
                                    </td>
                                    <td class="table-content-text">{{ $value->name }}</td>
                                    <td class="table-content-text">{{ $value->visited }}</td>
                                    <td class="table-content-text">{{ $value->stock }}</td>
                                </tr>
                            @endforeach
                        @endif                        
                    </table>
                </div>  
            </div>

        </div><!------- End of 3rd row --------->





    </div><!------- end of container-fluid---------->




@endsection


