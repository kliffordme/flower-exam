<template>
    <h4>PRODUCTS</h4>
    <div v-for="item in items"  :key="item.id" >
        <div v-if="item.status === 1" class="products"> 
        <div class="item-adjust"  >
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
        </div>
        <div v-else class="products">
        <div class="item-adjust"  >
        <h4>Product</h4>
        <input v-model="edits.newProd" />
        </div>
        <div class="item-adjust">
        <h4>Description</h4>
        <input v-model="edits.newDesc"/>
        </div>
        <div class="item-adjust">
        <h4>Quantity</h4>
        <input v-model="edits.newQuan" type="number" />
        </div>
        <div class="item-adjust">
        <h4>Price</h4>
        <input v-model="edits.newPri" type="number"/>
        </div>

        </div>


        <div>
            <!-- <input :value="item.status" /> -->
        <button @click="onDelete(item.id)" class="button">Delete</button>
        <button v-if="item.status === 1" 
        @click="onUpdate(
            item.id, 
            item.status, 
            item.product_name,
            item.product_description,
            item.quantity,
            item.prices
            )" 
        class="button">Update</button>
        <button @click="onEdit(item.id, item.status)" v-else class="button">Save</button>
        <button @click="onOrder(item.id, item.prices)" class="button">Order</button>
        </div>
    </div>
    
</template>

<script>
export default{
        props: ["items"],
        data: function(){
            return {
                edits : {
                    newProd: '',
                    newDesc: '',
                    newQuan: '',
                    newPri: ''
                }
            }

        },
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

            },
            onUpdate(id, stat, name, desc, quan, pri){
                this.edits.newProd = name
                this.edits.newDesc = desc
                this.edits.newQuan = quan
                this.edits.newPri = pri
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
            onEdit(id, stat){
                console.log(id, stat)
                console.log(this.edits)
                axios({
                    method: 'put',
                    url: `api/products/${id}`,
                    data: {
                        product_name: this.edits.newProd,
                        product_description: this.edits.newDesc,
                        quantity: this.edits.newQuan,
                        prices: this.edits.newPri,
                        status: 1,
                    }
                })
                .then((res)=> {
                    console.log(res)
                    this.$emit('reloadlist')
                })
            }

        }
}
</script>

<style scoped>
.products{
    margin: 1rem auto;
    display: flex;
    min-width: 80%;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    border: 1px solid black;
}
.item-adjust{
    padding: 5px;
}
.button{
    cursor: pointer;
    margin: 5px;
}

</style>
