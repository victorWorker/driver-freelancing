<template>
  <div class="row">
     <div class="col-lg-6 offset-lg-3 grid-margin stretch-card mt-5 flex-column">
        <div class="mb-5" v-if="transactionDays !== null && transactionDays <= 30">
            <h4 class="font-weight-light">Last <span class="font-weight-bold">Transaction</span></h4>
            <div class="table-res-contain">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Method</th>
                    <th>Referencia</th>
                    <th>Entidade</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>#{{ lastSubTransaction.id }}</td>
                    <td>{{ lastSubTransaction.method }}</td>
                    <td>{{ lastSubTransaction.payment_details.referencia }}</td>
                    <td>{{ lastSubTransaction.payment_details.entidade }}</td>
                    <td>
                        <span :class="(lastSubTransaction.status === 'SUCCESS') ? 'badge badge-success' : (lastSubTransaction.status === 'FAILED') ? 'badge badge-danger' : 'badge badge-warning'">
                            {{ lastSubTransaction.status }}
                        </span>
                    </td>

                    <td>
                        <a href="#" class="small text-success" v-if="lastSubTransaction.status === 'PENDING'">Complete Payment</a>
                    </td>
                </tr>
            </table>
            </div>
            <div class="alert alert-primary mt-5 small"  v-if="!membership">
                Complete the payment above OR create a new payment request below.
            </div>
        </div>

        <div class="title text-center mb-3" v-if="!membership">
            <div class="font-weight-light">Great, <span class="font-weight-bold">{{ authUser.name }}</span>, Pay <span class="font-weight-bold">€5</span>  <br /> And enjoy our <i class="fa fa-star text-warning"></i> Premium <i class="fa fa-star text-warning"></i> services.</div>
        </div>
        
        <Payment v-if="!membership" amount="5" type="SUBSCRIPTION" link="/transporter/dashboard/subscribe" />

        <div class="card membershipCard"  v-if="membership">
            <div class="d-flex justify-content-between card-body bg-success text-white">
                <div>
                    <span>SUBSCRIBED TO</span>
                    <h3 class="font-weight-bold">€5</h3>
                    <span>PLAN</span>
                </div>
                
                <div>
                    <span> DATE</span>
                    <span class="d-block small font-weight-bold mb-3">{{ moment(authUser.membership_date).format('LL') }}</span>

                    <span>EXPIRY</span>
                    <span class="d-block small font-weight-bold text-danger">{{ moment(authUser.membership_date).add(1, 'months').format('LL') }}</span>
                </div>
            </div>
        </div>

     </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import moment from 'moment';
import Loading from '../common/Loading';
import Payment from '../common/Payment';
export default {
    components: { Loading, Payment },
    data() {
        return {
            baseURL,
            moment,
            formData: {
                paymentMethod: 'Multibanco',
            },
            transactionDays: null,
            loading: false,
            loadingText: 'Loading...',

        }
    },
    computed: {
        ...mapGetters('user', ['authUser']),
        ...mapGetters('transaction', ['transData', 'lastSubTransaction']),
        membership() {
            return this.authUser.membership != null && this.authUser.membership == 1 && this.authUser.membership_status == 'ACTIVE';
        }
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions('transaction', ['addSubscriptionTransaction', 'getLastSubscriptionTransactions' , 'confirmPayPalPayment']),
        async init() {
            let resp = await this.getLastSubscriptionTransactions();
            let today = moment();
            let transDate = moment(this.lastSubTransaction.created_at).format('YYYY-MM-DD')
            this.transactionDays = today.diff(transDate, 'days');
        },    
    }
}
</script>

<style>
.pay-logo{
    max-width: 85px;
}
.bordered-box {
    padding: 10px 15px;
    border-radius: 8px; 
    font-size: 14px;
    color: #aaaaaa;
    background: #f7f4f4;
}
label.form-check-label{
    font-size: 15px;
}
.membershipCard{
    border-top: 10px solid white;
}
.membershipCard > div{
    border-radius: 15px 15px 0px 0px;
}
</style>