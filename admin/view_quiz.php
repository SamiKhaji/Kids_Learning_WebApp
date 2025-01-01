<?php
include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:quizzes.php');
}

if(isset($_POST['delete_question'])){ // Corrected the form action name
   $delete_id = $_POST['question_id']; // Corrected to use 'question_id'
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $delete_question = $conn->prepare("DELETE FROM `questions` WHERE id = ?");
   $delete_question->execute([$delete_id]);
   header('location:quizzes.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quiz Details</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
   <style>
      /* Add your custom styles here */
      .question-box {
         background-color: #f9f9f9;
         color: #000; /* Change text color */
         border: 1px solid #ccc;
         border-radius: 5px;
         padding: 15px;
         margin-bottom: 20px;
         position: relative;
      }
      .question-box .question {
         margin-bottom: 10px;
      }
      .question-box .date {
         color: #999;
         margin-bottom: 10px;
      }
      .question-box .actions {
         position: absolute;
         bottom: 10px;
         right: 10px;
         display: flex;
         align-items: center;
      }
      .question-box .actions button {
         padding: 5px 10px;
         font-size: 14px;
         background-color: #5bc0de; /* Update button color */
         color: white;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         transition: background-color 0.3s;
      }
      .question-box .actions button.delete-btn {
         background-color: #d9534f; /* Delete button color */
      }
      .question-box .actions button:hover {
         background-color: #31b0d5; /* Hover color */
      }
      .question-box .actions button + button {
         margin-left: 5px; /* Add a small gap between buttons */
      }
      /* Add margin to the edit button */
      .question-box .actions button.edit-btn {
         margin-right: 5px;
      }
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-details">

   <h1 class="heading">Quiz Details</h1>

   <?php
      $select_quiz = $conn->prepare("SELECT * FROM `quizzes` WHERE id = ? AND tutor_id = ?");
      $select_quiz->execute([$get_id, $tutor_id]);
      if($select_quiz->rowCount() > 0){
         while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
            $quiz_id = $fetch_quiz['id'];
            $count_questions = $conn->prepare("SELECT * FROM `questions` WHERE quiz_id = ?");
            $count_questions->execute([$quiz_id]);
            $total_questions = $count_questions->rowCount();
   ?>
   <div class="row">
      <div class="thumb reduced-width">
         <img src="../uploaded_files/<?= $fetch_quiz['thumbnail']; ?>" alt="Quiz Thumbnail">
      </div>
      <div class="details">
         <h3 class="title"><?= $fetch_quiz['quiz_name']; ?></h3>
         <div class="description"><?= $fetch_quiz['quiz_description']; ?></div>
         <div class="date"><i class="fas fa-calendar"></i> Created at: <?= $fetch_quiz['created_at']; ?></div>
         <span class="total-questions">Total Questions: <?= $total_questions; ?></span>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="quiz_id" value="<?= $quiz_id; ?>">
            <a href="update_quizzes.php?get_id=<?= $quiz_id; ?>" class="option-btn">Update Quiz</a>
            <input type="submit" value="Delete Quiz" class="delete-btn" onclick="return confirm('Delete this quiz?');" name="delete_quiz">
         </form>
         <!-- Add More Questions Button -->
         <form action="add_ques.php" method="get">
            <input type="hidden" name="quiz_id" value="<?= $quiz_id; ?>">
            <button type="submit" class="btn">Add More Questions</button>
         </form>
      </div>
   </div>

   <style>
   /* Add your custom styles here */
   .total-questions {
      color: white;
   }
   .date {
      color: white;
   }
   .question-box {
      background-color: #000;
      color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 15px;
      margin-bottom: 20px;
   }
   .question-box .question {
      margin-bottom: 10px;
   }
   .question-box .date {
      color: white;
      margin-bottom: 10px;
   }
   .question-box .actions {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      margin-top: 10px;
   }
   .question-box .actions button {
      padding: 5px 10px;
      font-size: 14px;
      background-color: #5bc0de; /* Update button color */
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
   }
   .question-box .actions button.delete-btn {
      background-color: #d9534f; /* Delete button color */
   }
   .question-box .actions button:hover {
      background-color: #31b0d5; /* Hover color */
   }
   .question-box .actions button + button {
      margin-left: 10px; /* Add a small gap between buttons */
   }
   /* Add margin to the edit button */
   .question-box .actions button.edit-btn {
      margin-right: 10px;
   }
</style>


   <?php
         }
      }else{
         echo '<p class="empty">No quiz found!</p>';
      }
   ?>

</section>

<section class="contents">
   <h1 class="heading">Quiz Questions</h1>

   <?php
      $select_questions = $conn->prepare("SELECT * FROM `questions` WHERE quiz_id = ?");
      $select_questions->execute([$quiz_id]);
      if($select_questions->rowCount() > 0){
         while($fetch_question = $select_questions->fetch(PDO::FETCH_ASSOC)){ 
   ?>
            <div class="question-box">
               <h3 class="question"><?= $fetch_question['question_text']; ?></h3>
               <div class="date"><i class="fas fa-calendar"></i> Created at: <?= $fetch_question['created_at']; ?></div>
               <div class="actions">
                  <form action="update_ques.php" method="get" style="display: inline;">
                     <input type="hidden" name="id" value="<?= $fetch_question['id']; ?>">
                     <button type="submit" class="btn edit-btn">Edit</button>
                  </form>

                  <form action="view_quiz.php" method="post" style="display: inline;">
    <input type="hidden" name="question_id" value="<?= $fetch_question['id']; ?>">
    <button type="submit" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this question?')" name="delete_question">Delete</button>
</form>


               </div>
            </div>
   <?php
         }
      } else {
         echo '<p class="empty">No questions added yet!</p>';
      }
   ?>
</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
