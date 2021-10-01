<template>
  <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="profile-image">
                  <img class="img-xs rounded-circle" :src="`${baseURL}dashboard/assets/images/faces/face8.jpg`" alt="profile image">
                  <div class="dot-indicator bg-success"></div>
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">Muhammad Musaib</p>
                  <p class="designation">ROOT user</p>
                </div>
              </a>
            </li>
            <li class="nav-item nav-category">Main Menu</li>
            <li v-for="(route, index) in routes"  class="nav-item" :key="index" v-if="route.type == undefined">
              <router-link class="nav-link" :to="route.link">
                <i class="menu-icon typcn typcn-document-text"></i>
                <span class="menu-title">{{ route.title }}</span>
              </router-link>
            </li>
            <li class="nav-item" v-for="(route, index) in routes" :key="index" v-if="route.type == 'multi'">
              <a class="nav-link" data-toggle="collapse" :href="`#ui-basic${index}`" aria-expanded="false" :aria-controls="`ui-basic${index}`">
                <i class="menu-icon typcn typcn-coffee"></i>
                <span class="menu-title">{{ route.title }}</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" :id="`ui-basic${index}`">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item" v-for="(sub, index) in route.links" :key="index">
                    <router-link class="nav-link" :to="sub.link">{{ sub.title }}</router-link>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        <!-- partial -->
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    data() {
        return {
            baseURL
        }
    },
    computed: {
        ...mapGetters('common', ['routes'])
    },
    mounted() {
        
    }
}
</script>

<style>

</style>