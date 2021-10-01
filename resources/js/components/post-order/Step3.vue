<template>
  <b-form class="step-form">
    <b-form-group label="Name">
      <b-form-input
        v-model="form.name"
        placeholder="Name"
        :state="validateState('name')"
      />
    </b-form-group>
    <b-form-group :label="language.hero_form_step3_mail">
      <b-form-input
        v-model="form.email"
        placeholder="E-mail"
        type="email"
        :state="validateState('email')"
      />
    </b-form-group>
    <b-form-group :label="language.homepage_msgmodel_pass">
      <b-form-input
        v-model="form.password"
        placeholder="Password"
        type="password"
        :state="validateState('password')"
      />
    </b-form-group>
    <b-form-group :label="language.hero_form_step3_telephone">
      <b-form-input
        v-model="form.phone"
        placeholder="Telephone"
        :state="validateState('phone')"
      />
    </b-form-group>
    <div v-if="emailExist" class="text-danger">Email exist, choose different email</div>
  </b-form>
</template>

<script>
import { BForm, BFormGroup, BFormInput, BFormSelect } from "bootstrap-vue";
import { validationMixin } from "vuelidate";
import { required, email, minLength } from "vuelidate/lib/validators";
import Api from '../../Api/Api';
export default {
  mixins: [validationMixin],
  props: ["language"],
  data: () => ({
    form: {
      name: null,
      email: null,
      password: null,
      phone: null,
    },
    emailExist: false
  }),
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(4),
      },
      email: {
        email,
        required,
      },
      password: {
        required,
        minLength: minLength(5),
      },
      phone: {
        required,
        minLength: minLength(5),
      },
    },
  },
  methods: {
    validateState(name) {
      const { $dirty, $error } = this.$v.form[name];
      return $dirty ? !$error : null;
    },
    async onSubmit(cb) {
      this.$v.form.$touch();
      if (this.$v.form.$anyError) return;
      const {data} = await Api.get(`/user/email/${this.form.email}`)
      if(+data) return this.emailExist = true;
      this.emailExist = false;
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
