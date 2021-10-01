<template>
  <div class="row">
      <div class="col-lg-8 offset-md-2 mt-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" v-model="formData.name" placeholder="Enter Name">
                    </div>

                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="tel" class="form-control" v-model="formData.phone" placeholder="Enter Phone Number">
                    </div>

                    <div class="form-group">
                        <label for="">Image </label>
                        <input type="file" class="form-control" id="ShipmentImage" accept="image/png, image/jpeg" @change="uploadFile('#ShipmentImage')"> 

                        <br>
                        <div class="progress my-4" v-if="barstart">
                            <div class="progress-bar" role="progressbar" :style="'width: '+progress+'%'" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
                        </div>
                        <img :src="`${baseURL}/shipments/${formData.image}`" v-if="formData.image != undefined"  alt="" class="img-fluid w-50 mb-3">
                        <img :src="`${baseURL}images/nia.jpg`" v-if="formData.image === null" class=" rounded align-self-center mb-3 w-50" />            
                    </div>

                    <div class="form-group">
                        <label for="">Your Bio</label>
                        <textarea class="form-control" rows="5" v-model="formData.about" placeholder="Enter Your Bio"></textarea>
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="" id="" v-model="formData.password" class="form-control" placeholder="Enter New Password">
                    </div>

                    <div class="form-group text-right">
                        <button class="btn btn-sm btn-success" @click.prevent="saveDetails">SAVE DETAILS</button>
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
            formData: { }, 
            barstart: false,
            pushurl:'',
            baseURL
        }
    },
    computed:{
        ...mapGetters('user', [ 'authUser', 'errors' ,'progress'])
    },
    mounted() {
        this.formData = {
            name: this.authUser.name,
            phone: this.authUser.phone,
            about: this.authUser.about,
            profileimage: this.authUser.profileimage
        }
    },
    methods: {
        ...mapActions('user', [ 'updateTransporter', 'updateUser' ,'uploadProfileImage' ,'uploaduserProfileImage']),
        async saveDetails() {
            let resp = '';
            if(this.authUser.type === 'TRANSPORTER'){
                resp = await this.updateTransporter(this.formData);
                this.pushurl='/transporter/dashboard';
            }else if(this.authUser.type === 'USER'){
                resp = await this.updateUser(this.formData);
                this.pushurl='/user/dashboard';
            }
            
             if(resp === 'error') {
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swal.fire('Error', errors, 'error');
            }else if(resp === 'success') {
                Swals.toast('Profile Updated Successfully!', 'success');
                this.$router.push(this.pushurl);
            }
        },
        uploadFile(id) {
            //alert(id);
            let file = document.querySelector(id).files[0];
            if(file.type.includes('jpg') || file.type.includes('jpeg') || file.type.includes('png')){

                if(this.authUser.type === 'TRANSPORTER'){
                
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = () => {
                    this.barstart = true;
                    this.uploadProfileImage(reader.result).then((response) => {
                        if(id === '#ShipmentImage'){
                            this.formData.image = response;
                            this.barstart = false;
                            console.log(this.formData.image );
                        }
                    }).catch(
                        () => {
                            
                        }
                    );
                }; 
                }
                else if(this.authUser.type === 'USER'){
                    
                    let reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onloadend = () => {
                        this.barstart = true;
                        this.uploaduserProfileImage(reader.result).then((response) => {
                            if(id === '#ShipmentImage'){
                                this.formData.image = response;
                                this.barstart = false;
                                console.log(this.formData.image );
                            }
                        }).catch(
                            () => {
                                
                            }
                        );
                    }; 
               }

            }else{
                alert('only image file is allowed')
            }
            
        },
    }
}
</script>

<style>

</style>