<template>
  <nav class="navbar navbar-expand-lg navbar-light d-sm-none bg-light pt-0 mobileNavAN">
    <div class="container-fluid">
      <a class="navbar-brand pt-0" href="#">
        <div class="col-sm-4 logoholder">
          <img :src="`${baseURL}images/bclogo.png`" />
        </div>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarText"
        aria-controls="navbarText"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link class="nav-link active" aria-current="page" to="/"
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link to="/search" class="nav-link">{{
              language.search_deliveries
            }}</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/how-it-works">{{
              language.how_it_works
            }}</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/aboutus">{{
              language.about_us
            }}</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/help">{{
              language.help
            }}</router-link>
          </li>

          <li class="nav-item text-center actions-nav">
            <b-button
              data-bs-toggle="modal"
              data-bs-target="#exampleModal1"
              v-if="token === 'N/A'"
              variant="warning"
              pill
              size="lg"
              block
            >
              {{ language.sign_in }}
            </b-button>
            <b-button
              v-if="token == 'N/A'"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
              variant="warning"
              pill
              size="lg"
              block
              >{{ language.register }}
            </b-button>
            <UserDropdown />
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
import UserDropdown from "../../core/user-dropdown/UserDropdown.vue"
import { BButton } from "bootstrap-vue";
import { mapActions } from "vuex";
export default {
  data() {
    return {
      token,
      baseURL,
      userRole,
      language: require(`../language/${$lang}/common.json`),
    };
  },
  methods: {
    ...mapActions("common", ["logoutUser"]),
    async logout() {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger",
        },
        buttonsStyling: false,
      });
      swalWithBootstrapButtons
        .fire({
          title: "Are you sure?",
          text: "You will be logged out from the dashboard!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Yes, log me out!",
          cancelButtonText: "No, cancel!",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.logoutUser()
              .then((resp) => {
                return resp;
              })
              .then((resp) => {
                if (resp === "success") {
                  localStorage.clear();
                  window.location.href = this.baseURL;
                }
                swalWithBootstrapButtons.fire(
                  "Logged out!",
                  "Your have been successfully logged out.",
                  "success"
                );
              })
              .catch(() => {
                console.log("Error in logging out");
              });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
          }
        });
    },
  },
  components: { BButton, UserDropdown },
};
</script>
<style lang="scss" scoped>
.logoholder img {
  max-width: 12rem;
}
.navbar {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 9999;
}
.actions-nav {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  > * {
    width: 100%;
    margin-top: 10px;
  }
  a {
    font-family: inherit;
  }
}
.mobileNavAN {
      position: sticky;
    top: 0;
    z-index: 99;
}
</style>