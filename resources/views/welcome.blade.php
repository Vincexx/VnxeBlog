@extends('layouts.app')

@section('content')
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  


    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
      <div class="container-fluid">
        <div class="owl-banner owl-carousel">
           @foreach ($posts as $post)
               <div class="item">
                <img src="{{ '/storage/' . $post->image }}" alt="">
                <div class="item-content">
                  <div class="main-content">
                    <div class="meta-category">
                      <span>{{ $post->category->name }}</span>
                    </div>
                    <a href="{{ route('posts.show', $post->id) }}"><h4>{{ $post->title }}</h4></a>
                    <ul class="post-info">
                      <li><a href="#">{{ $post->user->name }}</a></li>
                      <li><a href="#">{{ $post->created_at->format('M d, Y') }}</a></li>
                      {{-- <li><a href="#">12 Comments</a></li> --}}
                    </ul>
                  </div>
                </div>
              </div>
           @endforeach
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->



    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                @foreach ($recentPosts as $recent)

                    <div class="col-lg-12">
                      <div class="blog-post">
                        <div class="blog-thumb">
                          <img src="{{ asset('/storage/' . $recent->image) }}" alt="">
                        </div>
                        <div class="down-content">
                          <span>{{ $post->category->name }}</span>
                          <a href="{{ route('posts.show', $post->id) }}"><h4>{{ $recent->title }}</h4></a>
                          <ul class="post-info">
                            <li><a href="#">{{ $recent->user->name }}</a></li>
                            <li><a href="#">{{ $recent->created_at->format('M d, Y') }}</a></li>
                            <li><a href="#">12 Comments</a></li>
                          </ul>
                          <p>{{ $recent->description }}</p>
                      
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
                  <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="#">
                      <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                    </form>
                  </div>
                </div>
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
                            <li><a href="#">- {{ $category->name }}</a></li>
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