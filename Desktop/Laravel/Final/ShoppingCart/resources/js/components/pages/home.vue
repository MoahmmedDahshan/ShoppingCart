<template>

    <div class="container">

        <div class="row">


            <div class="col-lg-9">

                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" style="height: 300px; width:100%;" src="https://simplecore.intel.com/itpeernetwork/wp-content/uploads/sites/38/2017/12/retail_shopping_cart_1200.png" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" style="height: 300px; width:100%;" src="https://mercuryorder.com/wp-content/uploads/2020/06/online-shopping.jpg" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" style="height: 300px; width:100%;" src="https://cdn.vox-cdn.com/thumbor/84u_eUYdeB-6Zxjgb2MTX41wEs0=/0x0:1200x530/1200x0/filters:focal(0x0:1200x530):no_upscale()/cdn.vox-cdn.com/uploads/chorus_asset/file/11816571/vigamer.jpg" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="row">

                    <product v-for="product in products" :key="product.id" :product="product" @addCart="addToCart" v-if="Object.keys(products).length !== 0 "/>
                    <p v-if="Object.keys(products).length === 0 ">No Product To display Now</p>

                </div>

            </div>

        </div>

    </div>
</template>

<script>
    import Product from "../models/product";


    export default {
        name: "home",

        data() {
            return {
                products: {},
            }
        },
        methods:{
            getProducts() {
                window.axios.get('/api/products/').then(({data}) => {
                    if (data.length > 0) {
                        this.products = data;
                    } else {
                        this.products = {}
                    }
                    console.log(data);
                }).catch(errors => {
                    if (errors.response.status == 500 && errors.response.data.error) {
                        console.log('error')
                    }
                })
            },
            addToCart(id){
                window.axios.get(`/api/cart/add/${id}`).then(({data}) => {
                    // notify('success','تم حذف المستخدم بنجاح');
                    this.$notify.success({
                        position: 'bottom center',
                        title: 'Success',
                        msg: 'Add Product To Cart Successfuly',
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
            this.getProducts()
        },
        components: {Product},
    }
</script>

<style scoped>

</style>
