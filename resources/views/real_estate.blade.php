@extends('layouts.front')

@section('content')
    <div class="site-blocks-cover overlay" style="background-image: url({{ $realEstate->getFirstMediaUrl('main_photo') }});" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-10">
                    <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded">Деталі нерухомості</span>
                    <h1 class="mb-2">{{ $realEstate->name }}</h1>
                    <p class="mb-5"><strong class="h2 text-success font-weight-bold">${{$formatted_price = number_format(intval($realEstate->price), 0, ',', ' ')}}</strong></p>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section site-section-sm">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" style="margin-top: -150px;">
                    <div class="mb-5">
                        <div class="slide-one-item home-slider owl-carousel">
                            <div><img src="{{ $realEstate->getFirstMediaUrl('main_photo', 'big_thumb') }}" alt="{{ $realEstate->name }}"
                                      class="img-fluid"></div>
                        </div>
                    </div>
                    <div class="bg-white">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <strong class="text-success h1 mb-3">${{$formatted_price = number_format(intval($realEstate->price), 0, ',', ' ')}}</strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Тип нерухомості</span>
                                <strong class="d-block">{{ implode(', ', $realEstate->types->pluck('name')->toArray()) }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text align-content-center">Кількість кімнат</span>
                                <strong class="d-block">{{ $realEstate->number_of_rooms }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text align-content-center">Спальні місця</span>
                                <strong class="d-block">{{ $realEstate->number_of_beds }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Місто/Район</span>
                                <strong class="d-block">{{$realEstate -> location -> name}}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text">Адреса</span>
                                <strong class="d-block">{{ $realEstate->address }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text align-content-center">Площа</span>
                                <strong class="d-block">{{ $realEstate->area }}</strong>
                            </div>
                            <div class="col-md-6 col-lg-4 text-left border-bottom border-top py-3">
                                <span class="d-inline-block text-black mb-0 caption-text align-content-center">Поверх</span>
                                <strong class="d-block">{{ $realEstate->floor }}</strong>
                            </div>
                        </div>
                        <h2 class="h4 text-black">Більше інформації</h2>
                        <p>{{ $realEstate->description }}</p>

                        <div class="row mt-5">
                            <div class="col-12">
                                <h2 class="h4 text-black mb-3">Галерея нерухомості</h2>
                            </div>
                            @foreach ($realEstate->getMedia('gallery') as $galleryItem)
                            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                <a href="{{ $galleryItem->getFullUrl() }}" class="image-popup gal-item">
                                    <img src="{{ $galleryItem->getFullUrl() }}" alt="{{ $realEstate->name }} {{ $loop->iteration }}" class="img-fluid">
                                </a>
                            </div>
                            @endforeach
                        </div>

                        <div class="row mt-5">
                            <div class="col-12">
                                <div style="width: 100%; height: 400px" id="address-map"></div>

                                <script>
                                  var map;
                                  var default_center_latitude = {{ $realEstate->latitude }};
                                  var default_center_longitude = {{ $realEstate->longitude }};
                                  var default_zoom = 10;

                                  function initMap() {
                                    var center = new google.maps.LatLng(
                                      default_center_latitude,
                                      default_center_longitude);
                                    var mapOptions = {
                                      zoom: default_zoom,
                                      center: center
                                    };
                                    map = new google.maps.Map(document.getElementById('address-map'), mapOptions);

                                    var marker = {"latitude": {{ $realEstate->latitude }}, "longitude": {{ $realEstate->longitude }} };

                                    var markerLatLng = new google.maps.LatLng(
                                      parseFloat(marker.latitude),
                                      parseFloat(marker.longitude));

                                    var icon = 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';
                                    mark = new google.maps.Marker({
                                      map: map,
                                      position: markerLatLng,
                                      icon: icon
                                    });

                                  }
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pl-md-5">

                    <div class="bg-white widget border rounded">

                        <h3 class="h4 text-black widget-title mb-3">Контакти власника</h3>
                        <form action="" class="form-contact-agent">
                            <div class="form-group">
                                <label for="name" style="color: #1d2124">Ім'я: </label>
                                <label for="name">{{ $realEstate->user->name }}</label>
                            </div>
                            <div class="form-group">
                                <label for="email" style="color: #1d2124">Email: </label>
                                <label for="name">{{ $realEstate->user->email }}</label>
                            </div>
                            <div class="form-group">
                                <label for="phone" style="color: #1d2124">Телефон: </label>
                                <label for="name">{{ $realEstate->user->phone }}</label>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white widget border rounded">
                        <h3 class="h4 text-black widget-title mb-3">Обирайте нас!</h3>
                        <p>Шукаєте надійного партнера у покупці або продажу нерухомості? Наш сайт допоможе вам знайти Вашу омріяну квартиру, будинок або дачу за найвигіднішими цінами на ринку. Обирайте EstateEase - надійність і якість гарантовані!</p>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="site-section site-section-sm bg-light">
        <div class="container">

            <div class="row">
                <div class="col-12">
                    <div class="site-section-title mb-5">
                        <h2>Схожі пропозиції</h2>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                @foreach ($relatedRealEstate as $realEstate)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <a href="{{ route('real_estate.show', [$realEstate->slug, $realEstate->id]) }}" class="prop-entry d-block">
                            <figure>
                                <img src="{{ $realEstate->getFirstMediaUrl('main_photo', 'big_thumb') }}" alt="{{ $realEstate->name }}" class="img-fluid">
                            </figure>
                            <div class="prop-text">
                                <div class="inner">
                                    <span class="price rounded">${{$formatted_price = number_format(intval($realEstate->price), 0, ',', ' ')}}</span>
                                    <h3 class="title">{{ $realEstate->name }}</h3>
                                    <p class="location">{{ $realEstate->address . ', ' . $realEstate -> location -> name}}</p>
                                </div>
                                <div class="prop-more-info">
                                    <div class="inner d-flex">
                                        <div class="col">
                                            <span>Тип нерухомості:</span>
                                            <strong>{{ implode(', ', $realEstate->types->pluck('name')->toArray()) }}</strong>
                                        </div>
                                        <div class="col">
                                            <span>Кількість кімнат:</span>
                                            <strong>{{ $realEstate->number_of_rooms }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
@endsection

@section('javascript')
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"
        async defer></script>
@endsection
