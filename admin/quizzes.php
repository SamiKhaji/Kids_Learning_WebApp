<?php
include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

// Check if the delete button is clicked
if(isset($_POST['delete'])){
   $quiz_id = $_POST['quiz_id']; // Get the ID of the quiz to be deleted
   $quiz_id = filter_var($quiz_id, FILTER_SANITIZE_STRING);

   // Prepare and execute the query to delete the quiz
   $delete_quiz = $conn->prepare("DELETE FROM `quizzes` WHERE id = ? AND tutor_id = ?");
   $delete_quiz->execute([$quiz_id, $tutor_id]);

   // Check if the quiz is successfully deleted
   if($delete_quiz->rowCount() > 0){
      $message[] = 'Quiz deleted!';
   }else{
      $message[] = 'Failed to delete quiz!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quizzes</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

   <style>
      .button-container {
         display: flex;
         gap: 10px;
         margin-bottom: 10px; /* Add margin bottom */
      }

      .button-container form {
         flex: 1;
      }
   </style>
</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlists">

   <h1 class="heading">Your Quizzes</h1>

   <div class="box-container">

   <div class="box" style="text-align: center;">
    <h3 class="title" style="margin-bottom: .5rem;">Create New Quiz</h3>
    <a href="addquiz.php" class="btn">Add Quiz</a> <!-- Updated link -->
</div>


      <?php
         $select_quizzes = $conn->prepare("SELECT * FROM `quizzes` WHERE tutor_id = ?");
         $select_quizzes->execute([$tutor_id]);
         if($select_quizzes->rowCount() > 0){
            while($fetch_quizzes = $select_quizzes->fetch(PDO::FETCH_ASSOC)){ 
               $quiz_id = $fetch_quizzes['id'];
      ?>
         <div class="box">
            <div class="flex">
               <div><i class="fas fa-dot-circle" style="<?php if($fetch_quizzes['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_quizzes['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_quizzes['status']; ?></span></div>
               <div><i class="fas fa-calendar"></i><span><?= $fetch_quizzes['created_at']; ?></span></div>
            </div>
            <div class="thumb">
               <?php if(!empty($fetch_quizzes['thumbnail'])): ?>
                  <img src="../uploaded_files/<?= $fetch_quizzes['thumbnail']; ?>" alt="Quiz Thumbnail">
               <?php endif; ?>
            </div>
            <!-- You can add more details about the quiz here -->
            <h3 class="title"><?= $fetch_quizzes['quiz_name']; ?></h3>
            <p class="description"><?= $fetch_quizzes['quiz_description']; ?></p>
            <div class="button-container">
   <form action="update_quizzes.php" method="get">
      <input type="hidden" name="get_id" value="<?= $quiz_id; ?>">
      <button type="submit" class="option-btn">Update</button>
   </form>
   <form action="" method="post">
      <input type="hidden" name="quiz_id" value="<?= $quiz_id; ?>">
      <button type="submit" class="delete-btn" onclick="return confirm('Delete this quiz?')" name="delete">Delete</button>
   </form>

</div>

            <div class="button-container"> <!-- New container for View Quiz -->
               <a href="view_quiz.php?get_id=<?= $quiz_id; ?>" class="btn">View Quiz</a>
            </div>
         </div>
      <?php
            }
         }else{
            echo '<p class="empty">No quizzes added yet!</p>';
         }
      ?>

   </div>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

</body>
</html>
