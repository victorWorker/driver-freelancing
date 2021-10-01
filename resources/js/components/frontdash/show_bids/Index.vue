<template>
  <div class="row">
      <div class="col-lg-12 offset-md-0 mt-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.bid_details}}</span></h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{language.title}}</th>
                        <th>{{language.description}}</th>
                        <th>{{language.collection}}</th>
                        <th>{{language.delivery}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(bid, index) in bids" :key="index">
                        <td>{{ (index + 1) }}</td>
                        <td>{{ bid.title }}</td>
                        <td>{{ bid.description }}</td>
                        <td>{{ bid.collection }}</td>
                        <td>{{ bid.delivery }}</td>
                        <td>{{ bid.status }}</td>
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
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
import Pagination from '../common/Pagination';
export default {

        data() {
            return {
              language: require(`../language/${$lang}/bidlist.json`),
              page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
              bids: {},
            }
        },
        methods: {
            getBids(){
                axios.get('/transpoter/bidlist/'+this.$route.params.id)
                     .then((response)=>{
                       this.bids = response.data;
                     })
            }
        },
        created() {
            this.getBids()
        }
    }
</script>