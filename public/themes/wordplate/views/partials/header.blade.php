<div v-if="mobileMenuOpen" class="mobile-menu" ref="mobileMenuContainer" :class="{ 'open': this.mobileMenuOpen }" >
    <mobile-menu :mobile-nav="{{ website_menu('mobile-navigation') }}" class="navbar-nav m-auto" ></mobile-menu>
</div>
<header class="top">
    <div role="navigation" class="topnav navbar navbar-expand-lg" >
        <div class="container d-flex justify-content-center justify-content-between-md">
            <button @click="toggleMenu" class="d-lg-none btn btn-secondary btn-sm mt-1 fira" type="button" data-toggle="collapse" data-target="#mobilemenu" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                MENU <i
                        class="fa" 
                        :class="{
                            'fa-bars': !mobileMenuOpen,
                            'fa-times': mobileMenuOpen
                        }"
                        aria-hidden="true"
                    ></i>
            </button>
            <div class="text-center" >
                <a class="logo" href="/">
                <img src="{{ get_template_directory_uri().'/assets/images/parker-logo.png' }}" alt="Mexico Beach Vacation Rentals" class="img-fluid" >
                </a>
            </div>
            <div class="main-navigation flex-grow-1">
                <div class="mini-nav d-flex align-items-center">
                    <weather-fetcher location="mexico beach, fl" >
                        <span slot-scope="{weatherIcon, weatherInfo, loading}">
                            <div v-if="! loading">
                                <a class="link" href="/current-weather/" >
                                    <i class="wi" :class="weatherIcon"></i>
                                    <span v-text="weatherInfo.item.condition.temp + '&deg;F'"></span>
                                </a> 
                            </div>
                        </span>
                    </weather-fetcher>
                    <social-icons :size="26" :margin=".25" class="d-flex social-icons justify-content-end" ></social-icons> 
                    <a class="link" href="tel:{{ get_field('toll_free_phone', 'option') }}">{{ get_field('toll_free_phone', 'option') }}</a> 
                </div>
                <div class="top-nav-menu collapse navbar-collapse">
                    <main-menu :main-nav="{{ website_menu('main-navigation') }}" class="navbar-nav ml-auto"></main-menu>
                </div>
            </div>
        </div>
    </div>
</header>
