@extends('backend.layouts.main')
@section('page-title', 'Blog Edit')
@section('main-content')
<div>
    <h4 class="page-title text-left">Blog Management</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('admin.blog.index')}}">Blog</a>
        </li>
        <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Blog Edit</a></li>

    </ol>
</div>
    <div class="p-1">
        <a class="btn btn-primary btn-sm " href="{{ route('admin.blog.index') }}"><i class="fa-solid fa-eye px-1"></i>view </a>
    </div>
    <div class="card">
        <div class="col-xxl">
            <div class=" mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit Blog</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.blog.update',$blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" value="{{$blog->title}}" class="form-control" id="title"
                                    placeholder="Title" />
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="title"> Present Image</label>
                            <div class="col-sm-10">
                                <img width="200px" src="{{ asset('../uploads/' . $blog->image) }}" alt="blog image">
                            </div>
                        </div>
                      
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="image">Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" class="form-control" id="image" />
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="product">Category</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($category->id == $blog->category_id)>{{ $category->title }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-default-email">Description</label>
                            <div class="col-sm-10">
                                    <textarea name="description" class="form-control" id="description" cols="5" rows="5">{{$blog->description}}</textarea>
                                
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
