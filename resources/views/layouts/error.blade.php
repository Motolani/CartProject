@extends('layout.index')

@section('error')
    <div class="container">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                {{ $error }}
                </div>
            @endforeach
        @endif
    </div>
@endsection