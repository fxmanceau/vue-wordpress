<template>
  <section class="home-parallax">
    <slot></slot>
  </section>
</template>

<script>
export default {
  name: 'HomeParallax',
  methods:
  {
    scrollParallax()
    {
      window.addEventListener('scroll', () =>
      {
        this.scrollY = window.scrollY
    
        for(const scrollParallax of this.scrollParallaxes)
        {
          const depth = parseFloat(scrollParallax.dataset.scrollDepth);
          const translateY = this.scrollY * depth
  
          scrollParallax.style.transform = `translateX(-50%) translateY(${translateY}px)`
        }
      })
    },
    cursorParallax()
    {
      window.addEventListener('mousemove', (e) =>
      {
          this.ratioX = e.clientX / this.windowWidth - 0.5
          this.ratioY = e.clientY / this.windowHeight -0.5
          for(const cursorParallax of this.cursorParallaxes)
          {
              const depth = parseFloat(cursorParallax.dataset.cursorDepth)
              const translateX = -this.ratioX * depth * 100
              const translateY = -this.ratioY * depth * 100
              cursorParallax.style.transform = `translateX(${translateX}px) translateY(${translateY}px)`
          }
      })
    },
    resize()
    {
      this.windowWidth = window.innerWidth
      this.windowHeight = window.innerHeight
    }
  },
  mounted()
  {
    console.log('hey')
    this.scrollParallaxes = document.querySelectorAll('.scroll-parallax')
    this.cursorParallaxes = document.querySelectorAll('.cursor-parallax')
    window.addEventListener('load', this.resize)
    window.addEventListener('resize', this.resize)
    this.scrollParallax()
    this.cursorParallax()
  }
}
</script>

<style lang="scss">
  @import './Home-Parallax.scss';
</style>


