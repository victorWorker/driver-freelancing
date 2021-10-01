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
                                <a href="" class="small text-success" @click.prevent="edit(shipment)" v-if="shipment.competitors !== null">Edit Prices</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

export default {
    components: { Pagination, CompetitorModal },
    data() {
        return {
            language: require(`../language/${$lang}/shipments.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            editing: false,
            shipment: {}
        }
    },
    computed: {
        ...mapGetters("shipment", ['shipments', 'pagination']),
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("shipment", ["getShipments"]),
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
    }
}
</script>

<style>

</style>