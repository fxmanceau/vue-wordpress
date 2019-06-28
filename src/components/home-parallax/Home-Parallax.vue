<template>
  <section class="home-parallax">
    <slot></slot>
  </section>
</template>

<script>
import TweenLite from 'gsap/TweenLite';
import Hammer from 'hammerjs/hammer'
import normalizeWheel from 'normalize-wheel';
import lottie from 'lottie-web';

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
        const scrollParallaxVar = TweenLite.to(scrollParallax, 0.5, {ease: Power1.easeOut, xPercent: 0, y: translateY, onComplete: () => {scrollParallaxVar.kill()}});
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
            if(this.ratioY < 0)
            {
              cursorParallax.style.transform = `translateX(${translateX}px) translateY(${translateY}px)`
            }
            else
            {
              cursorParallax.style.transform = `translateX(${translateX}px) translateY(0px)`
            }
          }
      })
    },
    resize()
    {
      this.windowWidth = window.innerWidth
      this.windowHeight = window.innerHeight
    },
    detectMobile(){
      // Check mobile device with user agent & regex
    	let check = false;
      (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od|ad)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
      // Store global result in Vuex
      this.isMobile = check
    },
    lottieAnimation(element, speed)
    {
      const animation = lottie.loadAnimation({
        container: element, // the dom element that will contain the animation
        renderer: 'svg',
        loop: true,
        autoplay: true,
        path: element.dataset.json // the path to the animation json
      });
      animation.setSpeed(speed);
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
    this.detectMobile()
    
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

    this.lottieAnimation(document.querySelector('.metro'), 1.8)
    this.lottieAnimation(document.querySelector('.sky'), 0.2)
  }
}
</script>

<style lang="scss">
  @import './Home-Parallax.scss';
</style>


