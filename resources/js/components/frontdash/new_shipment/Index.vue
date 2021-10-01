<template>
  <div class="row">
    <div class="col-lg-7 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
          <h4 class="font-weight-bolder mt-1">
            <span class="font-weight-light">{{ language.new }}</span>
            {{ language.shipment }}
          </h4>
          <span class="clearfix"></span>
          <div class="form-group mt-5">
            <label for="">{{ language.shipment_title }}</label>
            <input
              type="text"
              v-model="formData.title"
              class="form-control"
              :placeholder="language.shipment_title_placeholder"
            />
          </div>

          <div class="form-group">
            <label for="">{{ language.shipment_category }}</label>
            <select class="form-control" v-model="formData.category_id">
              <option
                v-for="(category, index) in categories"
                :key="index"
                :value="category.id"
              >
                {{ lang == "en" ? category.title : category.title_pt }}
              </option>
            </select>
          </div>

          <div class="form-group">
            <label for="">{{ language.image }}</label>
            <input
              type="file"
              class="form-control"
              id="ShipmentImage"
              accept="image/png, image/jpeg"
              @change="uploadFile('#ShipmentImage')"
            />
          </div>

          <div class="form-group">
            <label for="">{{ language.description }}</label>
            <textarea
              v-model="formData.description"
              rows="5"
              class="form-control"
              :placeholder="language.description_placeholder"
            ></textarea>
          </div>
          <b-form-group class="form-inpsec" :label="language.collection">
            <GmapAutocomplete
              @input="locate('inp-div2')"
              class="form-control"
              @place_changed='setCollectionPlace'
              :placeholder="language.collection_placeholder"
            />
            <div class="inp-div2"></div>
          </b-form-group>
          <b-form-group class="form-inpsec" :label="language.delivery">
            <GmapAutocomplete
              @input="locate('inp-div3', true)"
              class="form-control"
              @place_changed="setDeliveryPlace"
              :placeholder="language.delivery_placeholder"
            />
            <div class="inp-div3"></div>
          </b-form-group>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="" class="d-block">{{
                  language.delivery_date
                }}</label>
                <v-date-picker
                  v-model="formData.delivery_date"
                  :min-date="new Date()"
                />
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">{{ language.shipment_size }}</label>
                <select class="form-control" v-model="formData.delivery_size">
                  <option
                    v-for="(item, index) in sizes"
                    :key="index"
                    :value="item"
                  >
                    {{ item }}
                  </option>
                </select>
              </div>

              <div class="bg-light p-3 rounded mb-3">
                <p>
                  <b>XL - </b>{{ language.xl_text }}
                  <br />

                  <b>L - </b>{{ language.l_text }}
                  <br />

                  <b>M - </b>{{ language.m_text }}
                  <br />

                  <b>S - </b>{{ language.s_text }}
                  <br />
                </p>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="" class="d-block">{{ language.budget }}</label>
            <input
              type="text"
              v-model="formData.budget"
              class="form-control"
              :placeholder="language.budget_placeholder"
            />
          </div>
          <!-- <div class="form-group">
                        <label for="">{{ language.location_type }}</label>
                        <select class="form-control" v-model="formData.location_type">
                            <option ></option>
                            <option value="cities">{{ language.cities}}</option>
                            <option value="countries">{{ language.countries}}</option>
                            <option value="near">{{ language.near}}</option>

                        </select>
                    </div> -->
          <div class="row">
            <div class="col-md-6">
              <label for="">{{ language.pickup_point_details }}</label>
              <div class="form-group mt-3">
                <label for="">{{ language.select_floor }}</label>
                <select class="form-control" v-model="formData.pickup_floor">
                  <option
                    v-for="(item, index) in 15"
                    :key="index"
                    :value="item"
                  >
                    {{ item }}
                  </option>
                </select>
              </div>

              <div class="form-group">
                <label for="">{{ language.lift_present }}</label>
                <select
                  name=""
                  id=""
                  class="form-control"
                  v-model="formData.pickup_lift"
                >
                  <option value="1">Sim</option>
                  <option value="0">Não</option>
                </select>
              </div>
            </div>

            <div class="col-md-6">
              <label for="">{{ language.delivery_point_details }}</label>

              <div class="form-group mt-3">
                <label for="">{{ language.select_floor }}</label>
                <select
                  name=""
                  id=""
                  class="form-control"
                  v-model="formData.delivery_floor"
                >
                  <option
                    v-for="(item, index) in 15"
                    :key="index"
                    :value="item"
                  >
                    {{ item }}
                  </option>
                </select>
              </div>

              <div class="form-group">
                <label for="">{{ language.lift_present }}</label>
                <select
                  name=""
                  id=""
                  class="form-control"
                  v-model="formData.delivery_lift"
                >
                  <option value="1">Sim</option>
                  <option value="0">Não</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group text-right mt-4">
            <button
              class="btn btn-sm btn-success"
              @click.prevent="saveShipping"
            >
              {{ language.submit_text }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-5 py-3 px-5 grid-margin stretch-card">
      <div class="mt-5">
        <div class="progress my-4" v-if="barstart">
          <div
            class="progress-bar"
            role="progressbar"
            :style="'width: ' + progress + '%'"
            :aria-valuenow="progress"
            aria-valuemin="0"
            aria-valuemax="100"
          >
            {{ progress }}%
          </div>
        </div>
        <img
          :src="`${baseURL}/shipments/${formData.image}`"
          v-if="formData.image != undefined"
          alt=""
          class="img-fluid mb-3"
        />
        <h4 class="font-weight-bold mb-4">{{ formData.title }}</h4>
        <span
          class="btn btn-md btn-success rounded-pill mb-3 mt-2"
          v-if="formData.budget != undefined"
          ><h4 class="mb-0 font-weight-bold">€{{ formData.budget }}</h4></span
        >
        <span
          class="btn btn-md btn-primary rounded-pill mb-3 mt-2"
          v-if="formData.distance != undefined"
          ><h4 class="mb-0 font-weight-bold">
            {{ formData.distance }} KM
          </h4></span
        >
        <span class="font-weight-bold small d-block"
          >{{ language.collection }}:
          <span class="font-weight-light">{{ formData.collection }}</span></span
        >
        <span class="font-weight-bold small d-block"
          >{{ language.delivery }}:
          <span class="font-weight-light">{{ formData.delivery }}</span></span
        >
        <span class="font-weight-bold small d-block"
          >{{ language.delivery_date }}:
          <span class="font-weight-light">{{
            moment(formData.delivery_date).format("LL")
          }}</span></span
        >
        <span class="font-weight-bold small d-block"
          >{{ language.shipment_size }}:
          <span class="font-weight-light">{{
            formData.delivery_size
          }}</span></span
        >
        <!--   <span class="font-weight-bold small d-block">{{ language.location_type }}: <span class="font-weight-light">{{ formData.location_type }}</span></span> -->
        <p class="small font-weight-light mt-3">{{ formData.description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { BFormGroup } from "bootstrap-vue";
import { mapActions, mapGetters } from "vuex";
import moment from "moment";
export default {
  data() {
    return {
      moment: moment,
      lang: $lang,
      language: require(`../language/${$lang}/newshipment.json`),
      page: this.$route.query.page == undefined ? 1 : this.$route.query.page,
      bid: "",
      sizes: ["S", "M", "L", "XL"],
      formData: {
        // location_type:'',
        collection: "",
        delivery: "",
        geometry: {
          collection: {},
          delivery: {},
        },
        distance: 0,
      },
      // location:['countries','cities','near'],
      barstart: false,
      baseURL,
    };
  },
  computed: {
    ...mapGetters("shipment", ["errors", "progress"]),
    ...mapGetters("front", ["categories"]),
  },
  mounted() {
    this.init();
  },
  methods: {
    ...mapActions("shipment", ["addUserShipment", "uploadImage"]),
    ...mapActions("front", ["getCategories"]),
    locate(el, noCss = false) {
      $(".pac-container").appendTo(`.${el}`);
      noCss ? $(".pac-container:last").removeClass("dorp_cls") : $(".pac-container:last").addClass("dorp_cls");
    },
    async init() {
      let respq = await this.getCategories();
      console.log(respq);
    },
    view(bid) {
      this.bid = bid;
      this.editing = false;
      $("#bidModal").modal("show");
    },
    uploadFile(id) {
      let file = document.querySelector(id).files[0];
      if (
        file.type.includes("jpg") ||
        file.type.includes("jpeg") ||
        file.type.includes("png")
      ) {
        let reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = () => {
          this.barstart = true;
          this.uploadImage(reader.result)
            .then((response) => {
              if (id === "#ShipmentImage") {
                this.formData.image = response;
                this.barstart = false;
              }
            })
            .catch(() => {});
        };
      } else {
        alert("only image file is allowed");
      }
    },
    setCollectionPlace(place) {
      this.formData.collection = place.formatted_address;
      this.formData.geometry.collection.location = place.geometry.location;
      this.formData.geometry.collection.latitude =
        place.geometry.location.lat();
      this.formData.geometry.collection.longitude =
        place.geometry.location.lng();
      if (this.formData.delivery != "") {
        this.formData.distance = this.getDistance(
          place.geometry.location,
          this.formData.geometry.delivery.location
        );
      }
    },
    setDeliveryPlace(place) {
      this.formData.delivery = place.formatted_address;
      this.formData.geometry.delivery.location = place.geometry.location;
      this.formData.geometry.delivery.latitude = place.geometry.location.lat();
      this.formData.geometry.delivery.longitude = place.geometry.location.lng();
      if (this.formData.collection != "") {
        this.formData.distance = this.getDistance(
          place.geometry.location,
          this.formData.geometry.collection.location
        );
      }
    },
    getDistance(p1, p2) {
      var R = 6378137; // Earth’s mean radius in meter
      var dLat = this.rad(p2.lat() - p1.lat());
      var dLong = this.rad(p2.lng() - p1.lng());
      var a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(this.rad(p1.lat())) *
          Math.cos(this.rad(p2.lat())) *
          Math.sin(dLong / 2) *
          Math.sin(dLong / 2);
      var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      var d = R * c;
      return (d / 1000).toFixed(3); // returns the distance in kilo-meter
    },
    rad(x) {
      return (x * Math.PI) / 180;
    },
    async saveShipping() {
      this.formData.delivery_date = this.moment(
        this.formData.delivery_date
      ).format("YYYY-MM-DD");
      console.log(this.formData);
      let resp = await this.addUserShipment(this.formData);
      if (resp === "error") {
        let errors = "";
        for (const error in this.errors) {
          errors =
            '<span class="text-danger">' +
            errors +
            this.errors[error][0] +
            "</span><br>";
        }
        Swals.message("Error", errors, "error");
      } else {
        Swals.toast(this.language.shipment_added_successfully, "success");
        this.$router.push("/user/dashboard/openshipments");
      }
    },
  },
  components: { BFormGroup },
};
</script>

<style>
</style>