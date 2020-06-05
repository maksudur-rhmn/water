@extends('layouts/dashboard')

@section('title')
  Frequently Asked Questions
@endsection

@section('active-faq')
  active
@endsection

@section('nav')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    {{-- <a class="breadcrumb-item" href="index.html">Pages</a> --}}
    <span class="breadcrumb-item active">Faq</span>
  </nav>
@endsection

@section('content')



        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="card">
               <div class="card-header">
                  <h1 class="text-center">All FAQ !!!</h1>
               </div>
               <div class="card-body">
                 @if(session('status'))
                 <div class="alert alert-success">
                   {{ session('status') }}
                 </div>
               @endif
               @if(session('success'))
                 <div class="alert alert-success">
                   {{ session('success') }}
                 </div>
               @endif
                 <table class="table table-dark table-striped">
                    <tr>
                      <th>SL NO.</th>
                      <th>Question</th>
                      <th>Answer</th>
                      <th>Action</th>
                    </tr>
                    @forelse($faqs as $index => $faq)
                    <tr>
                      <th>{{ $loop-> index + 1 }}</th>
                      <th>{{ $faq->faq_question }}</th>
                      <th>{{ $faq->faq_answer }}</th>
                      <th>
                        <div class="btn-group">
                          <a href="{{ url('/faq/edit') }}/{{ $faq->id }}" class="btn btn-primary btn-sm">Edit</a>
                          <a href="{{ url('/faq/delete') }}/{{ $faq->id }}" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                      </th>
                    </tr>
                       @empty
                       <tr>
                         <td>No data Available</td>
                       </tr>

                    @endforelse
                 </table>



               </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                @if($errors->all())
                     <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                     </div>
              @endif
                <div class="card-header">
                  Add FAQ
                </div>
                <div class="card-body">
                  <form class="form-group" action="{{ route('faq_insert') }}" method="post">
                    @csrf
                  <div class="py-3">
                    <label for="question">Enter Question</label>
                    <input name="faq_question" class="form-control" id="question" type="text" name="" placeholder="Enter Your Question?" value="{{ old('faq_question') }}">
                    @error ('faq_question')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror

                  </div>
                    <label for="answer">Enter Answer</label>
                    <textarea name="faq_answer" id="answer" class="form-control" name="" placeholder="Enter Your Answer">{{ old('faq_answer') }}</textarea>
                    @error ('faq_answer')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  <div class="py-3">
                      <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card">
               <div class="card-header">
                  <h1 class="text-center">Deleted FAQ !!!</h1>
               </div>
               <div class="card-body">

                 <table class="table table-dark table-striped">
                    <tr>
                      <th>SL NO.</th>
                      <th>Question</th>
                      <th>Answer</th>
                      <th>Deleted at</th>
                      <th>Action</th>
                    </tr>

                    @forelse ($deleted_faqs as $deleted)
                    <tr>
                        <th>{{ $loop -> index +1 }}</th>
                        <th>{{ $deleted->faq_question }}</th>
                        <th>{{ $deleted->faq_answer }}</th>
                        <th>{{ $deleted->deleted_at->diffForHumans() }}</th>
                        <th>
                          <div class="btn-group">
                            <a href="{{ url('/faq/restore') }}/{{ $deleted->id }}" class="btn btn-primary btn-sm">Restore</a>
                            <a href="{{ url('/faq/permanentDelete') }}/{{ $deleted->id }}" class="btn btn-danger btn-sm">permanentDelete</a>
                          </div>
                        </th>

                    </tr>
                  @empty
                    <tr>

                      <th>No data</th>
                    </tr>
                  @endforelse

                 </table>



               </div>
              </div>
            </div>
          </div>

        </div>











@endsection
