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
       <div class="col-lg-4">
         <div class="card">
           <div class="card-header">
             <h5 class="text-center">{{ (isset($category)) ? 'Edit Category' : 'Add Category' }}</h5>
           </div>
           <div class="card-body">
             <form class="form-group" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="py-3">
                 <input class="form-control" type="text" name="category_name" placeholder="Enter Category">
               </div>
               <div class="py-3">
                 <input class="form-control" type="file" name="category_image">
               </div>
               <div class="py-3">
                 <button type="submit" class="btn btn-primary">Add Category</button>
               </div>
             </form>
         </div> 
         </div>
       </div>
       <div class="col-lg-8">
         <div class="card-header">
           <h5 class="text-center">All Categories</h5>
         </div>
         <div class="card-body">
              <table class="table table-dark table-striped">
                <tr>
                  <th>SL</th>
                  <th>Category Name</th>
                  <th>Added By</th>
                  <th>Category Image</th>
                  <th>Created at</th>
                  <th>Updated at</th>
                  <th>Action</th>
                  <th></th>
                </tr>
                 @foreach ($categories as $category)
                   <tr>
                     <td>{{ $loop-> index + 1 }}</td>
                     <td>{{ $category->category_name }}</td>
                     <td>{{ $category->relationBetweenCategory->name }}</td>
                     <td>
                       <img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="not found" width="50">
                     </td>
                      {{-- <td>{{ Auth::user()->findorFail($category->added_by)->name }}</td>  Chorami  --}}
                     <td>{{ $category->created_at->diffForHumans() }}</td>
                     <td>--</td>
                     <td>
                       <a href="{{ route('category.edit', $category->id) }}" class="btn btn-info">Edit</a>
                     </td>
                     <td>
                          <button type="button" class="btn btn-danger" onclick="deleteHandler({{ $category->id }})">Delete</button>
                     </td>
                   </tr>
                 @endforeach
              </table>
              <!-- Modal -->
              <form action="" method="post" id="forId">
                @csrf
                {{ method_field('DELETE') }}
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                      Are you sure?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
           </div>
         </div>
       </div>
     </div>
   </div>

@endsection

@section('scripts')
  <script>
      function deleteHandler(id)
    {
      var form = document.getElementById('forId')
      form.action = 'category/' + id
      $('#deleteModal').modal('show')

    }
  </script>
@endsection
