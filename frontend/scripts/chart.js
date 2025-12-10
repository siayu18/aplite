const xValues = ["2025-10-24", "2025-10-25", "2025-10-26", "2025-10-27", "2025-10-28"];
const yValues = [30, 70, 80, 90, 50];
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