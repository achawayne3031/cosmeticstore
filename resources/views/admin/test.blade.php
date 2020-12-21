



            {!! Form::open(['method' => 'POST', 'action' => 'AdminController@store', 'enctype' => 'multipart/form-data']) !!}

            <div class="form-group">
                {{ Form::label('title', 'Product Name')}}
                {{ Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Enter the product name'])}}
            </div>

            <div class="form-group">
                {{ Form::label('price', 'Price')}}
                {{ Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Enter the price'])}}
            </div>


            <div class="form-group">
                {{ Form::label('discount', 'Discount')}}
                {{ Form::text('discount', '', ['class' => 'form-control', 'placeholder' => 'Enter the discount'])}}
            </div>

            <div class="form-group">
                {{ Form::label('discount state', 'Discount State')}}
                {{ Form::radio('state', 'on')}}On
                {{ Form::radio('state', 'off')}}Off
            </div>

            <div class="form-group">
                {{ Form::label('volume', 'Volume')}}
                {{ Form::text('volume', '', ['class' => 'form-control', 'placeholder' => 'Volume'])}}
            </div>

            <div class="form-group">
                {{ Form::label('brand name', 'Brand Name')}}
                {{ Form::text('brand_name', '', ['class' => 'form-control', 'placeholder' => 'Brand name'])}}
            </div>

            <div class="form-group">
                {{ Form::label('Category', 'Category')}}
                {{ Form::select('category', ['' => 'Pick a Category','skin care' => 'Skin care', 'fragrance' => 'Fragrance', 'make up' => 'Make Up', 'bath and body' => 'Bath & Body'], null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('image', 'Product Image')}}
                {{ Form::file('product_image')}}
            </div>

            <div class="form-group">
                {{ Form::label('description', 'Description')}}
                {{ Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
            </div>

            <div class="form-group">
                {{ Form::label('sold', 'Sold')}}
                {{ Form::text('sold', '', ['class' => 'form-control', 'placeholder' => 'Sold'])}}
            </div>

            <div class="form-group">
                {{ Form::submit('Submit', ['class' => 'btn btn-success'])}}
            </div>

        {!! Form::close() !!}
