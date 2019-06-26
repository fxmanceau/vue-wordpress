<template>
  <article class="global-article">
    <slot></slot>
  </article>
</template>

<script>
import TweenLite from 'gsap/TweenLite';
import Hammer from 'hammerjs/hammer'
import normalizeWheel from 'normalize-wheel';

export default {
  name: 'ArticlePage',
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
    visibileObject(elements)
    {
      const observer = new IntersectionObserver((observable) =>
      {
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
    this.container = document.querySelector('.global-article')
    this.h3 = [...document.querySelectorAll('h3')]
    this.h4 = [...document.querySelectorAll('h4')]
    this.paragraphs = [...document.querySelectorAll('p')]
    this.images = [...document.querySelectorAll('img')]
    
    this.visibileObject(this.h3)
    this.visibileObject(this.h4)
    this.visibileObject(this.paragraphs)
    this.visibileObject(this.images)

    document.addEventListener('wheel', this.scrollController)
    if(this.isMobile)
    {
      this.hammerManager = new Hammer(this.container)
      this.hammerManager.get('pan').set({ direction: Hammer.DIRECTION_VERTICAL, threshold: 50 });
      this.hammerManager.on("panup pandown", this.scrollController);
    }
  }
}
</script>

<style lang="scss">
  @import './Article.scss';
</style>


