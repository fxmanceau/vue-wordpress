<template>
  <section class="home-articles">
    <slot></slot>
  </section>
</template>

<script>
export default {
  name: 'HomeParallax',
  methods:
  {
    visibileObject(elements)
    {
      const observer = new IntersectionObserver((observable) =>
      {
        if (observable[0].intersectionRatio > 0) {
          observable[0].target.classList.add('on-view')
          observer.unobserve(observable[0].target)
        }
      }, {threshold: [0]});
      elements.forEach(element => {
        observer.observe(element);
      });
    }
  },
  mounted()
  {
    this.elements = document.querySelectorAll('.articles-item')
    this.visibileObject(this.elements)
  }
}
</script>

<style lang="scss">
  @import './Home-Articles.scss';
</style>


