<template>
<div class="vue-container">
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
                                <label class="uppercase">{{ language.password }}</label>
                                <input type="password" class="form-control"  v-model="password" :placeholder="language.password_placeholder">
                            </div>
                            <div class="inputingroup">
                                <label class="uppercase">{{ language.password }}</label>
                                <input type="password" class="form-control"  v-model="cpassword" :placeholder="language.password_placeholder">
                            </div>
                        <button class="yellowbtn w-50 mt-5 mb-4 uppercase"  @click.prevent="reset">{{ language.reset }}</button>
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
             password: '',
             cpassword: '',
            language: require(`../language/${$lang}/register.json`),
        }
    },
      methods: {
        ...mapActions('common', ['resetPassword']),
        async reset() {
            let resp = await this.resetPassword({id:this.$route.params.id, password: this.password,cpassword: this.cpassword});
            // console.log(resp)
            if(resp != 'error'){
                //Login user
                 Swal.fire({
                    icon: 'success',
                    title: 'Alert',
                    text: 'Your Password has been reset.',
                })
            }else{
                //Display Error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password Not Matched',
                })
            }
        }
    }
}
</script>
