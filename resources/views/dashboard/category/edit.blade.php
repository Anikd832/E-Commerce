@extends('layouts.app')
@section('content')

<div class="content-body" style="min-height:1116px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('category/index')}}">Category</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$category->category_name}}</a></li>
            </ol>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card ">
                    <div class="card-header d-inline">
                        Edit Category - {{$category->category_name}}
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <div class="basic-form">
                                @if (session('edit_succ'))
                                    <div class="alert alert-success">
                                        {{session('edit_succ')}}
                                    </div>
                                @endif
                                <form action="{{url('category/update')}}/{{$category->id}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Category Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Category Name" name="category_name" value="{{$category->category_name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Current Category photo</label>
                                        <div class="col-sm-8">
                                            <img width="80" src="{{asset('uploads/category_photos')}}/{{$category->category_photo}}" alt="no image found">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">New Category photo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="category_photo" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">Is Top Category</div>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                {{-- <input id="check_box_top" class="form-check-input" type="checkbox" name="is_top_category" checked> --}}
                                                <input id="check_box_top" class="form-check-input" type="checkbox" name="is_top_category" {{($category->is_top_category=='yes')?'checked':''}}>
                                                <label for="check_box_top" class="form-check-label">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button  type="submit" class="btn btn-sm btn-primary ">Edit Category</button>
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
{{-- @section('footer_section')
    <script>
        $(document).ready(function(){
            $('.edit_btn').click(function(){
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
        });
    </script>

@endsection --}}

