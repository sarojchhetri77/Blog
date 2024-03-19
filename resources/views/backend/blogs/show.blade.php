@extends('backend.layouts.main')
@section('page-title', 'Blog Create')
@section('main-content')

    <div class="p-1">
        <a class="btn btn-primary btn-sm " href="{{ route('admin.blog.index') }}"><i class="fa-solid fa-eye px-1"></i>view </a>
    </div>
    <div class="card">
        <div class="col-xxl">
            <div class=" mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">View Blog</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <img width="200px" src="{{ asset('../uploads/' . $blog->image) }}" alt="blog image">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{ $blog->title }}" @disabled(true)>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <input class="form-control" value="{{ $blog->category->title }}" @disabled(true)>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-email">Description</label>
                        <div class="col-sm-10">
                            <div class="input-group input-group-merge">
                                <textarea class="form-control" id="" cols="5" rows="5" @disabled(true)>{{ $blog->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
