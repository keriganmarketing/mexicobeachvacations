<template>
    <div>
        <div 
            @click="toggleMenu()" 
            v-if="selectedOption !== ''"
            :class="['current-selection', { 'open': showMenu }]"
        >
          {{ selectedOption }}
          <i class="fa fa-chevron-down text-primary float-right" aria-hidden="true"></i>
        </div>

        <div 
            @click="toggleMenu()" 
            v-if="selectedOption === ''"
            :class="['current-selection', { 'open': showMenu }]"
        >
          {{ placeholderText }}
          <i class="fa fa-chevron-down text-primary float-right" aria-hidden="true"></i>
        </div>

        <ul class="dropdown-bubble" v-if="showMenu">
            <li v-for="(option, index) in options" :key="index">
                <a @click="updateOption(option)">
                    {{ option.name }}
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedOption: '',
                showMenu: false,
                placeholderText: 'Please select an item',
            }
        },
        props: {
            options: {
                type: [Array, Object]
            },
            selected: {},
            placeholder: [String]
        },

        mounted() {
            this.selectedOption = this.selected;
            if (this.placeholder)
            {
                this.placeholderText = this.placeholder;
            }
        },

        methods: {
            updateOption(option) {
                this.selectedOption = option.name;
                this.showMenu = false;
                this.$emit('updateOption', option.value);
            },

            toggleMenu() {
              this.showMenu = !this.showMenu;
            }
        }
    }
</script>

<style lang="scss">

.current-selection {
    border-radius: 1.5em;
    border: 0;
    height: 44px;
    padding: .575rem 1rem .2rem 1rem;
    background-color: #FFF;
    box-shadow: 0 0 5px rgba(0,0,0,.2);
    border: 2px solid #46a5b5 !important;

    .fa {
        margin-top: 2px;
    }

    &.open {
        border-radius: 1.5em 1.5em 0 0;
        border-bottom: 0 !important;
    }
}

.dropdown-bubble {
    border-radius: 0 0 1.3rem 1.3rem;
    background-color: #FFF;
    position: relative;
    z-index: 50;
    box-shadow: 0 0 5px rgba(0,0,0,.2);
    margin: 0;
    padding: 0 0 .5rem;
    overflow: hidden;
    border: 2px solid #46a5b5 !important;
    border-top: 0 !important;

    li > a {
        text-align: left;
        display: block;
        padding: .45rem 1rem;
        color: #555;

        &:hover {
            background-color: #ff6f74;
            color: #FFF !important;
        }
    }
}

li {
    list-style: none;
}
</style>
