<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <router-link class="menu-item" to="/">Example Shopping Cart</router-link>

            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#" style="text-decoration: none">
                            <router-link class="menu-item" to="/">Home</router-link>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">

                            <router-link class="menu-item" to="/cart"><i class="fas fa-shopping-cart"></i>{{totalQty}}</router-link>
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "sidebar",
        data() {
            return {
                totalQty: 0,
            }
        },
        methods:{
            getCart() {
                window.axios.get('/api/cart/show/').then(({data}) => {
                    if (data !== null){
                        this.totalQty = data.totalQty;
                    }else {
                        this.totalQty = 0;
                    }

                }).catch(errors => {
                    if (errors.response.status == 500 && errors.response.data.error) {
                        console.log('error')
                    }
                })
            },
        },
        created() {
            this.getCart();
        }
    }
</script>

<style scoped>
    a:hover{
        text-decoration: none;
        color:white
    }
    a{
        color:white

    }
</style>
