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
                    <a class="link" href="/current-weather/">85&deg;F</a> 
                    <social-icons :size="26" :margin=".25" class="d-flex social-icons justify-content-end" ></social-icons> 
                    <a class="link" href="tel:800-874-5073">800-874-5073</a> 
                </div>
                <div class="top-nav-menu collapse navbar-collapse">
                    <main-menu :main-nav="{{ website_menu('main-navigation') }}" class="navbar-nav ml-auto"></main-menu>
                </div>
            </div>
        </div>
    </div>
</header>
