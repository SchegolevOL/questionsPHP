<?php
function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

/**
 *The method returns all questions from the database
 * @return array
 */
function getAllQuestions(): array
{
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM tab_question");
    $res->execute();
    $result = [];
    while ($row = $res->fetch()) {
        $result[] = $row;
    }

    return $result;
}

function setAnswerDB($arr = []): bool
{
    global $pdo;
    $id =1;
    foreach ($arr as $item) {
        $res = $pdo->prepare("INSERT INTO `tab_answers`(`id_question`, `answer`, `user`) VALUES (?, ? ,?)");
        $res->execute([$id, $item, $_SESSION['user']]);
        $id++;
    }


    return true;
}