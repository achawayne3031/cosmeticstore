
@extends('admin.layouts.app')
@section('content')

    <div class="col-lg-4 col-xl-4 col-md-4" id="create-alert-success">
        <div class="alert alert-danger alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6 class="create-product-alert-text">Product has been added</h6>
        </div>
    </div>

    <div class="col-lg-4 col-xl-4 col-md-4" id="create-alert-error">
        <div class="alert alert-danger alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h6 class="create-product-alert-text">Error, something went wrong. Try again</h6>
        </div>
    </div>


    <div class="row">
    <!----
        <div class="col-lg-2 col-md-2"></div>
        --->
        <div class="col-lg-8 col-md-8">
            <h5 class="text-center" id="add-title">Add New Item</h5>
    
                <table class="table table-borderless">
                <tr>
                    <th><span class="table-text">Product Name</span></th>
                    <td>
                        <input type="text" id="pro-name" class="form-control add-new-item-text-fields" placeholder="Enter the product name" required>
                        <span id="pro-name-msg" class="text-success"></span>
                    </td>
                </tr>

                <tr>
                    <th><span class="table-text">Price</span></th>
                    <td>
                        <input type="number" id="price" class="form-control add-new-item-text-fields" placeholder="Enter the price" required min="1">
                        <span id="price-msg" class="text-success"></span>
                    </td>
                </tr>

                <tr>
                    <th><span class="table-text">Discount</span></th>
                    <td>
                        <input type="number" id="discount" class="form-control add-new-item-text-fields" placeholder="Enter the discount" required>
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
                        <input type="number" id="volume" class="form-control add-new-item-text-fields" placeholder="Volume" required min="1">
                    </td>
                </tr>

                 <tr>
                    <th><span class="table-text">Brand Name</span></th>
                    <td>
                        <input type="text" id="brand-name" class="form-control add-new-item-text-fields" placeholder="Brand Name" required>
                    </td>
                </tr>

                <tr>
                    <th><span class="table-text">Category</span></th>
                    <td>
                        <select class="form-control add-new-item-text-fields custom-select" id="category" required>
                            <option></option>
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
                        <textarea id="desc-body" rows="10" class="form-control add-new-item-text-fields" placeholder="Description" required></textarea>
                    </td>
                </tr> 

                <tr>
                    <th><span class="table-text">Sold</span></th>
                    <td>
                        <input type="number" id="sold" name="sold" class="form-control add-new-item-text-fields" placeholder="Sold" required>
                    </td>
                </tr> 

                 <tr>
                    <th><span class="table-text">Stock</span></th>
                    <td>
                        <input type="number" id="stock" name="stock" class="form-control add-new-item-text-fields" placeholder="Stock" required>
                    </td>
                </tr> 

                <tr rowspan="2">
                    <td>
                        <button onclick="createProduct()" id="create-btn" class="btn btn-success">
                            <span id="create-btn-text">Create Product</span>
                             <div id="create-btn-loader">
                                <span class="spinner-border spinner-border-sm"></span>
                            </div>
                        </button>
                    </td>
                </tr> 

            </table>
           
        </div>

        <div class="col-lg-2 col-md-2">
        
        </div>

    </div>


        <script>
            $(document).ready(() => {



            });
        </script>


@endsection





