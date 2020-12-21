
@extends('admin.layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h5 class="text-center" id="add-title">out of stock items</h5>
                <table class="table table-responsive">
                    <tr class="thead-dark">
                        <th><span class="table-text">S/N</span></th>
                        <th><span class="table-text">Image</span></th>
                        <th><span class="table-text">Name</span></th>
                        <th><span class="table-text">Price</span></th>
                        <th><span class="table-text">Sold</span></th> 
                        <th><span class="table-text">Available Stock</span></th> 
                        <th><span class="table-text">Action</span></th> 

                    </tr>

                    @if(count($out_of_stock) > 0)
                        @foreach($out_of_stock as $key => $value)
                            <tr>
                                <td></td>
                                <td>
                                    @php
                                        echo '<img src="data:image/jpeg;base64,' . base64_encode($value->images) . '" alt="" class="img-fluid most-order-img">';
                                    @endphp
                                </td>
                                <td class="table-text">{{$value->name}}</td>
                                <td class="table-text">
                                    @php echo number_format($value->price, 2); @endphp
                                </td>
                                <td class="table-text">{{$value->sold}}</td>
                                <td class="table-text text-center">{{$value->stock}}<span class="fa fa-sort-amount-desc"></span></td>
                                <td>
                                    <input type="number" class="form-control mb-1">
                                    <button class="btn btn-danger btn-item table-text">Update</button>
                                </td>
                            </tr>
                            
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">No out of stock item</td>
                        </tr>

                    @endif
                </table>

        </div>
    </div>

      

@endsection





