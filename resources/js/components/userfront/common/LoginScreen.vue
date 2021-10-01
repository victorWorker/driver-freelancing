<template>
  <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto text-center">
              <img :src="`${baseURL}images/yellowlogo.png`" alt="" class="mb-4">
              <div class="auto-form-wrapper">
                <form action="#">
                  <div class="form-group">
                    <label class="label">Email</label>
                    <div class="input-group">
                      <input type="email" class="form-control" v-model="email" placeholder="Email">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" v-model="password" placeholder="*********">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary submit-btn btn-block" @click.prevent="login">Login</button>
                  </div>
                  <div class="form-group d-flex justify-content-between">
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
                    </div>
                    <!-- <a href="#" class="text-small forgot-password text-black">Forgot Password</a> -->
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
export default {
    data() {
        return {
            email: '',
            password: '',
            baseURL,
            token,
        }
    },
    computed: {
        ...mapGetters('common', ['errors']),
    },
    created() {
        if(this.token !== 'N/A') {
            window.location.href = baseURL;
        }
    },
    methods: {
        ...mapActions('common', ['authLogin']),
        async login() {
            let resp = await this.authLogin({ email: this.email, password: this.password});
            if(resp != 'error'){
                //Login user
                localStorage.setItem('token', resp.token);
                localStorage.setItem('userId', resp.user.id);
                localStorage.setItem('userName', resp.user.name);
                localStorage.setItem('userType', resp.user.type);
                localStorage.setItem('userEmail', resp.user.email);
                localStorage.setItem('role', resp.user.type.toLowerCase());
                let url = this.baseURL;
                if(resp.user.type === 'ROOT'){
                    url = url + 'dash';
                }else{
                    url = url + resp.user.type.toLowerCase() + '/dashboard';
                }
                setTimeout(function(){
                    window.location.href = url;
                },500)
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

<style>

</style>