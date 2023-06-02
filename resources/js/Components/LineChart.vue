<template>
    <div class="chart-container">
      <canvas ref="chartCanvas"></canvas>
    </div>
  </template>

  <script>
  import { onMounted, ref } from 'vue';
  import Chart from 'chart.js/auto';

  export default {
    props: {
      dailyValues: {
        type: Array,
        required: true
      }
    },
    setup(props) {
      const chartCanvas = ref(null);

      onMounted(() => {
        renderChart();

        // Clean up the chart instance when the component is unmounted
        return () => {
          if (chartCanvas.value && chartCanvas.value.destroy) {
            chartCanvas.value.destroy();
          }
        };
      });

      const renderChart = () => {
        const stats = Object.keys(props.dailyValues[0]); // Get the available stats dynamically
        const datasets = stats
          .filter(stat => stat !== 'date') // Exclude 'date' from the stats
          .map((stat, index) => ({
            label: stat.charAt(0).toUpperCase() + stat.slice(1), // Capitalize the stat name
            data: props.dailyValues.map(value => value[stat]),
            yAxisID: `y-axis-${index}`, // Assign unique y-axis ID for each stat
            borderColor: getRandomColor(),
            backgroundColor: 'transparent',
            fill: false
          }));

        const chartData = {
          labels: props.dailyValues.map((value, index) => {
            if (index % 5 === 0) {
              return value.date;
            } else {
              return '';
            }
          }),
          datasets: datasets
        };

        const chartOptions = {
          responsive: true,
          maintainAspectRatio: false,
          aspectRatio: 2, // Set the aspect ratio to achieve 50% minimum height
          scales: {
            x: {
              display: true,
              title: {
                display: true,
                text: 'Date'
              },
              ticks: {
                autoSkip: false,
                maxRotation: 0,
                callback: (value, index) => {
                  if (index % 5 === 0) {
                    return props.dailyValues[index].date;
                  } else {
                    return '';
                  }
                }
              }
            },
            y: {}
          }
        };

        // Dynamically define the y-axis scales based on datasets
        datasets.forEach((dataset, index) => {
          chartOptions.scales.y[`y-axis-${index}`] = {
            display: true,
            position: index === 0 ? 'left' : 'right',
            title: {
              display: true,
              text: dataset.label
            },
            grid: {
              color: dataset.borderColor // Assign the line color to the grid color
            },
            ticks: {
              color: dataset.borderColor // Assign the line color to the tick color
            }
          };
        });

        chartCanvas.value = new Chart(chartCanvas.value, {
          type: 'line',
          data: chartData,
          options: chartOptions
        });
      };

      const getRandomColor = () => {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
          color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
      };

      return {
        chartCanvas,
        renderChart
      };
    }
  };
  </script>

  <style scoped>
  .chart-container {
    height: 50vh;
    /* Set the initial height to 50% of the viewport */
  }
  </style>
