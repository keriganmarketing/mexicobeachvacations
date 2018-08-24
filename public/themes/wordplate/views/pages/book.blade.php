@extends('layouts.main')
@section('content')

@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
        @include('partials.mast')
        <main role="main">
            <div class="container">
                <article class="support">
                    {{ the_content() }}

                    <booking-form></booking-form>
                </article>
            </div>
        </main>
    @endwhile
@else
    @include('pages.404')
@endif

@endsection
