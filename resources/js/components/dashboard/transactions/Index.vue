<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
               
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.all}}</span>  {{ language.transactions }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{language.user}}</th>
                        <th>{{language.bid_id}}</th>
                        <th>{{language.shipment_id}}</th>
                        <th>{{language.type}}</th>
                        <th>{{language.status}}</th>
                        <th>{{language.amount}}</th>
                        <th>{{language.date}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(transaction, index) in transactions" :key="index">
                            <td>{{ transaction.id }}</td>
                            <td>{{ transaction.user.name }}</td>
                            <td v-if="transaction.bid_id == null">{{  'N/A' }}</td>
                            <td v-else><router-link :to="`/dash/jobs/view/bidlist/${transaction.shipment_id}`" class="small">{{transaction.bid_id}}  </router-link></td>
                            <td>{{ (transaction.shipment_id != null) ? transaction.shipment_id : 'N/A' }}</td>
                            <td> 
                                <span class="badge badge-secondary">
                                    {{ transaction.type }}
                                </span>
                            </td>
                            <td>
                                <span 
                                    :class="(transaction.status === 'SUCCESS') ? 'badge badge-success text-white' : (transaction.status === 'FAILED') ? 'badge badge-danger text-white' : 'badge badge-warning text-white'">
                                    {{ transaction.status }}
                                </span>
                            </td>
                            <td><h5 class="font-weight-bold text-dark">€{{ transaction.amount }}</h5></td>
                            <td>
                                <span class="date">{{ moment(transaction.created_at).format('LLL') }}</span>
                            </td>
                            <td>
                                
                                 <a href="javascript:void(0)" v-if="transaction.status === 'PENDING'" @click.prevent="approvePayment(transaction.id)" class="small text-info"> {{language.approve}} </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>

        </div>

        <Pagination :pagination="pagination" route="dash/transactions" :fetch="getTransactions" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
import Pagination from '../common/Pagination';

export default {
    components: { Pagination },
    data() {
        return {
            language: require(`../language/${$lang}/transactions.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            moment,
               editing: false,
        }
    },
    computed: {
        ...mapGetters("transaction", ['transactions', 'pagination']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("transaction", ["getTransactions","updatePayment"]),

        async init() {
            let resp = await this.getTransactions(this.page);
        },
        async approvePayment(id){
             await Swals.dialog(
                'Are You Sure?',
                'This Will Transaction Approved !',
                'Yes',
                'Approved',
                'Transaction Approved Successfully.',
                this.updatePayment,
                id
            );
            this.getTransactions(this.page);
        }
          
    }
}
</script>

<style>
.date{
    font-size: 12px;
    color: #ababab;
}
table{
    overflow-x: scroll !important;
}
</style>