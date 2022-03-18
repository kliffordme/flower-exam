<template>
    <h4>PRODUCTS</h4>
    <div v-for="item in items" :key="item.id" class="products">
        <div class="item-adjust">
        <h4>Product</h4>
        {{item.product_name}}
        </div>
        <div class="item-adjust">
        <h4>Description</h4>
        {{item.product_description}}
        </div>
        <div class="item-adjust">
        <h4>Quantity</h4>
        {{item.quantity}}
        </div>
        <div class="item-adjust">
        <h4>Price</h4>
        ${{item.prices}}.00
        </div>
        <div class="item-adjust">
        <h4>Status</h4>
        {{item.status === 1 ? 'active' : 'inactive'}}
        </div>
        <button @click="onDelete(item.id)" class="button">Delete</button>
        <button @click="onOrder(item.id, item.prices)" class="button">Order</button>
        <button @click="onDeactivate(item.id, item.status)" class="button">Deactivate</button>
    </div>
</template>

<script>
export default{
        props: ["items"],
        methods: {
            onDelete(id){
                console.log(id)
                try{
                axios({
                    method: 'delete',
                    url: `api/products/${id}`
                })
                .then((res)=> {
                    console.log(res)
                    this.$emit("reloadlist");

                })

                }catch(e){

                }

            },
            onDeactivate(id, stat){
                axios({
                    method: 'put',
                    url: `api/products/${id}`,
                    data: {
                        status: stat === 1 ? 0 : 1
                     }
                })
                .then((res)=> {
                    console.log(res)
                    this.$emit('reloadlist')
                })
            },
            onOrder(id, price){
                try{
                axios({
                    method: 'post',
                    url: 'api/order',
                    data: {
                        product_id: id,
                        user_id: localStorage.getItem('id'),
                        price: price
                    }
                })
                .then((res)=> {
                    console.log(res.data[0])
                    this.$emit('reloadorders')
                })
                }catch(e){

                }

            }

        }
}
</script>

<style scoped>
.products{
    margin: auto;
    display: flex;
    width: 80%;
    justify-content: space-between;
    align-items: center;
    padding: 5px;
}
.item-adjust{
    padding: 5px;
}
.button{
    cursor: pointer;
}
</style>
