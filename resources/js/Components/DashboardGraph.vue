<template>
    <div>
      <line-chart :daily-values="dailyValues" />
    </div>
  </template>

  <script>
  import LineChart from './LineChart.vue';

  export default {
    components: {
      LineChart
    },
    data() {
      return {
        dailyValues: [
          { date: '2023-05-01', weight: 10, calories: 150 },
          { date: '2023-05-02', weight: 8, calories: 100 },
          { date: '2023-05-03', weight: 11, calories: 160 },
          { date: '2023-05-04', weight: 10, calories: 150 },
          { date: '2023-05-05', weight: 12, calories: 200 },
          { date: '2023-05-06', weight: 11, calories: 160 },
          { date: '2023-05-07', weight: 10, calories: 240 },
          { date: '2023-05-08', weight: 8, calories: 440},
          { date: '2023-05-09', weight: 9, calories: 230 },
          { date: '2023-05-10', weight: 10, calories: 150 },
          { date: '2023-05-11', weight: 8, calories: 100 },
          { date: '2023-05-12', weight: 11, calories: 140 },
          { date: '2023-05-13', weight: 10, calories: 150 },
          { date: '2023-05-14', weight: 12, calories: 430 },
          { date: '2023-05-15', weight: 11, calories: 160 },
          { date: '2023-05-16', weight: 14, calories: 440 },
          { date: '2023-05-17', weight: 13, calories: 220 },
          { date: '2023-05-18', weight: 11, calories: 160 },
          { date: '2023-05-19', weight: 10, calories: 220 },
          { date: '2023-05-20', weight: 8, calories: 100 },
          { date: '2023-05-21', weight: 11, calories: 120 },
          { date: '2023-05-22', weight: 10, calories: 150 },
          { date: '2023-05-23', weight: 8, calories: 1120 },
          { date: '2023-05-24', weight: 11, calories: 160 },
          { date: '2023-05-25', weight: 9, calories: 150 },
          { date: '2023-05-26', weight: 8, calories: 130 },
          { date: '2023-05-27', weight: 7, calories: 130 },
          { date: '2023-05-28', weight: 6, calories: 130 },
          { date: '2023-05-29', weight: 5, calories: 140 },
          { date: '2023-05-30', weight: 11, calories: 160 },

          // Add more daily values...
        ]
      };
    }
  };
  </script>

