<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.all_transporter_with_no_documents}}</span> <button v-on:click="sendCancelAccount" class="btn btn-primary"> {{language.send_email_button}}</button></h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>{{language.name}}</th>
                        <th>{{language.email}}</th>
                        <th>{{language.phone}}</th>
                        <th>{{language.status}}</th>
                        <th>{{language.email_status}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(transporter, index) in transporters" :key="index">
                            <td>{{ transporter.name }}</td>
                            <td>{{ transporter.email }}</td>
                            <td>{{ transporter.phone }}</td>
                            <td>
                                <label :class="(transporter.status === 'APPROVED') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ transporter.status }}</label>
                            </td>
                            <td>
                                   
                                 <a href="javascript:void(0)" v-if="transporter.cancel_account_email == 'send'" class="small text-success"> {{language.email_send}} </a>
                                 <a href="javascript:void(0)" v-else class="small text-danger"> {{language.email_not_send}}  </a>
                         </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="dash/transporters/nodocument" :fetch="getTransportersNoDocuments" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import Pagination from '../common/Pagination';

export default {
    components: { Pagination },
    data() {
        return {
            language: require(`../language/${$lang}/users.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            formData: {
                email:'rere',
                user_id:'1',
                shipment_id:'2',
            },
        }
    },
    computed: {
        ...mapGetters("user", ['transporters', 'pagination']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", ["getTransportersNoDocuments","banUser","approveUser","deleteUser"]),
        async init() {
            let resp = await this.getTransportersNoDocuments(this.page);
        },
        async ban(id){
           await Swals.dialog(
                'Are You Sure?',
                'This Will Ban the User Permanently !',
                'Yes, Continue',
                'Banned',
                'Transporter Banned Successfully.',
                this.banUser,
                id
            );
            this.getTransportersNoDocuments(this.page);
        },
        async sendCancelAccount(){
               alert();
                axios.get('/admin/users/sendcancelemail')
                     .then((response)=>{
                       console.log(response.data);
                })
        },
        async approve(id){
            await Swals.dialog(
                'Are You Sure?',
                'This Will Activate the Transporter !',
                'Yes, Continue',
                'Activated',
                'Transporter Activated Successfully.',
                this.approveUser,
                id
            );
            this.getTransportersNoDocuments(this.page);
        },
        async removeUser(id){
           await Swals.dialog(
                'Are You Sure?',
                'This Will Delete  Transporter Permanently !',
                'Yes, Continue',
                'Deleted',
                'Transporter Deleted Successfully.',
                this.deleteUser,
                id
            );
            this.getTransportersNoDocuments(this.page);
        },
    }
}
</script>

<style>

</style>