
@extends('admin.layouts.app')
@section('content')

    <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 class="text-center text-bold">Orders</h3>
        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table">
                <tr class="thead-dark">
                    <th><span class="table-text">S/N</span></th>
                    <th><span class="table-text">Image</span></th>
                    <th><span class="table-text">Name</span></th>
                    <th><span class="table-text">Price</span></th>
                    <th><span class="table-text">Email</span></th>
                    <th><span class="table-text">Quantity</span></th>
                    <th><span class="table-text">Ref</span></th>
                    <th><span class="table-text">Delivery method</span></th>
                </tr>

        @if(count($orders) > 0)
           <?php  $num = 0; ?>
            @foreach ($orders as $item)
               <?php $num++; ?>
                <tr>
                    <td><span class="table-text">{{ $item->id }}</span></td>
                    <td>
                        @php
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($item->images) . '" alt="" class="img-fluid admin-table-img-view">';
                        @endphp
                    </td>
                    <td><span class="table-text">{{ $item->name }}</span></td>
                    <td>
                        <span class="naira-text">NGN</span>

                        <span class="table-text"><?php echo number_format($item->price, 2); ?></span>
                    </td>
                    <td><span class="table-text">{{ $item->email }}</span></td>
                    <td class="text-center"><span class="table-text">{{ $item->quantity }}</span></td>
                    <td><span class="table-text">{{ $item->payment_ref }}</span></td>
                    <td><span class="table-text">{{ $item->delivery_method }}</span></td>


                </tr>
            @endforeach

            @else
                <tr>
                    <td colspan="5" class="text-center">No Item Avaliable</td>
                </tr>
        @endif


            </table>
        </div>

       


    </div>



    </div>

@endsection


