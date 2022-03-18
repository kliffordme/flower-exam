<template>
    <h3>ORDERS</h3>
    <div v-for="order in orders" :key="order.id" class="orders">
        <div>
            <h4>Order ID</h4>
            {{order.id}}
        </div>
        <div>
            <h4>Product</h4>
            {{order.product.product_name}}
        </div>
        <div>
            <h4>Price</h4>
            ${{order.price}}.00
        </div>
    </div>
</template>

<script>
export default {
    props: ['orders']
}
</script>

<style scoped>
.orders{
    border: 1px solid black;
    margin: auto;
    display: flex;
    width: 80%;
    justify-content: space-between;
    align-items: center;
    padding: 1rem ;
}
</style>