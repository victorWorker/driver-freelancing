<template>
    <div class="modal fade" id="shipmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Competitor's Prices</h5>
                    <p class="modal-title" id="exampleModalLabel">Shipment #{{data.id}}</p>
                </div>
                <div class="modal-body">
                    <h3 class="font-weight-bold mb-4"><span class="font-weight-light">Budget: </span>€{{ this.data.budget }}</h3>
                    <div v-if="editing" class="small bg-secondary p-3 rounded mb-4">
                        <h5>Old Prices:</h5>
                        DPD: €{{ data.competitors.dpd }}<br />
                        FedEx: €{{ data.competitors.fedex }}<br />
                        Local Driver: €{{ data.competitors.local }}<br />
                    </div>
                    <div class="form-group">
                        <label for="">Shiply Price:</label>
                        <input type="text" v-model="formData.competitors.dpd" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Shiply Price:</label>
                        <input type="text" v-model="formData.competitors.fedex" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Shiply Price:</label>
                        <input type="text" v-model="formData.competitors.local" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="close">Close</button>
                    <button type="button" class="btn btn-primary" v-if="editing" @click="update">Save changes</button>
                    <button type="button" class="btn btn-primary" v-if="!editing" @click="update">Add Prices</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions} from 'vuex';
import moment from "moment";
export default {
    
    props:['data','editing', 'success'],
    data() {
        return {
            moment,
            // language: require(`../language/${$lang}/bidlist.json`),
            formData: {
                competitors: {}
            }
        }
    },
    computed: {
        shipment() {
            console.log(this.data);
            return this.data;
        }
    },
    methods:{
        ...mapActions("shipment", ['addPrices']),
        close(){
            $('#shipmentModal').modal('hide');
        },
        async update(){
            this.formData.shipment_id = this.data.id;
            await Swals.dialog(
                'Are You Sure?',
                'This Will Add Competitor Prices to this Shpment !',
                'Yes, Continue',
                'Updated',
                'Prices Added Successfully.',
                this.addPrices,
                this.formData
            );
            this.formData = {
                competitors: {}
            };
            $('#shipmentModal').modal('hide');
            this.success();
        }
    }
}
</script>
