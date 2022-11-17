@extends('layouts.app')


@section('main')
    <div id="dashboard" data-route="{{$route}}" data-token="{{$token}}" data-values="{{$values}}"></div>
@endsection