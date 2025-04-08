@extends('layout.user.main')

@section('main')
<!-- Hero Section Begin -->
<section class="hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Les Restaurants</span>
                    </div>
                    <ul id="restaurant-list">
                        @foreach($restaurants as $restaurant)
                            <li class="item"><a href="{{ route('home_user.restaurantchoosen', $restaurant->id) }}">{{ $restaurant->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-lg-9">
                <section class="featured spad">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                    <h2>{{$selectedRestaurant->name}}</h2>
                                </div>
                                <div class="featured__controls">
                                    <ul>
                                        <li class="active" data-filter="*">All</li>
                                        @foreach($categories as $category)
                                            <li data-filter=".{{ $category->name }}">{{ $category->name }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row featured__filter">
                            @foreach($selectedRestaurant->items as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6 mix {{ $item->category->name }}">
                                    <div class="featured__item">
                                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('template-users/img/featured/feature-1.jpg') }}">
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="featured__item__text">
                                            <h6><a href="#">{{ $item->name }}</a></h6>
                                            <h5>{{ number_format($item->price / 100, 2, ',', ' ') }} €</h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                <!-- Featured Section End -->
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

@endsection