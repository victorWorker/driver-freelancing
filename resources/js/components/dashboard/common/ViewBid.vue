<template>
    <div class="modal fade" id="bidModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bid Details</h5>
                    <p class="modal-title" id="exampleModalLabel">Bid #{{data.id}}</p>
                </div>
                <div class="modal-body" v-if="!editing">
                    <div>
                        <p class="mb-0 text-black-50">Title</p>
                        <p>{{data.proposal}}</p>
                    </div>
                    <div class="d-flex">
                        <div class="w-50">
                            <p class="mb-0 text-black-50">Date</p>
                            <p>{{data.created_at}}</p>
                        </div>
                        <div class="w-50">
                            <p class="mb-0 text-black-50">Amount</p>
                            <p>{{data.amount}}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="w-50">
                            <p class="mb-0 text-black-50">Status</p>
                            <label :class="(data.status === 'ACTIVE') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ data.status }}</label>
                        </div>
                        <div class="w-50">
                            <p class="mb-0 text-black-50">Shipment id</p>
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
export default {
    
    props:['data','editing'],
    data() {
        return {
            language: require(`../language/${$lang}/shipments.json`),
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
