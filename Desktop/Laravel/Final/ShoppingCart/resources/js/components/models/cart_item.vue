<template>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{item.title}}</h5>
            <div class="card-text">
                <p style="float: left;margin-right: 8px;margin-top: 5px">
                    ${{item.price}}</p>
                    <input type="text" name="qty" v-model="qty">
                    <input type="submit" value="Change" @click="change" class="btn btn-success">
                    <input type="button" value="Remove" @click="remove" class="btn btn-danger">

            </div>
        </div>
    </div>


</template>

<script>
    export default {
        name: "cart_item",
        data() {
            return {
                qty:this.item.qty,
            }
        },
        methods:{
            remove() {
                this.$emit('remove', this.item.id)
            },
            change() {
                this.$emit('change', this.item.id,this.qty)
            },
        },
        props: ['item']

    }
</script>

<style scoped>

</style>
