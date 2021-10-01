<template>
  <div class="row">
     <div class="col-lg-12 grid-margin rjan stretch-card">
            <div class="card">
                <div class="card-body">
                <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light"></span>  {{ language.users }}</h4>
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
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in clients" :key="index">
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.phone }}</td>
                                <td>{{ user.state }}</td>
                                <td>
                                    <label :class="(user.status === 'APPROVED') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ user.status }}</label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
  </div>
</template>

<script>
export default {

        data() {
            return {
              language: require(`../language/${$lang}/users.json`),
              page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
              clients: {},
            }
        },
        methods: {
            getClients(){
                axios.get('/dash/shipment/view/Clientlist/'+this.$route.params.id)
                     .then((response)=>{
                       this.clients = response.data;
                     })
            }
        },
        created() {
            this.getClients()
        }
    }
</script>