<?php
session_start(); // Start the session

include 'components/connect.php';

// Get the user ID from the cookie
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

// Get the quiz ID from the URL parameter
$quiz_id = $_SESSION['quiz_id'];

// Fetch quiz details
$select_quiz = $conn->prepare("SELECT * FROM quizzes WHERE id = ?");
$select_quiz->execute([$quiz_id]);
$fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC);

// Fetch total number of questions for the quiz
$total_questions=$_SESSION['total_questions']  ;

// Calculate the maximum possible score
$max_score = $total_questions * 5;

// HTML for the result page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Performance Report</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #6EE2F5, #6454F0, #FFD64D, #F52D2D, #FFE184, #FF7FBB);
            background-size: 1000% 1000%;
            animation: gradient 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #ffeb3b;
            border-radius: 50%;
            animation: confetti 1s linear infinite;
        }

        @keyframes confetti {
            0% {
                transform: translateY(-100vh) rotateZ(0);
            }
            100% {
                transform: translateY(100vh) rotateZ(360deg);
            }
        }

        .confetti:nth-child(1) {
            left: 5%;
            animation-delay: 0s;
        }

        .confetti:nth-child(2) {
            left: 10%;
            animation-delay: 0.1s;
        }

        .confetti:nth-child(3) {
            left: 15%;
            animation-delay: 0.2s;
        }

        /* Add more .confetti:nth-child(N) for additional confetti elements */

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .score {
            font-size: 24px;
            font-weight: 700;
            color: #555;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .message {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .chart-container {
            position: relative;
            margin: 0 auto 30px;
        }

        canvas {
            max-width: 100%;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .trophy {
            font-size: 48px;
            color: #ffd700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: bounce 0.5s infinite alternate;
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-10px);
            }
        }
        .btn {
    padding: 10px 20px;
    background-color: #ffcc00;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
    border: none;
}

.btn:hover {
    background-color: #e6b800;
}

.btn:active {
    transform: translateY(1px);
}

.btn.retake {
    background-color: #007bff;
}

.btn.retake:hover {
    background-color: #0056b3;
}

.btn.home {
    background-color: #28a745;
}

.btn.home:hover {
    background-color: #1e7e34;
}

    </style>
</head>
<body>
<div class="container">
    <h1>Quiz Performance Report</h1>
    <p class="score">Total Score: <?php echo isset($_SESSION['quiz_score']) ? $_SESSION['quiz_score'] : 0; ?> / <?php echo $max_score; ?></p>
    <?php
    $score_percentage = (isset($_SESSION['quiz_score']) ? $_SESSION['quiz_score'] : 0) / $max_score * 100;
    if ($score_percentage < 50) {
        echo '<p class="message">Work hard, you can do it!</p>';
    } elseif ($score_percentage >= 50 && $score_percentage < 85) {
        echo '<p class="message">Good one, you can improve!</p>';
    } else {
        echo '<p class="message">Great job! <span class="trophy">&#127942;</span></p>';
    }
    ?>
    <div class="chart-container">
        <canvas id="scoreChart"></canvas>
    </div>
    <div class="buttons">
    <a href="take_quiz.php?quiz_id=<?php echo $quiz_id; ?>" class="btn retake">Retake Quiz</a>
    <a href="home.php" class="btn home">Go to Home</a>
</div>

    <!-- Confetti Elements -->
    <div class="confetti"></div>
    <div class="confetti"></div>
    <div class="confetti"></div>
    <!-- Add more confetti elements for additional celebration -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('scoreChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Correct', 'Wrong'],
            datasets: [{
                data: [<?php echo isset($_SESSION['quiz_score']) ? $_SESSION['quiz_score'] : 0; ?>, <?php echo $max_score - (isset($_SESSION['quiz_score']) ? $_SESSION['quiz_score'] : 0); ?>],
                backgroundColor: [
                    '#28a745',
                    '#dc3545'
                ],
                borderColor: [
                    '#1e7e34',
                    '#c82333'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 15,
                        padding: 20
                    }
                }
            }
        }
    });

    function createConfetti() {
        const emojis = ['🎉', '🎈', '🏆', '🥳', '🌟'];
        const confetti = document.createElement('div');
        confetti.classList.add('confetti');
        confetti.innerText = emojis[Math.floor(Math.random() * emojis.length)];
        confetti.style.left = Math.random() * 100 + 'vw';
        confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
        confetti.style.opacity = Math.random();
        confetti.style.fontSize = Math.random() * 30 + 10 + 'px';
        document.body.appendChild(confetti);

        setTimeout(() => {
            confetti.remove();
        }, 3000);
    }

    setInterval(createConfetti, 100);
</script>

</body>
</html>


