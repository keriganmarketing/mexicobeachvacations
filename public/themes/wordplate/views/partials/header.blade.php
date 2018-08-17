<div v-if="mobileMenuOpen" class="mobile-menu" ref="mobileMenuContainer" :class="{ 'open': this.mobileMenuOpen }" >
    <mobile-menu :mobile-nav="{{ website_menu('mobile-navigation') }}" class="navbar-nav m-auto" ></mobile-menu>
</div>
<header class="top">
    <div role="navigation" class="topnav navbar navbar-expand-xl" >
        <div class="container d-flex justify-content-center justify-content-between-md">
            <div class="text-center" >
                <a class="logo" href="/">
                <img src="{{ get_template_directory_uri().'/assets/images/parker-logo.png' }}" alt="Mexico Beach Vacation Rentals" class="img-fluid" >
                </a>
            </div>
            <button @click="toggleMenu" class="d-xl-none btn btn-secondary btn-sm mt-4 fira" type="button" data-toggle="collapse" data-target="#mobilemenu" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                MENU <i
                        class="fa" 
                        :class="{
                            'fa-bars': !mobileMenuOpen,
                            'fa-times': mobileMenuOpen
                        }"
                        aria-hidden="true"
                    ></i>
            </button>
            <div class="main-navigation collapse navbar-collapse flex-grow-1">
                <main-menu :main-nav="{{ website_menu('main-navigation') }}" class="navbar-nav ml-auto"></main-menu>
            </div>
        </div>
    </div>
</header>