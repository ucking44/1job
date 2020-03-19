@extends('layouts.frontend.app')

@section('title', 'Edit')

@push('css')

@endpush

    <link href="{{ asset('assets/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet">
@section('content')

  <body>
    <div class="container">
      <form method="post" action="{{action('ProductController@update', $id)}}">
        @csrf
         <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <lable>Approval</lable>
                <select name="approve">
                  <option value="0" @if($products->status==0)selected @endif>Pending</option>
                  <option value="1" @if($products->status==1)selected @endif>Approve</option>
                  <option value="2" @if($products->status==2)selected @endif>Reject</option>
                  <option value="3" @if($products->status==3)selected @endif>Postponed</option>
                </select>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-top:40px">Update</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>


@endsection

@push('js')

@endpush
