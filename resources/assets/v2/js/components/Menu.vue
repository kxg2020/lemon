<template>
    <div>
        <!-- 项部Title -->
        <mu-appbar title="Title" class="example-appbar" :class="{'nav-hide': !open}">
            <mu-icon-button icon="menu" @click="toggle" slot="left"/>
            <mu-text-field icon="search" class="appbar-search-field"  slot="right" hintText="请输入搜索内容"/>
            <mu-icon-menu :value="theme" @change="changeTheme" icon="palette" slot="right">
                <mu-menu-item title="默认" value="defaul"/>
                <mu-menu-item title="Light" value="light"/>
                <mu-menu-item title="Dark" value="dark"/>
                <mu-menu-item title="Carbon" value="carbon"/>
                <mu-menu-item title="Teal" value="teal"/>
            </mu-icon-menu>
        </mu-appbar>

        <!-- 左侧抽屉 -->
        <mu-drawer :open="open" :docked="docked" @close="toggle()" :zDepth="0" class="app-drawer">
            <mu-appbar title="Hello World">
            </mu-appbar>
            <mu-divider/>
            <mu-list>
                <template v-for="(menu, index) in $router.options.routes" v-if="menu.children && ((menu.meta.requireAuth && $store.state.authLogin) || !menu.meta.requireAuth)">
                    <template v-if="menu.leaf">
                        <mu-list-item :title="menu.name"  toggleNested :open="false">
                            <template v-for="(submenu, index2) in menu.children" v-if="!submenu.hidden">
                                <mu-list-item slot="nested" :title="submenu.name" :to="submenu.path" :exact="true">
                                </mu-list-item>
                            </template>
                        </mu-list-item>
                    </template>
                    <template v-else>
                        <mu-list-item :title="menu.children[0].name" :to="menu.children[0].path" :exact="true">
                        </mu-list-item>
                    </template>
                </template>
            </mu-list>
            <mu-divider />
            <mu-list>
                <mu-sub-header style="text-align: left;">历史记录</mu-sub-header>
                <mu-list-item title="Trash">
                </mu-list-item>
                <mu-list-item title="Spam">
                </mu-list-item>
                <mu-list-item title="Follow up">
                </mu-list-item>
                <mu-list-item title="reSetAuthStatus" v-on:click="reSetAuthStatus">
                </mu-list-item>
            </mu-list>
        </mu-drawer>

        <!-- 主内容区域 -->
        <div class="example-content" :class="{'nav-hide': !open}">
            <router-view>

            </router-view>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    import defaul from '!raw-loader!muse-ui/dist/theme-default.css';
    import light from '!raw-loader!muse-ui/dist/theme-light.css';
    import dark from '!raw-loader!muse-ui/dist/theme-dark.css';
    import carbon from '!raw-loader!muse-ui/dist/theme-carbon.css';
    import teal from '!raw-loader!muse-ui/dist/theme-teal.css';

    export default {
        data () {
            return {
                theme: 'carbon',
                themes: {
                    defaul,
                    light,
                    dark,
                    carbon,
                    teal
                },
                winWidth: 0,
                open: true,
                docked: true,
                bottomNav: 'movies',
                bottomNavColor: 'movies',
            }
        },
        created: function () {
            this.widthChange(document.documentElement.clientWidth)
            const that = this
            window.onresize = function () {
                that.widthChange(document.documentElement.clientWidth)
//                console.log('Window width: ' + that.winWidth)
            }
            this.changeTheme('carbon')
        },
        methods: {
            changeTheme (theme) {
                this.theme = theme
                const styleEl = this.getThemeStyle();
                styleEl.innerHTML = this.themes[theme] || ''
            },
            getThemeStyle () {
                const themeId = 'muse-theme';
                let styleEl = document.getElementById(themeId)
                if (styleEl) return styleEl
                styleEl = document.createElement('style')
                styleEl.id = themeId
                document.body.appendChild(styleEl)
                return styleEl
            },
            toggle (flag) {
                this.open = !this.open
                // this.docked = !flag
            },
            widthChange (width) {
                if (width <= 993) {
                    this.open = false
                    this.docked = false
                } else {
                    this.open = true
                    this.docked = true
                }
            },
            reSetAuthStatus () {
                console.log(this.$store.state.authLogin)
                this.$store.commit('reSetAuthStatus')
            }
        },
        watch: {
            authStatus: {

            }
        }
    }
</script>

<style lang="less">
    .example-appbar {
        position: fixed;
        left: 256px;
        right: 0;
        top: 0;
        width: auto;
        -webkit-transition: all .45s cubic-bezier(.23,1,.32,1);
        transition: all .45s cubic-bezier(.23,1,.32,1);
    }
    .example-content {
        padding-top: 56px;
        padding-left: 256px;
        -webkit-transition: all .45s cubic-bezier(.23,1,.32,1);
        transition: all .45s cubic-bezier(.23,1,.32,1);
    }
    .example-appbar.nav-hide {
        left: 0;
    }
    .example-content.nav-hide {
        padding-left: 0;
    }


    @media (max-width: 993px){
        .example-appbar {
            left: 0;
        }
        .example-content {
            padding-left: 0;
        }
    }

    @media (min-width: 480px){
        .mu-appbar {
            height: 64px;
        }
        .example-content {
            padding-top: 64px;
        }
    }
    .appbar-search-field{
        color: #FFF;
        margin-bottom: 0;
    &.focus-state {
         color: #FFF;
     }
    .mu-text-field-hint {
        color: fade(#FFF, 54%);
    }
    .mu-text-field-input {
        color: #FFF;
    }
    .mu-text-field-focus-line {
        background-color: #FFF;
    }
    }
</style>
