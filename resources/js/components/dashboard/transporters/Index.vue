<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                <h4 class="font-weight-bolder mt-1">
                    <span class="font-weight-light">{{language.all}} </span>  {{ language.transporters }}
                    <router-link :to="`/dash/transporters/nodocument`" class="small text-success"> {{language.all_transporter_with_no_documents}} </router-link>
                    <router-link :to="`/dash/transporters/sendsms`" class="small btn-info" style="padding:10px;"> SELECT TRANSPORTER TO SEND SMS </router-link>
                    </h4>
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
                                <label :class="(transporter.status === 'APPROVED') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ transporter.status }}</label>
                            </td>
                            <td>
                                <a href="#" 
                                    @click.prevent="approve(transporter.id)" 
                                    class="small" 
                                    v-if="transporter.status === 'UNAPPROVED'">
                                        {{language.approve}} | 
                                </a>  
                                <router-link  :to="`/dash/transporters/view/${transporter.id}`" class="small">{{language.view}} | </router-link>  
                                <a  href="#" 
                                    @click.prevent="ban(transporter.id)" 
                                    class="small text-danger" 
                                    v-if="transporter.status === 'APPROVED'">
                                        {{language.ban}} | 
                                </a>  
                                <router-link :to="`/dash/transporters/documents/view/${transporter.id}`" v-if="transporter.documents != null" class="small text-success">View Documents | </router-link>
                                <router-link :to="'/dash/users/add/'+transporter.id" class="small">{{language.addbadges}} </router-link>  |  
                                 <a href="javascript:void(0)" @click.prevent="removeUser(transporter.id)" class="small text-danger">Delete  </a>
                         </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="dash/transporters" :fetch="getTransporters" />
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
        }
    },
    computed: {
        ...mapGetters("user", ['transporters', 'pagination']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", ["getTransporters","banUser","approveUser","deleteUser"]),
        async init() {
            let resp = await this.getTransporters(this.page);
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