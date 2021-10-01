import Api from './Api';

export default {
    async validateuser(data) {
        await Api.get('/sanctum/csrf-cookie')
        return Api.post('/login', data);
    },
    logoutuser() {
        return Api.post('/logout');
    },
    loadauthuser() {
        return Api.get('/user');
    },
    forgotpassword(data) {
        return Api.post('/forgot-pass', data);
    },
    resetpassword(data) {
        return Api.post('/reset-pass', data);
    }

}
