<template>
    <nav id="side-menu" class="navbar navbar-light navbar-custom show"
         v-bind:style="{
            flexBasis: sidebarConf.flexBasis + 'px',
        }"
    >
        <div class="navbar-logo navbar-top">
            <a v-if=sidebarConf.showLabel class="navbar-brand p-0" href="/">
                <img :src="this.config.logoSrc" alt="vmzt.sk">
            </a>
            <button-component :config="{...buttonConfig }"></button-component>
        </div>
        <div class="navbar-menu-container">
            <div v-for="menuItem in config.menuItems">
                <!--                <h6 v-if=sidebarConf.showLabel class="text-muted text-uppercase my-0">-->
                <!--                    <span>{{ menuItem.title }}</span>-->
                <!--                </h6>-->
                <ul class="nav navbar-nav">
                    <li class="nav-item" v-for="subItem in menuItem.subItems">
                        <a class="nav-link" :href="subItem.src">
                            <span
                                v-if="subItem.icon"
                                class="material-icons"
                                v-b-tooltip.hover.right
                                :title="subItem.title"
                                :disabled="sidebarConf.showLabel"
                            >{{subItem.icon}}</span>
                            <span v-if=sidebarConf.showLabel class="align-bottom">{{subItem.title}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        props: ['config'],
        mounted() {
            this.$root.$on('toggleLeftMenu', () => {
                this.toggleSidebar();
            });
        },
        data() {
            return {
                isMenuCollapsed: this.config.isMenuCollapsed,
                sidebarConf: {
                    'showLabel': !this.config.isMenuCollapsed,
                    'flexBasis': this.config.isMenuCollapsed ? this.config.widthCollapsed : this.config.widthUncollapsed,
                },
                buttonConfig: {
                    'id': 'menu-toggle',
                    'class': 'navbar-toggler border-0 p-0',
                    'eventName': 'toggleLeftMenu'
                }
            }
        },
        methods: {
            toggleSidebar() {
                this.isMenuCollapsed = !this.isMenuCollapsed;
                this.sidebarConf = {
                    'showLabel': !this.sidebarConf.showLabel,
                    'flexBasis': this.sidebarConf.flexBasis === this.config.widthCollapsed ? this.config.widthUncollapsed : this.config.widthCollapsed,
                }
            }
        }
    }
</script>
