@extends('layouts.app')

@section('content')


    <div class="content-wrapper">

        <div class="container" style="padding-top: 10px;">

            <!--Breadcrumbs-->
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h3 class="m-0 text-muted ml-2 mt-2"><strong> Categories </strong></h3> </br>
                    <div class="row">
                        <div class="col-sm-10">
                        <ol class="breadcrumb float-sm-left ml-2">
                            <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item active"><a href="{{url('category')}}">Categories</a></li>
                            
                        </div>
                        <div class="col-sm-2 float-right">
                                <div>
                                    <a href="#" data-toggle="modal" data-target="#addCategoryModal">
                                        <button class="btn btn-success">
                                            <i class="fa fa-plus fa-1x"></i>New Category
                                        </button>
                                    </a>
                                </div>
                        </div>
                        </ol>
                    </div>
                </div> <!--Closing the Column Tag for the Breadcrumbs-->
            </div> <!--Closing the Row Tag for the Breadcrumbs-->

            @if(session("success"))
                <div class="alert alert-success">
                    <a href="#" class="close text-white" data-dismiss="alert">&times;</a>
                    <strong><i class="fa fa-info"></i> {{(session("success"))}}</strong>
                </div>
            @endif

            @if(session("error"))
                <div class="alert alert-danger">
                    <a href="#" class="close text-white" data-dismiss="alert">&times;</a>
                    <strong><i class="fa fa-info"></i> {{(session("error"))}}</strong>
                </div>
            @endif

            <div class="card">

                <div class="card-header">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif
                            
                </div> <!--Closing the Card Header Class-->

                <!--View of the Categories-->
                <div class="card-body">


                    <table class="table table-hover table-bordered" id="categorytable">

                        <thead style="background-color:lightgrey;">
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th>Actions</th>
                        </thead>

                        <tbody>

                            <!--Display when no categories are available-->
                            @if($categories->count()==0)

                                <tr>
                                    <td colspan="16">
                                        <div class="py-5">
                                            <center style="color:black;" >
                                                <i class="fas fa-file fa-4x"></i>
                                                <i class="fas fa-times fa-1x" style="z-index: 9999; color: white; margin-left: -25px;"></i>
                                                <br>
                                                <p>No Categories Available</p>
                                            
                                            </center>
                                        </div>
                                    </td>
                                </tr>
                            
                            @endif

                            <!--Displaying the Fetched Data Using the Controller-->
                            @foreach ($categories as $key => $category)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{$category->category_description}}</td>
                                    <td>
                                            
                                        <div class="dropdown dropright"><i class="fas fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" ></i>
                                            
                                            <ul class="dropdown-menu">
                                                      
                                                <li class="dropdown-item">
                                                    <a href="{{ route('category.edit', $category->id)}}" data-toggle="modal" data-target="#editIndividualCategoryModal-{{$category->id}}">
                                                        <i class="fa fa-pen"></i>
                                                            Edit
                                                    </a>
                                                </li>

                                                <li class="dropdown-item">
                                                    <form action="{{ route('category.destroy', $category->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="myFunction();" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                      Delete </button>
                                                        </form>
                                                </li>

                                            </ul><!--Closing the dropdown Menu UL list for Actions-->

                                        </div> <!--Closing the dropdown Menu Class for the Actions -->
                                                
                                    </td>

                                </tr>
                                
                            @endforeach

                        </tbody> 

                    </table><!--Closing the table-->

                    @foreach ($categories as $key => $category)
                        @include('category.edit')
                    @endforeach

                </div> <!--Closing the Card Body Class-->

            </div> <!--Closing the Card Class-->

            <!--Modals-->
            <div class="modal" id="addCategoryModal" style="display:none;" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header bg-light">
                                <h1>Add Category</h1>
                                <button type="button" class="close float-right" data-dismiss="modal">
                                <i class="fa fa-window-close text-danger float-right fa-2x"></i>
                                </button>
                                <hr>
                        </div> <!--Closing the modal-header Tag-->

                        <div class="modal-body">

                                <form action="{{ route('category.store') }}" method="POST">
                            
                                        @csrf
            
                                        <div class="form-group">
                                        <label for="categoryname">Category Name <span class="text-danger">* </span> </label>
                                        <input type="text" name="category_name" class="form-control" required>
                                        </div>
                                        {!! $errors->first('category_name', '<p style="text-white; font-size:12px;" class="help-block alert alert-danger">:message</p>') !!}
            
                                        <div class="form-group">
                                        <label for="categorydescription">Category Description</label>
                                        <textarea rows="5" cols="73" name="category_description" class="form-control"> </textarea>
                                        </div>
                                                                                
                                        <button class="btn btn-success float-right" type="submit" name="submitNewCategory" value="submitNewCategory"> Submit</button>
            
                                        </form>

                        </div>  <!--Closing the modal-body Tag-->

                        <div class="modal-footer">

                                <button class="btn btn-secondary" type="submit" name="closeNewCategory" value="closeNewCategory" data-dismiss="modal"> Close</button>

                        </div> <!--Closing the modal-footer Tag-->

                    </div> <!--Closing the modal content Tag-->
                </div> <!--Closing the modal dialog Tag-->
            </div> <!--Closing the modal Tag-->
    
        </div> <!--Closing the Container-Fluid Div-->

    </div> <!--Closing the Content-Wrapper-->

    <script>
        
        function myFunction() {
            if (confirm("You are about to delete a Category, Are You Sure You Want to Continue?")) {
                location.href = '/category';
            }else{
                event.preventDefault();
            }
        }
    </script>
    
@endsection