<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="home_css.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .accordion {
            background-color: rgb(40, 22, 171);
            ;
            color: rgb(255, 255, 255);
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
            border-radius: 10px;
        }

        .accordion>span {
            display: inline-block;
            margin-right: 2rem;
        }

        .jacobian {
            margin-top: 2rem;
            margin-left: 30px;
            width: 90% !important;
        }

        .active,
        .accordion:hover {
            background-color: blueviolet;
        }

        .panel {
            padding: 0 18px;
            background-color: white;
            margin-top: 1rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            border-radius: 10px;
        }

        .profile-photo {
            margin-top: 1px;
            margin-left: 1px !important;
            margin-right: 50px !important;
            margin-bottom: 2px;
            width: 20px;
        }

        .panel>.textdata {
            color: black;
            font-size: medium;
            font-weight: 500;
            display: flex;
            margin-left: 5px;
            padding: 15px;
            border-radius: 10px;
        }

        .accordion:after {
            content: '\02795';
            /* Unicode character for "plus" sign (+) */
            font-size: 13px;
            color: rgb(90, 81, 81) !important;
            float: right;
            margin-left: 5px;
        }

        main .active:after {
            content: "\2796";
            /* Unicode character for "minus" sign (-) */
        }
    </style>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Parent</b></p>
                        <small class="text-muted"></small>
                    </div>
                    <div class="profile-photo">
                        <img src="profile-2.jpg">
                    </div>
                </div>
                <div id="close-btn" class="close">
                    <span class="material-icons-sharp">close</span>
                </div>
            </div>
            <div class="sidebar">
                <a href="parent_home.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Home</h3>
                </a>
                <a href="parent_messages.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Messages </h3><span class="message-count">26</span>
                </a>
                <a href="customisatin.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>customisation</h3>
                </a>
                <a href="conseller.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Account Controls</h3>
                </a>
                <a href="studentsdata.html">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Payment</h3>
                </a>
                <a href="login.html">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>logout</h3>
                </a>
            </div>
        </aside>
        <main>
            <h1>Dashboard</h1>
            <div class="jacobian">
                <button class="accordion"><span class="material-icons-sharp"></span>Child Details</button>
                <div class="panel">
                    <div class="textdata">
                        <div class="profile-photo"><img src="boy1.png.png"></div>
                        User ID : 9515UID45 <br>
                        Name : Kumar <br>
                        Age : 14 <br>
                        Gender : Male <br>
                        Class : 9th <br>
                    </div>
                </div>
            </div>
            <div class="insights">
                <div class="sales">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Course Completion</h3>
                            <h1>86%</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>86%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted"></small>
                </div>
                <div class="expenses">
                    <span class="material-icons-sharp">stacked_line_chart</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Daily Achivement</h3>
                            <h1>70%</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>70%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
                <div class="income">
                    <span class="material-icons-sharp">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Screen Time</h3>
                            <h1>50%</h1>
                        </div>
                        <div class="progress">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="number">
                                <p>50%</p>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted">Last 24 hours</small>
                </div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            </div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                var r = document.querySelector(':root');
                google.charts.load('current', { 'packages': ['bar'] });
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Quiz', 'Highest Mark', 'Average Mark', 'Your Child Mark'],
                        ['Test-1', 80, 70, 52],
                        ['Test-2', 85, 60, 59],
                        ['Test-3', 78, 54, 47],
                        ['Test-4', 90, 75, 70]
                    ]);

                    var options = {
                        'title': 'Tests Summary',
                        hAxis: {
                            title: 'Year'
                        },
                        vAxis: {
                            title: 'Percentage(%)'
                        },
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>
            <div class="graph_plotter">
                <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
            </div>
        </main>
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
                <div class="theme-toggler" id="themeToggler">
                    <span class="material-icons-sharp active">light_mode</span>
                    <span class="material-icons-sharp">dark_mode</span>
                </div>
            </div>
            <!-- ============top===== -->
            <div class="recent-updates">
                <h2>Recent updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="p.jpeg">
                        </div>
                        <div class="message">
                            <p><b></b>Parent Controls</p>
                            <small class="text-muted">A parent can monitor his/her child's activity, track their progress, and view their milestones within the application.
                            </small>
                            <small class="text-muted"></small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="p.jpeg">
                        </div>
                        <div class="message">
                            <p><b></b>Content Exploration</p>
                            <small class="text-muted">Child can access the content according to his course.</small>
                            <small class="text-muted"></small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="p.jpeg">
                        </div>
                        <div class="message">
                            <p><b></b>Quizzes and Rewards</p>
                            <small class="text-muted">Child can take Quizes and get rewarded with in app coins based on his score.</small>
                            <small class="text-muted"></small>
                        </div>
                    </div>
                </div>
                <div class="sales-analytics">
                    <h2>Upcoming Updates</h2>
                    <div class="item online">
                        <div class="icon"></div>
                        <span class="material-symbols-sharp">
                            schedule
                        </span>
                        <div class="right">
                            <div class="info">
                                <h3>Parent Controls</h3>
                                <small class="text-muted">Parent can set specific screen time limits and breaks to foster healthy usage habits for his/her child.
                                </small>
                            </div>
                            <h5 class="success"></h5>
                            <h3></h3>
                        </div>
                    </div>
                    <div class="item offline">
                        <div class="icon"></div>
                        <span class="material-symbols-sharp">
                            cast_for_education
                        </span>
                        <div class="right">
                            <div class="info">
                                <h3>Quizes and Rewards</h3>
                                <small class="text-muted">Child can redeem some goodies with the coins he achived.</small>
                            </div>
                            <h5 class="danger"></h5>
                            <h3></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }

        const sidemenu = document.querySelector('aside');
        const menubtn = document.querySelector('#menu-btn');
        const closebtn = document.querySelector('#close-btn');

        menubtn.addEventListener('click', () => {
            sidemenu.style.display = "block"
        })

        closebtn.addEventListener('click', () => {
            sidemenu.style.display = "none"
        })

        const theme_toggler = document.querySelector('#themeToggler');
        var count = 0;

        theme_toggler.addEventListener('click', () => {
            document.body.classList.toggle('dark-theme-variables');
            theme_toggler.querySelector('span:nth-child(1)').classList.toggle('active');
            theme_toggler.querySelector('span:nth-child(2)').classList.toggle('active');

            if (count % 2 == 0) {
                drawChart1();
            } else {
                drawChart();
            }
            count++;

            function drawChart1() {
                var data = google.visualization.arrayToDataTable([
                    ['Quiz', 'Highest Mark', 'Average Mark', 'Your Child Mark'],
                    ['Test-1', 80, 70, 52],
                        ['Test-2', 85, 60, 59],
                        ['Test-3', 78, 54, 47],
                        ['Test-4', 90, 75, 70]
                ]);

                var options = {
                    'title': 'Education status',
                    hAxis: {
                        title: 'Year',
                        textStyle: { color: '#FFF' }
                    },
                    vAxis: {
                        title: 'Percentage(%)',
                        textStyle: { color: '#FFF' }
                    },
                    backgroundColor: "#202528",
                    chartArea: {
                        backgroundColor: "#202528"
                    },
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        })
    </script>
</body>

</html>