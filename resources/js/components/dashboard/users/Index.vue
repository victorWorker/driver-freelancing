<template>
  <div class="row">
      <div class="col-lg-12 grid-margin rjan stretch-card">
            <div class="card">
                <div class="card-body">
                <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.all}}</span>  {{ language.users }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>{{language.name}}</th>
                        <th>{{language.email}}</th>
                        <th>{{language.phone}}</th>
                        <th>{{language.state}}</th>
                        <th>{{language.status}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users" :key="index">
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.phone }}</td>
                            <td>{{ user.state }}</td>
                            <td>
                                <label :class="(user.status === 'APPROVED') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ user.status }}</label>
                            </td>
                            <td>
                                <a href="#" 
                                    @click.prevent="approve(user.id)" 
                                    class="small" 
                                    v-if="user.status === 'UNAPPROVED'">
                                        {{language.approve}} | 
                                </a>  
                                <router-link :to="'/dash/users/view/'+user.id" class="small">{{language.view}} | </router-link>  
                                <a href="#" 
                                    @click.prevent="ban(user.id)" 
                                    class="small text-danger" 
                                    v-if="user.status === 'APPROVED'">
                                        {{language.ban}} | 
                                </a> 
                                <router-link :to="'/dash/users/add/'+user.id" class="small">{{language.addbadges}} </router-link>   
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="dash/users" :fetch="getUsers" />
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
        ...mapGetters("user", ['users', 'pagination']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", ["getUsers","banUser","approveUser"]),
        async init() {
            let resp = await this.getUsers(this.page);
            console.log(this.users);
        },
        async ban(id){
           await Swals.dialog(
                'Are You Sure?',
                'This Will Ban the User Permanently !',
                'Yes, Continue',
                'Banned',
                'user Banned Successfully.',
                this.banUser,
                id
            );
            this.getUsers(this.page);
        },
        async approve(id){
            await Swals.dialog(
                'Are You Sure?',
                'This Will Activate the user !',
                'Yes, Continue',
                'Activated',
                'user Activated Successfully.',
                this.approveUser,
                id
            );
            this.getUsers(this.page);
        }
    }
}
</script>

<style>

</style>