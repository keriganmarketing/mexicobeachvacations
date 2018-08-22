@extends('layouts.main')

@section('content')
@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
                
        @include('partials.mast')

        @php
            echo '<pre>', print_r($units->data), '</pre>';
        @endphp
        
        <main role="main" class="support">
            <div class="container">
                <article class="support">
                    <header class="text-primary">
                        <h1>{{ $headline != '' ? $headline : the_title() }}</h1>
                    </header>
                    {{ the_content() }}
                </article>

                <div class="row">
                    <div class="col-md-4 col-lg-3 mb-4">
                        <side-search-bar></side-search-bar>
                    </div>
                    <div class="col-md-8 col-lg-9 rental-feed">

                        @foreach ($units->data as $unit)
                            <div class="row no-gutters unit">
                                <div class="col-lg-4">
                                    <a class="property-image" href="/property?id={{ $unit->rns_id }}" >
                                    <img src="{{ $unit->images[0]->url }}" style="width:100%;" >
                                    </a>
                                </div>
                                <div class="col-lg-8">
                                    <div class="rental-feed-info mt-3">
                                    <h2 class="text-primary"><a href="/property?id={{ $unit->rns_id }}" >{{ $unit->name }}</a></h2>
                                    <p class="subhead"><span class="type">{{ $unit->type }}</span> &bull;
                                    <span class="location">{{ $unit->location }}</span></p>
                                    <div class="row no-gutters tiles">
                                        <div class="col-auto">
                                            <span class="data">{{ $unit->details[0]->beds }}</span>
                                            <span class="label">BEDS</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="data">{{ $unit->details[0]->baths }}</span>
                                            <span class="label">BATHS</span>
                                        </div>
                                        <div class="col-auto">
                                            <span class="data">{{ $unit->details[0]->sleeps }}</span>
                                            <span class="label">SLEEPS</span>
                                        </div>
                                    </div>
                                    <p>{!! wp_trim_words($unit->details[0]->description, 20, '... <a href="/property?id='.$unit->rns_id.'" >read&nbsp;more</a>.' ) !!}</p>
                                    <a class="btn btn-lg btn-outline-info btn-rounded" href="/property?id={{ $unit->rns_id }}" >View Property &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    @endwhile
@else
    @include('pages.404')
@endif
@endsection
