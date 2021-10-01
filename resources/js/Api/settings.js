import Api from './Api';

export default {
    loadcategories(page) {
        return Api.get(`/admin/categories?page=${page}`);
    },
    addcategory(data) {
        return Api.post('/admin/categories', data);
    },
    updatecategory(data, id){
        return Api.patch(`/admin/categories/${id}`, data);
    },
    deletecategory(id) {
        return Api.delete(`/admin/categories/${id}`);
    }
}