@extends('layouts.app')
@section('content')

<div class="content-body" style="min-height:1116px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
            </ol>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card ">
                    <div class="card-header d-inline">
                        Add Product Brand
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <div class="basic-form">
                                @if (session('brand_up_suc'))
                                    <div class="alert alert-success">
                                        {{session('brand_add_suc')}}
                                    </div>
                                @endif
                                <form action="{{url('banner/update')}}/{{$banner->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Category</label>
                                        <div class="col-sm-8">
                                            <select name="category_id" class="form-control">
                                                <option value="">--{{App\Models\Category::find($banner->category_id)->category_name}}--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Current Banner photo</label>
                                        <div class="col-sm-8">
                                            <img width="100" src="{{asset('uploads/banner_photos')}}/{{$banner->product_banner_photo}}" alt="not found">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">New Banner Photo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="product_banner_photo" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">Product Name</div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Product Name" name="product_name" value="{{$banner->product_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Work</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Product Work" name="product_work" value="{{$banner->product_work}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Short Breff</label>
                                        <div class="col-sm-8">
                                            <textarea  id="product_short_breff" type="text" class="form-control" placeholder="Product Short Breff" name="product_short_breff" value="{{$banner->product_short_breff}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Regular Price</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" placeholder="Product Regular Price" name="product_regular_price" value="{{$banner->product_regular_price}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Discounted price</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" placeholder="Product Discounted Price" name="product_discounted_price" value="{{$banner->product_discounted_price}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-sm btn-primary">Add Product Banner</button>
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

             $('#product_short_breff').summernote({
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
