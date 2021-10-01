<template>
  <div class="card rounded">
        <div class="card-body">
            <div class="form-radio d-flex form-radio-flat justify-content-between align-items-center">
                <div class="caption">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="flatRadios1" id="flatRadios1" v-model="formData.paymentMethod" value="Multibanco" checked=""> Multibanco <i class="input-helper"></i></label>
                </div>
                <div class="logo text-right">
                    <img :src="`${baseURL}images/multibanco_logo.png`" alt="" srcset="" class="pay-logo">
                </div>
            </div>

 
            <div class="form-radio d-flex form-radio-flat justify-content-between align-items-center">
                <div class="caption">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="flatRadios1" id="flatRadios1" value="PayPal" v-model="formData.paymentMethod"> PayPal <i class="input-helper"></i></label>
                </div>
                <div class="logo text-right">
                    <img :src="`${baseURL}images/paypal.png`" alt="" srcset="" class="pay-logo">
                </div>
            </div>


            <div class="form-radio d-flex form-radio-flat justify-content-between align-items-center">
                <div class="caption">
                    <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="flatRadios1" id="flatRadios1" value="MB Way" v-model="formData.paymentMethod"> MB Way <i class="input-helper"></i></label>
                </div>
                <div class="logo text-right">
                    <img :src="`${baseURL}images/mbway_logo.png`" alt="" srcset="" class="pay-logo">
                </div>
            </div>

            <div class="row mt-3" v-if="formData.paymentMethod === 'MB Way'">
                <div class="col-md-12" style="padding: 0px 42px;">
                    <div class="bordered-box">
                        <div class="form-group">
                            <label for="">MB Way Number</label>
                            <input type="tel" name="" id="" v-model="formData.number" class="form-control" placeholder="MB Way Number">
                        </div>
                    </div>
                </div>     
            </div>


            <div class="form-group mt-4">
                <button class="btn btn-sm form-control btn-success font-weight-bold" @click.prevent="completePayment"> 
                   <i class="fa fa-lock"></i> <span v-if="formData.paymentMethod === 'Multibanco'">{{language.generate_payment_details}}</span>
                   <span  v-else-if="formData.paymentMethod === 'MB Way'">{{language.generate_payment_details}}</span>
                   <span v-else>Finish and Pay</span>
                </button>
            </div> 

            <div class="row">
                <div class="col-md-12">
                    <a href="https://wa.me/351937982969/?text=urlencodedtext" target="_blank"><i class="fa fa-whatsapp" style="font-size: 30px; margin-top: 5px;color:#28a745"></i></a> &nbsp;+351 937982969 {{language.payment_page_whatsapp_msg}}
                </div>  
            </div>

            {{response_state}}
            <div id="payment_success"></div>

            </div>

         <Loading :condition="loading" :text="loadingText" />   
    </div>
</template>

<script>
import { mapGetters, mapActions, mapState } from 'vuex';
import Loading from './Loading';
export default {
    components: { Loading },
    props: [ 'amount', 'type', 'link', 'bid', 'shipmentData' ],
    data() {
        return {
            baseURL, 
            language: require(`../language/${$lang}/newshipment.json`),
            formData: {
                paymentMethod: 'Multibanco',
                amount:this.amount,
                type: this.type
            },
            loading: false,
            loadingText: 'Loading...',
        }
    },
    computed: {
        ...mapGetters('transaction', ['transData', 'lastSubTransaction','getloadlastshiptransaction'],{
            last_ship: 'tansaction/loadlastshiptransaction'        }),
        ...mapState({
            response_state: state => state.loadlastshiptransaction
        })
    },
    mounted() {
        this.paypalConfirm();
        
    },
    methods: {
        ...mapActions('transaction', ['addSubscriptionTransaction', 'getLastSubscriptionTransactions' , 'loadlastshiptransaction' , 'confirmPayPalPayment']),
        async completePayment() {

                this.formData.amount = $("#payable").attr('amount');
                this.formData.discount = $("#payable").attr('discount_percent');
                console.log(this.formData.amount);

            if(this.type == 'SHIPMENT'){
                if(this.bid === '' || this.shipmentData.phone === undefined || this.shipmentData.address === undefined){
                    Swals.message('Info', "Address and contact number are required", 'warning');
                    return;
                }
                this.formData.bidid = this.bid;
                this.formData.actualDetails = this.shipmentData;
                this.formData.amount = $("#payable").attr('amount');
                this.formData.type = 'SHIPMENT';
            }
            // if(this.formData.paymentMethod === 'MB Way'){
            //     Swals.message('Info', "MB Way is not available currently.<br />It Will be available soon !", 'warning');
            //     return;
            // }  
            //console.log(this.formData);
            this.loading = true;
            this.loadingText = "A gerar pagamento…";
            let resp = await this.addSubscriptionTransaction(this.formData);
            console.log(resp);

            if(resp === 'success') {
                if(this.formData.paymentMethod === "PayPal"){
                    window.location.href = this.transData;
                }else{
                    let test_resp = await this.loadlastshiptransaction();
                    console.log(test_resp);
                    console.log(test_resp.payment_details);
                   
                   //$("#payment_success").html(test_resp.payment_details.referencia);
                   if(test_resp.payment_details.alias){
                    Swals.message('Success',"Por favor, recolha os dados e complete o  pagamento:\Referência:"+ test_resp.payment_details.referencia +"\nSuccess: "+ test_resp.payment_details.sucesso +"", 'success');
                     var paid_amount=test_resp.payment_details.valor;
                    // paid_amount=paid_amount.toFixed(2);
                    // var paid_amount= $("#payable").attr('amount');
                   }
                   else{
                       var strmsg="Entidade          :    "+ test_resp.payment_details.entidade +"," +
                            "Referência    :    "+ test_resp.payment_details.referencia +"," +
                            "Montante    :    €"+ test_resp.payment_details.valor_minimo +".00";
                        Swals.message('Success', "Por favor, recolha os dados e complete o  pagamento:\n"+ strmsg +"", 'success');
                       var paid_amount= test_resp.payment_details.valor_minimo;
                       //paid_amount=paid_amount.toFixed(2);
                     // var paid_amount= $("#payable").attr('amount');
                   }
                   $(".payment-section").html('');
                    $(".payment-section").css('display','none');
                    $(".invoice-info").css('display','inline-flex');
                    $("#phone_no").text(this.shipmentData.phone);
                    $("#full_address").text(this.shipmentData.address);

                     var total_amt=$("#payment_total").text();
                        total_amt=parseFloat(total_amt);
                     var driver_amt=  total_amt-paid_amount;
                         driver_amt=driver_amt.toFixed(2);
                    $("#reference_no").text(test_resp.payment_details.referencia);
                    //$("#payment_total").text("€"+ test_resp.payment_details.valor_minimo +".00");
                    $("#deposit_total").text("€"+parseFloat(paid_amount).toFixed(2));
                    $("#driver_amount").text("€"+ driver_amt );
                    $("#discount_amount").text( test_resp.discount + "%");
                    
                    
                    if(this.type == 'SUBSCRIPTION'){
                        this.getLastSubscriptionTransactions();
                    }else{

                    }
                }

            }else{
                Swals.message('Error', 'Some Error Occurred. Try again !', 'error');
            }
            this.loading = false;
            this.loadingText = "Loading...";
        },
        async paypalConfirm() {
            if(this.$route.query.token !== undefined && this.$route.query.PayerID !== undefined){
                this.loading = true;
                this.loadingText = "Completing Payment...";
                let data = {
                    token: this.$route.query.token,
                    PayerID: this.$route.query.PayerID,
                    paymentId: this.$route.query.paymentId
                }
                let resp = await this.confirmPayPalPayment(data);
                if(resp === 'success') {
                    Swals.message('Success', 'Payment Done Successfully', 'success');
                }else{
                    Swals.message('Error', 'Some error occured', 'error');
                }
                if(this.type == 'SUBSCRIPTION'){
                    this.getLastSubscriptionTransactions();
                }
                
                this.$router.push(this.link);
                this.loading = false;
                this.loadingText = "Loading...";
            }
        },
    }
}
</script>

<style>

</style>