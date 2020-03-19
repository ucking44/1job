@extends('layouts.frontend.app')

@section('title', 'Index')

@push('css')

@endpush

    <link href="{{ asset('assets/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/css/responsive.css') }}" rel="stylesheet">
@section('content')

<div class="row">
    <div class="col-sm-6 margin-tb" style="margin-top: 20px;">
        <div class="pull-left">
            <h1 class="pull-right">My Products</h1>
        </div>
        <div class="pull-right">
            <a href="{{route('admin', Auth::user()->usertype == 'admin') }}" class="btn btn-success">Back To Admin</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No</th>
                {{-- <th>User</th> --}}
                <th>Name</th>
                <th>Details</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    {{-- <td>{{ $product->user_id }}</td> --}}
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->detail }}</td>
                    <td>
                        @if($product->status == 0)
                        <span class="label label-primary">Pending</span>
                        @elseif($product->status == 1)
                        <span class="label label-success">Approved</span>
                        @elseif($product->status == 2)
                        <span class="label label-danger">Rejected</span>
                        @else
                        <span class="label label-info">Postponed</span>
                       @endif
                    </td>
                    <td><a href="{{action('ProductController@edit', $product->id)}}" class="btn btn-warning">App/Rej</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('js')

@endpush




