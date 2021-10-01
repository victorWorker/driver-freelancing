<template>
  <b-modal centered v-model="status" id="modalUserInfo" :title="language.dashboard_model_heading ">
    <ul>
      <li>{{ language.dashboard_model_paragraph }}</li>
      <li>{{ language.dashboard_model_list1 }}</li>
      <li>{{ language.dashboard_model_list2 }}</li>
      <li>{{ language.dashboard_model_list3 }}</li>
    </ul>
    <template #modal-footer>
      <div></div>
    </template>
  </b-modal>
  <!-- <div
    class="modal fade"
    id="userDashbordonload"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div
      class="modal-dialog dash-auto-model modal-dialog-centered"
      role="document"
    >
      <div class="modal-content">
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
          onclick="$('.modal').hide()"
        >
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-body d-flex p-5">
          <div class="my-auto">
            <h3>{{ language.dashboard_model_heading }}</h3>

            <ul>
              <li>{{ language.dashboard_model_paragraph }}</li>
              <li>{{ language.dashboard_model_list1 }}</li>
              <li>{{ language.dashboard_model_list2 }}</li>
              <li>{{ language.dashboard_model_list3 }}</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div> -->
</template>

<script>
import { BModal } from "bootstrap-vue";
export default {
  props: ["language", "active"],
  data: () => ({
    status: false,
  }),
  watch: {
    active(v) {
      if(!v) return;
      if(window.opnedBefore) return;
      window.opnedBefore = true;
      this.status = true
    }
  },
  components: { BModal },
};
</script>

<style lang="scss">
#modalUserInfo {
  .modal-body {
    min-height: 215px;
    margin-left: 0 !important;
  }
  li {
        text-shadow: 1px -1px 4px #fff;
  }
}
</style>