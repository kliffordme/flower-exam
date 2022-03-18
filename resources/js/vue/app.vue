<template> 
    <div class="container"> 
        <add-item-form   v-on:reloadlist="getItems()"> </add-item-form>
        <product-list v-on:reloadorders="getOrders()" :items="items" v-on:reloadlist="getItems()"> </product-list>
        <order-list :orders="orders" v-on:reloadorders="getOrders()"> </order-list>
    </div>
</template>

<script> 
import addItemForm from './addItemForm.vue'
import ProductList from './productList.vue'
import OrderList from './orderList.vue'
export default {
  components: { addItemForm, ProductList, OrderList },
        data: function(){
        return {
            items: [

            ],
            orders: [

            ]
        }
    },
    created(){
        this.getItems()
        this.getOrders()
    }
    ,
    methods:{
        getItems(){
            try{
                axios({
                    method: 'get',
                    url: 'api/products'
                })
                .then((res) => {
                    console.log(res.data[0])
                    this.items = res.data[0]
                })
            }catch(e){

            }
        },
        getOrders(){
            axios({
                method: 'get',
                url: 'api/order'
            })
            .then((res)=>{
                this.orders = res.data[0]
                console.log(res.data[0])
            })
        }
    }
    }
</script>

<style scoped>
.container{
    min-height: 100vh;
    background: rgb(175, 170, 170);
    padding: 3rem;
}
</style>