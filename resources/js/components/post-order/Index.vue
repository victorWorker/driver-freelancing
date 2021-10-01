<template>
  <b-card
    :title="activeTab.title"
    :img-src="activeTab.image"
    img-alt="Image"
    img-top
    tag="article"
    class="mb-2"
    id="postOrder"
  >
    <keep-alive>
      <!-- Form component -->
      <component ref="comp" :is="activeTab.form" :language="language" />
    </keep-alive>
    <!-- Actions -->
    <div class="text-right mt-4">
      <b-button
        @click="switchTab(-1)"
        v-if="activeTab.id !== 0"
        :disabled="loading"
      >
        {{ language.hero_form_step_prev }}
      </b-button>
      <b-button
        @click="switchTab(1)"
        v-if="activeTab.id !== finalTabs.length - 1"
        variant="primary"
      >
        {{ language.hero_form_step_nextbtton }}
      </b-button>
      <b-button
        @click="submit"
        v-if="activeTab.id === finalTabs.length - 1"
        variant="success"
        :disabled="loading"
      >
        <b-spinner v-if="loading" small></b-spinner>
        <span v-else>{{ language.hero_form_step_submit }}</span>
      </b-button>
    </div>
  </b-card>
</template>

<script>
import loginMixin from "../../mixins/login";
import { mapState } from "vuex";
import { BButton, BCard, BSpinner } from "bootstrap-vue";
import Step1 from "./Step1.vue";
import Step2 from "./Step2.vue";
import Step3 from "./Step3.vue";
import Step4 from "./Step4.vue";
import Api from "../../Api/Api";
export default {
  props: ["language"],
  mixins: [loginMixin],
  data: () => ({
    form: {},
    activeTab: null,
    tabs: [
      {
        image: "/images/selection_new.gif",
        form: Step1,
      },
      {
        image: "/images/pickup_new.gif",
        form: Step2,
      },
      {
        image: "/images/deliver_new.gif",
        guetsOnly: true,
        form: Step3,
      },
      {
        image: "/images/deliver_new.gif",
        form: Step4,
      },
    ],
  }),
  created() {
    this.activeTab = this.finalTabs[0];
  },
  computed: {
    ...mapState("common", ["isAuthenticated"]),
    ...mapState("user", ["authUser"]),
    finalTabs() {
      console.log(this.authUser.type);
      return this.tabs
        .filter((t) =>
          t.guetsOnly
            ? this.authUser.type != "USER" || !this.isAuthenticated
            : true
        )
        .map((t, i) => ({
          ...t,
          title: `${this.language["hero_form_step"]} ${i + 1}`,
          id: i,
        }));
    },
  },
  methods: {
    // Next, previous
    switchTab(dirSign) {
      if (dirSign > 0) {
        // Before go to next - should validate and get form data
        this.$refs.comp.onSubmit((data) => {
          this.form = { ...this.form, ...data };
          this.activeTab = this.finalTabs[this.activeTab.id + 1];
        });
      } else {
        this.activeTab = this.finalTabs[this.activeTab.id + dirSign];
      }
    },
    // Submit form
    submit() {
      this.$refs.comp.onSubmit(async (data) => {
        this.loading = true;
        this.form = { ...this.form, ...data };
        if (this.isAuthenticated) this.form.userid = this.authUser?.id || null;
        const result = await Api.post("/form/shipment-create", this.form);
        if (this.form.email && this.form.password){
          await this.loginPost(this.form.email, this.form.password, result.data.id);
          Swal.fire({
            icon: "success",
            title: "Alert",
            text: "Congrats, shipment is created now",
          });
        }else {
          console.log('updateworkser', result);
          this.loading = false;
          // this.$router.push(this.authUser.type === 'ROOT' ? 'dash' : `${this.authUser.type.toLowerCase()}/dashboard`); 
          this.$router.push(this.authUser.type === 'ROOT' ? `shipment/${result.data.id}` : `shipment/${result.data.id}`)
          Swal.fire({
            icon: "success",
            title: "Alert",
            text: "Congrats, shipment is created now",
          });
        }
      });
    },
  },
  components: { BButton, BCard, BSpinner },
};
</script>

<style scoped>
#postOrder {
  box-shadow: 2px -2px 20px 8px #d7d7d775;
  border: none;
  border-radius: 15px;
}
.text-right {
  text-align: right;
}
</style>