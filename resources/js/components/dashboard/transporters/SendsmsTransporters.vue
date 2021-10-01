<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">SELECT TRANSPORTERS TO SEND SMS</span></h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>{{language.name}}</th>
                        <th>{{language.email}}</th>
                        <th>{{language.phone}}</th>
                        <th>{{language.status}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(transporter, index) in transporters" :key="index">
                            
                            <td>{{ transporter.name }}</td>
                            <td>{{ transporter.email }}</td>
                            <td>{{ transporter.phone }}</td>
                            <td>
                                <label :class="(transporter.is_send_sms === 'YES') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ transporter.is_send_sms }}</label>
                            </td>
                            <td>
                                <a href="#" 
                                    @click.prevent="setSMS(transporter.is_send_sms,transporter.id)" 
                                    class="small" 
                                    v-if="transporter.is_send_sms === 'NO'">
                                        SET SMS 
                                </a> 
                                <a href="#" 
                                    @click.prevent="setSMS(transporter.is_send_sms,transporter.id)" 
                                    class="small" 
                                    v-if="transporter.is_send_sms === 'YES'">
                                        UNSET SMS
                                </a> 
                         </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="dash/transporters/sendsms" :fetch="getTransporters" />
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
            rolesSelected:''
        }
    },
    computed: {
        ...mapGetters("user", ['transporters', 'pagination']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", ["getTransporters","banUser","approveUser","deleteUser","setUserSMS","unsetUserSMS"]),
        async init() {
            let resp = await this.getTransporters(this.page);
            console.log(this.transporters);
        },
        async setSMS(smsstatus,id){
            //alert(smsstatus+id);
            if(smsstatus=="YES"){
                await Swals.dialog(
                    'Are You Sure?',
                    'This Will set sms send FALSE !',
                    'Yes, Continue',
                    'SMS UNSET',
                    'SMS unset Successfully.',
                    this.unsetUserSMS,
                    id
                );
            }
            if(smsstatus=="NO"){
                await Swals.dialog(
                    'Are You Sure?',
                    'This Will set sms send true !',
                    'Yes, Continue',
                    'SMS SET',
                    'SMS Set Successfully.',
                    this.setUserSMS,
                    id
                );
            }
            this.getTransporters(this.page);

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
            this.getTransporters(this.page);
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
            this.getTransporters(this.page);
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
            this.getTransporters(this.page);
        },
    }
}
</script>

<style>

</style>