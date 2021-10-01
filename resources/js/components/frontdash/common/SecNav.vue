<template>
  <!-- partial:partials/_sidebar.html -->
        <nav :class="(!menu) ? 'sidebar sidebar-offcanvas' : 'sidebar sidebar-offcanvas active'" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ userName }}</p>
                  <p class="designation">{{ userType }}</p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li v-for="(route, index) in frontRoutes"  class="nav-item" :key="index" v-if="route.type == undefined && route.role == userRole" @click="hideMenu">
              <router-link class="nav-link" :to="route.link">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{ (lang === 'en') ? route.title : route.title_pt }}</span>
              </router-link>
            </li>
            <li class="nav-item" v-for="(route, index) in frontRoutes" :key="index" v-if="route.type == 'multi' && route.role == userRole" @click="hideMenu">
              <a class="nav-link" data-toggle="collapse" :href="`#ui-basic${hideMenu}`" aria-expanded="false" :aria-controls="`ui-basic${index}`">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">{{ (lang === 'en') ? route.title : route.title_pt }}</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" :id="`ui-basic${index}`">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item" v-for="(sub, index) in route.links" :key="index">
                    <router-link class="nav-link" :to="sub.link">{{ (lang === 'en') ? sub.title : sub.title_pt }}</router-link>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
</template>

<script>
import { mapActions, mapGetters,mapState } from 'vuex';
export default {
    data() {
        return {
            lang: $lang,
            baseURL,
            userRole,
            userType,
            userName,
        }
    },
    computed: {
        ...mapGetters('common', ['frontRoutes',"menu"])
    },
    
    methods: {
        ...mapActions("common", ['hideMenu'])
    }
}
</script>

<style>

</style>