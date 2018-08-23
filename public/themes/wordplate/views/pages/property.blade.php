@extends('layouts.main')

@section('content')
@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
                
        @include('partials.mast')

        <main role="main" class="support">
            <div class="container">
                <article class="support">                   
                    <full-property rns-id="{{ $unit }}" ></full-property>
                </article>
            </div>
        </main>

        @endwhile
    @else
        @include('pages.404')
    @endif
@endsection