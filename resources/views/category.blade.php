@extends('layouts.app')

@section('content')
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  


    <div class="heading-page header-text" style="background: rgb(28, 32, 30);">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>Category</h4>
                <h2>{{ $category->name }}</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <section class="blog-posts grid-system">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                @foreach ($category->posts as $post)
                    <div class="col-lg-6">
                        <div class="blog-post">
                            <div class="blog-thumb">
                                <img src="{{ $post->image_path_aws }}" alt="">
                                </div>
                                <div class="down-content">
                                <span>{{ $category->name }}</span>
                                <a href="post-details.html"><h4>{{ $post->title }}</h4></a>
                                <ul class="post-info">
                                    <li><a href="#">{{ $post->user->name }}</a></li>
                                    <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                                    <li><a href="#">12 Comments</a></li>
                                </ul>
                                <p>{{ $post->description }}</p>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
            
                <div class="col-lg-12">
                  <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                      <h2>Categories</h2>
                    </div>
                    <div class="content">
                      <ul>
                         @foreach ($categories as $category)
                            <li><a href="{{ route('categories.show', $category->id) }}">- {{ $category->name }}</a></li>
                         @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection

@section('footer')
    <footer>
      <div class="container">
        <div class="row">
          {{-- <div class="col-lg-12">
            <ul class="social-icons">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Linkedin</a></li>
            </ul>
          </div> --}}
          <div class="col-lg-12">
            <div class="copyright-text">
              <p>Copyright 2020 | Charles Pitagan
                    
              </p>
            </div>
          </div>
        </div>
      </div>
      
    </footer>
@endsection