<template>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
            <a href="#"><img class="card-img-top"  :src="product.image" alt=""></a>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="#">{{product.title}}</a>
                </h4>
                <h5>{{product.price}}</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
            </div>
            <div class="card-footer">
                <button class="btn btn-success" style="float: left">Buy</button>
                <button class="btn btn-info" style="float: right" @click="addCart"><i class="fas fa-cart-plus"></i>

                </button>
            </div>
        </div>
    </div>


</template>

<script>
    export default {
        name: "product",
        methods:{
            addCart() {
                this.$emit('addCart', this.product.id)
            },
        },
        props: ['product']

    }
</script>

<style scoped>

</style>
