<template>
    <div class="col-md-12 text-right mb-5 pr-5 pagination-holder">
        <div class="btn-group border-0" role="group" aria-label="First group">
            <button type="button" v-if="pagination.current_page > 1" class="btn btn-dark mr-2" @click.prevent="goto(pagination.current_page - 1)">&laquo; Prev</button>
            <template v-if="pagination.total !== 0">
                <button 
                    type="button" 
                    v-for="(page, index) in pagination.last_page" 
                    :key="index" 
                    :class="(pagination.current_page == page) ? 'btn btn-secondary' : 'btn btn-light'"
                    @click.prevent="goto(page)">
                    {{page}}
                </button>
            </template>
            <template v-else>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <img :src="baseURL+'images/noresults.svg'" class="w-50" />
                    <h1 class="primaryboldfont mt-4 mtcolor">No <span class="primarylightfont">Results</span> Found</h1>
                </div>
                
            </template>
            <button type="button" v-if="pagination.last_page > pagination.current_page" class="btn btn-dark ml-2" @click.prevent="goto(pagination.current_page+1)">Next &raquo;</button>
        </div>
    </div>
</template>

<script>
export default {
    props: [ 'pagination', 'route', 'fetch','setloading','unsetloading','filters','form' ],
    data() {
        return {
            baseURL,
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
        }
    },
    methods: {
        paginate() {
           this.page = this.$route.query.page;
            if(!this.page){
                this.page = 1;
            }
            this.fetch({filters:this.filters,form:this.form,page:this.page});
        },
        goto(page){
            console.log(this.page);
            this.$router.push(`/${this.route}?page=${page}`).catch(()=>{});
            this.fetch({filters:this.filters,form:this.form,page:page});
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