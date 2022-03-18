<template>
    <div class="addItem">
        <h4>Add a product:</h4>
        <label>Product name</label>
        <input type="text" v-model="item.product_name" maxlength="60" />
        <label>description</label>
        <input type="text" v-model="item.product_description" />
        <label>quantity</label>
        <input type="number" v-model="item.quantity" />
        <label>Price</label>
        <input type="number" v-model="item.prices" />
        <button @click="addProducts()" class="button">Save</button>
    </div>
</template>

<script>
    export default{
        data: function() {
            return {
                item: {
                    product_name: '',
                    product_description: '',
                    quantity: '',
                    prices: '',
                }
            }
        },
        methods: {
            addProducts(){
                if(this.item.product_name === "" || this.item.product_description === "" ){
                    return
                }
                try{
                    axios({
                        method: 'post',
                        url: '/api/products',
                        data: this.item,
                    })
                    .then((res)=>{
                        console.log(res)
                        this.$emit("reloadlist");
                    })
                }catch(e){

                }
            }
        }
    }
</script>

<style scoped> 
.addItem{
    display: flex;
    justify-content: center;
    flex-direction: column;
    margin: auto;
    width: 40vw;
}
.button{
    margin: 1rem 0;
    cursor: pointer;
}
</style>