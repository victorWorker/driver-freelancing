<template>
    <div class="col-md-12 text-right mb-5 pr-5 pagination-holder">
        <div class="btn-group border-0" role="group" aria-label="First group">
            <button type="button" v-if="pagination.current_page > 1" class="btn btn-dark mr-2" @click.prevent="goto(pagination.current_page - 1)">&laquo; Prev</button>
            
            <button 
                type="button" 
                v-for="(page, index) in pagination.last_page" 
                :key="index" 
                :class="(pagination.current_page == page) ? 'btn btn-secondary' : 'btn btn-light'"
                @click.prevent="goto(page)">
                {{page}}
            </button>

            <button type="button" v-if="pagination.last_page > pagination.current_page" class="btn btn-dark ml-2" @click.prevent="goto(pagination.current_page+1)">Next &raquo;</button>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'pagination', 'route', 'fetch','setloading','unsetloading' ],
    data() {
        return {
            page: null,
            first: true
        }
    },
    mounted() {
        this.paginate();
    },
    methods: {
        paginate() {
            if(this.first){
                this.page = 1;
                this.first = false
            }else{
                this.page = this.$route.query.page;
            }
           
            if(!this.page){
                this.page = 1;
            }
            this.fetch(this.page);
        },
        goto(page){
            console.log('triggered')
            this.$router.push(`/${this.route}?page=${page}`).catch(()=>{});
            
            this.fetch(page);
            this.setloading();
            setTimeout(() => {
                this.unsetloading();
                $("html, body").animate({ scrollTop: 0 }, "slow");
            },1000);
            
            
        }
    }
}
</script>

<style>

</style>