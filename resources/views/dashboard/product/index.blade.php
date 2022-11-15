@extends('layouts.app')
@section('content')

<div class="content-body" style="min-height:1116px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
            </ol>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card ">
                    <div class="card-header d-inline">
                        All Product
                        {{-- <button class="btn btn-sm btn-primary" >
                            <span class="badge text-white bg-primary">Total:{{$categories->count()}}</span>
                        </button>
                        @if (!$categories->where('is_top_category','yes')->count()==0)
                            <button class="btn btn-sm btn-info" >
                                <span class="badge text-white bg-info">Top Category:{{$categories->where('is_top_category','yes')->count()}}</span>
                            </button>
                        @endif
                        @if (!$categories->where('is_top_category','no')->count()==0)
                            <button class="btn btn-sm btn-warning" >
                                <span class="badge text-white bg-warning">Generel:{{$categories->where('is_top_category','no')->count()}}</span>
                            </button>
                        @endif --}}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered " id="product_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No.</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Category</th>
                                        <th scope="col">product_thumbnail_photo</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{App\Models\Category::find($product->category_id)->category_name}}</td>
                                            <td>
                                                <img width="100" src="{{ asset('uploads/product_thumbnail_photo')}}/{{$product->product_thumbnail_photo}}" alt="not found">
                                            </td>

                                            <td>
                                                <a href="" class="btn btn-sm btn-info">Edit</a>
                                                <button value="" class="btn btn-sm btn-danger delete_btn">Delete</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center text-danger">
                                            <td colspan="50"><h3>No Category Abilable</h3></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card ">
                    <div class="card-header d-inline">
                        Add Product
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <div class="basic-form">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error )
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </div>
                                @endif
                                @if (session('product_add_suc'))
                                    <div class="alert alert-success">
                                        {{session('product_add_suc')}}
                                    </div>
                                @endif
                                @if (session('product_discount_e'))
                                    <div class="alert alert-danger">
                                        {{session('product_discount_e')}}
                                    </div>
                                @endif
                                <form action="{{url('product/index/insert')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control"  name="product_name" value="{{old('product_name')}}">
                                            @error('product_name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">category Name</label>
                                        <div class="col-sm-8">
                                            <select name="category_id" class="form-control">
                                                <option value="">--Select a Category--</option>
                                                {{-- <optgroup label="--Select a Category--"> --}}
                                                @foreach ($categories as $category )
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            {{-- </optgroup> --}}
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Short Description</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" name="product_short_description" rows="3" value="{{old('product_short_description')}}"></textarea>
                                            @error('product_short_description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Long Description</label>
                                        <div class="col-sm-8">
                                            <textarea id="long_description" class="form-control" name="product_long_description" rows="5" value="{{old('product_long_description')}}"></textarea>
                                            @error('product_long_description')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product regular price</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control"  name="product_regular_price" value="{{old('product_regular_price')}}">
                                            @error('product_regular_price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Discounted price</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="product_discounted_price" value="{{old('product_discounted_price')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Additional Information</label>
                                        <div class="col-sm-8">
                                            <textarea id="additional_information" class="form-control" name="product_additional_information" rows="5" value="{{old('product_additional_information')}}"></textarea>
                                            @error('product_additional_information')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Quantity</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="product_quantity" value="{{old('product_quantity')}}">
                                            @error('product_quantity')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Thumbnail photo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="product_thumbnail_photo" value="{{}}">
                                        </div>
                                    </div>
                                    {{--<div class="form-group row">
                                        <div class="col-sm-4">Is Top Category</div>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input id="check_box_top" class="form-check-input" type="checkbox" name="is_top_category">
                                                <label for="check_box_top" class="form-check-label">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-sm btn-primary">Add Product</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_section')
    <script>
        $(document).ready(function(){
            $('.delete_btn').click(function(){
                //  alert($(this).val());
                var link = $(this).val();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if  (result.isConfirmed) {
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )
                    window.location.href= link;
                }
                })
            });
            $('#product_table').DataTable();
            // $('#summernote').summernote();
            $('#long_description,#additional_information').summernote({
                tabsize: 2,
                height: 120,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>

@endsection
