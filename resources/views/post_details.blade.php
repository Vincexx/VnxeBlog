@extends('layouts.app')

@section('content')
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  


    <section class="blog-posts grid-system">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                      <img src="{{ $post->image_path_aws }}" alt="">
                    </div>
                    <div class="down-content">
                      <span>{{ $post->category->name }}</span>
                      <a href="post-details.html"><h4>{{ $post->title }}</h4></a>
                      <ul class="post-info">
                        <li><a href="#">{{ $post->user->name }}</a></li>
                        <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                        <li><a href="#">10 Comments</a></li>
                      </ul>
                      <p>{{ $post->description }}</p>
                   
                    </div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <div class="col-lg-12">
                  <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                      <h2>Recent Posts</h2>
                    </div>
                    <div class="content">
                      <ul>
                        @foreach ($recentPosts as $recent)
                          <li><a href="{{ route('posts.show', $recent->id) }}">
                            <h5>{{ $recent->title }}</h5>
                            <span>{{ $recent->created_at->format('M d, Y') }}</span>
                          </a></li>
                        @endforeach
                     
                      </ul>
                    </div>
                  </div>
                </div>
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