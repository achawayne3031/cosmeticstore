
@extends('admin.layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-8 col-md-8">
            <h5 class="text-center" id="add-title">Update And Edit Item</h5>
            <span class="d-none">{{$items->id}}</span>
             <table class="table table-borderless">
                <tr>
                    <th><span class="table-text">View Product</span></th>
                    <td><span class="table-text"><input type="radio" name="view" value="on"> On</span><br>
                        <span class="table-text"><input type="radio" name="view" value="off"> Off</span></td>
                </tr>
                <tr>
                    <th><span class="table-text">Product Name</span></th>
                    <td>
                        <input type="text" id="pro-name" class="form-control add-new-item-text-fields" placeholder="Enter the product name" required value="{{$items->name}}">
                        <span id="pro-name-msg" class="text-success"></span>
                    </td>
                </tr>

                <tr>
                    <th><span class="table-text">Price</span></th>
                    <td>
                        <input type="number" id="price" class="form-control add-new-item-text-fields" placeholder="Enter the price" required min="1" value="{{$items->price}}">
                        <span id="price-msg" class="text-success"></span>
                    </td>
                </tr>

                <tr>
                    <th><span class="table-text">Discount</span></th>
                    <td>
                        <input type="number" id="discount" class="form-control add-new-item-text-fields" placeholder="Enter the discount" required value="{{$items->discount}}">
                    </td>
                </tr>

                <tr>
                    <th><span class="table-text">Discount Switch</span></th>
                    <td>
                        <span class="table-text"><input type="radio" name="state" value="on"> On<span><br>
                        <span class="table-text"><input type="radio" name="state" value="off"> Off</span>
                    </td>
                </tr>

                <tr>
                    <th><span class="table-text">Volume</span></th>
                    <td>
                        <input type="number" id="volume" class="form-control add-new-item-text-fields" placeholder="Volume" required min="1" value="{{$items->volume}}">
                    </td>
                </tr>

                 <tr>
                    <th><span class="table-text">Brand Name</span></th>
                    <td>
                        <input type="text" id="brand-name" class="form-control add-new-item-text-fields" placeholder="Brand Name" required value="{{$items->brand_name}}">
                    </td>
                </tr>

                <tr>
                    <th><span class="table-text">Category</span></th>
                    <td>
                        <select class="form-control add-new-item-text-fields custom-select" id="category" required>
                            <option>{{$items->category}}</option>
                            <option>skin care</option>
                            <option>foot care</option>
                            <option>face care</option>
                            <option>hair care</option>
                            <option>bath and body</option>
                            <option>fragrance</option>
                            <option>make up</option>
                        </select>
                    </td>
                </tr> 

                <tr>
                    <th><span class="table-text">Product Image</span></th>
                    <td>
                        <input type="file" id="image-btn-target" name="product_image">
                        <span class='btn btn-success table-text' onclick="callImageBtn()">Upload Image</span><span id="image-text-name"></span><span id="image-msg" class="text-danger"></span>
                    </td>
                </tr> 
            
                <tr>
                    <th><span class="table-text">Description</span></th>
                    <td>
                        <textarea id="desc-body" rows="10" class="form-control add-new-item-text-fields" placeholder="Description" required>{{$items->description}}</textarea>
                    </td>
                </tr> 

                <tr>
                    <th><span class="table-text">Sold</span></th>
                    <td>
                        <input type="number" id="sold" name="sold" class="form-control add-new-item-text-fields" placeholder="Sold" required value="{{$items->sold}}">
                    </td>
                </tr> 

                 <tr>
                    <th><span class="table-text">Stock</span></th>
                    <td>
                        <input type="number" id="stock" name="stock" class="form-control add-new-item-text-fields" placeholder="Stock" required value="{{$items->stock}}">
                    </td>
                </tr> 

                <tr rowspan="2">
                    <td>
                        <button onclick="updateProduct()" id="create-btn" class="btn btn-success">
                            <span id="create-btn-text">Update Product</span>
                             <div id="create-btn-loader">
                                <span class="spinner-border spinner-border-sm"></span>
                            </div>
                        </button>
                    </td>
                </tr> 

            </table>
           




        </div>


        <div class="col-lg-2 col-md-2"></div>

    </div>

  

    
@endsection





