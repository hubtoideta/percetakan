@extends('errors.minimal')

@section('title', __('Not Found'))
@section('code')
    <img src="assets/media/auth/404-error.png" class="mw-100 mh-300px theme-light-show" alt="" />
    <img src="assets/media/auth/404-error-dark.png" class="mw-100 mh-300px theme-dark-show" alt="" />
@endsection
@section('message', __('Not Found'))
