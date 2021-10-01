<template>
  <b-modal
    centered
    v-model="status"
    id="modalDiscount"
    :title="language.dashboard_model_heading"
    :ok-title="language.get_coupon_code"
    @ok="$emit('subscribe')"
  >
    <img
      :src="`/images/WhatsApp Image 2021-07-22 at 11.36.24.jpeg`"
      style="height: 300px; width: 100%"
      class="mb-4 img-fluid"
      alt="image"
    />
  </b-modal>
</template>

<script>
import { BModal, BButton } from "bootstrap-vue";
export default {
  props: ["language", "active"],
  data: () => ({
    status: false,
  }),
  watch: {
    active(v) {
      this.status = v;
    },
  },
  components: { BModal, BButton },
};
</script>

<style>
</style>