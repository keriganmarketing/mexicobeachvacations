@extends('layouts.main')

@section('content')
@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
                
        @include('partials.quicksearch')

        @php
            echo '<pre>', print_r($units), '</pre>';
        @endphp
        
        <main role="main" class="front">
            <div class="container">

                <div class="row">
                    @foreach ($units as $unit)
                        {{-- do stuff --}}
                    @endforeach
                </div>

            </div>
        </main>
    @endwhile
@else
    @include('pages.404')
@endif
@endsection
