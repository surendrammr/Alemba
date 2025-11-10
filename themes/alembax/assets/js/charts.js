$(document).ready(function() {
    
    //30% Call reduction Pie Chart
    var ctx = document.getElementById('callPie').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [30, 70],
                backgroundColor: [
                    'rgba(0, 150, 220, 1)',
                    'rgba(245, 245, 245, 1)'
                ],
                borderColor: [
                    'rgba(61, 145, 249, 1)',
                    'rgba(255, 255, 255, 1)'
                ],
                hoverBackgroundColor: [
                    'rgba(0, 150, 220, 1)',
                    'rgba(245,245,245, 1)'
                ],
                hoverBorderColor: [
                    'rgba(61,145,249, 1)',
                    'rgba(255,255,255, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            cutoutPercentage: 70,
            animation: {
                duration: 3000,
            },
            tooltips: {
                // Disable the on-canvas tooltip
                enabled: false,
            }
        }
    });
    
    
});