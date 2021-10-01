<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
          <h4 class="font-weight-bolder mt-1">
            <span class="font-weight-light">{{ language.shipment }}</span> Jobs
          </h4>
          <span class="clearfix"></span>
          <div class="table-res-contain">
            <table class="table mt-5">
              <thead>
                <tr>
                  <th>{{ language.title }}</th>
                  <th>{{ language.collection }}</th>
                  <th>{{ language.delivery }}</th>
                  <!-- <th>{{language.distance}}</th> -->
                  <!-- <th>{{language.delivery_date}}</th> -->
                  <th>{{ language.status }}</th>
                  <th>{{ language.actions }}</th>
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
                    <label
                      :class="
                        shipment.status === 'ACTIVE'
                          ? 'badge badge-success text-white'
                          : 'badge badge-danger'
                      "
                      >{{ shipment.status }}</label
                    >
                  </td>
                  <td>
                    <router-link
                      :to="`/dash/jobs/view/bidlist/${shipment.id}`"
                      class="small"
                      >View bid |
                    </router-link>
                    <a
                      href="javascript:void(0)"
                      @click.prevent="removeShipment(shipment.id)"
                      class="small text-danger"
                      >Delete
                    </a>
                    <a
                      href="javascript:void(0)"
                      v-if="shipment.status === 'AWARDED'"
                      @click.prevent="markasComplete(shipment.id)"
                      class="small text-info"
                    >
                      | Mark as Complete
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <Pagination :pagination="pagination" route="dash/jobs" :fetch="getJobs" />
    <CompetitorModal :data="shipment" :editing="editing" :success="getJobs" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Pagination from "../common/Pagination";
import CompetitorModal from "../common/CompetitorModal";

export default {
  components: { Pagination, CompetitorModal },
  data() {
    return {
      language: require(`../language/${$lang}/shipments.json`),
      page: this.$route.query.page == undefined ? 1 : this.$route.query.page,
      editing: false,
      shipment: {},
    };
  },
  computed: {
    ...mapGetters("shipment", ["shipments", "pagination"]),
  },
  mounted() {
    // this.init();
  },
  methods: {
    ...mapActions("shipment", ["getJobs", "deleteShipment", "completemarkJob"]),
    async init() {
      let resp = await this.getJobs(this.page);
    },
    async markasComplete(id) {
      await Swals.dialog(
        "Are You Sure?",
        "This Will Mark as Complete Shipment !",
        "Yes, Continue",
        "Completed",
        "Shipment Completed Successfully.",
        this.completemarkJob,
        id
      );
      this.getJobs(this.page);
    },
    view(shipment) {
      this.shipment = shipment;
      this.editing = false;
      $("#shipmentModal").modal("show");
    },
    edit(shipment) {
      this.shipment = shipment;
      this.editing = true;
      $("#shipmentModal").modal("show");
    },
    async removeShipment(id) {
      await Swals.dialog(
        "Are You Sure?",
        "This Will Delete your Shipment Permanently !",
        "Yes, Continue",
        "Deleted",
        "Shipment Deleted Successfully.",
        this.deleteShipment,
        id
      );
      this.getJobs(this.page);
    },
  },
};
</script>
