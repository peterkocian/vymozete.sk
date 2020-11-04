<template>
    <a id="toTop" v-show="show" @click.prevent="scrollToTop">
        <img :src="src" alt="back_to_top">
    </a>
</template>

<script>
export default {
    props: ['src'],
    data() {
        return {
            show: false,
        }
    },

    mounted: function () {
        window.addEventListener('scroll', this.handleScroll);

        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        //mobile menu open/close
        document.querySelector('#myTopnav i.menu').addEventListener('click', function () {
            document.querySelector('#mySidenav').classList.toggle('open');
        });
        document.querySelector('#mySidenav a').addEventListener('click', function () {
            document.querySelector('#mySidenav').classList.toggle('open');
        });
    },

    methods: {
        handleScroll() {
            this.show = window.pageYOffset > 1000;
            // console.log('here',window.pageYOffset);
        },
        scrollToTop() {
            // window.scrollTo(0,0);
            window.scroll({
                top: 0,
                left: 0,
                behavior: 'smooth'
            })
        },
        hide() {
            this.show = false;
            this.reset();
        },
        reset() {
            this.type = '';
            this.body = '';
        }
    }
}
</script>
