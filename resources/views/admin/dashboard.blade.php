@extends('layouts.admin')

@section('content')
    @if (Auth::check())

        @if (Auth::user()->role == 'admin')
            <admin-navigation 
            :authUser="{{ Auth::user() }}" 
            :user_posts="{{ Auth::user()->posts }}"
            user_profile="{{ Auth::user()->profile ? Auth::user()->profile : ""  }}"
            :users_count="{{ $users->count() }}"
            :categories_count="{{ $categories->count() }}"
            :posts_count="{{ $posts->count() }}"
            ></admin-navigation>
        @else
            <admin-navigation 
            :authUser="{{ Auth::user() }}" 
            :user_posts="{{ Auth::user()->posts }}"
            user_profile="{{ Auth::user()->profile ? Auth::user()->profile : ""  }}"
            :categories_count="{{ $categories->count() }}"
            :posts_count="{{ Auth::user()->posts->count() }}"
            ></admin-navigation>
        @endif

    @endif
@endsection
