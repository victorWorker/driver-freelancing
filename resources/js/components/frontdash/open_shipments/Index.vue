<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.open}}</span>  {{ language.shipments }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                <table class="table mt-5">
                    <thead>
                    <tr>
                        <th>{{language.title}}</th>
                        <th>{{language.collection}}</th>
                        <th>{{language.delivery}}</th>
                        <th>{{language.delivery_date}}</th>
                        <th>{{language.budget}}</th>
                        <th>{{language.actions}}</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(shipment, index) in openshipments" :key="index">
                            <td>{{ shipment.title }}</td>
                            <td>{{ shipment.collection }}</td>
                            <td>{{ shipment.delivery }}</td>
                            <td><span class="date small">{{ moment(shipment.delivery_date).format('LL') }}</span></td>
                            <td><h5 class="font-weight-bold text-dark">€{{ shipment.budget }}</h5></td>
                    
                            <td>
                                <router-link :to="`/user/dashboard/shipment/view/${shipment.id}`" class="small text-success">
                                    {{ language.view_shipment }} | 
                                </router-link>  

                                  <a href="javascript:void(0)" @click.prevent="addShipmentModal(shipment)" class="small text-info">{{ language.edit }} | </a>
                                   <a href="#" @click.prevent="removeBid(shipment.id)" class="small text-danger">{{ language.delete }}  </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="shipmentModal" tabindex="-1" role="dialog" aria-labelledby="shipmentModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md " role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Shipment</h5>
                        <button type="button" class="close" @click.prevent="closeShipmentModal">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       
                        <div class="form-group">
                        <label for="" class="d-block">{{ language.budget }}</label>
                        <input type="text" v-model="formData.budget" class="form-control" :placeholder="language.budget_placeholder">
                       </div>

                       <div class="form-group">
                        <label for="">{{ language.image }} </label>
                        <input type="file" class="form-control" id="ShipmentImage" accept="image/png, image/jpeg" @change="uploadFile('#ShipmentImage')"> 

                        <br>
                        <div class="progress my-4" v-if="barstart">
                    <div class="progress-bar" role="progressbar" :style="'width: '+progress+'%'" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
                </div>
                <img :src="`${baseURL}/shipments/${formData.image}`" v-if="formData.image != undefined" alt="" class="img-fluid w-50 mb-3">
                        <img :src="`${baseURL}images/nia.jpg`" v-if="formData.image === null" class=" rounded align-self-center mb-3 w-50" />
                           <!--  <img :src="`${baseURL}shipments/${formData.image}`" v-if="formData.image !== null" class="w-50 rounded align-self-center mb-4" />  -->
                       </div>
                           
                    <div class="form-group">
                        <label for="">{{ language.description }}</label>
                        <textarea v-model="formData.description" rows="5" class="form-control" :placeholder="language.description_placeholder"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="editBid" class="btn btn-primary">UPDATE </button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="user/dashboard/openshipments" :fetch="getUserOpenShipments" />
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
            language: require(`../language/${$lang}/openshipments.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            edit: false,
            formData: {},
            moment,           
            barstart: false,
            baseURL
        }
    },
    computed: { 
        ...mapGetters("shipment", ['openshipments', 'pagination', 'errors','progress']),
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("shipment", ["getUserOpenShipments", "updateBid","updateShipment", "deleteUserShipment","uploadImage"]),
        async init() {
            let resp = await this.getUserOpenShipments(this.page);
        },
        addShipmentModal(data) {
            this.formData = data;           
            $('#shipmentModal').modal('show');
        },
        closeShipmentModal() {
            $('#shipmentModal').modal('hide');
        },
        uploadFile(id) {
            let file = document.querySelector(id).files[0];
            if(file.type.includes('jpg') || file.type.includes('jpeg') || file.type.includes('png')){
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = () => {
                    this.barstart = true;
                    this.uploadImage(reader.result).then((response) => {
                        if(id === '#ShipmentImage'){
                            this.formData.image = response;
                            this.barstart = false;
                        }
                    }).catch(
                        () => {
                            
                        }
                    );
                }; 
            }else{
                alert('only image file is allowed')
            }
            
        },
        async editBid() {         
         this.formData.expiration = this.moment(this.formData.expiration).format('YYYY-MM-DD');
            let resp = await this.updateShipment(this.formData);
            if(resp == 'success') {
              this.getUserOpenShipments(this.page);
                Swals.toast('Shipment Updated Successfully', 'success');
                this.closeShipmentModal();
            }else{
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swals.message('Error', errors, 'error');
            }
            
        },
        async removeBid(id){
           await Swals.dialog(
                'Are You Sure?',
                'This Will Delete your Shipment Permanently !',
                'Yes, Continue',
                'Deleted',
                'Shipment Deleted Successfully.',
                this.deleteUserShipment,
                id
            );
            this.getUserOpenShipments(this.page);
        },
    }
}
</script>

<style>
.date{
    color: #b7b7b7;
}
</style>