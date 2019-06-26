<template>
  <div class="global-cursor">
    <div class="global-cursor-container">
      <div class="global-cursor-main">
        <span class="global-cursor-dot">
        </span>
        <span class="global-cursor-svg">
          <svg viewBox="0 0 38 38">
          <circle r="17" cx="19" cy="19" class="global-cursor-circle"></circle>
          </svg>
          <span class="circle-shock-wave"></span>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import { TweenLite } from 'gsap';

export default {
  name: 'Mouse',
  data() {
    return {
      cursorContainer: null,
      cursorDot: null,
      cursorSVG: null,
      cursorSVGShockWave: null,
      cursorDotCenter: {},
      cursorSVGCenter: {},
      mouse: {},
      move: {},
      cursorTlClick: new TimelineLite({paused: true}),
      cursorTlHold: new TimelineLite({paused: true}),
      cursorMorph: new TimelineLite({paused: true}),
      cursorTlHoverClick: new TimelineLite({paused: true}),
      cursorTlHoverDrag: new TimelineLite({paused: true}),
    }
  },
  mounted(){
    // Needed DOM elements
    this.cursorContainer = document.querySelector('.global-cursor-container');
    this.cursorDot = this.cursorContainer.querySelector('.global-cursor-dot');
    this.cursorSVG = this.cursorContainer.querySelector('.global-cursor-svg');
    this.cursorCircle = this.cursorSVG.querySelector('.global-cursor-circle')

    // Check if getTotalLength available (IE & Edge compatibility)
    if(this.cursorCircle.getTotalLength)
    {
      this.cursorCircleLength = this.cursorCircle.getTotalLength()
    }

    this.cursorSVGShockWave = this.cursorContainer.querySelector('.circle-shock-wave');
    this.cursorDotCenter.width = this.cursorDot.offsetWidth/2
    this.cursorDotCenter.height = this.cursorDot.offsetHeight/2
    this.cursorSVGCenter.width = this.cursorSVG.offsetWidth/2
    this.cursorSVGCenter.height = this.cursorSVG.offsetHeight/2
    this.cursorContainer.style.opacity = 1

    // Init mouse move & animations
    document.addEventListener('mousemove', this.updatePosition)
    this.cursorClickAnimation()
    this.cursorHoverAnimation()
  },
  methods: {
    moveElements()
    {
      // Tween cursor's elements with mouse position
      const posDot = TweenLite.to(this.cursorDot, 0.2, {x: this.move.dotX, y: this.move.dotY, onComplete: () => {posDot.kill()}});
      const posSVG = TweenLite.to(this.cursorSVG, 0.5, {x: this.move.svgX, y: this.move.svgY, onComplete: () => {posSVG.kill()}});
    },
    updatePosition(e)
    {
      // Update cursor position
      this.move.dotX = e.clientX - this.cursorDotCenter.width
      this.move.dotY = e.clientY - this.cursorDotCenter.height
      this.move.svgX = e.clientX - this.cursorSVGCenter.width
      this.move.svgY = e.clientY - this.cursorSVGCenter.height
      this.moveElements();
    },
    cursorClickAnimation()
    {
      // Setup click & hold timelines
      this.cursorTlClick.to(this.cursorSVG, 0.3, {ease: Power1.easeInOut, scale: 0.8})
      this.cursorTlHold.fromTo(this.cursorSVGShockWave, 0.5, {scale: 0, autoAlpha: 0.5}, {scale: 1.5, autoAlpha: 0})

      // Check if getTotalLength is available or not, and define a part of the morph timeline
      if(this.cursorCircle.getTotalLength)
      {
        this.cursorMorph.fromTo(this.cursorCircle, 1, {ease: Power1.easeInOut, strokeDasharray: this.cursorCircleLength+1, strokeDashoffset: 0, autoAlpha: 1}, {ease: Power1.easeInOut, strokeDasharray: this.cursorCircleLength, strokeDashoffset: this.cursorCircleLength, autoAlpha: 0})
      }
      else
      {
        this.cursorMorph.fromTo(this.cursorCircle, 1, {ease: Power1.easeInOut, autoAlpha: 1}, {ease: Power1.easeInOut, autoAlpha: 0})
      }
      
      // Click animation
      let time = 0
      let holdTimer
      window.addEventListener('mousedown', () =>
      {
        holdTimer = setInterval(() =>
        {
          time+=100
        }, 100)
        // Play click animation
        this.cursorTlClick.play()
      })
      window.addEventListener('mouseup', () =>
      {
        this.cursorTlClick.reverse()
        this.cursorTlHold.progress(0).play()
        time = 0
        clearInterval(holdTimer)
      })
    },
    cursorHoverAnimation()
    {
      // Upscale cursor's dot on clickable hover
      this.cursorTlHoverClick.to(this.cursorDot, 0.2, {ease: Power1.easeInOut, scaleX: 1.6, scaleY: 1.6})

      // Upscale cursor's dot on draggable hover
      this.cursorTlHoverDrag.to(this.cursorDot, 0.2, {ease: Power1.easeInOut, scaleX: 7, scaleY: 7})
      this.cursorTlHoverDrag.to(this.cursorCircle, 0.2, {ease: Power1.easeInOut, opacity: 0, autoAlpha: 0}, 0)
    },
  },
  beforeDestroy()
  {
    // Destroy listener
    document.addEventListener('remove', this.updatePosition)
  }
};
</script>

<style lang="scss">
    @import './Cursor.scss';
</style>
