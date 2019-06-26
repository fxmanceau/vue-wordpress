<template>
  <section class="home-parallax">
    <slot></slot>
  </section>
</template>

<script>
import TweenLite from 'gsap/TweenLite';
import Hammer from 'hammerjs/hammer'
import normalizeWheel from 'normalize-wheel';

export default {
  name: 'HomeParallax',
  data() {
    return {
      scrollManager: null,
      containerBound: 0,
      scroll: 0,
      isMobile: false
    };
  },
  methods:
  {
    scrollController(e)
    {
      // Check if mobile or not to use wheel normalizer
      if(!this.isMobile)
      {
        this.scrollForce = normalizeWheel(e)
      }
      else
      {
        this.scrollForce = {}
        this.scrollForce.pixelY = -e.velocity*50
        this.scrollForce.spinY = -e.velocity
      }
      
      // Optimize GSAP
      TweenLite.killTweensOf(this.container);

      // Scroll algorithm to start and sy at the right spot
      if (this.scrollForce.pixelY > 0) {
        if (this.scroll + this.scrollForce.pixelY > this.container.offsetHeight - window.innerHeight) {
          this.scroll = this.container.offsetHeight - window.innerHeight
          TweenLite.to(this.container, 0.5, {
              ease: Power1.easeOut,
              y: -this.scroll
          })
        }
        else
        {
          this.scroll += Math.floor((this.scrollForce.pixelY))
          TweenLite.to(this.container, 0.5, {
              ease: Power1.easeOut,
              y: -this.scroll
          })
        }
      }
      else
      {
        if (this.scroll + this.scrollForce.pixelY < 0) {
          this.scroll = 0
          TweenLite.to(this.container, 0.5, {
              ease: Power1.easeOut,
              y: -this.scroll
          })
        }
        else
        {
          this.scroll += Math.floor((this.scrollForce.pixelY))
          TweenLite.to(this.container, 0.5, {
              ease: Power1.easeOut,
              y: -this.scroll
          })
        }
      }
    },
    scrollParallax()
    {
      for(const scrollParallax of this.scrollParallaxes)
      {
        const depth = parseFloat(scrollParallax.dataset.scrollDepth);
        const translateY = this.scroll * depth
        const scrollParallaxVar = TweenLite.to(scrollParallax, 0.5, {ease: Power1.easeOut, y: translateY, onComplete: () => {scrollParallaxVar.kill()}});
      }
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
  computed:{
    scrolled()
    {
      return this.scroll
    }
  },
  watch:{
    scrolled()
    {
      this.scrollParallax()
    }
  },
  mounted()
  {
    this.container = document.querySelector('.global-home')
    this.scrollParallaxes = document.querySelectorAll('.scroll-parallax')
    this.cursorParallaxes = document.querySelectorAll('.cursor-parallax')
    window.addEventListener('load', this.resize)
    window.addEventListener('resize', this.resize)

    document.addEventListener('wheel', this.scrollController)
    if(this.isMobile)
    {
      this.hammerManager = new Hammer(this.container)
      this.hammerManager.get('pan').set({ direction: Hammer.DIRECTION_VERTICAL, threshold: 50 });
      this.hammerManager.on("panup pandown", this.scrollController);
    }

    this.scrollParallax()
    this.cursorParallax()
  }
}
</script>

<style lang="scss">
  @import './Home-Parallax.scss';
</style>


