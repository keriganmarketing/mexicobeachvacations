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

                    <weather-fetcher location="mexico beach, fl" class="weather-page" >
                        <span slot-scope="{weatherIcon, weatherInfo, loading}">
                            <div v-if="! loading">
                                <p class="weather-updated" >This report was generated: <span v-text="weatherInfo.item.pubDate"></span> 
                                    using <a href="https://www.yahoo.com/news/weather/country/state/city-2449985/" target="_blank">
                                    <img style="width:130px;" :src="weatherInfo.image.url" alt="Weather provided by Yahoo! Weather" >
                                </a></p>
                                &nbsp;

                                <h2>Current Conditions</h2>
                                <div class="card">
                                    <div class="card-body" style="padding-top: 2.5rem;">
                                        <div class="row text-center">
                                            <div class="col-sm-6 col-lg-3" >
                                                <div class="current-conditions text-lg">
                                                    <i class="wi" :class="weatherIcon"></i>
                                                    <span v-text="weatherInfo.item.condition.temp + '&deg;F'"></span>
                                                    <p v-text="weatherInfo.item.condition.text"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-lg-3" >
                                                <p>Wind Chill: <span v-text="weatherInfo.wind.chill + '&deg;F'" ></span><br>
                                                Wind Speed: <span v-text="weatherInfo.wind.speed + ' ' + weatherInfo.units.speed" ></span></p>
                                            </div>
                                            <div class="col-sm-6 col-lg-3" >
                                                <p>Humidity: <span v-text="weatherInfo.atmosphere.humidity + '%'" ></span><br>
                                                Pressure: <span v-text="weatherInfo.atmosphere.pressure + ' ' + weatherInfo.units.pressure" ></span></p>
                                            </div>
                                            <div class="col-sm-6 col-lg-3" >
                                                <p>Sunrise: <span v-text="weatherInfo.astronomy.sunrise" ></span><br>
                                                Sunset: <span v-text="weatherInfo.astronomy.sunset" ></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                &nbsp;

                                <h2>Forecast</h2>
                                <div class="row">
                                    <div v-for="item in weatherInfo.item.forecast" :key="item.key" class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-4">
                                        <div class="card text-center">
                                            <div class="card-body">
                                        <p><span v-text="item.day"></span><br>
                                        <span v-text="item.date" style="font-size:.9em;" class="text-dark" ></span></p>
                                        <p><weather-icon :code="item.code"></weather-icon></p>
                                        High: <span v-text="item.high + '&deg;F'"></span><br>
                                        Low: <span v-text="item.low + '&deg;F'"></span><br>
                                        <span v-text="item.text"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </span>
                    </weather-fetcher>

                </article>
            </div>
        </main>
    @endwhile
@else
    @include('pages.404')
@endif

@endsection