@extends('layouts.app')

@section('content')
    {{-- Section Hero --}}
    @include('section.hero')

    {{-- Section Menu (Recommended Food & Drink) --}}
    @include('section.menu')

    {{-- Section Moment / Enjoy the Moment --}}
    @include('section.bold')

    {{-- Section Moment / Enjoy the Moment --}}
    @include('section.moment')

    {{-- Section Guide (Enjoy the Best Experience) --}}
    @include('section.guide')

    {{-- Section Ads (Promo, highlight produk, dll) --}}
    @include('section.ads')

    {{-- Section Review (Promo, highlight produk, dll) --}}
    @include('section.review')

    {{-- Section Footer (otomatis dari layout juga bisa) --}}
    @include('section.footer')
@endsection
