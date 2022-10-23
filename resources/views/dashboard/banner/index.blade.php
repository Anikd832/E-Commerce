@extends('layouts.app')
@section('content')

<div class="content-body" style="min-height:1116px;">
    <div class="container-fluid">
        <div class="page-titles">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Messages</a></li>
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
                                        <th scope="col">Sender Name</th>
                                        <th scope="col">Sender Email</th>
                                        <th scope="col">Sender Message</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse($contacts as $contact )
                                    <tr class="">
                                        <td scope="row">{{$loop->index+1}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->email}}</td>
                                        <td>{{$contact->message}}</td>
                                        <td>{{$contact->status}}</td>
                                        <td>
                                        <button value="{{url('delete/message')}}/{{$contact->id}}" class="btn btn-sm btn-danger delete_btn">Delete</button>
                                            @if ($contact->status=='unread')
                                                <a href="{{url('read/message')}}/{{$contact->id}}"class="btn btn-sm btn-info">Read</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="50"> <h3>Nothing to show</h3> </td>
                                    </tr>
                                    @endforelse --}}
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
                                <form action="{{url('banner/insert')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Brand Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" placeholder="Product Brand Name" name="product_brand_name" value="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Product Brand logo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="product_brand_logo" value="{{}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-4">Is Top Product Brand</div>
                                        <div class="col-sm-8">
                                            <div class="form-check">
                                                <input id="check_box_top" class="form-check-input" type="checkbox" name="is_top_product_brand">
                                                <label for="check_box_top" class="form-check-label">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <button type="submit" class="btn btn-sm btn-primary">Add Product Brand</button>
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
        });
    </script>
@endsection
