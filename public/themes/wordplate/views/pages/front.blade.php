@extends('layouts.main')

@section('content')
@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
                
        <kma-slider class="slider-container"></kma-slider>

        <search-bar></search-bar>
        @include('partials.buttons')
        <main role="main" class="front">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ $featuredImage['url'] }}" class="my-3 img-fluid" alt="Cathey & Ralph Hobbs" >
                    </div>
                    <div class="col-lg-6">
                        <article class="front">
                            <header>
                                <h1>{{ $headline != '' ? $headline : the_title() }}</h1>
                            </header>
                            
                            {{ the_content() }}

                        </article>
                    </div>
                </div>

            </div>
        </main>
        
        @include('partials.featureboxes')

    @endwhile
@else
    @include('pages.404')
@endif
@endsection
