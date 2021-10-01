<template>
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" v-if="data.shipment != undefined">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{language.message}} {{ data.transporter.name }}</h5>
                    <p class="modal-title" id="exampleModalLabel">{{language.bid}} #{{ data.id }}</p>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">{{language.subject}}</label>
                          <input type="text" readonly="" v-model="data.shipment.title" placeholder="Enter Subject" class="form-control">
                       
                    </div>

                    <div class="form-group">
                        <label for="">{{language.message}}</label>
                        <textarea v-model="formData.message"  rows="3" class="form-control" placeholder="Enter Message"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" @click.prevent="close">{{language.close}}</button>
                    <button type="button" class="btn btn-success" @click="submit">{{language.send}}</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapActions, mapGetters} from 'vuex';
export default {
    props:['data'],
    data() {
        return {
            language: require(`../language/${$lang}/bidlist.json`),
            formData: {
                subject: '',
                message: '',
            }
        }
    },
    computed: {
        ...mapGetters("shipment", ["errors"])
    },
    methods:{
        ...mapActions("shipment", ['addMessageSubject']),
        close(){
            $('#messageModal').modal('hide');
        },
        async submit(){
            this.formData.bid_id = this.data.id;
            this.formData.subject= this.data.shipment.title;
            this.formData.shipment_id = this.data.shipment.id;
            this.formData.driver_id = this.data.transporter.id;
            await Swals.dialog1(
                this.language.are_you_sure,
                this.language.send_message_to_transporter,
                this.language.yes+','+ this.language.continue, 
                this.language.cancel,
                this.language.sent,
                this.language.message_sent_successfully,
                this.addMessageSubject,
                this.formData
            );
            $('#messageModal').modal('hide');
            this.$router.push('/user/dashboard/messages');
        }
    }
}
</script>
