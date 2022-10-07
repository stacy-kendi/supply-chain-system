<div class="modal" id="editIndividualProductModal-{{$product->id}}" style="display:none;" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header bg-light">
                <h1>Edit Product</h1>
                <button type="button" class="close float-right" data-dismiss="modal">
                <i class="fa fa-window-close text-danger float-right fa-2x"></i>
                </button>
                <hr>
            </div>

            <div class="modal-body">

                <form action="{{ route('product.update', $product->id) }}" method="POST">
                
                @csrf
                @method('PUT')

                <div class="form-group">
                        <label for="productname">Product Name <span class="text-danger">* </span> </label>
                        <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" required>
                        </div>
                        {!! $errors->first('product_name', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}

                        <div class="form-group">
                        <label for="email">Category</label>
                        <select class="form-control" name="category_id" required>
                            <option disabled value=""> Select Category</option>

                            @foreach ($categories as $category)

                                <option value="{{$category->id}}" {{ old('name',$category->id)==$product->category_id ? 'selected' : ''  }}> {{$category->category_name}}</option>

                            @endforeach
                            
                        </select>
                        </div>
                        {!! $errors->first('category_id', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}

                        <div class="form-group">
                        <label for="product_price">Price</label>
                        <input type="text" name="product_price" value="{{$product->product_price}}" class="form-control" required>
                        </div>
                        {!! $errors->first('product_price', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}

                        <div class="form-group">
                        <label for="productdescription">Product Description</label>
                        <input type="text" name="product_description" value="{{$product->product_description}}" class="form-control" required>
                        </div>
                        {!! $errors->first('product_description', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}
                            
                        <button class="btn btn-success float-right" type="submit" name="submitEditedProduct" value="submitEditedProduct"> Submit</button>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="submit" name="closeEditedProduct" value="closeEditedProduct" data-dismiss="modal"> Close</button>
            </div>

        </div>

    </div>
</div>

