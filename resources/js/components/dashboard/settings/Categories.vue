<template>
  <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <button type="button" class="btn btn-md btn-primary btn-fw float-right" @click.prevent="addCategoryModal"><i class="fa fa-plus"></i> ADD CATEGORY</button>
                <h4 class="font-weight-bolder mt-1"><span class="font-weight-light">{{language.all}}</span>  {{ language.categories }}</h4>
                <span class="clearfix"></span>
                <div class="table-res-contain">
                    <table class="table mt-5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{language.title}}</th>
                            <th>{{language.title_pt}}</th>
                            <th>{{language.icon}}</th>
                            <th>{{language.actions}}</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(category, index) in categories" :key="index">
                                <td>{{ (index + 1) }}</td>
                                <td>{{ category.title }}</td>
                                <td>{{ category.title_pt }}</td>
                                <td><i :class="category.icon"></i></td>
                                <td>
                                    <a href="#" class="small text-primary" 
                                        @click.prevent="addCategoryModal({ id: category.id, title: category.title, title_pt: category.title_pt, icon: category.icon })">
                                        Edit | 
                                    </a>
                                    <a href="#" @click.prevent="removeCategory(category.id)" class="small text-danger">Delete | </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!edit" id="exampleModalLabel">Add Category</h5>
                        <h5 class="modal-title" v-if="edit" id="exampleModalLabel">Edit Category</h5>
                        <button type="button" class="close" @click.prevent="closeCategoryModal">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="form-group">
                           <label for="">Category Title</label>
                           <input type="text" v-model="formData.title" class="form-control" placeholder="Enter Category Title">
                       </div>
                       <div class="form-group">
                           <label for="">Category Title (Portugese)</label>
                           <input type="text" v-model="formData.title_pt" class="form-control" placeholder="Enter Category Title (Portugese)">
                       </div>
                       <div class="form-group">
                           <label for="">Icon</label>
                           <input type="text" v-model="formData.icon" class="form-control" placeholder="Enter Code of Icon">
                       </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" v-if="!edit" @click.prevent="saveCategory" class="btn btn-primary">SAVE CATEGORY</button>
                        <button type="button" v-if="edit" @click.prevent="editCategory" class="btn btn-primary">UPDATE CATEGORY</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <Pagination :pagination="pagination" route="dash/settings/categories" :fetch="getCategories" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import Pagination from '../common/Pagination';

export default {
    components: { Pagination },
    data() {
        return {
            language: require(`../language/${$lang}/categories.json`),
            page: (this.$route.query.page == undefined) ? 1 : this.$route.query.page,
            edit: false,
            formData: {}
        }
    },
    computed: {
        ...mapGetters("settings", ['categories', 'pagination', 'errors']),
    },
    mounted() {
        // this.init();
    },
    methods: {
        ...mapActions("settings", ["getCategories", 'addCategory', 'updateCategory', 'deleteCategory']),
        async init() {
            let resp = await this.getCategories(this.page);
        },
        addCategoryModal(data) {
            if(data.title != undefined) {
                this.formData = data;
                this.edit = true;
            }else{
                this.formData = {
                    title: '',
                    title_pt: '',
                    icon: ''
                };
                this.edit = false;
            }
            $('#categoryModal').modal('show');
        },
        closeCategoryModal() {
            $('#categoryModal').modal('hide');
        },
        async saveCategory() {
            let resp =  await this.addCategory(this.formData);
            if(resp == 'success'){
                this.getCategories(this.page);
                Swals.toast('Category Added Successfully', 'success');
                this.formData = {
                    title: '',
                    code: ''
                };
                this.closeCategoryModal();
            }else{
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swals.message('Error', errors, 'error');
            }
        },
        async editCategory() {
            let resp = await this.updateCategory(this.formData);
            if(resp == 'success') {
                this.getCategories(this.page);
                Swals.toast('Category Updated Successfully', 'success');
                this.closeCategoryModal();
            }else{
                let errors = '';
                for(const error in this.errors){
                    errors = '<span class="text-danger">'+errors + this.errors[error][0]+'</span><br>';
                }
                Swals.message('Error', errors, 'error');
            }
        },
        async removeCategory(id){
           await Swals.dialog(
                'Are You Sure?',
                'This Will Delete the Category Permanently !',
                'Yes, Continue',
                'Deleted',
                'Category Deleted Successfully.',
                this.deleteCategory,
                id
            );
            this.getCategories(this.page);
        },
    }
}
</script>

<style>

</style>