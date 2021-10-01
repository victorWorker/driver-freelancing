<template>
    <!--Footer-->
    <footer class="secondarybg">
        <div class="container-fluid blackbg footer position-relative">
            <div class="container text-white">
                <div class="row mt-5 pb-5">
                    <img :src="baseURL+'images/yellowlogo.png'" class="yellowlogo"/>
                    <div class="social col-sm-4 mt-5">
                        <div class="head">
                            <h2>FOLLOW ON</h2>
                            <h1>SOCIAL 
                            <span class="primarylightfont"> MÍDIA</span></h1>
                        </div>
                        <div class="socialicons">
                            <a href="https://www.facebook.com/buscargotransporte/" target="_blank"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/buscargopt/" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/channel/UCYmfInr_0404aJHS8qLtCBw" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        </div>

                            <h2><i class="fas fa-phone-volume" aria-hidden="true" style="font-size:20px;"></i> 937 982 969</h2>

                        <div class="language d-flex align-items-center">
                            <i class="fas fa-language"></i>
                            <select name="" id="" v-model="lang" @change="changeLanguage">
                                <option value="en">English</option>
                                <option value="pt">Portugese</option>
                            </select>
                        </div>
                    </div>
                    <div class="links col-sm-3 my-3 my-sm-0">
                        <div class="head">
                            <h2>BROWSE</h2>
                            <h1>RÁPIDOS <span class="primarylightfont"> LINKS</span></h1>
                            <hr>
                        </div>
                        <ul class="m-0 p-0">
                            <li><router-link to="/" class="uppercase">{{ language.home }}</router-link></li>
                            <li><router-link to="/search" class="uppercase">{{ language.search_deliveries }}</router-link></li>
                            <li><router-link to="/how-it-works" class="uppercase">{{ language.how_it_works }}</router-link></li>
                            <li><router-link to="/help" class="uppercase">{{ language.help }}</router-link></li>
                            <li><router-link to="/aboutus" class="uppercase">{{ language.about_us }}</router-link></li>
                        </ul>
                    </div>
                    <div class="about col-sm-4 offset-sm-1 my-3 my-sm-0">
                        <div class="head">
                            <h2>READ</h2>
                            <h1>SOBRE <span class="primarylightfont"> NÓS</span></h1>
                            <hr>
                        </div>
                        <p class="primarylightfont"> {{ language.footer_about }} </p>
                    </div>
                </div>
                <div class="copyright bg-white w-100">
                    <p class="mb-0 text-center text-secondary mobilepadding">BusCargo LDA. All rights reserved |  Designed, developed and maintained by RedArc Technology Pvt. Ltd. </p>
					
                    <button type="button" @click.prevent="chkLogin" class="btn btn-primary" id="hidnform" style="display:none">T</button>
                    <input type="hidden" id="logusrusrnm" value=""/>
                    <input type="hidden" id="logpass" value=""/>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer-->
	
</template>
<script>
export default {
    data(){
        return {
            baseURL,
            lang: $lang,
            language: require(`../language/${$lang}/common.json`),
        }
    },
    methods: {
		
		chkLogin(){
			    let usrEml =  document.getElementById('logusrusrnm').value;
                let usrPass = document.getElementById('logpass').value;
				let loginData = {'email': usrEml, 'password': usrPass};
                axios.post('/public/api/login', loginData)
                 .then((resp) => {
                        localStorage.setItem('token', resp.data.token);
                        localStorage.setItem('userId', resp.data.user.id);
                        localStorage.setItem('userName', resp.data.user.name);
                        localStorage.setItem('userType', resp.data.user.type);
                        localStorage.setItem('userEmail', resp.data.user.email);
                        localStorage.setItem('role', resp.data.user.type.toLowerCase());
                        let url = this.baseURL;
                        if(resp.data.user.type === 'ROOT'){
                            url = url + 'dash';
                        }else{
                             url = url + resp.data.user.type.toLowerCase() + '/dashboard';
                        }

                        setTimeout(function(){
                            window.location.href = url;
                        },1000)


                 })
                 .catch((error) => {
                     if(error){
                        console.log(error);
                     }
                 });
			
		},
	
        changeLanguage() {
            localStorage.setItem('lang', this.lang);
            window.location.href = window.location.pathname;
        }
    }
    
}
</script>

<style scoped>
.language {
    margin-top: 25px;
}
.language select{
    background: transparent;
    color: #bbb8b8;
    padding: 2px 15px; 
}
.language i{ 
    color: #dfdede !important;
}
</style>