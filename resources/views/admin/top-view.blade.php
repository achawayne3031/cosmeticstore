
@extends('admin.layouts.app')
@section('content')

    <div class="row">
    
        <div class="col-lg-12 col-md-12">
            <h5 class="text-center" id="add-title">Top View</h5>
                <table class="table table-responsive">
                    <tr class="thead-dark">
                        <th><span class="table-text">S/N</span></th>
                        <th><span class="table-text">Image</span></th>
                        <th><span class="table-text">Name</span></th>
                        <th><span class="table-text">Price</span></th>
                        <th><span class="table-text">Sold</span></th> 
                    </tr>

                    @if(count($views) > 0)
                        @foreach($views as $key => $value)
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

                            </tr>
                            
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">No top view</td>
                        </tr>

                    @endif
                </table>

        </div>
    </div>


      

@endsection





