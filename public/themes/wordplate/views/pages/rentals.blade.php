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
                :data-results="{{ json_encode($units) }}"
                data-check-in="{{ json_encode($_GET['checkIn']) }}"
                data-check-out="{{ json_encode($_GET['checkOut']) }}"
                data-location="{{ json_encode($_GET['location']) }}"
                data-type="{{ json_encode($_GET['type']) }}"
            >
            </search-results-container>

            </div>
        </main>
    @endwhile
@else
    @include('pages.404')
@endif
@endsection
