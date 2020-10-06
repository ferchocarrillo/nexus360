


<div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Total Sales</h3>
                <div class="card-tools">
                    <a href="{{ route('enercare.downloadreportsales',['startDate'=>$request->startDate,'endDate'=>$request->endDate,'teamleader'=> $request->teamleader]) }}" class="btn btn-tool btn-sm">
                        <i class="fas fa-download"></i> Download Report
                      </a>
                </div>
            </div>
            <div class="card-body text-center">
                <h1 class="display-1 text-dark font-weight-bold">{{$total_sales}} </h1>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">Plans</h3>
              </div>
            <div class="card-body">
              <div class="position-relative mb-4">
                <canvas id="planChart" height="150"></canvas>
              </div>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">TOP 10 Supervisors</h3>
              </div>
            <div class="card-body">
              <div class="position-relative">
                <canvas id="supervisorChart" height="150"></canvas>
              </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">TOP 10 Agents</h3>
              </div>
            <div class="card-body">
              <div class="position-relative">
                <canvas id="agentChart" height="150"></canvas>
              </div>
            </div>
        </div>
    </div>
</div>




<script>

var chartData = {!! json_encode($chart) !!};


var colors = [
                '#200406',
                '#40080c',
                '#600d13',
                '#801119',
                '#a0151f',
                '#c01a26',
                '#e01e2c',
                '#e43e4a',
                '#e95e68',
                '#ed7e86',
                '#f19ea4',
                '#f6bec2',
                '#fadee0'
            ];

            
function getColors(cant){
    var x = Math.round((colors.length-cant)/2) 
    return colors.slice(x,x+cant);
}

var ctx_plan = document.getElementById('planChart');
var planChart = new Chart(ctx_plan, {
    type: 'doughnut',
    data: {
        labels: chartData.plan[0],
        datasets: [{
            label: 'Plans',
            data: chartData.plan[1],
            backgroundColor: getColors(chartData.plan[0].length)
        }]
    },
    options: {
        responsive: true,
        legend: {
            position: 'bottom',
        },
        title: {
            display: false,
            text: 'Sales per Plan'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },

        tooltips: {
            callbacks: {
                title: function(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
                },
                label: function(tooltipItem, data) {
                return data['datasets'][0]['data'][tooltipItem['index']];
                },
                afterLabel: function(tooltipItem, data) {
                    const reducer = (accumulator, currentValue) => accumulator + currentValue;
                    var dataset = data['datasets'][0];
                    var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset['data'].reduce(reducer)) * 100)
                    return '(' + percent + '%)';
                }
            },
            backgroundColor: '#FFF',
            titleFontSize: 16,
            titleFontColor: '#0066ff',
            bodyFontColor: '#000',
            bodyFontSize: 14,
            displayColors: false
        }

    }
});

var ctx_supervisor = document.getElementById('supervisorChart');
var supervisorChart = new Chart(ctx_supervisor, {
    type: 'horizontalBar',
    data: {
        labels: chartData.supervisor[0].slice(0,10),
        datasets: [{
            label: 'Supervisors',
            data: chartData.supervisor[1].slice(0,10),
            backgroundColor: getColors(chartData.supervisor[0].slice(0,10).length),
        }]
    },
    options: {
        responsive: true,
        legend: {
            display:false,
            position: 'bottom',
        },
        title: {
            display: false,
            text: 'Sales per Plan'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx_agent = document.getElementById('agentChart');
var agentChart = new Chart(ctx_agent, {
    type: 'horizontalBar',
    data: {
        labels: chartData.agent[0].slice(0,10),
        datasets: [{
            label: 'Agents',
            data: chartData.agent[1].slice(0,10),
            backgroundColor: getColors(chartData.agent[1].slice(0,10).length),
        }]
    },
    options: {
        responsive: true,
        legend: {
            display:false,
            position: 'bottom',
        },
        title: {
            display: false,
            text: 'Sales per Plan'
        },
        animation: {
            animateScale: true,
            animateRotate: true
        },
        scales: {
            xAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
