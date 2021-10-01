<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
          <h4 class="font-weight-bolder mt-1">
            <span class="font-weight-light">{{ language.expired }}</span>
            {{ language.shipments }}
          </h4>
          <span class="clearfix"></span>
          <div class="table-res-contain">
            <table class="table mt-5">
              <thead>
                <tr>
                  <th>{{ language.title }}</th>
                  <th>{{ language.collection }}</th>
                  <th>{{ language.delivery }}</th>
                  <th>{{ language.delivery_date }}</th>
                  <th>{{ language.budget }}</th>
                  <th>{{ language.status }}</th>
                  <th>{{ language.actions }}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(shipment, index) in shipments" :key="index">
                  <td>{{ shipment.title }}</td>
                  <td>{{ shipment.collection }}</td>
                  <td>{{ shipment.delivery }}</td>
                  <td>
                    <span class="date small">{{
                      moment(shipment.delivery_date).format("LL")
                    }}</span>
                  </td>
                  <td>
                    <h5 class="font-weight-bold text-dark mb-0">
                      €{{ shipment.budget }}
                    </h5>
                  </td>
                  <td>
                    <h5 class="font-weight-bold text-dark mb-0">
                      <span class="badge badge-danger">{{
                        shipment.status
                      }}</span>
                    </h5>
                  </td>
                  <td>
                    <a
                      href="javascript:void(0)"
                      @click.prevent="addShipmentModal(shipment)"
                      class="small text-info"
                      >EDIT
                    </a>
                    |
                    <a
                      href="javascript:void(0)"
                      @click.prevent="removeShipment(shipment.id)"
                      class="small text-danger"
                      >Delete
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="shipmentModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="shipmentModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Shipment</h5>
            <button
              type="button"
              class="close"
              @click.prevent="closeShipmentModal"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="">Delivery Date</label>
              <br />
              <v-date-picker
                v-model="formData.delivery_date"
                :min-date="new Date()"
              />
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click.prevent="editShipment"
                class="btn btn-primary"
              >
                UPDATE
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Pagination
      :pagination="pagination"
      route="dash/expiredjobs"
      :fetch="getAdminExpiredShipments"
    />
    <CompetitorModal
      :data="shipment"
      :editing="editing"
      :success="getAdminExpiredShipments"
    />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Pagination from "../common/Pagination";
import CompetitorModal from "../common/CompetitorModal";
import moment from "moment";

export default {
  components: { Pagination, CompetitorModal },
  data() {
    return {
      language: require(`../language/${$lang}/expiredshipments.json`),
      page: this.$route.query.page == undefined ? 1 : this.$route.query.page,
      editing: false,
      shipment: {},
      formData: {},
      moment,
    };
  },
  computed: {
    ...mapGetters("shipment", ["shipments", "pagination"]),
  },
  mounted() {
    // this.init();
  },
  methods: {
    ...mapActions("shipment", [
      "updateDashShipment",
      "deleteShipment",
      "getAdminExpiredShipments",
    ]),
    async init() {
      let resp = await this.getAdminExpiredShipments(this.page);
    },
    addShipmentModal(data) {
      this.formData = data;
      $("#shipmentModal").modal("show");
    },
    closeShipmentModal() {
      $("#shipmentModal").modal("hide");
    },
    async editShipment() {
      this.formData.delivery_date = this.moment(
        this.formData.delivery_date
      ).format("YYYY-MM-DD");
      let resp = await this.updateDashShipment(this.formData);
      if (resp == "success") {
        this.getAdminExpiredShipments(this.page);
        Swals.toast("Job Activated Successfully", "success");
        this.closeShipmentModal();
      } else {
        let errors = "";
        for (const error in this.errors) {
          errors =
            '<span class="text-danger">' +
            errors +
            this.errors[error][0] +
            "</span><br>";
        }
        Swals.message("Error", errors, "error");
      }
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
      this.getAdminExpiredShipments(this.page);
    },
  },
};
</script>
