<?php include 'components/connect.php';
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzes</title>
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'components/user_header.php'; ?>

    <!-- quizzes section starts -->
    <section class="courses">
        <h1 class="heading">All Quizzes</h1>
        <div class="box-container">
            <?php
            $select_quizzes = $conn->prepare("SELECT * FROM `quizzes` WHERE status = ? ORDER BY created_at DESC");
            $select_quizzes->execute(['active']);
            if ($select_quizzes->rowCount() > 0) {
                while ($fetch_quiz = $select_quizzes->fetch(PDO::FETCH_ASSOC)) {
                    $quiz_id = $fetch_quiz['id'];
                    $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE id = ?");
                    $select_tutor->execute([$fetch_quiz['tutor_id']]);
                    $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="box">
                        <div class="tutor">
                            <img src="uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
                            <div>
                                <h3><?= $fetch_tutor['name']; ?></h3>
                                <span><?= $fetch_quiz['created_at']; ?></span>
                            </div>
                        </div>
                        <img src="uploaded_files/<?= $fetch_quiz['thumbnail']; ?>" class="thumb" alt="">
                        <h3 class="title"><?= $fetch_quiz['quiz_name']; ?></h3>
                        <a href="take_quiz.php?quiz_id=<?= $quiz_id; ?>" class="inline-btn">Take Quiz</a>
                    </div>
                <?php
                }
            } else {
                echo '<p class="empty">No quizzes available!</p>';
            }
            ?>
        </div>
    </section>
    <!-- quizzes section ends -->

    <?php include 'components/footer.php'; ?>

    <!-- custom js file link -->
    <script src="js/script.js"></script>
</body>
</html>