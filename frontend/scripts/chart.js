const barColors = ["#043915", "#4C763B","#70AC58","#89B64E","#B0CE88"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,

    plugins: {
      legend: { display: false }
    }
  }
});