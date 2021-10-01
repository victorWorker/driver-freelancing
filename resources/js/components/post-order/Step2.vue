<template>
  <b-form @submit.prevent class="step-form">
    <b-form-group
      class="form-inpsec"
      :label="language.hero_form_step2_pickuppoint"
    >
      <GmapAutocomplete
        @input="locate('inp-div1')"
        class="form-control"
        @place_changed="(p) => setPlace(p, true)"
        :placeholder="language.enterLocation"
      />
      <div class="inp-div1"></div>
    </b-form-group>
    <b-form-group
      class="form-inpsec"
      :label="language.hero_form_step2_dropofpoint"
    >
      <GmapAutocomplete
        @input="locate('inp-div1')"
        class="form-control"
        @place_changed="(p) => setPlace(p, false)"
        :placeholder="language.enterLocation"
      />
      <div class="inp-div2"></div>
    </b-form-group>
    <div v-if="error" class="text-danger">{{ error }}</div>
  </b-form>
</template>

<script>
import { BForm, BFormGroup, BFormInput, BFormSelect } from "bootstrap-vue";
export default {
  props: ["language"],
  data: () => ({
    form: {
      collection: null,
      delivery: null,
      geometry: {
        collection: {},
        delivery: {},
      },
      distance: null,
    },
    error: null,
  }),
  methods: {
    locate(el) {
      $(".pac-container").appendTo(`.${el}`);
      $(".pac-container:last").addClass("dorp_cls");
    },
    validate() {
      if (!this.form.collection || !this.form.delivery) {
        this.error = "Location is required";
        return false;
      }
      this.error = null;
      return true;
    },
    setPlace(place, toCollection) {
      if (!place.geometry) return;
      const getKey = (cond) => (cond ? "collection" : "delivery");
      const key = getKey(toCollection);
      const altKey = getKey(!toCollection);
      this.form[key] = place.formatted_address;
      this.form.geometry[key].location = place.geometry.location;
      this.form.geometry[key].latitude = place.geometry.location.lat();
      this.form.geometry[key].longitude = place.geometry.location.lng();
      if (this.form[altKey]) {
        this.form.distance = this.getDistance(
          place.geometry.location,
          this.form.geometry[altKey].location
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
    onSubmit(cb) {
      if (!this.validate()) return;
      cb(this.form);
    },
  },
  components: { BForm, BFormGroup, BFormInput, BFormSelect },
};
</script>

<style lang="scss" scoped>
.step-form {
  > * {
    margin-bottom: 15px;
  }
}
</style>
