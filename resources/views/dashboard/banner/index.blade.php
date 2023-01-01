@extends('layouts.app')
@section('content')

<div class="content-body" style="min-height:1116px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Banner or Advertise</a></li>
            </ol>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card ">
                    <div class="card-header d-inline">
                        All Banner & Ads
                        {{-- <button class="btn btn-sm btn-primary" >
                            <span class="badge text-white bg-primary">Total:{{$contacts->count()}}</span>
                        </button>
                        @if (!$contacts->where('status','read')->count()==0)
                            <button class="btn btn-sm btn-info" >
                                <span class="badge text-white bg-info">Readed:{{$contacts->where('status','read')->count()}}</span>
                            </button>
                        @endif
                        @if (!$contacts->where('status','unread')->count()==0)
                            <button class="btn btn-sm btn-warning" >
                                <span class="badge text-white bg-warning">Unread:{{$contacts->where('status','unread')->count()}}</span>
                            </button>
                        @endif --}}
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered " id="message_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No.</th>
                                        <th scope="col">Product Category</th>
                                        <th scope="col">Product Banner Photo</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Work</th>
                                        <th scope="col">Product Short Breff</th>
                                        <th scope="col">Product Reagular Price</th>
                                        <th scope="col">Product Discount Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner )
                                    <tr class="">
                                        <td scope="row">{{$loop->index+1}}</td>
                                        <td>{{App\Models\Category::find($banner->category_id)->category_name}}</td>
                                        <td>
                                            <img width="100" src="{{asset('uploas/banner_photos')}}/{{$banner->product_banner_photo}}" alt="not found">
                                        </td>
                                        <td>{{$banner->product_name}}</td>
                                        <td>{{$banner->product_work}}</td>
                                        <td>{{$banner->product_short_breff}}</td>
                                        <td>{{$banner->product_reagular_price}}</td>
                                        <td>{{$banner->product_discount_price}}</td>
                                        <td>
                                        <button value="{{url('')}}/{{$banner->id}}" class="btn btn-sm btn-danger delete_btn">Delete</button>
                                        <a href="{{url('')}}/{{$banner->id}}"class="btn btn-sm btn-info">Read</a>

                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="50"> <h3>Nothing to show</h3> </td>
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
                        Add Product Brand
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <div class="basic-form">
                                @if (session('brand_add_suc'))
                                    <div class="alert alert-success">
                                        {{session('brand_add_suc')}}
                                    </div>
                                @endif
                                @if ($errors->any())
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
                                @endif
                                <form action="{{url('banner/insert')}}" method="POST" enctype="multipart/form-data">
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
                                            @error('category_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Banner Photo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="product_banner_photo" value="">
                                            @error('product_banner_photo')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">Product Name</div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control @error('product_name') is-invalid @enderror" placeholder="Product Name" name="product_name">
                                            @error('product_name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
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
                                            @error('product_regular_price')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
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
            $('#message_table').DataTable();
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
