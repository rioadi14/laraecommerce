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
                <h3>Add Sliders
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
                <form action="{{ url('admin/sliders/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" name="title" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="">Description</label>
                            <textarea name="description" id="" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="">Image</label>
                            <input type="file" name="image" id=""  class="form-control"/>
                        </div>
                    </div>
                   <div class="col-md-12">
                    <div class="mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status" id="" /> Checked=Hidden, UnChecked=Visible
                    </div>
                   </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary btn-sm text-white float-end">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection