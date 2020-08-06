@extends('layouts.admin')

@section('content')
    @if (Auth::check())

        <admin-navigation 
        :authUser="{{ Auth::user() }}" 
        :user_posts="{{ Auth::user()->posts }}"
        user_profile="{{ Auth::user()->profile ? Auth::user()->profile : ""  }}"
        ></admin-navigation>

    @endif
@endsection
