<template>
  <div v-if="links" class="specifc-usr-an">
    <b-dropdown
      ref="usrD"
      class="user-dropdown-an m-2"
      variant="outline-light"
      offset="-100"
      no-caret
    >
      <template #button-content>
        <span class="text-buscargo">My Buscargo</span>
        <b-avatar src="/dashboard/assets/images/faces/face8.jpg"></b-avatar>
      </template>
      <div class="info-userdropdown">
        <h3>{{ authUser.name }}</h3>
        <p>{{ authUser.email }}</p>
      </div>
      <b-dropdown-divider />
      <div v-for="(d, i) in links" :key="`d${i}`">
        <b-dropdown-divider v-if="d.divider" />
        <b-dropdown-item-button @click="navigate(d.to)" v-else-if="d.label">
          <span
            class="count bg-success"
            v-if="unreadCount != undefined && d.to.includes('/messages')"
            v-text="unreadCount || 0"
          />
          {{ d.label }}
        </b-dropdown-item-button>
        <b-dropdown-group v-else-if="d.groupLabel" :header="d.groupLabel">
          <router-link
            v-for="(b, ii) in d.items"
            :to="b.to"
            :key="`dd${ii}`"
            class="link-dropdown"
          >
            <b-dropdown-item-button>
              {{ b.label }}
            </b-dropdown-item-button>
          </router-link>
        </b-dropdown-group>
      </div>
      <b-dropdown-item-button @click="logout">
        {{ language.signOut }}
      </b-dropdown-item-button>
    </b-dropdown>
  </div>
</template>

<script>
import {
  BDropdown,
  BDropdownGroup,
  BDropdownDivider,
  BDropdownItemButton,
  BAvatar,
} from "bootstrap-vue";
import { mapGetters } from "vuex";
import userLinks from "./links/user.type";
import transLinks from "./links/transporter.type";
import adminLinks from "./links/admin.type";
export default {
  data: () => ({
    links: null,
    language: require(`../../frontdash/language/${$lang}/dashboardList.json`),
  }),
  watch: {
    authUser(v) {
      if (!v) return;
      if (this.isAdmin) return (this.links = adminLinks(this.language));
      this.links =
        this.authUser.type == "TRANSPORTER"
          ? transLinks(this.language)
          : userLinks(this.language);
    },
  },
  methods: {
    logout() {
      localStorage.clear();
      location.pathname = "/";
    },
    navigate(to) {
      if (this.isAdmin) location.pathname = to;
      else {
        this.$router.push(to);
      }
    },
  },
  computed: {
    ...mapGetters("front", ["unreadCount"]),
    ...mapGetters("user", ["authUser"]),
    isAdmin() {
      return this.authUser.type == "ROOT";
    },
  },
  components: {
    BDropdown,
    BDropdownGroup,
    BDropdownDivider,
    BDropdownItemButton,
    BAvatar,
  },
};
</script>

<style lang="scss">
.specifc-usr-an {
  ul li {
    padding: 0 !important;
    font-size: initial !important;
    a:hover {
      font-family: inherit;
      color: #5d5d5d;
    }
  }
}
.user-dropdown-an {
  &.show {
    background-color: #f7f7f7;
  }
  hr {
    background: #eee;
  }
  .link-dropdown {
    text-decoration: none;
  }
  .info-userdropdown {
    padding: 5px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    h3 {
      font-size: 18px;
    }
    p {
      margin-bottom: 0;
      color: #b8b7b7;
      font-size: 14px;
    }
  }
}
.count {
  color: white;
  border-radius: 200%;
  padding: 2px;
  width: 25px;
  display: inline-flex;
  height: 25px;
  text-align: center;
  justify-content: center;
  align-items: center;  
}
.text-buscargo {
  display: none;
  color: #5d5d5d;
}
@media (max-width: 576px) {
  .user-dropdown-an {
    width: 97%;
  }
  .specifc-usr-an {
    border: 1px solid #ccc;
    border-radius: 15px;
  }
  .text-buscargo {
    display: inline-block;
  }
}
</style>