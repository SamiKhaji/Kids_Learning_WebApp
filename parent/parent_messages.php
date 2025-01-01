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
                <a href="parent_messages.php" class="active">
                    <span class="material-icons-sharp">grid_view</span>
                    <h3>Messages </h3><span class="message-count">26</span>

                </a>
                <a href="customisatin.php">
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
                <h2 style="margin-bottom: 8px;">Recent Messages &ensp;<span class="message-counter" style="background-color: #ee2c3c;border-radius: 50%;color: white;padding: 5px;">26</span></h2>
                <button class="accordion"><span class="material-icons-sharp">mail</span>Registration Successful</button>
                <div class="panel">
                    <div class="textdata">

                        <div class="profile-photo"><img src="p.jpeg"></div>


                        This is to inform you that you have successfuly completed registration by completing the payment. <br>
                        Your child can now start the course.


                    </div>
                </div>

                <button class="accordion"><span class="material-icons-sharp">mail</span>Quiz Response Received</button>
                <div class="panel">
                    <div class="textdata">

                        <div class="profile-photo"><img src="p.jpeg"></div>


                        This is to inform that your child has completed the Quiz and we received the response successfully.

                    </div>
                </div>

                <button class="accordion"><span class="material-icons-sharp">mail</span>Alert</button>
                <div class="panel">
                    <div class="textdata">

                        <div class="profile-photo"><img src="p.jpeg"></div>

                        This is to inform that your child made an attempt to do the in-app purchase with the coins he/she earned.

                    </div>
                </div>
                <button class="accordion"><span class="material-icons-sharp">mail</span>Checkout the coupon!</button>
                <div class="panel">
                    <div class="textdata">

                        <div class="profile-photo"><img src="p.jpeg"></div>

                        Congratulation!! you unloacked a new coupon, you can apply it at the checkout of a new course registration.

                    </div>
                </div>
                <button class="accordion"><span class="material-icons-sharp">mail</span>Successfully changed the Password</button>
                <div class="panel">
                    <div class="textdata">

                        <div class="profile-photo"><img src="p.jpeg"></div>

                        This is to inform you that you have changed the password of your child's account.

                    </div>
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
    </script>

</body>

</html>