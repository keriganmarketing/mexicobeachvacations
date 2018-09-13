// Vue.component('component-name', require('path/to/component'))

//navigation menus
Vue.component(
  "main-menu",
  require("./components/navigation/MainNavigationMenu.vue")
);
Vue.component(
  "mobile-menu",
  require("./components/navigation/MobileNavigationMenu.vue")
);
Vue.component(
  "footer-menu",
  require("./components/navigation/FooterNavigationMenu.vue")
);

//plugins
Vue.component("social-icons", require("./components/SocialMediaIcons.vue"));
Vue.component("kma-slider", require("./components/KMASliderModule.vue"));
Vue.component(
  "portfolio-gallery",
  require("./components/PortfolioGallery.vue")
);
Vue.component("contact-form", require("./components/ContactForm.vue"));
Vue.component("fit-text", require("./components/FitText.vue"));
Vue.component("weather-fetcher", require("./components/WeatherFetcher.vue"));
Vue.component("search-bar", require("./components/SearchBar.vue"));
Vue.component("side-search-bar", require("./components/SideSearchBar.vue"));
Vue.component("weather-icon", require("./components/WeatherIcon.vue"));
Vue.component(
  "search-results-container",
  require("./components/SearchResultsContainer.vue")
);
Vue.component("full-property", require("./components/FullProperty.vue"));
Vue.component("photo-gallery", require("./components/PhotoGallery.vue"));
Vue.component("booking-form", require("./components/BookingForm.vue"));
Vue.component("state-options", require("./components/StateOptions.vue"));
Vue.component("country-options", require("./components/CountryOptions.vue"));
Vue.component(
  "property-management-form",
  require("./components/PropertyManagementForm.vue")
);

Vue.component("dropdown", require("./components/Dropdowns.vue"));