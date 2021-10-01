<template>
  <b-form class="step-form">
    <b-form-group :label="language.hero_form_step1_whatareyoumoving">
      <b-form-select
        v-model="form.transport"
        :options="transports"
        :state="validateState('transport')"
      />
    </b-form-group>
    <b-form-group :label="language.hero_form_step1_jobtitle">
      <b-form-input
        v-model="form.title"
        :placeholder="language.hero_form_service"
        :state="validateState('title')"
      />
    </b-form-group>
  </b-form>
</template>

<script>
import { BForm, BFormGroup, BFormInput, BFormSelect } from "bootstrap-vue";
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";
import transports from "./data/transports";
export default {
  mixins: [validationMixin],
  props: ["language"],
  data: () => ({
    form: {
      title: "",
      transport: null,
    },
    transports,
  }),
  validations: {
    form: {
      title: {
        required,
        minLength: minLength(3),
      },
      transport: {
        required,
      },
    },
  },
  methods: {
    validateState(name) {
      const { $dirty, $error } = this.$v.form[name];
      return $dirty ? !$error : null;
    },
    onSubmit(cb) {
      this.$v.form.$touch();
      if (this.$v.form.$anyError) {
        return;
      }
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
