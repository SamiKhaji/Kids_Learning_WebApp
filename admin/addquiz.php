<?php
require_once '../vendor/autoload.php'; // Load the PhpSpreadsheet library
include '../components/connect.php';

if (isset($_COOKIE['tutor_id'])) {
    $tutor_id = $_COOKIE['tutor_id'];
} else {
    $tutor_id = '';
    header('location:login.php');
}

if (isset($_POST['submit'])) {
    $id = unique_id();
    $title = $_POST['title'];
    $title = filter_var($title, FILTER_SANITIZE_STRING);
    $description = $_POST['description'];
    $description = filter_var($description, FILTER_SANITIZE_STRING);
    $status = $_POST['status'];
    $status = filter_var($status, FILTER_SANITIZE_STRING);
    $image = $_FILES['image']['name'];
    $image = filter_var($image, FILTER_SANITIZE_STRING);
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $rename = unique_id() . '.' . $ext;
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_files/' . $rename;
    $total_questions = $_POST['total_questions'];

    $add_quiz = $conn->prepare("INSERT INTO `quizzes`(id, tutor_id, quiz_name, quiz_description, thumbnail, status,total_questions) VALUES(?,?,?,?,?,?,?)");
    $add_quiz->execute([$id, $tutor_id, $title, $description, $rename, $status,$total_questions]);
    move_uploaded_file($image_tmp_name, $image_folder);

    if (isset($_FILES['questions_file']) && $_FILES['questions_file']['error'] == 0) {
        $allowed_extensions = array('xlsx', 'xls');
        $file_extension = pathinfo($_FILES['questions_file']['name'], PATHINFO_EXTENSION);
    
        if (in_array($file_extension, $allowed_extensions)) {
            require_once '../vendor/autoload.php';
            $inputFile = $_FILES['questions_file']['tmp_name'];
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($inputFile);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
    
            for ($row = 2; $row <= $highestRow; $row++) {
                $question_text = $worksheet->getCell('A' . $row)->getValue();
                $option1 = $worksheet->getCell('B' . $row)->getValue();
                $option2 = $worksheet->getCell('C' . $row)->getValue();
                $option3 = $worksheet->getCell('D' . $row)->getValue();
                $option4 = $worksheet->getCell('E' . $row)->getValue();
                $correct_answer = $worksheet->getCell('F' . $row)->getValue();
                $explanation = $worksheet->getCell('G' . $row)->getValue();
                $difficulty = $worksheet->getCell('H' . $row)->getValue();
                $points = $worksheet->getCell('I' . $row)->getValue();
    
                $add_question = $conn->prepare("INSERT INTO questions (quiz_id, question_text, option1, option2, option3, option4, correct_answer, explanation, difficulty, points, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
                $add_question->execute([$id, $question_text, $option1, $option2, $option3, $option4, $correct_answer, $explanation, $difficulty, $points]);
            }
        } else {
            $message[] = 'Please upload an Excel file (.xlsx or .xls)';
        }
    }

    $message[] = 'New quiz created!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/admin_style.css">
</head>
<body>
    <?php include '../components/admin_header.php'; ?>

    <section class="playlist-form">
        <h1 class="heading">Create Quiz</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <p>Quiz Status <span>*</span></p>
            <select name="status" class="box" required>
                <option value="" selected disabled>-- Select Status --</option>
                <option value="active">Active</option>
                <option value="deactive">Deactive</option>
            </select>
            <p>Quiz Title <span>*</span></p>
            <input type="text" name="title" maxlength="100" required placeholder="Enter quiz title" class="box">
            <p>Quiz Description <span>*</span></p>
            <textarea name="description" class="box" required placeholder="Write description" maxlength="1000" cols="30" rows="10"></textarea>
            <p>Quiz Thumbnail <span>*</span></p>
            <input type="file" name="image" accept="image/*" required class="box">
            <p>Upload Quiz Questions (Excel file) <span>*</span></p>
            <input type="file" name="questions_file" accept=".xlsx,.xls" required class="box">
            <p>Number of Questions <span>*</span></p>
            <input type="number" name="total_questions" required class="box" min="1">

            <input type="submit" value="Create Quiz" name="submit" class="btn">
        </form>
    </section>

    <?php include '../components/footer.php'; ?>
    <script src="../js/admin_script.js"></script>
</body>
</html>