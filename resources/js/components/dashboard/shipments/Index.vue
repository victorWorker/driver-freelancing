<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.shipment}}</span>  {{ language.details }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                    <table class="table mt-5">
                        <thead>
                        <tr>
                            <th>{{language.title}}</th>
                            <th>{{language.collection}}</th>
                            <th>{{language.delivery}}</th>
                            <!-- <th>{{language.distance}}</th> -->
                            <!-- <th>{{language.delivery_date}}</th> -->
                            <th>{{language.status}}</th>
                            <th>{{language.actions}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(shipment, index) in shipments" :key="index">
                                <td>{{ shipment.title }}</td>
                                <td>{{ shipment.collection }}</td>
                                <td>{{ shipment.delivery }}</td>
                                <!-- <td>{{ shipment.distance }} KM</td> -->
                                <!-- <td>{{ shipment.delivery_date }}</td> -->
                                <td>
                                    <label :class="(shipment.status === 'ACTIVE') ? 'badge badge-success text-white' : 'badge badge-danger'">{{ shipment.status }}</label>
                                </td>
                                <td>
                                    <router-link :to="`/dash/shipments/view/${shipment.id}`" class="small">{{language.view}} | </router-link>  
                                    <a href="#" class="small">{{language.block}} | </a>  
                                    <a href="" class="small text-success" @click.prevent="view(shipment)" v-if="shipment.competitors === null">Add Prices</a>
                                    <a href="" class="small text-success" @click.prevent="edit(shipment)" v-if="shipment.competitors !== null">Edit Prices | </a> 
                                    <a href="javascript:void(0)" @click.prevent="addShipmentModal(shipment)" class="small text-info">Edit Shipment | </a>
                                    <router-link :to="`/dash/jobs/view/bidlist/${shipment.id}`" class="small">View bid list | </router-link>
                                    <router-link :to='{name:"showclients",params:{id:shipment.user_id}}' class="small">View client details | </router-link>
                                    <a href="javascript:void(0)" @click.prevent="removeShipment(shipment.id)" class="small text-danger">Delete  </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

            <!-- Modal -->
            <div class="modal fade" id="shipmentModal1" tabindex="-1" role="dialog" aria-labelledby="shipmentModalLabel" aria-hidden="true">
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
                        <label for="" class="d-block">Budget</label>
                        <input type="text" v-model="formData.budget" class="form-control" :placeholder="language.budget_placeholder">
                       </div>

                       <div class="form-group">
                        <label for="">Image </label>
                        <input type="file" class="form-control" id="ShipmentImage" accept="image/png, image/jpeg" @change="uploadFile('#ShipmentImage')"> 

                        <br>
                        <div class="progress my-4" v-if="barstart">
                    <div class="progress-bar" role="progressbar" :style="'width: '+progress+'%'" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">{{progress}}%</div>
                </div>
                <img :src="`${baseURL}/shipments/${formData.image}`" v-if="formData.image != undefined" alt="" class="img-fluid w-50 mb-3">
                        <img :src="`${baseURL}images/nia.jpg`" v-if="formData.image === null" class=" rounded align-self-center mb-3 w-50" />
                          
                       </div>
                           
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea v-model="formData.description" rows="5" class="form-control" :placeholder="language.description_placeholder"></textarea>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click.prevent="editBid" class="btn btn-primary">UPDATE </button>
                    </div>
                    </div>
                </div>
            </div>

        <Pagination :pagination="pagination" route="dash/shipments" :fetch="getShipments" />
        <CompetitorModal :data="shipment" :editing="editing" :success="getShipments"/>
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import Pagination from '../common/Pagination';
import CompetitorModal from '../common/CompetitorModal';
import moment from 'moment';
export default {
    components: { Pagination, CompetitorModal },
    data() {
        return {
            language: require(`../language/${$lang}/shipments.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            editing: false,
            shipment: {},
            formData: {},
            moment,           
            barstart: false,
            baseURL
        }
    },
    computed: {
        ...mapGetters("shipment", ['shipments', 'pagination','errors','progress']),
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("shipment", ["getShipments","updateDashShipments","deleteShipment","uploadDashImage"]),
        async init() {
            let resp = await this.getShipments(this.page);
        },
        view(shipment) {
            this.shipment = shipment;
            this.editing = false;
            $('#shipmentModal').modal('show');
        },
        edit(shipment) {
            this.shipment = shipment;
            this.editing = true;
            $('#shipmentModal').modal('show')
        },
        
        addShipmentModal(data) {
            this.formData = data;           
            $('#shipmentModal1').modal('show');
        },
        closeShipmentModal() {
            $('#shipmentModal1').modal('hide');
        },
        uploadFile(id) {
            let file = document.querySelector(id).files[0];
            if(file.type.includes('jpg') || file.type.includes('jpeg') || file.type.includes('png')){
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = () => {
                    this.barstart = true;
                    this.uploadDashImage(reader.result).then((response) => {
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
            let resp = await this.updateDashShipments(this.formData);
            if(resp == 'success') {
              this.getShipments(this.page);
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
        
         async removeShipment(id){
           await Swals.dialog(
                'Are You Sure?',
                'This Will Delete your Shipment Permanently !',
                'Yes, Continue',
                'Deleted',
                'Shipment Deleted Successfully.',
                this.deleteShipment,
                id
            );
            this.getShipments(this.page);
        }
    }
}
</script>

<style>

</style>