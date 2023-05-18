@extends('layouts.front')

@section('content')
    <div class="slide-one-item home-slider owl-carousel">
        @foreach ($featuredRealEstates as $featuredRealEstate)
            <div class="site-blocks-cover"
                 style="background-image: url('{{ $featuredRealEstate->getFirstMediaUrl('main_photo') }}');"
                 data-aos="fade" data-stellar-background-ratio="0.5">

                <div class="text">
                    <h2>{{ $featuredRealEstate->name }}</h2>
                    <p class="location"><span
                            class="property-icon icon-room"></span> {{ $featuredRealEstate->address . ', ' . $featuredRealEstate -> location -> name}}
                    </p>
                    <p class="mb-2"><strong>${{ number_format($featuredRealEstate->price) }}</strong></p>
                    <p class="mb-0"><a
                            href="{{ route('real_estate.show', [$featuredRealEstate->slug, $featuredRealEstate->id]) }}"
                            class="text-black text-uppercase small letter-spacing-1 font-weight-bold">Переглянути</a>
                    </p>

                </div>
            </div>
        @endforeach
    </div>
    </div>
    <div class="border-bottom bg-white top-bar align-items-center mt-3" style="height: 60px; font-size: 15px;">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                <h1 class="">
                    <a href="/" class="h5 text-black" style="font-size: 35px; margin-top: 10px">
                        <strong>Знайдіть своє ідеальне житло на Закарпатті з EstateEase</strong>
                    </a>
                </h1>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <form class="row mb-5" action="{{ route('search') }}" method="GET">

                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="select-wrap">
                        <span class="icon icon-arrow_drop_down"></span>
                        <select name="types" id="types" class="form-control d-block "
                                style="border-radius: 50px; background-color: #e6f2fc">
                            <option value="">Тип нерухомості</option>
                            @foreach ($realEstateTypes as $realEstateType)
                                <option value="{{ $realEstateType->id }}">{{ $realEstateType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="select-wrap">
                        <span class="icon icon-arrow_drop_down"></span>
                        <select name="location_id" id="location_id" class="form-control d-block"
                                style="border-radius: 50px;  background-color: #e6f2fc">
                            <option value="">Місто/Район</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="select-wrap">
                        <input type="number" name="number_of_rooms" id="number_of_rooms" min="1"
                               class="form-control d-block" placeholder="Кількість кімнат"
                               style="border-radius: 50px;
                                background-color: #e6f2fc">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="select-wrap">
                        <input type="number" name="area" id="area" min="1"
                               class="form-control d-block" placeholder="Площа"
                               style="border-radius: 50px;
                                background-color: #e6f2fc">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="select-wrap">
                        <input type="number" name="number_of_beds" id="number_of_beds" min="1"
                               class="form-control d-block" placeholder="Кількість спальних місць"
                               style="border-radius: 50px;
                                background-color: #e6f2fc">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="select-wrap">
                        <input type="number" name="floor" id="floor" min="1"
                               class="form-control d-block" placeholder="Поверх"
                               style="border-radius: 50px;
                                background-color: #e6f2fc">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-4">
                        <div id="slider-range" class="border-primary" data-min="{{ $min_price }}"
                             data-max="{{ $max_price }}"></div>
                        <input type="text" name="text" id="amount"
                               class="form-control border-0 pl-0 bg-white text-center" disabled=""/>
                        <input type="hidden" name="min_price" id="min_price" value="{{ $min_price }}">
                        <input type="hidden" name="max_price" id="max_price" value="{{ $max_price }}">
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <input type="submit" class="btn btn-primary btn-block form-control-same-height"
                           style="border-radius: 50px" value="Шукати">
                </div>

            </form>

            <div class="row justify-content-center">
                <div class="col-md-7 text-center mb-5">
                    <div class="site-section-title">
                        <h2>Тип нерухомості</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach ($realEstateTypes as $realEstateType)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <a href="{{ route('event_type', $realEstateType->slug) }}"
                           class="service text-center border rounded">
                            <span class="icon flaticon-house-1"></span>
                            <h2 class="service-heading">{{ $realEstateType->name }}</h2>
                            <p><span class="read-more">Переглянути</span></p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="site-section site-section-sm bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="site-section-title">
                        <h2>Нова нерухомість для вас</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                @foreach ($newestRealEstates as $realEstate)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <a href="{{ route('real_estate.show', [$realEstate->slug, $realEstate->id]) }}"
                           class="prop-entry d-block">
                            <figure>
                                <img src="{{ $realEstate->getFirstMediaUrl('main_photo', 'big_thumb') }}"
                                     alt="{{ $realEstate->name }}" class="img-fluid">
                            </figure>
                            <div class="prop-text">
                                <div class="inner">
                                    <span
                                        class="price rounded">${{$formatted_price = number_format(intval($realEstate->price), 0, ',', ' ')}}</span>
                                    <h3 class="title">{{ $realEstate->name }}</h3>
                                    <p class="location">{{ $realEstate->address . ', ' . $realEstate -> location -> name}}</p>
                                </div>
                                <div class="prop-more-info">
                                    <div class="inner d-flex">
                                        <div class="col">
                                            <span>Типи нерухомості:</span>
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
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7">
                    <div class="site-section-title text-center">
                        <h2>Нерухомість у місті </h2>
                    </div>
                </div>
            </div>
            <div class="row block-13">

                <div class="nonloop-block-13 owl-carousel">

                    @foreach ($locations as $location)

                        <div class="slide-item">
                            <div class="team-member text-center">
                                <a href="{{ route('location', $location->slug) }}">
                                    <img src="{{ $location->getFirstMediaUrl('photo') }}" alt="{{ $location->name }}"
                                         class="img-fluid mb-4 w-50 rounded-circle mx-auto">
                                </a>
                                <div class="text p-3">
                                    <a href="{{ route('location', $location->slug) }}">
                                        <h2 class="mb-2 font-weight-light text-black h4">{{ $location->name }}</h2>
                                    </a>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>

            </div>
        </div>
    </div>

@endsection
