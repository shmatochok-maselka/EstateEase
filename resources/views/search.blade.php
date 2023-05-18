@extends('layouts.front')

@section('content')
    <div class="site-section site-section-sm bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="site-section-title text-black">
                        <h2>Результати пошуку</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                @foreach ($realEstates as $realEstate)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <a href="{{ route('real_estate.show', [$realEstate->slug, $realEstate->id]) }}"
                           class="prop-entry d-block">
                            <figure>
                                <img src="{{ $realEstate->getFirstMediaUrl('main_photo', 'big_thumb') }}"
                                     alt="{{ $realEstate->name }}" class="img-fluid">
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
                {{ $realEstates->appends(request()->except('page'))->links() }}
        </div>
    </div>

@endsection
