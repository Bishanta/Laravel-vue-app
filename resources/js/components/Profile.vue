<template>

    <div class="grid-container">
        <HeaderComponent/>
        <div class="menu-icon active" id="menu-icon" >
            <i class="fas fa-bars"></i>
        </div>

        <!--
            Side menu content starts
        -->
        <Nav/>
        <!--
            Side menu content ends
        -->
         <!--MAIN CONTENTS THE CONTENTS-->
        <main class="main" v-if="user != null && products != null">
            <section class="container">

                <div class="mt-20">
                    <div style="width: 90%; margin: auto;display:block;" class="msg_success" v-if="message != null">
                        {{message}}
                    </div>
                </div>

                <div class="profile-container">
                    <div class="profile-display mt-20 mb-20">
                    <div class="wrapper">
                        <div class="left">
                            <img :src="user.img" alt="user" width="100">
                            <h5>User Role:</h5>
                            <p v-if="user.role == 2">ADMIN</p>
                            <p v-if="user.role == 1">EDITOR</p>
                        </div>
                        <div class="right">
                            <div class="info">
                                <h3>Information</h3>
                                <div class="info_data">
                                    <div class="data">
                                        <h4>Email</h4>
                                        <p>{{user.email}}</p>
                                    </div>
                                    <div class="data">
                                    <h4>User Name</h4>
                                        <p>{{user.name}}</p>
                                </div>
                                </div>
                            </div>
                            
                            <div class="projects">
                                    <h3>STATUS</h3>
                                    <div class="projects_data">
                                        <div class="data">
                                            <h4>Account Type</h4>
                                            <p v-if="user.role == 2">ADMIN</p>
                                            <p v-if="user.role == 1">EDITOR</p>
                                        </div>
                                        <div class="data">
                                        <h4>Products Created:</h4>
                                            <p v-text="products.length"></p>
                                    </div>
                                    </div>
                                </div>
                            
                                <div class="social_media" v-if="user.role != 0">

                                    <i class="fas fa-user-check" v-if="user.role != 0"></i> <span>Active</span>

                                </div>
                                <div class="social_media red" v-if="user.role == 0">

                                    <i class="fas fa-user-check" v-if="user.role == 0"></i> <span class="red">Deactived</span>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-edit mt-20 mb-20">

                        <div class="wrapper">
                            <div class="right">
                                <div class="info">
                                    <h3>EDIT INFO</h3>
                                <form @submit.prevent="updateUser">
                                    <input type='text' name="name"  value="" v-model="user.name"/>
                                    <p style="color:red;margin-bottom:10px" v-if="errors.name">{{errors.name[0]}}</p>
                                    <input type='password' name="password"  placeholder="password" v-model="user.password"/>
                                    <p style="color:red;margin-bottom:10px" v-if="errors.password">{{errors.password[0]}}</p>
                                    <input type='password' name="confirm_password"  placeholder="confirm password" v-model="user.password_confirmation"/>
                                    <p style="color:red;margin-bottom:10px" v-if="errors.confirm_password">{{errors.confirm_password[0]}}</p>

                                    <button type="submit" name="user_edit" class="register_btn">EDIT INFO</button><br>
                                </form>
                                

                                </div>
                            </div>
                        </div>

                        
                        </div>
                </div>
        </section>
            </main>
        </div>

</template>

<script>
import Nav from './Nav';
import HeaderComponent from './Header-component.vue';

    export default {
        components: {
            Nav,
            HeaderComponent
        },
        data(){
            return{
                user: null,
                isActive: false,
                products: null,
                errors: [],
                message: null

            }
        },
        methods:{
            getProductsUser() {
                axios.get('/api/products').then(response => {
                    console.log(response.data);
                    this.products = response.data;

                });
            },
            updateUser() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    console.log(this.user);
                    axios.put(`/api/user/update/${this.user.id}`, this.user)
                    .then((response) => {
                        this.user = response.data;
                        this.message = "Profile edited successfully!"
                    })
                    .catch(error => this.errors = error.response.data.errors);
                });
            }

        },
        mounted(){

                axios.get('/api/user')
                .then((res)=>{
                    this.user = res.data //sets the user details
                    this.products = this.getProductsUser();
                })
                .catch(error => console.log('Error: ', error));





            // axios.get('/sanctum/csrf-cookie').then(response => {
            //     // axios.post('/login', this.formData).then(response => {
            //     //     this.getSecrets();
            //     // });
                
            //     axios.post('api/login', this.formData)
            //     .then(() => {
            //         //login route checks for user and returns user if found

            //     //returned user is send to getProducts where products specific to the user is fetched.
            //     // this.getProducts();
            //     //redirect to editor and if admin is true redirect to admin
            //     this.$router.push({name: "Editor"})
            //     });


            // });
        }
    }
</script>

