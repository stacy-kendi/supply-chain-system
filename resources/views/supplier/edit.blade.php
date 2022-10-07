<div class="modal" id="editIndividualSupplierModal-{{$supplier->id}}" style="display:none;" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header bg-light">
                <h1>Edit Supplier</h1>
                <button type="button" class="close float-right" data-dismiss="modal">
                <i class="fa fa-window-close text-danger float-right fa-2x"></i>
                </button>
                <hr>
            </div>

            <div class="modal-body">

                <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                
                @csrf
                @method('PUT')

                <div class="form-group">
                        <label for="suppliername">Name <span class="text-danger">* </span> </label>
                        <input type="text" name="name" value="{{$supplier->name}}" class="form-control" required>
                        </div>
                        {!! $errors->first('name', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}

                        <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" value="{{$supplier->email}}" class="form-control" required>
                        </div>
                        {!! $errors->first('email', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}

                        <div class="form-group">
                        <label for="phonenumber">Phone Number</label>
                        <input type="text" name="phonenumber" value="{{$supplier->phonenumber}}" class="form-control" required>
                        </div>
                        {!! $errors->first('phonenumber', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}

                        <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" value="{{$supplier->address}}" class="form-control" required>
                        </div>
                        {!! $errors->first('address', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}
                            
                        <button class="btn btn-success float-right" type="submit" name="submitEditedSupplier" value="submitEditedSupplier"> Submit</button>

                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="submit" name="closeEditedSupplier" value="closeEditedSupplier" data-dismiss="modal"> Close</button>
            </div>

        </div>

    </div>
</div>

