$(document).ready(function () {
    $.ajax({
        url: "https://trackinushealth.uk/includes/chartData.inc.php",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            var labels = data.map(function (e) {
                return e.result_date;
            });

            var dataSet = data.map(function (e) {
                return e.result;
            });

            var lower = data.map(function (e) {
                return e.lower;
            });

            var upper = data.map(function (e) {
                return e.upper;
            });

            var ctx = document.getElementById("myAreaChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Result',
                        data: dataSet,
                        fill: false,
                        /*backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],*/
                        borderColor: [
                            'rgba(255,99,132,1)'/*,
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'*/
                        ],
                        borderWidth: 2
                    },
                    {
                        label: 'Range Lower',
                        data: lower,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'Range Upper',
                        data: upper,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                maxTicksLimit: 10
                            }
                        }]
                    }
                }
            });
        }
    });
});
