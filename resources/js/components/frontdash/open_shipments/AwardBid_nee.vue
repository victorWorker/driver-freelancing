<template>
<div class="row">
     <div class="col-lg-12 grid-margin stretch-card">
        <div class="card mt-3 px-4 py-4">

            <div class="row ">
                <div class="col-md-6">
                    <h5 class="font-weight-light">Enter Actual Shipment Location Details</h5>
                    <div class="form-group mt-5">
                        <label for="">Phone Number</label>
                        <input type="tel" name="" id="" v-model="formData.phone" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <label for="">Complete Address</label>
                        <textarea name="" id="" class="form-control" v-model="formData.address" rows="5" placeholder="Full Address"></textarea> 
                    </div>
                </div>
                <div class="col-md-6 payment-section33">
                     <div class="card rounded invoice-info" style="display:none;width: 100%">
                <div class="card-body">                  
                  <b>Referência:</b> <span id="reference_no"></span><br>
                  <b>Valor total:</b> €<span id="payment_total"></span><br>
                  <b>Valor do depósito:</b> <span id="deposit_total"></span> <br>
                  <b>Valor a liquidar ao motorista:</b> <span id="driver_amount"></span>
               </div>

             </div>

                    <h4 class="font-weight-light text-right">Amount  <span class="font-weight-bold text-success dep_amount"></span> </h4>
                    <Payment id="payable"  type="SHIPMENT" link="/user/dashboard/awardedshipments" :bid="this.$route.params.id" :shipmentData="formData" />
                </div>

               

            </div>
   



        </div>
     </div>
</div>
</template>

<script>
  import moment from 'moment';
import { mapGetters, mapActions } from 'vuex';
import Payment from '../common/Payment';
export default {
    components: { Payment },
    data() {
        return {
           moment:moment,
            baseURL,
            formData: {},
            bidDetails:{'amt' : '120'},
             page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
        }
    },
    computed: {
        ...mapGetters('bid', ['bidInfo']),
    },
    mounted() {
         this.init();
        
    },
    methods: {
        ...mapActions('bid', ['getbidInfo']),
       
        
         async init() {
            let resp = await this.getbidInfo(this.$route.params.id);
            console.log(this.bidInfo.data.amount);
            var main_amount=this.bidInfo.data.amount;
               main_amount=parseFloat(main_amount);           
            var payemount=(this.bidInfo.data.amount*20)/100;
               payemount=payemount.toFixed(2);
               payemount=parseFloat(payemount);
               const res = main_amount+payemount
               $("#payment_total").text(res);
            $(".dep_amount").text('€'+payemount);
            $("#payable").attr('amount',payemount);
        },
      }
    }
      </script>
</style>