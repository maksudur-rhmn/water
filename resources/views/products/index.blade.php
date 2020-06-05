@extends('layouts.dashboard')

@section('active-products')
  active
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif
          <div class="card-header">
            <h5 class="text-center">Add Products</h5>
          </div>
          <div class="card-body">
            <form class="" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="py-3">
                <select class="form-control" name="category_id">
                  <option value="">Select Product Category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="py-3">
                <input class="form-control"  type="text" name="product_name" placeholder="Product name">
              </div>
              <div class="py-3">
                <input class="form-control"  type="number" name="product_price" placeholder="Product price">
              </div>
              <div class="py-3">
                {{-- <textarea name="product_short_description" class="form-control" rows="6" placeholder="Product Short Description"></textarea> --}}
                <label for="product_short_description">Product Short Description</label>
                <input id="product_short_description" type="hidden" name="product_short_description">
                <trix-editor input="product_short_description"></trix-editor>
              </div>
              <div class="py-3">
                <textarea name="product_long_description" class="form-control" rows="6" placeholder="Product Long Description"></textarea>
              </div>
              <div class="py-3">
                <label for="product_thumbnail_image">Thumbnail Image</label>
                <input class="form-control" type="file" name="product_thumbnail_image" id="product_thumbnail_image">
              </div>
              <div class="py-3">
                <label for="product_multiple_image">Multiple Image</label>
                <input class="form-control" type="file" name="product_multiple_image[]" id="product_multiple_image" multiple>
              </div>
              <div class="py-3">
                <button type="submit" class="btn btn-primary">Add Products</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h5 class="text-center">Products</h5>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <th>SL</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Thumbnail</th>
                <th>Product Multiple</th>
              </thead>
              @foreach ($products as $product)
              <tbody>
                  <td>{{ $loop-> index + 1  }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_price }}</td>
                  <td>
                    <img src="{{ asset('uploads/product_thumbnail_image') }}/{{ $product->product_thumbnail_image }}" alt="Not found" width="100">
                  </td>
                  <td>
                        Pore korbo
                  </td>
              </tbody>
            @endforeach
            </table>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>  
@endsection