<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.send}}</span>  {{ language.email }}</h4>
                <span class="clearfix"></span>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" v-model="formData.subject" class="form-control" placeholder="Enter Subject">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" v-model="formData.name" @keypress="findUser" class="form-control" placeholder="Enter username">
                                    </div>

                                    <div class="form-group" v-if="formData.emails.length > 0">
                                        <span class="badge badge-success text-white mr-1" v-for="(email, index) in formData.emails" :key="index">{{email.name}}</span>
                                    </div>
                                    
                                    <div class="form-group" v-if="searchStatus">
                                        <label>Select User</label>
                                        <select class="form-control" v-model="currentEmail" @change="addUser">
                                            <option v-for="(user, index) in users" :key="index" :value="user">{{ user.name }}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <textarea class="form-control" v-model="formData.message" placeholder="Enter Message" rows="6"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button @click.prevent="submit" class="btn btn-success">{{ language.send }} {{ language.email }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';

export default {
    data() {
        return {
            language: require(`../language/${$lang}/email.json`),
            searchStatus: false,
            currentEmail: {}, 
            formData: {
                subject: '',
                message: '',
                name: '',
                emails: []
            }
        }
    },
    computed: {
        ...mapGetters("user", ['users', 'errors']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", ["searchUser", "sendMail"]),
        async init() {

        },
        async findUser() {
            if(this.formData.name.length > 1){
                this.searchStatus = true;
                let resp = await this.searchUser({ name: this.formData.name });
            } 
        },
        addUser() {
            this.formData.emails.push(this.currentEmail);
            this.formData.name = '';
            this.searchStatus = false;
        },
        async submit() {
            let resp = await this.sendMail(this.formData);
        }
    }
}
</script>

<style>

</style>