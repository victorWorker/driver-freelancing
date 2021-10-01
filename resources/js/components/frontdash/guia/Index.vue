<template>
   <div class="row">
      <div class="col-md-8 offset-md-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" id="GUIA">
                    <div class="table-res-contain">
                    <table class="w-100 table-bordered" v-if="guia.awarded != undefined">
                        <tr>
                            <td class="px-4">
                                <b>TRANSPORTADOR</b>
                                <p class="mt-2">
                                    Name: {{ guia.awarded.name }}<br />
                                    Address: {{ guia.awarded.address }}
                                </p>
                            </td>

                            <td rowspan="2" class="d-flex flex-column align-items-end p-4">
                                <span class="font-weight-bold">GUIA DE TRANSPORTE #{{$route.params.id}}</span>
                                <div class="details mt-5">
                                    <h4 class="font-weight-bold text-primary mb-1">BusCargo <span class="font-weight-light">LDA</span></h4>
                                    <p>
                                        Portugal, PT<br />
                                        210 203 206<br />
                                        <i>www.buscargo.pt</i>
                                    </p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-4" colspan="2">
                                <b>DESTINATÁRIO</b>
                                <p class="mt-2">
                                    Name: {{ guia.user.name }}<br />
                                    Address: {{ guia.actual_details.address }}<br />
                                    Phone: {{ guia.actual_details.phone }}<br />
                                </p>
                            </td>
                        </tr>
                    </table>
                    </div>
                    <div class="form-group text-right mt-5">
                        <a href="" class="btn btn-md rounded-pill btn-success" @click.prevent="downloadGuia"><i class="fas fa-download"></i> DOWNLOAD</a>
                    </div>
                </div>
            </div>
      </div>
   </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex';
import {jsPDF} from 'jspdf';
import html2canvas from "html2canvas";

export default {
    data() {
        return {

        }
    },
    computed: {
        ...mapGetters('shipment', ['guia']),
    },
    async mounted() {
        let resp = await this.generateGuia(this.$route.params.id);
        if(resp !== 'success'){
            Swals.message('Forbidden', "You are not allowed to access this resource.", 'error');
            this.$router.push('/transporter/dashboard');
        }
    },
    methods: {
        ...mapActions('shipment', ['generateGuia']),
        downloadGuia() {
            let pdf = new jsPDF();
            var element = $('#GUIA');
            var width = element.width()/4;
            var height = element.height()/4;
            console.log(element);
            html2canvas(element[0]).then(canvas => {
                var image = canvas.toDataURL('image/jpg');
                pdf.addImage(image, 'JPEG', 10, 10, width, height);
                pdf.save('guia_de_transporte.pdf');
            });
        }
    }
}
</script>

<style>

</style>