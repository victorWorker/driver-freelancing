<template>
  <div class="row">
      <div class="col-lg-8 offset-md-2 mt-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">{{ language.name }}</label>
                        <input type="text" class="form-control" v-model="formData.name" placeholder="Enter Name">
                    </div>

                    <div class="form-group">
                        <label for="">{{ language.phone }}</label>
                        <input type="tel" class="form-control" v-model="formData.phone" placeholder="Enter Phone Number">
                    </div>

                    <div class="form-group">
                        <label for="">{{ language.bio }}</label>
                        <textarea class="form-control" rows="5" v-model="formData.about" placeholder="Enter Your Bio"></textarea>
                    </div>

                    <div class="form-group">
                        <label>{{ language.password }}</label>
                        <input type="password" name="" id="" v-model="formData.password" class="form-control" placeholder="Enter New Password">
                    </div>

                    <div class="form-group text-right">
                        <button class="btn btn-sm btn-success" @click.prevent="saveDetails">{{ language.savedetails }}</button>
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
             language: require(`../language/${$lang}/common.json`),
            formData: { }
        }
    },
    computed:{
        ...mapGetters('user', [ 'authUser', 'errors' ])
    },
    mounted() {
        this.formData = {
            name: this.authUser.name,
            phone: this.authUser.phone,
            about: this.authUser.about
        }
    },
    methods: {
        ...mapActions('user', [ 'updateTransporter', 'updateUser' ]),
        async saveDetails() {
            let resp = '';
            if(this.authUser.type === 'TRANSPORTER'){
                resp = await this.updateTransporter(this.formData);
            }else if(this.authUser.type === 'USER'){
                resp = await this.updateUser(this.formData);
            }
            
             if(resp === 'error') {
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swal.fire('Error', errors, 'error');
            }else if(resp === 'success') {
                Swals.toast('Profile Updated Successfully!', 'success');
            }
        }
    }
}
</script>

<style>

</style>