@extends('layouts.main')
@section('content')

@if (have_posts())
    @while (have_posts())
        {{ the_post() }}
        @include('partials.mast')
        <main role="main">
            <div class="container">
                <article class="support">
                    <header class="text-primary">
                        <h1>{{ $headline != '' ? $headline : the_title() }}</h1>
                    </header>
                    {{ the_content() }}
                </article>
            </div>
        </main>

        <div class="feature-box-section travel-guide">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 text-white box-container">
                        <div class="feature-box feat-one">
                            <h3>{{ $featureBox1['title'] }}</h3>
                            <p>{{ $featureBox1['text'] }}</p>
                            <a class="btn btn-lg btn-outline-white btn-rounded" href="{{ $featureBox1['link']['url'] }}" >{{ $featureBox1['link']['title'] }} &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 text-white box-container">
                        <div class="feature-box feat-two">
                            <h3>{{ $featureBox2['title'] }}</h3>
                            <p>{{ $featureBox2['text'] }}</p>
                            <a class="btn btn-lg btn-outline-white btn-rounded" href="{{ $featureBox2['link']['url'] }}" >{{ $featureBox2['link']['title'] }} &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 text-white box-container">
                        <div class="feature-box feat-three">
                            <h3 class="text-white">{{ $featureBox3['title'] }}</h3>
                            <p>{{ $featureBox3['text'] }}</p>
                            <a class="btn btn-lg btn-outline-white btn-rounded" href="{{ $featureBox3['link']['url'] }}" >{{ $featureBox3['link']['title'] }} &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 text-white box-container">
                        <div class="feature-box feat-four">
                            <h3 class="text-white">{{ $featureBox4['title'] }}</h3>
                            <p>{{ $featureBox4['text'] }}</p>
                            <a class="btn btn-lg btn-outline-white btn-rounded" href="{{ $featureBox4['link']['url'] }}" >{{ $featureBox4['link']['title'] }} &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 text-white box-container">
                        <div class="feature-box feat-five">
                            <h3>{{ $featureBox5['title'] }}</h3>
                            <p>{{ $featureBox5['text'] }}</p>
                            <a class="btn btn-lg btn-outline-white btn-rounded" href="{{ $featureBox5['link']['url'] }}" >{{ $featureBox5['link']['title'] }} &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endwhile
@else
    @include('pages.404')
@endif

@endsection