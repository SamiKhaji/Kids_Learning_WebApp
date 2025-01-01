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
</head>

<style>

body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 30px 60px;
            border: none;
            border-radius: 30px;
            font-size: 36px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            display: block;
            margin: 20px auto;
            text-decoration: none;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .button:active {
            transform: translateY(2px);
        }
        /* Sliding bar styles */
        .slider-container {
            display: none;
            margin-top: 20px;
            position: relative;
        }
        .slider {
            -webkit-appearance: none;
            width: 70%; /* Adjusted width */
            height: 20px; /* Adjusted height */
            border-radius: 10px; /* Adjusted border radius */
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
            margin: 0 auto; /* Centered */
            position: relative;
            z-index: 1;
        }
        .slider::-webkit-slider-runnable-track {
            width: 100%;
            height: 20px;
            cursor: pointer;
            background: #d3d3d3;
            border-radius: 10px;
            border: 0.2px solid #010101;
        }
        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #007bff;
            cursor: pointer;
            margin-top: -5px; /* Align thumb with slider */
            position: relative;
            z-index: 2;
        }
        .slider::-moz-range-thumb {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #007bff;
            cursor: pointer;
            margin-top: -5px; /* Align thumb with slider */
            position: relative;
            z-index: 2;
        }
        /* Animation class for button */
        .animate {
            transform: translateY(-100vh);
        }
        /* Dropdown styles */
        .dropdown {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .dropdown select {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 18px;
            width: 250px;
            box-sizing: border-box;
            appearance: none;
            -webkit-appearance: none;
            background-color: #f9f9f9;
            cursor: pointer;
        }
        .dropdown button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .dropdown button:hover {
            background-color: #0056b3;
        }
        .slider-number {
            position: absolute;
            bottom: calc(100% + 10px); /* Adjusted position */
            transform: translateX(-50%);
            font-size: 12px;
            z-index: 0; /* Moved behind the slider */
            opacity: 0;
            pointer-events: none; /* Prevent hover interference */
        }
        .slider:hover .slider-number {
            opacity: 1; /* Show numbering on hover */
        }

    .accordion {
        background-color: rgb(29, 153, 68);
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
        margin-top: 8rem;
        margin-left: 30px;
        width: 90% !important;
    }

    .active,
    .accordion:hover {
        background-color: rgb(21, 162, 66);
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
        margin-top: 5px;
        margin-left: 5px !important;
        margin-right: 20px !important;
        margin-bottom: 5px;
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
                <a href="parent_home.php" >
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Home</h3>

                </a>
                <a href="parent_messages.php" >
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Messages </h3><span class="message-count">26</span>

                </a>
                <a href="customisatin.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Customisation</h3>

                </a>
                <a href="conseller.php">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Account Controls</h3>

                </a>
                <a href="studentsdata.html">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Payement</h3>

                </a>



                <a href="login.html">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>logout</h3>

                </a>
            </div>




        </aside>
        <!-- =========================================================start edit========================================== -->
        <main>

            <div class="jacobian">
                
                    <a href="#" class="button" id="setScreenLimitBtn">Set Screen Limit</a>
                    <a href="#" class="button" id="setGoalBtn">Set Goal</a>
                
                    <!-- Sliding bar for Screen Limit -->
                    <div class="slider-container" id="sliderContainer">
                        <input type="range" min="1" max="10" value="5" class="slider" id="screenLimitSlider">
                    </div>
                
                    <!-- Dropdowns for Set Goal -->
                    <div class="dropdown" id="goalDropdowns" style="display: none;">
                        <select id="videoDropdown">
                            <option value="">Number of videos to complete</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <!-- Add more options as needed -->
                        </select>
                        <select id="testDropdown">
                            <option value="">Number of tests to take</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <!-- Add more options as needed -->
                        </select>
                        <button id="submitGoalBtn">Submit</button>
                    </div>
            
                
            </div>
            <!-- <=======================end edit=====================================================> -->
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
        const sidemenu = document.querySelector('aside');
        const menubtn = document.querySelector('#menu-btn');
        const closebtn = document.querySelector('#close-btn');
        menubtn.addEventListener('click', () => {
            sidemenu.style.display = "block"
        })
        closebtn.addEventListener('click', () => {
            sidemenu.style.display = "none"

        })
        const theme_toggler = document.querySelector('#themeToggler')
        var count = 0
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
                    ['Year', 'dropout%', 'success rate%', 'literacy rate%'],
                    ['2014', 80, 20, 61.4],
                    ['2015', 70, 40, 72.3],
                    ['2016', 60, 54, 83.3],
                    ['2017', 33, 67, 81]
                ]);

                var options = {
                    'title': 'Education status',
                    hAxis: {
                        title: 'Percentage(%)',
                        textStyle: { color: '#FFF' }
                    },
                    vAxis: {
                        title: 'Year',
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

        document.addEventListener('DOMContentLoaded', function () {
        const setScreenLimitBtn = document.getElementById('setScreenLimitBtn');
        const setGoalBtn = document.getElementById('setGoalBtn');
        const sliderContainer = document.getElementById('sliderContainer');
        const goalDropdowns = document.getElementById('goalDropdowns');
        const submitGoalBtn = document.getElementById('submitGoalBtn');
        const screenLimitSlider = document.getElementById('screenLimitSlider');

        // Function to dynamically generate numbering on the slider
        function generateSliderNumbering() {
            const min = parseInt(screenLimitSlider.min);
            const max = parseInt(screenLimitSlider.max);
            const range = max - min;
            const trackWidth = screenLimitSlider.offsetWidth - 12; // Adjusted width for padding
            const increment = (trackWidth / range)*45;
            let position = 135;

            for (let i = min; i <= max; i++) {
                const sliderNumber = document.createElement('div');
                sliderNumber.classList.add('slider-number');
                sliderNumber.textContent = i;
                sliderNumber.style.left = `${position}px`;
                sliderContainer.appendChild(sliderNumber);
                position -= increment;
            }
        }

        setScreenLimitBtn.addEventListener('click', function() {
            setGoalBtn.classList.add('animate');
            goalDropdowns.style.display = 'none';
            setScreenLimitBtn.classList.remove('animate');
            sliderContainer.style.display = 'block';
        });

        setGoalBtn.addEventListener('click', function() {
            setScreenLimitBtn.classList.add('animate');
            sliderContainer.style.display = 'none';
            setGoalBtn.classList.remove('animate');
            goalDropdowns.style.display = 'block';
        });

        submitGoalBtn.addEventListener('click', function() {
            setScreenLimitBtn.classList.remove('animate');
            setGoalBtn.classList.remove('animate');
            goalDropdowns.style.display = 'none';
        });

        screenLimitSlider.addEventListener('input', function() {
            updateSliderNumber(this.value);
        });

        screenLimitSlider.addEventListener('change', function() {
            setScreenLimitBtn.classList.remove('animate');
            sliderContainer.style.display = 'none';
            setGoalBtn.classList.remove('animate');
        });

        // Function to update the slider number based on the slider value
        function updateSliderNumber(value) {
            const sliderNumbers = document.querySelectorAll('.slider-number');
            sliderNumbers.forEach(number => {
                if (parseInt(number.textContent) === parseInt(value)) {
                    number.style.opacity = '1';
                } else {
                    number.style.opacity = '0';
                }
            });
        }

        // Generate numbering on slider
        generateSliderNumbering();
    });
    </script>

</body>

</html>