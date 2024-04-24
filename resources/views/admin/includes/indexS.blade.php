@include("admin.includes.footer")
<script>
    // total sales
    var ctx = document.getElementById('previousChart').getContext('2d');
    var totalPercentage = @if(($monthtarget / $target * 100) > 100) {{100 }} @else {{(($monthtarget / $target * 100))}}@endif;
    var donePercentage = totalPercentage;
    var disabledPercentage = 100 - totalPercentage;
    var doughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Total Sales', 'Disabled'],
            datasets: [{
                data: [donePercentage, disabledPercentage],
                backgroundColor: ['#0557AF', '#e0e0e0'],
                hoverBackgroundColor: ['#0557AF', '#e0e0e0'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                enabled: false
            },
            cutout: '50%',
            cutoutPercentage: 60,
        }
    });
// team sales

    // Assuming these values are dynamically provided by your server-side code
 
    @php($index = 0)
    @foreach($teamStat as $teamchart)
   

  
        var ctx = document.getElementById('{{ $teamchart->name }}-' + {{$index}}).getContext('2d');
        var teamMembers = @json($teamchart->teamMembers);
            var totalTarget = {{ $teamchart->totalTarget }};
            var totalSales = teamMembers.reduce((acc, member) => acc + parseFloat(member.sales), 0);
            var salesData = teamMembers.map(member => (parseFloat(member.sales) / totalTarget * 100).toFixed(2));
            var remainingPercentage = ((totalTarget - totalSales) / totalTarget * 100).toFixed(2);
            var memberNames = teamMembers.map(member => member.name + ` (${member.sales} sales, ${((parseFloat(member.sales) / totalTarget) * 100).toFixed(2)}%)`);
            
            // Add the remaining target percentage if there's any target left unmet
            if (totalSales < totalTarget) {
                salesData.push(remainingPercentage);
                memberNames.push('Remaining Target');
            }

            var backgroundColors = teamMembers.map((_, index) => `hsl(${360 * index / teamMembers.length}, 70%, 50%)`); 
            backgroundColors.push('#e0e0e0'); 

            teamMembers.forEach(function(member, index) {
    var memberId = member.id;
    var memberName = member.name;
    var memberUniqueId = memberName.replace(/\s+/g, '') + '-' + memberId; 
    member.uniqueId = memberUniqueId;
    
    var userElements = document.querySelectorAll('.' + memberUniqueId);
    userElements.forEach(function(userElement) {
        userElement.style.backgroundColor = backgroundColors[index % backgroundColors.length];
    });
});


            new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: memberNames,
            datasets: [{
                data: salesData,
                backgroundColor: backgroundColors,
                hoverBackgroundColor: backgroundColors,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false // Hide labels by default
            },
            tooltips: {
                enabled: true,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index] || '';

                        if (label) {
                            label += ': ';
                        }
                        label += data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] + '%';
                        return label;
                    }
                }
            }
        }
    });

        <?php $index++ ?>
@endforeach 



    var chart = document.getElementById('chart').getContext('2d');
    var fxsaleValues = [];
    var fysaleValues = [];
    var sysaleValues = [];
    @foreach($sales as $k => $as)
    // if(date('D',strtotime($as['mark_date'])) == 'Sun') else
    fxsaleValues.push("{{date('d',strtotime($as['mark_date']))}}");
    fysaleValues.push("{{$as['sum']}}");
    sysaleValues.push("{{$as['total_pr']}}");
    // endif
    @endforeach

    var data = {
        labels: fxsaleValues,
        datasets: [{
            label: 'Sales',
            backgroundColor: '#1194F3',
            pointBackgroundColor: '#1194F3',
            borderWidth: 1,
            borderColor: '#1194F3',
            data: fysaleValues
        }, {
            label: 'Login User',
            backgroundColor: '#ff0000',
            pointBackgroundColor: '#ff0000',
            borderWidth: 1,
            borderColor: '#ff0000',
            data: sysaleValues
        }]
    };


    var options = {
        responsive: true,
        stacked: false,
        elements: {
            line: {
                tension: 0
            }
        },
        scales: {
            y: {
                type: 'linear',
                display: true,
                position: 'left',
            },
            y1: {
                type: 'linear',
                display: true,
                position: 'right',
            },
        }
    };


    var chartInstance = new Chart(chart, {
        type: 'line',
        data: data,
        options: options
    });
</script>
<script>
//   caht script come here

//   caht script come here

    function fixdate(dt) {
        const dateTimeString = dt;
        const dateObj = new Date(dateTimeString);
        const currentDate = new Date(); // Get the current date
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let formattedTime;
        if (dateObj.getUTCDate() === currentDate.getUTCDate() &&
            dateObj.getUTCMonth() === currentDate.getUTCMonth() &&
            dateObj.getUTCFullYear() === currentDate.getUTCFullYear()) {

            const hours = dateObj.getUTCHours();
            const minutes = dateObj.getUTCMinutes();
            formattedTime = `${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
        } else {
            const day = dateObj.getUTCDate().toString().padStart(2, '0');
            const month = monthNames[dateObj.getUTCMonth()];
            const year = dateObj.getUTCFullYear().toString().slice(2); // Get the last two digits of the year
            const hours = dateObj.getUTCHours();
            const minutes = dateObj.getUTCMinutes();
            formattedTime = `${day}, ${month} ${year}, ${hours}:${minutes < 10 ? '0' + minutes : minutes}`;
        }
        return formattedTime;
    }

    function playAudio() {
        var audio = new Audio('/public/sms.mp3');
        audio.play();
    }
    messdata();
</script>