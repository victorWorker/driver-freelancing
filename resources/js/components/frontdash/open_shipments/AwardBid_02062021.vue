<template>
<div class="row">
     <div class="col-lg-12 grid-margin stretch-card">
        <div class="card mt-3 px-4 py-4">
            <div class="row">
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

                <div class="col-md-6">
                    <h4 class="font-weight-light text-right">Amount <span class="font-weight-bold text-success">€10</span> </h4>
                    <Payment amount="10" type="SHIPMENT" link="/user/dashboard/awardedshipments" :bid="this.$route.params.id" :shipmentData="formData" />
                </div>
            </div>
        </div>
     </div>
</div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import Payment from '../common/Payment';
export default {
    components: { Payment },
    data() {
        return {
            baseURL,
            formData: {}
        }
    },
    computed: {

    },
    mounted() {

    },
    methods: {

    }
}
</script>

<style>

</style>