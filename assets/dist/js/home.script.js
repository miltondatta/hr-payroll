(function ($) {
    "use strict";
    var primarycolor = getComputedStyle(document.body).getPropertyValue('--primarycolor');

    let base = document.getElementById('base').value;
    let week_statistics = $("#pills-week-tab").attr('aria-selected');
    let month_statistics = $("#pills-month-tab").attr('aria-selected');
    let to = moment().format('YYYY-MM-DD');


    function getWeeklyAttendance() {
        if (week_statistics) {
            let from = moment().subtract(7, 'days').format('YYYY-MM-DD');
            let day_data = [];

            $.ajax({
                url: base + 'employee/getAttendance?from=' + from + '&to=' + to,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                $.each(response.attendance_report, function (index, value) {
                    day_data.push({period: value.atten_date, licensed: value.employee, sorned: 660})
                });

                $("#week_statistics").empty();
                $("#week_statistics").removeAttr('style');

                let weekstats = Morris.Line({
                    element: 'week_statistics',
                    data: day_data,
                    xkey: 'period',
                    preUnits: '',
                    resize: true,
                    lineColors: [primarycolor, '#7A92A3', '#4da74d', '#afd8f8', '#edc240', '#cb4b4b', '#9440ed'],
                    ykeys: ['licensed'],
                    labels: ['Attendance']
                });

                weekstats.redraw();
                $(window).trigger('resize');
            });
        }
    }

    function getMonthlyAttendance() {
        if (month_statistics) {
            let from = moment().subtract(30, 'days').format('YYYY-MM-DD');
            let day_data = [];

            $.ajax({
                url: base + 'employee/getAttendance?from=' + from + '&to=' + to,
                method: 'GET',
                data: '',
                dataType: 'json',
            }).done(function (response) {
                $.each(response.attendance_report, function (index, value) {
                    day_data.push({period: value.atten_date, licensed: value.employee, sorned: 660})
                });

                $("#month_statistics").empty();
                $("#month_statistics").removeAttr('style');

                var monthstats = Morris.Line({
                    element: 'month_statistics',
                    data: day_data,
                    xkey: 'period',
                    resize: true,
                    padding: 15,
                    preUnits: '',
                    lineColors: [primarycolor, '#7A92A3', '#4da74d', '#afd8f8', '#edc240', '#cb4b4b', '#9440ed'],
                    ykeys: ['licensed'],
                    labels: ['Attendance']
                });

                monthstats.redraw();
                $(window).trigger('resize');
            });
        }
    }

    $(document).ready(function () {
        getWeeklyAttendance();
    });

    $("#pills-week-tab").click(function () {
        getWeeklyAttendance();
    });

    $("#pills-month-tab").click(function () {
        getMonthlyAttendance();
    });

    /*day_data = [
        {"period": "2019", "licensed": 4},
        {"period": "2018", "licensed": 3},
        {"period": "2017", "licensed": 1},
        {"period": "2016", "licensed": 2},
        {"period": "2015", "licensed": 4},
        {"period": "2014", "licensed": 3},
        {"period": "2013", "licensed": 4}
    ];

    var year_statistics = document.getElementById("year_statistics");
    if (year_statistics) {
        var yearstats = Morris.Line({
            element: 'year_statistics',
            data: day_data,
            xkey: 'period',
            resize: true,
            padding: 15,
            preUnits: '',
            lineColors: [primarycolor, '#7A92A3', '#4da74d', '#afd8f8', '#edc240', '#cb4b4b', '#9440ed'],
            ykeys: ['licensed'],
            labels: ['Sale']
        });
    }*/

    /*$('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href") // activated tab

        switch (target) {
            case "#pills-week":
                if (week_statistics) {
                    weekstats.redraw();
                }
                $(window).trigger('resize');
                break;
            case "#pills-month":
                if (month_statistics) {
                    monthstats.redraw();
                }
                $(window).trigger('resize');
                break;
            case "#pills-year":
                if (year_statistics) {
                    yearstats.redraw();
                }
                $(window).trigger('resize');
                break;
        }
    });*/

    /*================================== Weather Chart =====================*/
    var t = document.getElementById("js-chart-weather");
    if (t) {
        new Chart(t, {
            type: "line",
            data: {
                labels: ["January 1", "January 5", "January 10", "January 15", "January 20", "January 25"],
                datasets: [{
                    label: "Sold",
                    fill: !0,
                    lineTension: 0,
                    backgroundColor: "#d8d4f1",
                    borderWidth: 2,
                    borderColor: primarycolor,
                    borderCapStyle: "butt",
                    borderDash: [],
                    borderDashOffset: 0,
                    borderJoinStyle: "miter",
                    pointRadius: 0,
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#2a2f37",
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: "#FC2055",
                    pointHoverBorderColor: "#fff",
                    pointHoverBorderWidth: 2,
                    data: [40, 32, 42, 28, 53, 34],
                    spanGaps: !1
                }]
            },
            options: {
                legend: {
                    display: !1
                },
                scales: {
                    xAxes: [{
                        display: !1,
                        ticks: {
                            fontSize: "11",
                            fontColor: "#969da5"
                        },
                        gridLines: {
                            color: "rgba(0,0,0,0.0)",
                            zeroLineColor: "rgba(0,0,0,0.0)"
                        }
                    }],
                    yAxes: [{
                        display: !1,
                        ticks: {
                            beginAtZero: !0,
                            max: 55
                        }
                    }]
                }
            }
        });
    }

    /************************* Rating *****************************/

    if ($('.starrr').length > 0) {
        $('.starrr').starrr({
            rating: 4,
            readOnly: true
        })
    }

    /************************************* Social Chart ************************/
    var social_chart = document.getElementById("social-chart");
    if (social_chart) {
        $.plot("#social-chart", [{
                data: [[1, 60], [2, 90], [3, 35], [4, 70], [5, 40]],
                canvasRender: !0,
                showLabels: !0,
                label: "Google ads",
                labelPlacement: "below"
            }
                , {
                    data: [[1, 0], [2, 30], [3, 80], [4, 30], [5, 65]],
                    canvasRender: !0,
                    showLabels: !0,
                    label: "Facebook",
                    labelPlacement: "below"
                },
                {
                    data: [[1, 0], [2, 40], [3, 30], [4, 20], [5, 65]],
                    canvasRender: !0,
                    showLabels: !0,
                    label: "Twitter",
                    labelPlacement: "below"
                }
            ], {
                series: {
                    lines: {
                        show: !0, lineWidth: 0, fill: !0, fillColor: {
                            colors: [{
                                opacity: 1
                            }
                                , {
                                    opacity: 1
                                }
                            ]
                        }
                    }
                    , fillColor: "rgba(0, 0, 0, 1)", shadowSize: 0, curvedLines: {
                        apply: !0, active: !0, monotonicFit: !0
                    }
                }

                , grid: {
                    show: !1, hoverable: !0, clickable: !0
                }
                , tooltip: {
                    show: !0,
                    cssClass: "tooltip-chart",
                    content: "<div class='content-chart'> <span> %s </span> <div class='label'> <div class='label-x'> %x.0 </div> - <div class='label-y'> %y.0 </div> </div></div>",
                    defaultTheme: !1
                }
                , colors: ['#dd4b39', '#3b5999', '#55acee'], xaxis: {
                    autoscaleMargin: 0, ticks: 11, tickDecimals: 0
                }
                , yaxis: {
                    autoscaleMargin: .5, ticks: 5, tickDecimals: 0
                }
            }
        );
    }

    /********************************** Tours *************************/
        // Instance the tour
    var tour = new Tour({
            steps: [
                {
                    placement: "bottom",
                    element: "#tourfirst",
                    title: "Title of my step",
                    content: "Content of my step"
                },
                {
                    placement: "bottom",
                    element: "#options",
                    title: "Title of my step",
                    content: "Content of my step"
                },
                {
                    placement: "left",
                    element: "#settingbutton",
                    title: "Title of my step",
                    content: "Content of my step"
                }
            ],
            template: "<div class='popover tour bg-primary border-0'>" +
                "<div class='arrow'></div>" +
                "<h3 class='popover-title text-white bg-primary border-0'></h3>" +
                " <div class='popover-content text-white'></div>" +
                " <div class='popover-navigation d-flex'>" +
                "   <button class='btn btn-primary' data-role='prev'>&laquo; Prev</button>" +
                "<button class='btn btn-primary mx-1' data-role='end'>End tour</button>" +
                "  <button class='btn btn-primary' data-role='next'>Next &raquo;</button>" +
                "</div>" +
                " </div>"
        });

// Initialize the tour
    //tour.init();

// Start the tour
    //  tour.start();

})(jQuery);  
