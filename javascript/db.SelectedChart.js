$(document).ready(function () {
    $.ajax({
        url: "https://trackinushealth.uk/includes/selectedChartData.inc.php",
        type: "GET",
        dataType: 'json',
        success: function (data) {

            var labels = data.map(function (e) {
                return e.result_date;
            });

            var units = data.map(function (e) {
                return e.range_units;
            });

            var result = data.map(function (e) {
                return e.result;
            });

            var lower = data.map(function (e) {
                return e.lower;
            });

            var upper = data.map(function (e) {
                return e.upper;
            });

            var name = data.map(function (e) {
                return e.test_name;
            });

            var ctx = document.getElementById("selectedAreaChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Result',
                        data: result,
                        fill: false,
                        borderColor: [
                            'rgba(255,99,132,1)'
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
                    }],
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
