@extends('layouts.dashboard')
@section('title')
  Category
@endsection

@section('active-category')
  active
@endsection
@section('nav')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Category</span>
  </nav>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-8 m-auto">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Edit Category</h5>
          </div>
          <div class="card-body">
            <form class="form-group" action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
              {{ method_field('PUT') }}
              @csrf
              <div class="py-3">
                <input class="form-control" type="text" name="category_name" value="{{ $category->category_name }}">
              </div>
              <div class="py-3">
                <img class="text-center my-4" src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="" width="100">
                <input class="form-control" type="file" name="category_image">
              </div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary">Update Category</button>
              </div>
              @if (session('hobena'))
                <div class="alert alert-danger">
                  {{ session('hobena') }}
                </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
