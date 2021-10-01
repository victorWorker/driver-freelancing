<template>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
          <h4 class="font-weight-bolder mt-1">
            <span class="font-weight-light">{{ language.all }}</span>
            {{ language.bids }}
          </h4>
          <span class="clearfix"></span>
          <div class="table-res-contain">
            <table class="table mt-5">
              <thead>
                <tr>
                  <th>{{ language.title }}</th>
                  <th>{{ language.collection }}</th>
                  <th>{{ language.delivery }}</th>
                  <th>{{ language.distance }}</th>
                  <th>{{ language.delivery_date }}</th>
                  <th>{{ language.status }}</th>
                  <th>{{ language.actions }}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(bid, index) in bids" :key="index">
                  <td>{{ bid.proposal.substring(0, 50) }}</td>
                  <td>$ {{ bid.amount }}</td>
                  <td>{{ bid.expiration }}</td>
                  <td>{{ bid.status }}</td>
                  <td>{{ moment(bid.created_at).format("DD-MM-YYYY") }}</td>
                  <td>
                    <label
                      :class="
                        bid.status === 'ACTIVE'
                          ? 'badge badge-success text-white'
                          : 'badge badge-danger'
                      "
                      >{{ bid.status }}</label
                    >
                  </td>
                  <td>
                    <a
                      v-if="bid.status === 'ACTIVE'"
                      href="#"
                      @click.prevent="suspend(bid.id)"
                      class="small"
                      >{{ language.suspend }} |
                    </a>
                    <a
                      v-if="bid.status === 'SUSPENDED'"
                      href="#"
                      @click.prevent="activate(bid.id)"
                      class="small"
                      >{{ language.activate }} |
                    </a>
                    <a href="#" @click.prevent="view(bid)" class="small"
                      >{{ language.view }} |
                    </a>
                    <a href="#" @click.prevent="edit(bid)" class="small"
                      >{{ language.edit }} |
                    </a>
                    <router-link
                      :to="{
                        name: 'showdriver',
                        params: { id: bid.driver_id },
                      }"
                      class="small"
                      >View driver details |
                    </router-link>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <Pagination
      :pagination="pagination"
      route="dash/shipments"
      :fetch="
        () => getShipmentBids({ page: this.page, id: this.$route.params.id })
      "
    />
    <ViewBid :data="bid" :editing="editing" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Pagination from "../common/Pagination";
import ViewBid from "../common/ViewBid";
import moment from "moment";
export default {
  components: { Pagination, ViewBid },
  data() {
    return {
      moment: moment,
      language: require(`../language/${$lang}/shipments.json`),
      page: this.$route.query.page == undefined ? 1 : this.$route.query.page,
      bid: "",
      editing: false,
    };
  },
  computed: {
    ...mapGetters("shipment", ["bids", "pagination"]),
  },
  mounted() {
    // this.init();
  },
  methods: {
    ...mapActions("shipment", ["getShipmentBids", "suspendBid", "activateBid"]),
    async init() {
      let resp = await this.getShipmentBids({
        page: this.page,
        id: this.$route.params.id,
      });
    },
    async suspend(id) {
      await Swals.dialog(
        "Are You Sure?",
        "This Will Remove The Bid Permanently !",
        "Yes, Continue",
        "Suspended",
        "Bid Successfully Suspended.",
        this.suspendBid,
        id
      );
      this.getShipmentBids({ page: this.page, id: this.$route.params.id });
    },
    async activate(id) {
      await Swals.dialog(
        "Are You Sure?",
        "This Will Activate The Bid !",
        "Yes, Continue",
        "Activated",
        "Bid Successfully Activated.",
        this.activateBid,
        id
      );
      this.getShipmentBids({ page: this.page, id: this.$route.params.id });
    },
    view(bid) {
      this.bid = bid;
      this.editing = false;
      $("#bidModal").modal("show");
    },
    edit(bid) {
      this.bid = bid;
      this.editing = true;
      $("#bidModal").modal("show");
    },
  },
};
</script>

<style>
</style>