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
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img
                        src="https://www.completecs.com.au/wp-content/uploads/clark-street-mercantile-33931-unsplash.jpg"
                        class="d-block w-100" alt="img-1">
                </div>
                <div class="carousel-item">
                    <img
                        src="https://i.artfile.me/wallpaper/02-10-2017/1920x1080/raznoe---drugoe-more-leto-aksessuary-fot-1241533.jpg"
                        class="d-block w-100" alt="img-2">
                </div>
                <div class="carousel-item">
                    <img src="https://apparelresources.com/wp-content/uploads/2018/06/Retail.jpg" class="d-block w-100"
                         alt="img-3">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@endsection
