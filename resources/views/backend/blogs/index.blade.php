@extends('backend.layouts.main')
@section('page-title', 'Blog view')
@section('main-content')
<div>
    <h4 class="page-title text-left">Blog Management</h4>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
        </li>
        <li class="breadcrumb-item"><a href="{{route('admin.blog.index')}}">Blog</a>
        </li>
        <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Blog View</a></li>

    </ol>
</div>
@if (session('success'))
    <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center justify-content-between">
            <div class="text-dark">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

    <div class="p-1">
        <a class="btn btn-primary btn-sm " href="{{ route('admin.blog.create') }}"><i class="fa-solid fa-plus px-1"></i>Add</a>
    </div>
    <div class="card">
        <h5 class="card-header">View Blogs</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="text-white">
                    <tr class="bg-primary">
                        <th class="text-white">S.N</th>
                        <th class="text-white">Title</th>
                        <th class="text-white">Category</th>
                        <th class="text-white">Image</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($blogs->isNotEmpty())
                        @foreach ($blogs as $blog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->category->title }}</td>
                                <td>
                                    <img width="50px" src="{{ asset('../uploads/' . $blog->image) }}" alt="blog image">
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm " href="{{ route('admin.blog.show',$blog->id) }}"><i
                                            class="fa-solid fa-eye"></i></a>
                                    <a class="btn btn-success btn-sm " href="{{ route('admin.blog.edit', $blog->id) }}"><i
                                            class="fa-solid fa-edit"></i></a>
                                    <form class="d-inline" action="{{ route('admin.blog.destroy', $blog->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Are you want to delete')" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
                                <h6 class="text-center">--------Please add the category first----------</h6>
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <div class="p-2">
        {{ $blogs->links() }}
    </div>
@endsection
