<template>
     <section class="container team-section text-center my-5">
        <!--Grid row-->
        <div class="row text-center">
            <!--Grid column-->
            <div class="col-md-4 mb-md-0 mb-5">

            <div class="testimonial">
                <!--Avatar-->
                <div class="avatar mx-auto">
                <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(1).jpg" class="rounded-circle z-depth-1 img-fluid">
                </div>
                <!--Content-->
                <h4 class="font-weight-bold dark-grey-text mt-4">Anna Deynah</h4>
                <h6 class="font-weight-bold blue-text my-3">Web Designer</h6>
                <p class="font-weight-normal dark-grey-text">
                <i class="fas fa-quote-left pr-2"></i> {{ language.testimonial_1_text }}</p>
                <!--Review-->
                <div class="text-warning">
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="fas fa-star-half-alt"> </i>
                </div>
            </div>

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-md-0 mb-5">

            <div class="testimonial">
                <!--Avatar-->
                <div class="avatar mx-auto">
                <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(8).jpg" class="rounded-circle z-depth-1 img-fluid">
                </div>
                <!--Content-->
                <h4 class="font-weight-bold dark-grey-text mt-4">John Doe</h4>
                <h6 class="font-weight-bold blue-text my-3">Web Developer</h6>
                <p class="font-weight-normal dark-grey-text">
                <i class="fas fa-quote-left pr-2"></i> {{ language.testimonial_2_text }}</p>
                <!--Review-->
                <div class="text-warning">
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                </div>
            </div>

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4">

            <div class="testimonial">
                <!--Avatar-->
                <div class="avatar mx-auto">
                <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(10).jpg" class="rounded-circle z-depth-1 img-fluid">
                </div>
                <!--Content-->
                <h4 class="font-weight-bold dark-grey-text mt-4">Maria Kate</h4>
                <h6 class="font-weight-bold blue-text my-3">Photographer</h6>
                <p class="font-weight-normal dark-grey-text">
                <i class="fas fa-quote-left pr-2"></i> {{ language.testimonial_3_text }}</p>
                <!--Review-->
                <div class="text-warning">
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="fas fa-star"> </i>
                <i class="far fa-star"> </i>
                </div>
            </div>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        </section>
</template>

<script>
export default {
    props: [ 'language' ],
    data() {
        return {
            
        }
    },
    mounted() {

    }
}
</script>

<style>

</style>