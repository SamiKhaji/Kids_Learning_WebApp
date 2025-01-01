<?php
include '../components/connect.php';
$tutor_id = isset($_COOKIE['tutor_id']) ? $_COOKIE['tutor_id'] : '';

if (!isset($_COOKIE['tutor_id'])) {
   header('location:login.php');
   exit(); // Stop further execution
}

// Fetch quiz ID from the URL if available
$quiz_id = isset($_GET['quiz_id']) ? $_GET['quiz_id'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Form submission detected

   // Validate form data
   if (!isset($_POST['question_text']) || !isset($_POST['option1']) || !isset($_POST['option2']) || !isset($_POST['option3']) || !isset($_POST['option4']) || !isset($_POST['correct_answer']) || !isset($_POST['explanation']) || !isset($_POST['difficulty']) || !isset($_POST['points'])) {
      $message = "Error: Missing required form fields.";
   } else {
      $question_text = filter_var($_POST['question_text'], FILTER_SANITIZE_STRING);
      $option1 = filter_var($_POST['option1'], FILTER_SANITIZE_STRING);
      $option2 = filter_var($_POST['option2'], FILTER_SANITIZE_STRING);
      $option3 = filter_var($_POST['option3'], FILTER_SANITIZE_STRING);
      $option4 = filter_var($_POST['option4'], FILTER_SANITIZE_STRING);
      $correct_answer = filter_var($_POST['correct_answer'], FILTER_SANITIZE_STRING);
      $explanation = filter_var($_POST['explanation'], FILTER_SANITIZE_STRING);
      $difficulty = filter_var($_POST['difficulty'], FILTER_SANITIZE_STRING);
      $points = filter_var($_POST['points'], FILTER_SANITIZE_STRING);

      // Insert question into database
      $insert_question = $conn->prepare("INSERT INTO `questions` (quiz_id, question_text, option1, option2, option3, option4, correct_answer, explanation, difficulty, points) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_question->execute([$quiz_id, $question_text, $option1, $option2, $option3, $option4, $correct_answer, $explanation, $difficulty, $points]);

      if ($insert_question) {
         // Redirect to the same page after adding the question
         header('Location: ' . $_SERVER['PHP_SELF'] . '?quiz_id=' . $quiz_id);
         exit();
      } else {
         $message = "Failed to add the question. Please try again.";
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Questions</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   
   <style>
      /* Custom CSS for the form */
      .question-form {
         width: 50%;
         margin: 50px auto;
         padding: 20px;
         border-radius: 10px;
         background-color: rgba(0, 0, 0, 0.1); /* Light black background */
      }

      .question-form .heading {
         margin-bottom: 20px;
         color: white;
      }

      .question-form form .form-group {
         margin-bottom: 20px;
      }

      .question-form form label {
         display: block;
         font-weight: bold;
         margin-bottom: 10px; /* Increased margin bottom */
         color: #555; /* Grey color for labels */
         font-size: 18px; /* Increased font size */
      }

      .question-form form input[type="text"],
      .question-form form select,
      .question-form form textarea {
         width: 100%;
         padding: 10px;
         border: 1px solid #000; /* Black border */
         border-radius: 5px;
         font-size: 16px;
         box-sizing: border-box;
         background-color: #000; /* Black background for text boxes */
         color: white; /* Text color */
      }

      .question-form form select {
         appearance: none;
         -webkit-appearance: none;
         -moz-appearance: none;
         background: transparent;
         background-image: url("data:image/svg+xml, %3Csvg viewBox='0 0 10 5' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 0L10 5H0Z' fill='%23007ACC'/%3E%3C/svg%3E");
         background-repeat: no-repeat;
         background-position: right 10px top 50%;
         background-size: 8px auto;
      }

      .question-form form textarea {
         resize: none;
      }

      .question-form form input[type="submit"] {
         background-color: purple;
         color: #fff;
         border: none;
         cursor: pointer;
         padding: 10px 20px;
         border-radius: 5px;
         font-size: 16px;
      }

      .question-form form input[type="submit"]:hover {
         background-color: #6a1b9a;
      }

      .required {
         color: red;
      }

      .box {
         background-color: #000; /* Black background */
         color: white; /* White text color */
      }
      /* Custom CSS for dropdown options */
.question-form select option {
    color: black; /* Set the text color to black */
}
.btn,
.inline-btn{
   background-color: var(--main-color);
}

.option-btn,
.inline-option-btn{
   background-color: var(--oragen);
}

.delete-btn,
.inline-delete-btn{
   background-color: var(--red);
}
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="question-form">

   <h1 class="heading">Add Question</h1>

   <form action="" method="post" class="form">
      <!-- Hidden input field to pass the quiz ID -->
      <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
      <div class="form-group">
         <label>Question Text <span>*</span></label>
         <textarea name="question_text" required placeholder="Enter Question Text" class="box" cols="30" rows="5"></textarea>
      </div>
      <div class="form-group">
         <label>Option 1 <span>*</span></label>
         <input type="text" name="option1" required placeholder="Enter Option 1" class="box">
      </div>
      <div class="form-group">
         <label>Option 2 <span>*</span></label>
         <input type="text" name="option2" required placeholder="Enter Option 2" class="box">
      </div>
      <div class="form-group">
         <label>Option 3 <span>*</span></label>
         <input type="text" name="option3" required placeholder="Enter Option 3" class="box">
      </div>
      <div class="form-group">
         <label>Option 4 <span>*</span></label>
         <input type="text" name="option4" required placeholder="Enter Option 4" class="box">
      </div>
      <div class="form-group">
         <label>Correct Answer <span>*</span></label>
         <select name="correct_answer" required class="box">
            <option value="opt1">Option 1</option>
            <option value="opt2">Option 2</option>
            <option value="opt3">Option 3</option>
            <option value="opt4">Option 4</option>
         </select>
      </div>
      <div class="form-group">
         <label>Explanation <span>*</span></label>
         <textarea name="explanation" required placeholder="Enter Explanation" class="box" cols="30" rows="5"></textarea>
      </div>
      <div class="form-group">
         <label>Difficulty <span>*</span></label>
         <select name="difficulty" required class="box">
            <option value="easy">Easy</option>
            <option value="moderate">Moderate</option>
            <option value="hard">Hard</option>
         </select>
      </div>
      <div class="form-group">
         <label>Points <span>*</span></label>
         <input type="text" name="points" required placeholder="Enter Points" class="box">
      </div>
      <button type="submit" class="btn">Add Question</button>
   </form>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
