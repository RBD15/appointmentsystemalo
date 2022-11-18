@extends('layouts.app')


@section('main')
    <div id="edit" data-params={{$params}} data-fields={{$fields}} data-model="{{$model}}"></div>
@endsection