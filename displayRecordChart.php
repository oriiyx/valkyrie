<?php
require_once 'head.php';
?>

<div id="chart-container" >
    <canvas id="graphCanvas" style="height:40vh; width:100%"></canvas>
</div>

<script>
  $(document).ready(function() {
    showGraph();
  });

  var dynamicColors = function() {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return 'rgba(' + r + ',' + g + ',' + b + ', 0.5)';
  };

  function showGraph() {
    {

      $.post('data-records.php',
          function(data) {

            var tempData = {};
            var dates = [];
            for (var i in data) {
              tempData[i] = data[i];
              for (var y in data[i]) {
                dates.push(data[i][y].time);
              }
            }
            var datasets = [];
            for (var i in tempData) {
              var currentData = [];
              for (var y in tempData[i]) {
                currentData.push({
                  t: new Date(tempData[i][y].time),
                  y: tempData[i][y].status,
                });
              }

              var color = dynamicColors();
              datasets.push({
                label: i,
                backgroundColor: color,
                borderColor: color,
                hoverBackgroundColor: '#CCCCCC',
                hoverBorderColor: '#666666',
                data: currentData,
                type: 'line',
                showLine: true,
                // showLine: false,
                fill: false,
              });
            }

            var newchartdata = {
              datasets: datasets,
            };

            var cfg = {
              data: newchartdata,
              options: {
                responsive: true,
                spanGaps: true,
                animation: {
                  duration: 0,
                },
                hover: {
                  animationDuration: 0 // duration of animations when hovering an item
                },
                responsiveAnimationDuration: 0, // animation duration after a resize
                scales: {
                  xAxes: [
                    {
                      stacked: true,
                      type: 'time',
                      // distribution: 'series',
                      scaleLabel: {
                        display: true,
                        labelString: 'Date',
                      },
                      ticks: {
                        sampleSize: 100
                      }
                    }],
                  yAxes: [
                    {
                      // distribution: 'series',
                      gridLines: {
                        drawBorder: false,
                      },
                      scaleLabel: {
                        display: true,
                        labelString: 'Ping Code',
                      },
                      ticks: {
                        min: 0,
                        max: 500,
                        maxRotation: 0,
                        maxTicksLimit: 6,
                        lineHeight: 2,
                        fontSize: 16,
                      }
                    }],
                },
                elements: {
                  line: {
                    tension: 0 // disables bezier curves
                  }
                }
              },
            };
            var graphTarget = $('#graphCanvas');

            var barGraph = new Chart(graphTarget, cfg);
          });
    }
  }
</script>