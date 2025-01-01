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

if(isset($_POST['submit'])){

   $quiz_title = $_POST['quiz_title'];
   $quiz_title = filter_var($quiz_title, FILTER_SANITIZE_STRING);
   $quiz_description = $_POST['quiz_description'];
   $quiz_description = filter_var($quiz_description, FILTER_SANITIZE_STRING);
   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);

   $update_quiz = $conn->prepare("UPDATE `quizzes` SET quiz_name = ?, quiz_description = ?, status = ? WHERE id = ?");
   $update_quiz->execute([$quiz_title, $quiz_description, $status, $get_id]);

   $old_thumbnail = isset($_POST['old_thumbnail']) ? $_POST['old_thumbnail'] : '';
   $old_thumbnail = filter_var($old_thumbnail, FILTER_SANITIZE_STRING);
   $thumbnail = $_FILES['thumbnail']['name'];
   $thumbnail = filter_var($thumbnail, FILTER_SANITIZE_STRING);
   $ext = pathinfo($thumbnail, PATHINFO_EXTENSION);
   $rename = uniqid().'.'.$ext;
   $thumbnail_size = $_FILES['thumbnail']['size'];
   $thumbnail_tmp_name = $_FILES['thumbnail']['tmp_name'];
   $thumbnail_folder = '../uploaded_files/'.$rename;

   if(!empty($thumbnail)){
      if($thumbnail_size > 2000000){
         $message[] = 'Thumbnail size is too large!';
      }else{
         $update_thumbnail = $conn->prepare("UPDATE `quizzes` SET thumbnail = ? WHERE id = ?");
         $update_thumbnail->execute([$rename, $get_id]);
         move_uploaded_file($thumbnail_tmp_name, $thumbnail_folder);
         if($old_thumbnail != '' AND $old_thumbnail != $rename){
            unlink('../uploaded_files/'.$old_thumbnail);
         }
      }
   } 

   $message[] = 'Quiz updated!';  

}

if(isset($_POST['delete'])){
   $delete_id = $_POST['quiz_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
   $delete_quiz_thumbnail = $conn->prepare("SELECT * FROM `quizzes` WHERE id = ? LIMIT 1");
   $delete_quiz_thumbnail->execute([$delete_id]);
   $fetch_thumbnail = $delete_quiz_thumbnail->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumbnail['thumbnail']);
   $delete_quiz = $conn->prepare("DELETE FROM `quizzes` WHERE id = ?");
   $delete_quiz->execute([$delete_id]);
   header('location:quizzes.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Quiz</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="playlist-form">

   <h1 class="heading">Update Quiz</h1>

   <?php
      $select_quiz = $conn->prepare("SELECT * FROM `quizzes` WHERE id = ?");
      $select_quiz->execute([$get_id]);
      if($select_quiz->rowCount() > 0){
         while($fetch_quiz = $select_quiz->fetch(PDO::FETCH_ASSOC)){
            $quiz_id = $fetch_quiz['id'];
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="old_thumbnail" value="<?= isset($fetch_quiz['thumbnail']) ? $fetch_quiz['thumbnail'] : ''; ?>">
      <p>Quiz Status <span>*</span></p>
      <select name="status" class="box" required>
         <option value="<?= isset($fetch_quiz['status']) ? $fetch_quiz['status'] : ''; ?>" selected><?= isset($fetch_quiz['status']) ? $fetch_quiz['status'] : ''; ?></option>
         <option value="active">Active</option>
         <option value="inactive">Inactive</option>
      </select>
      <p>Quiz Title <span>*</span></p>
      <input type="text" name="quiz_title" maxlength="100" required placeholder="Enter quiz title" value="<?= isset($fetch_quiz['quiz_name']) ? $fetch_quiz['quiz_name'] : ''; ?>" class="box">
      <p>Quiz Description <span>*</span></p>
      <textarea name="quiz_description" class="box" required placeholder="Write description" maxlength="1000" cols="30" rows="10"><?= isset($fetch_quiz['quiz_description']) ? $fetch_quiz['quiz_description'] : ''; ?></textarea>
      <p>Quiz Thumbnail <span>*</span></p>
      <div class="thumb">
         <?php if(isset($fetch_quiz['thumbnail']) && !empty($fetch_quiz['thumbnail'])): ?>
            <img src="../uploaded_files/<?= $fetch_quiz['thumbnail']; ?>" alt="Quiz Thumbnail">
         <?php endif; ?>
      </div>
      <input type="file" name="thumbnail" accept="image/*" class="box">
      <input type="submit" value="Update Quiz" name="submit" class="btn">
      <div class="flex-btn">
         <input type="submit" value="Delete" class="delete-btn" onclick="return confirm('Delete this quiz?');" name="delete">
         <a href="view_quiz.php?get_id=<?= $quiz_id; ?>" class="option-btn">View Quiz</a>
      </div>
   </form>
   <?php
         } 
      }else{
         echo '<p class="empty">No quiz found!</p>';
      }
   ?>

</section>

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>
