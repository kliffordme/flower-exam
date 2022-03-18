<template>
    <div class="container">
        <div class="labels">
        <label>First name:</label>
        <input type="text" v-model="item.first_name" placeholder="enter first name"/>         
        </div>
        <div class="labels">
        <label>Last name:</label>
        <input type="text"  v-model="item.last_name" placeholder="enter last name" />
        </div>
        <div class="labels">
        <label>Email address:</label>
        <input type="text"  v-model="item.email_address" placeholder="enter email address" />
        </div>
        <div class="labels">
        <label>Mobile number:</label>
        <input type="text"  v-model="item.mobile_number" placeholder="enter mobile number" />
        </div>
        <div class="labels">
        <label>Address:</label>
        <input type="text"  v-model="item.address" placeholder="enter address" />
        </div>
        <button class="button" @click="loginUser()">Enter</button>
    </div>
</template>

<script>
export default{
    data: function() {
        return {
            item: {
                first_name: '',
                last_name: '',
                email_address: '',
                mobile_number: '',
                address: '',
            }
        }
    },
    methods: {
        loginUser() {
            if(this.item.first_name === "" || this.item.last_name === "" || this.item.email_address === "" || this.item.mobile_number === "" || this.item.address === ""){
                return
            }
            try{
            const data = axios({
                method: 'post',
                url: 'api/users',
                data: this.item
            })
            .then((res)=>
            {
            localStorage.setItem('id', res.data[0].id)
                if(res.data.success){
                    window.location.href = '/products'
                }
            }
            )
            
            }catch(e){
                console.log(e)
            }
        }
    }
    
}
</script>

<style scoped>
.container{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    padding: 2rem;
    background: rgb(194, 188, 188);
    height: 100vh;
}
.labels{
    padding: 1rem;
    width: 40vw;
    display: flex;
    justify-content: space-between;
}
.button{
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
}
</style>
