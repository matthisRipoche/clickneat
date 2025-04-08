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
                                    <h2>Veuillez sélectionner un restaurant</h2>
                                </div>
                            </div>
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