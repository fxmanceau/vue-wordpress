<template>
  <div class="data-visualization">
    <canvas :id="content.id" class="visualizer"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js'

export default {
  name: 'DataVisualizer',
  props: ['content'],
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
    ChartVisualizer()
    {
      const chart = new Chart(this.canvasContext, {
          // The type of chart we want to create
          type: this.content.type,

          // The data for our dataset
          data: {
              labels: this.content.labels,
              datasets: [{
                fill: false,
                label: this.content.labelName,
                backgroundColor: this.content.backgroundColor,
                borderColor: this.content.backgroundColor,
                data: this.content.data,
              }]
          },

          // Configuration options go here
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              yAxes: [{
                barPercentage: 0.1,
                gridLines: {
                  display: true,
                  color: "rgba(255, 255, 255, 0.1)"
                }
              }],
              xAxes: [{
                gridLines: {
                  display: false
                }
              }]
            },
            title: {
              display: this.content.title,
              text: this.content.titleText,
              fontSize: this.content.titleSize,
            }
          }
      });
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
    console.log(`#${this.content.id}`)
    this.canvasContext = document.querySelector(`#${this.content.id}`).getContext('2d');
    this.ChartVisualizer()
  }
}
</script>

<style lang="scss">
  @import './Data-Visualizer.scss';
</style>


