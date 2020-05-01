@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Home page</h3>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim ex exercitationem fugiat hic non quam qui
            rerum ullam? Aperiam hic incidunt nam rerum! Aliquam distinctio eius reprehenderit? Consectetur consequatur
            dicta eius exercitationem illo pariatur soluta vitae. A assumenda atque corporis deleniti earum eos fugit,
            illo libero magnam, modi nostrum quasi veniam voluptatem. Accusamus aliquid blanditiis eaque minima modi
            obcaecati quod reprehenderit. Ab adipisci atque consectetur, deleniti dignissimos doloribus, earum eos hic
            ipsum laudantium nisi nulla obcaecati rem reprehenderit rerum sequi voluptas, voluptates? Aliquid aperiam
            atque, autem beatae delectus dolore magni minus molestiae, omnis perspiciatis quas quisquam quos ratione
            reiciendis repudiandae?
        </p>
        {{--        <ajax-template-component :url="'{{ route('ajax') }}'"></ajax-template-component>--}} {{--Тестовый Ajax--}}

        <div id="carouselExampleCaptions3" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions3" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleCaptions3" data-slide-to="1"></li>
                <li data-target="#carouselExampleCaptions3" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        src="https://www.completecs.com.au/wp-content/uploads/clark-street-mercantile-33931-unsplash.jpg"
                        class="d-block w-100" alt="img-1">
                    <div class="carousel-caption d-none d-md-block">
                        <p class="display-1 text-primary">Discounts</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img
                        src="https://i.artfile.me/wallpaper/02-10-2017/1920x1080/raznoe---drugoe-more-leto-aksessuary-fot-1241533.jpg"
                        class="d-block w-100" alt="img-2">
                    <div class="carousel-caption d-none d-md-block">
                        <p class="display-1 text-primary">Find for yourself</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://apparelresources.com/wp-content/uploads/2018/06/Retail.jpg" class="d-block w-100"
                         alt="img-3">
                    <div class="carousel-caption d-none d-md-block">
                        <p class="display-1 text-primary">Time to buy</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions3" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions3" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="row my-4 align-items-start">
            <div id="carouselExampleCaptions" class="carousel slide col-6" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach ($lotsFirst as $lot)
                        <a href="{{route('lot.one', $lot)}}"
                           class="carousel-item {{ $lotsFirst->first() === $lot ? 'active' : '' }} slider-wrap">
                            <img class="d-block w-100 slider-img" src="{{ $lot->product()->img_url
? Storage::url($lot->product()->img_url) : Storage::url('placeholder.jpg') }}" alt="img_product">
                            <div class="carousel-caption d-none d-md-block bg-light text-dark">
                                <h4>{{ $lot->product()->name }}</h4>
                                <h5><strong>Start price:</strong> {{ $lot->start_price }}</h5>
                            </div>
                        </a>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div id="carouselExampleCaptions2" class="carousel slide col-6" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions2" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions2" data-slide-to="1"></li>
                    <li data-target="#carouselExampleCaptions2" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach ($lotsSecond as $lot)
                        <a href="{{route('lot.one', $lot)}}"
                           class="carousel-item {{ $lotsSecond->first() === $lot ? 'active' : '' }} slider-wrap">
                            <img class="d-block w-100 slider-img" src="{{ $lot->product()->img_url
? Storage::url($lot->product()->img_url) : Storage::url('placeholder.jpg') }}" alt="img_product">
                            <div class="carousel-caption d-none d-md-block bg-light text-dark">
                                <h4>{{ $lot->product()->name }}</h4>
                                <h5><strong>Start price:</strong> {{ $lot->start_price }}</h5>
                            </div>
                        </a>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions2" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions2" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div style="height: 200px"></div>
    </div>
@endsection
