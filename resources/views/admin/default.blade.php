@extends('layouts.admin.index')
@section('content')
   @push('title')
         <title>{{$title}}</title>
     @endpush

   <div class="row">
      <div class="col-md-12">
          <div class="box-body">
            <div class="error-page text-center">
            	<br>
            	<br>
              <h1>Welcome to admin system!</h1>
            </div>
        </div>
      </div>
  </div>
@endsection


@push('styles')
@endpush

@push('scripts')
@endpush
