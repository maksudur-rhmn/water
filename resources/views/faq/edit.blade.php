@extends('layouts.dashboard')

@section('title')
  Frequently Asked Questions
@endsection

@section('active-faq')
  active
@endsection
@section('nav')
  <nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <a class="breadcrumb-item" href="{{ route('faq_index') }}">Faq</a>
    <span class="breadcrumb-item active">{{ $faq->faq_question }}</span>
  </nav>
@endsection

@section('content')

 <div class="container">
   <div class="row">
     <div class="col-lg-8 m-auto">
      <div class="card">
        <div class="card-header">
          <h5 class="text-center">Edit Faq</h5>
        </div>
        <div class="card-body">
          <form class="form-group" action="{{ url('/faq/update') }}" method="post">
            @csrf
            <div class="py-3">
              <input type="hidden" name="id" value="{{ $faq->id }}">
              <input class="form-control" type="text" name="faq_question" value="{{ $faq->faq_question }}">
            </div>
            <div class="py-3">
              <input class="form-control" type="text" name="faq_answer" value="{{ $faq->faq_answer }}">
            </div>
            <div class="py-3">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
     </div>
   </div>
 </div>

@endsection
