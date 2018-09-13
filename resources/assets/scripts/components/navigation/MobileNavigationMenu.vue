<template>
    <ul>
        <li v-for="(navitem, index) in mobileNavData" v-bind:key="index" class="nav-item" :class="{'dropdown': navitem.children.length > 0 }">
            <a :href="navitem.url" :class="'nav-link'" :target="navitem.target" >{{ navitem.title }}</a>
            <span class="nav-icon" v-if="navitem.children.length > 0" @click="toggleSubMenu(index)">
                <i class="fa" :class="{
                    'fa-plus-circle': !navitem.subMenuOpen,
                    'fa-minus-circle': navitem.subMenuOpen
                    }" ></i>
            </span>
            <div class="dropdown-menu" v-if="navitem.subMenuOpen" >
                <li v-for="(child, i) in navitem.children" v-bind:key="i">
                    <a :href="child.url" :class="'nav-link'" :target="child.target" >{{ child.title }}</a>
                </li>
            </div>
        </li>
    </ul>
</template>

<script>
    export default {

        props: {
            mobileNav: {
                type: Object,
                default: () => []
            }
        },

        data() {
            return {
                mobileNavData: {}
            }
        },

        created(){
            this.mobileNavData = Object.keys(this.mobileNav).map((key) => {
                this.mobileNav[key].subMenuOpen = false;
                return this.mobileNav[key]
            })
        },

        methods: {
            toggleSubMenu(navitem){
                this.mobileNavData[navitem].subMenuOpen = !this.mobileNavData[navitem].subMenuOpen;
                console.log(navitem);
            }
        }

    }
</script>
<style>
    .mobile-menu {
        display: block;
        width: 100%;
        padding: 5rem 2rem;
        transition: all ease-in 1s;
    }
    .mobile-menu .nav-icon {
        font-size:1.2em;
        padding: .25rem .5rem;
        position: absolute;
        right: 0;
        margin-top:-2.5rem;
        cursor: pointer;
    }
    .mobile-menu .dropdown-menu {
        border: 0;
        display: block;
        padding: .5rem 1rem;
    }
</style>
