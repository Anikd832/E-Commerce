@extends('layouts.app')
@section('content')

<div class="content-body" style="min-height:1116px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
            </ol>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card ">
                    <div class="card-header d-inline">
                        All Category
                        <button class="btn btn-sm btn-primary" >
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
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered " id="message_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No.</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Category Photo</th>
                                        <th scope="col">Is Top Category</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$category->category_name}}</td>
                                            <td>
                                                <img width="100" src="{{ asset('uploads/category_photos')}}/{{$category->category_photo}}" alt="not found">
                                            </td>
                                            <td>{{$category->is_top_category}}</td>
                                            <td>
                                                <a href="{{url('category/edit')}}/{{$category->id}}" class="btn btn-sm btn-info">Edit</a>
                                                <button value="{{url('category/delete')}}/{{$category->id}}" class="btn btn-sm btn-danger delete_btn">Delete</button>
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
                        Add Category
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <div class="basic-form">
                                @if (session('category_add_s'))
                                    <div class="alert alert-success">
                                        {{session('category_add_s')}}
                                    </div>
                                @endif
                                <form action="{{url('category/index/insert')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Category Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Category Name" name="category_name" value="{{old('category_name')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Category photo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="category_photo" value="{{}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">Is Top Category</div>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input id="check_box_top" class="form-check-input" type="checkbox" name="is_top_category">
                                                <label for="check_box_top" class="form-check-label">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-sm btn-primary">Add Category</button>
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
            // $('#message_table').DataTable();
        });
    </script>

@endsection
