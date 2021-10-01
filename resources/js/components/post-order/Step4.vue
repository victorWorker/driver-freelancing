<template>
  <b-form class="step-form">
    <b-form-group :label="language.hero_form_step4_image">
      <b-form-file
        v-model="file"
        :state="Boolean(file)"
        :placeholder="language.hero_form_chooseImage"
        drop-placeholder="Drop file here..."
        accept=".jpg, .png, .jpeg"
      />
      <b-progress
        v-show="file && progress > 0"
        :value="progress"
        :max="100"
        show-value
        class="mb-3"
      />
      <span class="text-secondary">{{ language.homeimagesec }}</span>
    </b-form-group>
    <b-form-group
      :label="`${language.description} (${language.desc_minwords})`"
    >
      <b-form-textarea
        v-model="form.description"
        :placeholder="language.description"
        :state="validateState('description')"
        rows="4"
      />
    </b-form-group>
  </b-form>
</template>

<script>
import {
  BForm,
  BFormGroup,
  BFormInput,
  BFormSelect,
  BFormTextarea,
  BFormFile,
  BProgress,
} from "bootstrap-vue";
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";
import { mapActions, mapMutations, mapState } from "vuex";
export default {
  mixins: [validationMixin],
  props: ["language"],
  data: () => ({
    file: null,
    form: {
      image: null,
      description: null,
    },
  }),
  watch: {
    file(file) {
      if (!file) return;
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onloadend = (e) => {
        this.url = e.target.result;
        this.barstart = true;
        this.uploadImg(reader.result)
          .then((response) => {
            this.form.image = response;
          })
          .catch((error) => {
            console.log(error);
          });
      };
    },
  },
  validations: {
    form: {
      description: {
        required,
        minLength: minLength(15),
      },
    },
  },
  methods: {
    ...mapMutations("front", ["SET_PROGRESS"]),
    ...mapActions("front", ["uploadImg"]),
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
  mounted() {
    this.SET_PROGRESS(0);
  },
  computed: {
    ...mapState("front", ["progress"]),
  },
  components: {
    BForm,
    BFormGroup,
    BFormInput,
    BFormSelect,
    BFormTextarea,
    BFormFile,
    BProgress,
  },
};
</script>

<style lang="scss" scoped>
.step-form {
  > * {
    margin-bottom: 15px;
  }
}
</style>
