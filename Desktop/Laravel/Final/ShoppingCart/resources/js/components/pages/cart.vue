<template>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-9">

                <div class="row">
                        <div class="col-md-8">
                            <item v-for="item in cart.items" :key="item.id" :item="item" @change="change" @remove="remove" v-if="Object.keys(cart.items).length !== 0 "/>
                            <p v-if="typeof cart.items !== 'object' || Object.keys(cart.items).length === 0 ">No Product In The Cart</p>
                        </div>
                    </div>

            </div>

        </div>

    </div>
</template>

<script>
    import item from "../models/cart_item";

    export default {
        name: "cart",

        data() {
            return {
                cart: [],
            }
        },
        methods:{
            getCart() {
                window.axios.get('/api/cart/show/').then(({data}) => {
                    if (data !== null){
                        this.cart = data;
                    }else {
                        this.cart = {};
                    }

                    console.log(this.cart)
                }).catch(errors => {
                    if (errors.response.status == 500 && errors.response.data.error) {
                        console.log('error')
                    }
                })
            },

            remove(id){
                window.axios.post(`/api/cart/delete/${id}`).then(({item}) => {
                    Vue.delete(this.cart.items, id);

                    this.$notify.success({
                        position: 'bottom center',
                        title: 'Success',
                        msg: 'remove product from cart',
                        timeout: 1000
                    })
                }).catch(errors => {
                    if (errors.response.status == 500 && errors.response.data.error) {
                        console.log('error')
                    }
                })
            },

            change(id,qty){
                console.log(qty);
                window.axios.post(`/api/cart/update/${id}`,{qty}).then(({item}) => {
                    // Vue.delete(this.cart.items, id)
                    this.$notify.success({
                        position: 'bottom center',
                        title: 'Success',
                        msg: 'Update Price Successful',
                        timeout: 1000
                    })
                }).catch(errors => {
                    if (errors.response.status == 500 && errors.response.data.error) {
                        console.log('error')
                    }
                })
            }


        },
        created() {
            this.getCart()
        },
        components: {item},
    }
</script>

<style scoped>

</style>
