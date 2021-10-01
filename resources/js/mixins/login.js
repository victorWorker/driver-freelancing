import { mapActions } from 'vuex';

export default {
    data: () => ({
        baseURL,
	loading: false,
    }),
    methods: {
        ...mapActions('common', ['authLogin']),
        async login(email, password) {
	        this.loading = true;
            email = email || this.email
            password = password || this.password
            let resp = await this.authLogin({ email, password});
            if(resp != 'error'){
                //Login user
                localStorage.setItem('token', resp.token);
                localStorage.setItem('userId', resp.user.id);
                localStorage.setItem('userName', resp.user.name);
                localStorage.setItem('userType', resp.user.type);
                localStorage.setItem('userEmail', resp.user.email);
                localStorage.setItem('role', resp.user.type.toLowerCase());
		        let link = resp.user.type === 'ROOT' ? 'dash' : `${resp.user.type.toLowerCase()}/dashboard`
                if(resp.user.type == 'USER') link += '/redirect';
                location.pathname = link; 
            }else{
                //Display Error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Incorrect Username/Password',
                })
            }
            this.loading = false;
        },
        async loginPost(email, password, shipmentId) {
            this.loading = true;
            email = email || this.email
            password = password || this.password
            let resp = await this.authLogin({ email, password});
            if(resp != 'error'){
                //Login user
                localStorage.setItem('token', resp.token);
                localStorage.setItem('userId', resp.user.id);
                localStorage.setItem('userName', resp.user.name);
                localStorage.setItem('userType', resp.user.type);
                localStorage.setItem('userEmail', resp.user.email);
                localStorage.setItem('role', resp.user.type.toLowerCase());
		        // let link = resp.user.type === 'ROOT' ? 'dash' : `${resp.user.type.toLowerCase()}/dashboard`
                let link = resp.user.type === 'ROOT' ? 'dash' : `shipment/${shipmentId}`
                location.pathname = link; 
            }else{
                //Display Error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Incorrect Username/Password',
                })
            }
            this.loading = false;
        }
    }
}

