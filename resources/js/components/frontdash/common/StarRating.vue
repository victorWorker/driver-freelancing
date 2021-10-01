<template>
  <div class="rating">
    <ul class="list">
      <li @click="rate(star)" v-for="star in maxStars" :class="{ 'active': star <= stars }" :key="star.stars" class="star">
      <i :class="star <= stars ? 'fas fa-star' : 'far fa-star'"></i> 
      </li>
    </ul>
    <div v-if="hasCounter" class="info counter">
      <span class="score-rating">{{ stars }}</span>
      <span class="divider">/</span>
      <span class="score-max">{{ maxStars }}</span>
    </div>
  </div>
</template>
<script>
import { mapActions } from 'vuex';
export default {
  name: 'Rating',
  props: ['grade', 'maxStars', 'hasCounter'],
  data() {
    return {
      stars: this.grade
    }
  },
  methods: {
    ...mapActions('shipment', ['setRating']),
    rate(star) {
      if (typeof star === 'number' && star <= this.maxStars && star >= 0) {
        this.stars = this.stars === star ? star - 1 : star
        this.setRating(star);
      }
    }
  },
}
</script>

<style scoped lang="scss">
  @import '../../../../../public/css/rating.scss';
</style>