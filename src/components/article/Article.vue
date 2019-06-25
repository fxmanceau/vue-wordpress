<template>
  <article class="article-container">
    <slot></slot>
  </article>
</template>

<script>
export default {
  name: 'ArticlePage',
  methods:
  {
    visibileObject(elements)
    {
      const observer = new IntersectionObserver((observable) =>
      {
        console.log(observable[0].target, observable[0].intersectionRatio)
        if (observable[0].intersectionRatio >= 0) {
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
    this.h3 = [...document.querySelectorAll('h3')]
    this.h4 = [...document.querySelectorAll('h4')]
    this.paragraphs = [...document.querySelectorAll('p')]
    this.images = [...document.querySelectorAll('img')]
    
    this.visibileObject(this.h3)
    this.visibileObject(this.h4)
    this.visibileObject(this.paragraphs)
    this.visibileObject(this.images)
  }
}
</script>

<style lang="scss">
  @import './Article.scss';
</style>


