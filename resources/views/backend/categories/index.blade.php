@extends('backend.layouts.main')
@section('page-title', 'Category')
@section('main-content')
    <div>
        <h4 class="page-title text-left">Category Management</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active text-primary"><a href="javascript:void(0);">Category View</a></li>

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
    @if (session('error'))
        <div id="successAlert" class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center justify-content-between">
                <div class="text-dark">{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="card">
        <div class="col-xxl">
            <div class=" mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Add Category</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.category.store') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="category">Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="category"
                                    placeholder="Name" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- table to show the category --}}
    <div class="card mt-5">
        <h5 class="card-header">View Category</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="text-white">
                    <tr class="bg-primary">
                        <th class="text-white">S.N</th>
                        <th class="text-white">Name</th>
                        <th class="text-white">Slug</th>
                        <th class="text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories->isNotEmpty())
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ $category->title }}
                                </td>
                                <td>
                                    {{ $category->slug }}
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop_{{ $category->id }}">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop_{{ $category->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.category.update', $category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <label class="col-sm-2 col-form-label">Category</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" value="{{ $category->title }}"
                                                                    name="title" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <label class="col-sm-2 col-form-label">Slug</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" value="{{ $category->slug }}"
                                                                    name="slug" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                    <form class="d-inline" action="{{ route('admin.category.destroy', $category->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="return confirm('Are you want to delete')"
                                            class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
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
        {{ $categories->links() }}
    </div>
@endsection
