<div class="modal" id="editIndividualCategoryModal-{{$category->id}}" style="display:none;" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header bg-light">
                <h1>Edit Category</h1>
                <button type="button" class="close float-right" data-dismiss="modal">
                <i class="fa fa-window-close text-danger float-right fa-2x"></i>
                </button>
                <hr>
            </div>

            <div class="modal-body">

                <form action="{{ route('category.update', $category->id) }}" method="POST">
                
                @csrf
                @method('PUT')

                <div class="form-group">
                        <label for="categoryname">Category Name <span class="text-danger">* </span> </label>
                        <input type="text" name="category_name" value="{{$category->category_name}}" class="form-control" required>
                        </div>
                        {!! $errors->first('category_name', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}

                        <div class="form-group">
                        <label for="categorydescription">Category Description</label>
                        <textarea rows="5" cols="73" name="category_description"> {{$category->category_description}} </textarea>
                        </div>
                            
                        <button class="btn btn-success float-right" type="submit" name="submitEditedCategory" value="submitEditedCategory"> Submit</button>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="submit" name="closeEditedCategory" value="closeEditedCategory" data-dismiss="modal"> Close</button>
            </div>

        </div>

    </div>
</div>

