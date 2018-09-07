@extends('layouts.main')

@section('content')
@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
                
        @include('partials.mast')
        
        <main role="main" class="support">
            <div class="container">
                <article class="support">
                    <header class="text-primary">
                        <h1>{{ $headline != '' ? $headline : the_title() }}</h1>
                    </header>
                    {{ the_content() }}
                </article>

                <search-results-container
                    data-pool="{{ $pool }}"
                    :data-results="{{ $units }}"
                    data-check-in="{{ $checkIn }}"
                    data-check-out="{{ $checkOut }}"
                    data-location="{{ $location }}"
                    data-type="{{ $type }}"
                >
                </search-results-container>
            </div>
        </main>
    @endwhile
@else
    @include('pages.404')
@endif
@endsection
