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
            {{-- <div class="col-md-7">

            </div> --}}
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
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </div>
                                @endif
                                @if (session('discount_e'))
                                    <div class="alert alert-danger">
                                        {{session('discount_e')}}
                                    </div>
                                @endif --}}
                                <form action="{{url('banner/update')}}/{{$category->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Category</label>
                                        <div class="col-sm-8">
                                            {{-- <input type="text" class="form-control" placeholder="Product Category" name="category_id" value=""> --}}
                                            <select name="category_id" class="form-control">
                                                <option value="">--Select A Category--</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                            {{-- @error('category_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Banner Photo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="product_banner_photo" value="">
                                            {{-- @error('product_banner_photo')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">Product Name</div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" placeholder="Product Name" name="product_name">
                                            {{-- @error('product_name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Work</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Product Work" name="product_work" value="{{old('product_work')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Short Breff</label>
                                        <div class="col-sm-8">
                                            <textarea  id="product_short_breff" type="text" class="form-control" placeholder="Product Short Breff" name="product_short_breff" value="{{old('product_short_breff')}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Regular Price</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control @error('product_regular_price') is-invalid @enderror" placeholder="Product Regular Price" name="product_regular_price" value="">
                                            {{-- @error('product_regular_price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Discounted price</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" placeholder="Product Discounted Price" name="product_discounted_price" value="">
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
