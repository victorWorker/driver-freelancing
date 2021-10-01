import Api from './Api';

export default {
    loadusers(page) {
        return Api.get(`/admin/users/get/users?page=${page}`);
    },
    loaduser(id) {
        return Api.get(`/admin/users/get/user/${id}`);
    },
    loadtransporter(id) {
        return Api.get(`/admin/users/get/transporter/${id}`);
    },
    loadtransporters(page) {
        return Api.get(`/admin/users/get/transporters?page=${page}`);
    },
    loadnotdocumentstransporters(page) {
        return Api.get(`/admin/users/get/transporters/nodocument?page=${page}`);
    },
    saveuser(data) {
        return Api.post('/register', data);
    },
    banuser(id){
        return Api.patch('/admin/users/ban/'+id);
    }, 
    setusersms(id){
        return Api.patch('/admin/users/setusersms/'+id);
    },
    unsetusersms(id){
        return Api.patch('/admin/users/unsetusersms/'+id);
    },
    deleteuser(id){
       return Api.delete(`/admin/users/${id}`);
    },
    approveuser(id){
        return Api.patch('/admin/users/approve/'+id);
    },
    searchuser(data) {
        return Api.post('/admin/users/search', data);
    },
    sendemail(data) {
        return Api.post('/admin/users/mail', data);
    },
    uploadprofile(base64,commit){
        return Api.post('transporter/document/uploadprofile',{image:base64}, {onUploadProgress: (progressEvent) => {
            commit('SET_PROGRESS',Math.floor(progressEvent.loaded * 100 / progressEvent.total))
        }});
    },
     uploaduserprofile(base64,commit){
        return Api.post('user/document/uploadprofile',{image:base64}, {onUploadProgress: (progressEvent) => {
            commit('SET_PROGRESS',Math.floor(progressEvent.loaded * 100 / progressEvent.total))
        }});
    }, 
    upload(base64,commit){
        return Api.post('transporter/document/upload',{doc:base64}, {onUploadProgress: (progressEvent) => {
            commit('SET_PROGRESS',Math.floor(progressEvent.loaded * 100 / progressEvent.total))
        }});
    },
    addverificationdocs(data) {
        return Api.post('/transporter/documents/add', data);
    },
    updatetransporter(data) {
        return Api.patch('/transporter/update/profile', data);
    },
    updateuser(data) {
        return Api.patch('/user/update/profile', data);
    },
    updatebadge(data) {
        return Api.post('/admin/update/badge', data);
    }
}