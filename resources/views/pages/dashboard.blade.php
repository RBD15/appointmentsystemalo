@extends('layouts.app')


@section('content')
    <div id="dashboard" data-route="{{$route}}" data-token="{{$token}}" data-values="{{$values}}"></div>
@endsection