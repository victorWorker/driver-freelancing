<template>
<div class="vue-container">
    <!-- <MobileMenu /> -->
     <div class="section mobilepadding">
        <div class="divider text-center my-5">
            <h1 class="primaryheavyfont">{{ language.forgot_password }}</h1> 
        </div>
        <div class="container">
            <div class="row">           
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div class="row flex-column mt-5">
                        <div class="inputingroup">
                            <label class="uppercase">{{ language.email }}</label>
                            <input type="text" class="form-control" v-model="email" :placeholder="language.email_placeholder">
                        </div>
                        <button class="yellowbtn w-50 mt-5 mb-4 uppercase"  @click.prevent="forgot">{{ language.send }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>






</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    data() {
        return {
            baseURL,
             email: '',
            language: require(`../language/${$lang}/register.json`),
        }
    },
      methods: {
        ...mapActions('common', ['forgetPassword']),
        async forgot() {
            let resp = await this.forgetPassword({ email: this.email});
            // console.log(resp)
            if(resp != 'error'){
                //Login user
                 Swal.fire({
                    icon: 'success',
                    title: 'Alert',
                    text: 'We have send to reset link on your mail.',
                })
            }else{
                //Display Error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Incorrect Username/Password',
                })
            }
        }
    }
}
</script>
