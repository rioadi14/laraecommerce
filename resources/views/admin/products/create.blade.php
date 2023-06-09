@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12">

        @if (session('message'))
            <div class="alert alert-success">
                <h6>{{ session('message') }}</h6>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Add Products
                    <a href="{{ url('admin/products') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                </h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <form action="{{ url('admin/products') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                Home
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab" aria-selected="false">
                                SEO Tags
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab" aria-selected="false">
                                Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images-tab-pane" type="button" role="tab" aria-controls="images-tab" aria-selected="false">
                                Product Images
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab" aria-selected="false">
                                Product Color
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade border p-3 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="col-md-6 mb-3">
                                <label for="">Category</label>
                                <select name="category_id" id="" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Product Name</label>
                                <input type="text" name="name" id="" class="form-control">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Product Slug</label>
                                <input type="text" name="slug" id="" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Select Brand</label>
                                <select name="brand" id="" class="form-control">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Small Description (500 Words)</label>
                                <textarea name="small_description" id="" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Description</label>
                                <textarea name="description" id="" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab">
                            <div class="col-md-6 mb-3">
                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_keyword">Meta Keyword</label>
                                <input type="text" name="meta_keyword" class="form-control" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea name="meta_description" class="form-control" id="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Original Price</label>
                                        <input type="text" name="original_price" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Selling Price</label>
                                        <input type="text" name="selling_price" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Quantity</label>
                                        <input type="number" name="quantity" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Trending</label>
                                        <input type="checkbox" name="trending" id="" style="width: 50px; height: 50px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="">Status</label>
                                        <input type="checkbox" name="status" id="" style="width: 50px; height: 50px;">
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="images-tab-pane" role="tabpanel" aria-labelledby="images-tab">
                            <div class="mb-3">
                                <label for="">Upload Product Images</label>
                                <input type="file" multiple class="form-control" name="image[]" id="" />
                            </div>
                        </div>
                        <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab">
                            <div class="mb-3">
                                <label for="">Select Color</label>
                                <div class="row">
                                    @forelse ($colors as $color)
                                        <div class="col-md-3">
                                            <div class="p-2 border mb-3">
                                                Color : <input type="checkbox" name="colors[{{ $color->id }}]" id="" value="{{ $color->id }}" /> {{ $color->name }}
                                                <br />
                                                Quantity : <input type="number" name="color_quantity[{{ $color->id }}]" style="width: 70px; border: 1px solid;" class="" />
                                            </div>
                                            
                                        </div>
                                    @empty
                                        <div class="col-md-12">
                                            <h1>No Colors Found</h1>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary btn-sm text-white float-end" >Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection