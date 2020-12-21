

@extends('admin.layouts.app')
@section('content')



    <div class="container-fluid">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h3 class="text-center" style="font-weight: bold">Item Mangements</h3>
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
                    <th><span class="table-text">Category</span></th>
                    <th><span class="table-text">Brand Name</span></th>
                    <th><span class="table-text">Sold</span></th>
                    <th><span class="table-text">View</span></th>
                    <th><span class="table-text">Actions</span></th>
                </tr>

        @if(count($items) > 0)
           <?php  $num = 0; ?>
            @foreach ($items as $item)
               <?php $num++; ?>
                <tr>
                    <td><span class="table-text">{{ $num }}</span></td>
                    <td>
                        @php
                            echo '<img src="data:image/jpeg;base64,' . base64_encode($item->images) . '" alt="" class="img-fluid admin-table-img-view">';
                        @endphp
                    </td>
                    <td><span class="table-text">{{ $item->name }}</span></td>
                    <td>
                        <span class="naira-text">NGN</span>
                        <span class="table-text">
                        <?php echo number_format($item->price, 2); ?>
                        </span>
                    </td>
                    <td><span class="table-text">{{ $item->category }}</span></td>
                    <td><span class="table-text">{{ $item->brand_name }}</span></td>
                    <td><span class="table-text">{{ $item->sold }}</span></td>
                    @if($item->view == "on")
                        <td><span class="badge badge-primary">{{ $item->view }}</span></td>
                    @else
                        <td><span class="badge badge-warning">{{ $item->view }}</span></td>
                    @endif
                    
                    <td>
                        <a href="/admin/{{$item->id}}/edit" class="btn btn-secondary btn-item table-text" role="button">Edit</a>
                        {!! Form::open(['action' => ['AdminController@destroy', $item->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                            <div class="form-group">
                                {{ Form::hidden('_method', 'DELETE')}}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-item table-text'])}}
                            </div>
                        {!! Form::close()!!}
                    </td>

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


