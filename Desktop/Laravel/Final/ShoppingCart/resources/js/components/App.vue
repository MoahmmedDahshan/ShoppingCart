<template>
    <div class="app">
        <sidebar />
        <router-view></router-view>

    </div>

</template>

<script>
    import sidebar from './layout/sidebar';
    import home from './pages/home';
    import cart from './pages/cart';
    export default {
        name: "App",
        components:{
            sidebar,
        }
    }


</script>
