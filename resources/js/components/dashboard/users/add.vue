<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <!-- <button type="button" class="btn btn-md btn-primary btn-fw float-right"><i class="fa fa-plus"></i> ADD USER</button> -->
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.addbadges}}</span></h4>
                <span class="clearfix"></span>
                    <div class="col-lg-6">
                         <input type="radio" name="badge" @change="onChange($event)" value="dashboard/assets/images/badges/1.jpg" />
                         <img class="img-md" :src="`${baseURL}dashboard/assets/images/badges/1.jpg`" />
                    </div>
                    <div class="col-md-6">
                         <input type="radio" name="badge" @change="onChange($event)" value="dashboard/assets/images/badges/2.jpg" />
                         <img class="img-md" :src="`${baseURL}dashboard/assets/images/badges/2.jpg`" />
                    </div>
                    <div class="col-md-6">
                         <input type="radio" name="badge" @change="onChange($event)" value="dashboard/assets/images/badges/3.jpg" />
                         <img class="img-md" :src="`${baseURL}dashboard/assets/images/badges/3.jpg`" />
                    </div>
                    <div class="col-md-6">
                         <input type="radio" name="badge" @change="onChange($event)" value="dashboard/assets/images/badges/4.jpg" />
                         <img class="img-md" :src="`${baseURL}dashboard/assets/images/badges/4.jpg`" />
                    </div>
                    <div class="col-md-6">
                         <input type="radio" name="badge" @change="onChange($event)" value="dashboard/assets/images/badges/5.jpg" />
                         <img class="img-md" :src="`${baseURL}dashboard/assets/images/badges/5.jpg`" />
                    </div>
                </div>
            </div>
        </div>

 
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import Pagination from '../common/Pagination';

export default {
    components: { Pagination },
    data() {
        return {
            baseURL,
            language: require(`../language/${$lang}/users.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
        }
    },
    computed: {
        ...mapGetters("user", ['users', 'pagination']),
    },
    mounted() {
        this.init();
    },
    methods: {
        ...mapActions("user", ["getUsers","updateBadge"]),
        async init() {
            let resp = await this.getUsers(this.page);
            console.log(this.users);
        },
        async onChange(event) {
            var badge = event.target.value;
            var data={id:this.$route.params.id,badge:badge};
              console.log(data);
               await Swals.dialog(
                'Are You Sure?',
                'This Will add the badge !',
                'Yes, Continue',
                'Added',
                'Badge added Successfully.',
                this.updateBadge,
                data
            );
          }
    }
}
</script>

<style>

</style>