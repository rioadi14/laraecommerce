@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Create Category
                    <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" />
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" class="form-control" />
                            @error('slug')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="" rows="3"></textarea>
                            @error('description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status">Status</label>
                            <input type="checkbox" name="status" style="width: 50px; height: 50px;" />
                        </div>
                        <div class="col-md-12">
                            <h4>SEO Tags</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" />
                            @error('meta_title')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="meta_keyword">Meta Keyword</label>
                            <input type="text" name="meta_keyword" class="form-control" />
                            @error('meta_keyword')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" class="form-control" id="" rows="3"></textarea>
                            @error('meta_description')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary btn-sm text-white float-end" >Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection