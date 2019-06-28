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
      this.options = {
          root: null,
          rootMargin: '0px',
          threshold: 0.1
      };

      const observer = new IntersectionObserver(this.intersectCallback, this.options);

      for (let element of elements) {
          observer.observe(element);
      }
    },
    intersectCallback(entries, observer)
    {
      for (let entry of entries) {
        this.updateSection(entry);
      }
    },
    updateSection(entry)
    {
      if (entry.isIntersecting) {
        entry.target.classList.add('on-view');
      }
    },
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


