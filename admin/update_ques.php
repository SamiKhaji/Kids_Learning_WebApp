<?php
include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['id'])){
   $question_id = $_GET['id'];
   
   // Fetch the quiz ID associated with the question
   $select_question = $conn->prepare("SELECT quiz_id FROM `questions` WHERE id = ?");
   $select_question->execute([$question_id]);
   $fetch_question = $select_question->fetch(PDO::FETCH_ASSOC);
   
   if($fetch_question) {
       $quiz_id = $fetch_question['quiz_id'];
   } else {
       // Redirect if the question ID is not found
       header('location:view_quiz.php');
       exit; // Stop further execution
   }
} else {
   header('location:view_quiz.php');
   exit; // Stop further execution
}

if(isset($_POST['update_question'])){
   $question_text = $_POST['question-text'];
   $option1 = $_POST['option1'];
   $option2 = $_POST['option2'];
   $option3 = $_POST['option3'];
   $option4 = $_POST['option4'];
   $correct_answer = $_POST['correct-answer'];

   $update_question = $conn->prepare("UPDATE `questions` SET question_text=?, option1=?, option2=?, option3=?, option4=?, correct_answer=? WHERE id=?");
   $update_question->execute([$question_text, $option1, $option2, $option3, $option4, $correct_answer, $question_id]);

   // Redirect to the view_quiz.php page after updating the question
   header('location:view_quiz.php?get_id=' . $quiz_id);
   exit; // Stop further execution
}

$select_question = $conn->prepare("SELECT * FROM `questions` WHERE id = ?");
$select_question->execute([$question_id]);
$fetch_question = $select_question->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Question</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      /* Add your custom styles here */
      .btn{
        background-color: purple;
      }
      .playlist-form {
         width: 50%;
         margin: 50px auto;
      }
      .playlist-form .heading {
         margin-bottom: 20px;
      }
      .playlist-form form p {
         margin-bottom: 10px;
      }
      .playlist-form form input[type="text"],
      .playlist-form form input[type="submit"],
      .playlist-form form select {
         width: 100%;
         padding: 10px;
         margin-bottom: 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
         font-size: 16px;
      }
      .playlist-form form select {
         appearance: none;
         -webkit-appearance: none;
         -moz-appearance: none;
         background: transparent;
         background-image: url("data:image/svg+xml, %3Csvg viewBox='0 0 10 5' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 0L10 5H0Z' fill='%23007ACC'/%3E%3C/svg%3E");
         background-repeat: no-repeat;
         background-position: right 10px top 50%;
         background-size: 8px auto;
      }
      .playlist-form form textarea {
         width: 100%;
         padding: 10px;
         margin-bottom: 20px;
         border: 1px solid #ccc;
         border-radius: 5px;
         font-size: 16px;
         resize: none;
      }
      .playlist-form form input[type="submit"] {
         background-color: purple;
         color: #fff;
         border: none;
         cursor: pointer;
      }
      .playlist-form form input[type="submit"]:hover {
         background-color: #6a1b9a;
      }
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="playlist-form">
   <h1 class="heading">Edit Question</h1>

   <form action="" method="post">
      <p>Question Text <span>*</span></p>
      <input type="text" id="question-text" name="question-text" value="<?= $fetch_question['question_text']; ?>" required>
      
      <p>Option 1 <span>*</span></p>
      <input type="text" id="option1" name="option1" value="<?= $fetch_question['option1']; ?>" required>
      
      <p>Option 2 <span>*</span></p>
      <input type="text" id="option2" name="option2" value="<?= $fetch_question['option2']; ?>" required>
      
      <p>Option 3 <span>*</span></p>
      <input type="text" id="option3" name="option3" value="<?= $fetch_question['option3']; ?>" required>
      
      <p>Option 4 <span>*</span></p>
      <input type="text" id="option4" name="option4" value="<?= $fetch_question['option4']; ?>" required>
      
      <p>Correct Answer <span>*</span></p>
      <select id="correct-answer" name="correct-answer" required>
         <option value="1" <?= ($fetch_question['correct_answer'] == '1') ? 'selected' : ''; ?>>Option 1</option>
         <option value="2" <?= ($fetch_question['correct_answer'] == '2') ? 'selected' : ''; ?>>Option 2</option>
         <option value="3" <?= ($fetch_question['correct_answer'] == '3') ? 'selected' : ''; ?>>Option 3</option>
         <option value="4" <?= ($fetch_question['correct_answer'] == '4') ? 'selected' : ''; ?>>Option 4</option>
      </select>
      
      <input type="submit" value="Update Question" name="update_question" class="btn">
   </form>
</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
