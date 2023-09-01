<?php
error_reporting(-1);
session_start();
require_once __DIR__ . '/blocks/db.php';
require_once __DIR__ . '/blocks/functions.php';
$user='';
$answer = [];
$arr_quesrions = getAllQuestions();
if (isset($_POST['user'])) {
    $user = $_POST['user'];

    $_SESSION['user'] = $_POST['user'];
}

if (isset($_GET['do']) && $_GET['do'] == 'exit') {
    unset($_SESSION['user']);
    header("Location: index.php");
    die;
}

if (isset($_POST['answer'])) {
    $answer[] = $_POST['0answer'];
    $answer[] = $_POST['1answer'];
    $answer[] = $_POST['2answer'];
    $answer[] = $_POST['3answer'];
    $answer[] = $_POST['4answer'];
setAnswerDB($answer);
    debug($answer);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
<?php if (!isset($_SESSION["user"])): ?>
    <div class="container"></div>
    <form method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Enter your name</label>
            <input type="text" class="form-control" name="user" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?php else: ?>
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <p>Добро пожаловать, <?= htmlspecialchars($user) ?>! <a href="?do=exit">Log out</a>
            </p>
        </div>
    </div>
    <form method="post" name="">
        <?php for ($i = 0; $i < count($arr_quesrions); $i++): ?>
            <label for="exampleInputEmail1"
                   class="form-label"><?php echo $i + 1 . '. ' . $arr_quesrions[$i]['question'] ?></label>
            <input type="text" class="form-control" name="<?= $i . 'answer' ?>" aria-describedby="emailHelp">
        <?php endfor; ?>
        <button type="submit" name="answer" class="btn btn-primary">Submit</button>
    </form>
<?php endif; ?>


</body>
</html>
