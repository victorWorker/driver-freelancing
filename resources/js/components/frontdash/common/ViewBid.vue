<template>
    <div class="modal fade" id="bidModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ language.bid_details }}</h5>
                    <p class="modal-title" id="exampleModalLabel">{{ language.bid }} #{{data.id}}</p>
                </div>
                <div class="modal-body" v-if="!editing">
                    <div>
                        <p class="mb-0 text-black-50">{{ language.proposal }}</p>
                        <p>{{data.proposal}}</p>
                    </div>
                    <div class="d-flex">
                        <div class="w-50">
                            <p class="mb-0 text-black-50">{{ language.date }}</p>
                            <p>{{moment(data.created_at).format('LLL')}}</p>
                        </div>
                        <div class="w-50">
                            <p class="mb-0 text-black-50">{{ language.amount }}</p>
                            <p>€{{data.amount + (data.amount * 20 / 100)}}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="w-50">
                            <p class="mb-0 text-black-50">Status</p>
                            <label :class="(data.status === 'ACTIVE') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ data.status }}</label>
                        </div>
                        <div class="w-50">
                            <p class="mb-0 text-black-50">{{ language.shipment }} #</p>
                            <p>#{{data.shipment_id}}</p>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-body" v-else>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Proposal</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="data.proposal" >
                    </div>
                    <div class="d-flex">
                        <div class="form-group w-50">
                            <label for="exampleInputEmail1">Date</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="data.created_at" disabled>
                        </div>
                        <div class="form-group w-50">
                            <label for="exampleInputEmail1">Amount</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="data.amount">
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group w-50">
                            <label for="exampleInputEmail1">Status</label>
                            <select class="form-control" v-model="data.status">
                                <option value="ACTIVE">Active</option>
                                <option value="SUSPENDED">Suspended</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="close">Close</button>
                    <button type="button" class="btn btn-primary" v-if="editing" @click="update">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions} from 'vuex';
import moment from "moment";
export default {
    
    props:['data','editing'],
    data() {
        return {
            moment,
            language: require(`../language/${$lang}/bidlist.json`),
        }
    },
    methods:{
        ...mapActions("shipment", ['updateBid']),
        close(){
            $('#bidModal').modal('hide');
        },
        async update(){
            await Swals.dialog(
                'Are You Sure?',
                'This Will update The Details of Bid !',
                'Yes, Continue',
                'Updated',
                'Bid Successfully Updated.',
                this.updateBid,
                {data:this.data}
            );
            $('#bidModal').modal('hide');
        }
    }
}
</script>
