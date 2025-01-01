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
$quiz_id = $_GET['quiz_id'] ?? null;
$_SESSION['quiz_id'] = $quiz_id;
// Fetch quiz details
$select_quiz = $conn->prepare("SELECT * FROM quizzes WHERE id = ?");
$select_quiz->execute([$quiz_id]);
$fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC);

$total_questions = $fetch_quiz['total_questions'] ?? 0;

// Fetch all quiz questions
$select_questions_all = $conn->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$select_questions_all->execute([$quiz_id]);
$questions_all = $select_questions_all->fetchAll(PDO::FETCH_ASSOC);

// Check if the quiz has been submitted
if (isset($_POST['submit_quiz'])) {
    try {
        $total_score = 0;
        foreach ($questions_all as $question) {
            $selected_option = $_POST['question_' . $question['id']];
            $correct_answer = $question['correct_answer'];
            $points = ($selected_option == $correct_answer) ? $question['points'] : 0;
            $total_score += $points;

            // Insert into marks table
            $sql = "INSERT INTO marks (user_id, quiz_id, question_id, user_answer, correct_answer, points) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$user_id, $quiz_id, $question['id'], $selected_option, $correct_answer, $points]);
            $stmt->closeCursor(); // Close the statement cursor
        }

        // Set the score in a session variable
        $_SESSION['quiz_score'] = $total_score;

        // Redirect to quiz_result.php
        header('Location: quiz_result.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Select a random subset of questions based on total_questions
$total_questions = min($total_questions, count($questions_all)); // Limit to the number of questions available
if ($total_questions > 0) {
    $random_keys = array_rand($questions_all, $total_questions);
    if (!is_array($random_keys)) {
        $random_keys = [$random_keys];
    }
    $questions = array_intersect_key($questions_all, array_flip($random_keys));
} else {
    $questions = [];
}
$_SESSION['total_questions'] = $total_questions;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Take Quiz</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .quiz-container {
            width: 1000px; /* Increased max-width */
            margin: 10px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            animation: fadeIn 0.5s ease-in-out;
            transform: translateX(-30%);
        }

        .question {
            margin-bottom: 40px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            animation: fadeIn 0.5s ease-in-out;
        }

        .question-text {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .option {
            display: flex;
            align-items: center;
        }

        .option label {
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
            width: 100%;
        }

        .option label:hover {
            background-color: #e0e0e0;
        }

        .option input[type="radio"] {
            display: none;
        }

        .option input[type="radio"]:checked + label {
            background-color: #2196F3;
            color: #fff;
        }

        .option label span {
            margin-left: 10px;
        }

        .submit-btn {
            text-align: center;
            margin-top: 30px;
        }

        .submit-btn input[type="submit"] {
            padding: 12px 30px;
            background-color: #2196F3;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .submit-btn input[type="submit"]:hover {
            background-color: #0d8bf2;
        }
        

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }}
       
            </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>

    <!-- take quiz section starts -->
    <section class="courses">
        <h1 class="heading"><?= $fetch_quiz['quiz_name'] ?></h1>
        <div class="box-container">
            <div class="quiz-container">
                <form action="" method="post">
                    <?php
                    foreach ($questions as $question) {
                        ?>
                        <div class="question">
                            <div class="question-text"><?= $question['question_text'] ?></div>
                            <div class="options">
                                <?php for ($i = 1; $i <= 4; $i++) : ?>
                                    <div class="option">
                                        <input type="radio" name="question_<?= $question['id'] ?>" id="option_<?= $question['id'] ?>_<?= $i ?>" value="<?= $i ?>" required>
                                        <label for="option_<?= $question['id'] ?>_<?= $i ?>"><span><?= $question['option' . $i] ?></span></label>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="submit-btn">
                        <input type="submit" name="submit_quiz" value="Submit Quiz">
                    </div>
                    <input type="hidden" name="total_questions" value="<?= $total_questions ?>">
                </form>
            </div>
        </div>
    </section>
    <!-- take quiz section ends -->

    <!-- jQuery library file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- custom js file link -->
    <script src="js/script.js"></script>
</body>
</html>
