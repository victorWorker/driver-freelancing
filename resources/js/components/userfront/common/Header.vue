<template>
  <div>
    <!---Web Header -->
    <header class="mb-4 d-sm-block d-none">
      <div class="container" id="top">
        <div class="row">
          <div class="col-sm-4 logoholder">
            <img :src="`${baseURL}images/bclogo.png`" />
          </div>
          <div class="col-sm-8 mainmenuholder d-flex flex-column">
            <div class="topmenu d-flex justify-content-end">
              <div class="registermodal d-flex">
                <h3 v-if="token === 'N/A'" class="primaryboldfont registertext uppercase">
                  <i class="fas fa-user"></i>
                  <a
                    href="#"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    
                    >Motorista? Registe-se aqui !</a
                  >
                </h3>
                <h3 class="primaryboldfont registertext">
                  <a href="#" v-if="token !== 'N/A'">
                    Buscargo PRO coming soon
                  </a>
                </h3>
              </div>
              <div
                class="
                  infoblock
                  d-flex
                  justify-content-evenly
                  w-50
                  align-items-center
                  ms-5
                "
              >
                <div class="info1 d-flex align-items-center">
                  <i class="fas fa-phone-volume"></i>
                  <div>
                    <h3 class="biginfo mb-0">
                      <a href="tel:+351210203206">210 203 206</a>
                    </h3>
                    <p class="smallinfo mb-0">{{ language.mon_fri }}</p>
                  </div>
                </div>
                <div class="info2 d-flex align-items-center">
                  <i class="fas fa-at"></i>
                  <div>
                    <h3 class="biginfo mb-0">
                      <a href="mailto:info@buscargo.pt">info@buscargo.pt</a>
                    </h3>
                    <!--<p class="smallinfo mb-0">
                      <a href="mailto:contact@buscargo.pt"
                        >contact@buscargo.pt</a
                      >
                    </p>-->
                  </div>
                </div>
              </div>
            </div>
            <div
              class="
                mainmenu
                d-flex
                flex
                mt-4
                justify-content-end
                align-items-center
              "
            >
              <nav>
                <ul class="mb-0">
                  <li class="active uppercase">
                    <router-link to="/">{{ language.home }}</router-link>
                  </li>
                  <li class="uppercase">
                    <router-link to="/search">{{
                      language.search_deliveries
                    }}</router-link>
                  </li>
                  <li class="uppercase">
                    <router-link to="/how-it-works">{{
                      language.how_it_works
                    }}</router-link>
                  </li>
                  <li class="uppercase">
                    <router-link to="/help">{{ language.help }}</router-link>
                  </li>
                  <li class="uppercase">
                    <router-link to="/aboutus">{{
                      language.about_us
                    }}</router-link>
                  </li>
                </ul>
              </nav>
              <button
                class="roundedborderbutton primaryboldfont uppercase"
                data-bs-toggle="modal"
                data-bs-target="#exampleModal1"
                v-if="token === 'N/A'"
              >
                {{ language.sign_in }}
              </button>
              <UserDropdown v-else />
            </div>
          </div>
        </div>
      </div>
    </header>
    <!---Web Header -->
  </div>
</template>

<script>
import MobileMenu from "../../userfront/common/MobileMenu.vue";
import UserDropdown from "../../core/user-dropdown/UserDropdown.vue";
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      baseURL,
      userName,
      userType,
      userRole,
      token,
      language: require(`../language/${$lang}/common.json`),
    };
  },
  computed: {
    ...mapGetters("front", ["driver"]),
  },
  methods: {
    ...mapActions("front", ["getTransporter"]),
  },
  mounted() {
    this.getTransporter(this.$route.params.id);
  },
  components: { UserDropdown, MobileMenu },
};
</script>

<style>
</style>
