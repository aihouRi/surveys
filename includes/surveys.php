<?php session_start(); ?>

<?php include "db.php"; ?>
<?php include "header.php"; ?>


<?php

$user_name = $_SESSION['user_name'];

$stmt_user = $dbh->query('SELECT * FROM users WHERE user_name = "' . $user_name . '"');
$row = $stmt_user->fetch(PDO::FETCH_ASSOC);
$user_id = $row['user_id'];

if (isset($_POST["send"])) {

    $stmt = $dbh->query("SELECT * FROM questions");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $question_id = $row['question_id'];

        if (isset($_POST["responses_" . $question_id])) {
            $response = $_POST["responses_" . $question_id];
            $suggestion = $_POST["suggestions_" . $question_id] ?? '';

            $insertStmt = $dbh->prepare("INSERT INTO responses(question_id, user_id, rating, suggestion) VALUES (:question_id, :user_id, :response, :suggestion)");
            $insertStmt->bindParam(':question_id', $question_id);
            $insertStmt->bindParam(':user_id', $user_id);
            $insertStmt->bindParam(':response', $response);
            $insertStmt->bindParam(':suggestion', $suggestion);
            $insertStmt->execute();
        }
    }
}




?>


<!-- Page Content -->
<div class="container">
    <form method="post" action="">
        <!-- Card 1 -->
        <?php

        $count = 0;

        $stmt = $dbh->query("SELECT * FROM questions");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $count++;

            $question_text = $row['question_text'];
            $question_id = $row['question_id'];
        ?>


            <div class="mx-0 mx-sm-auto form-mp">
                <div class="q_text">
                    <p>
                        <strong>
                            <?php echo "Q" . $count . ". " . $question_text; ?>
                        </strong>
                    </p>
                </div>

                <div class="mb-3 custom-radio-size">
                    <div class="d-inline mx-4">
                        Bad
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="responses_<?php echo $question_id ?>" id="inlineRadio1_<?php echo $question_id; ?>" value="1" required />
                        <label class="form-check-label" for="inlineRadio1_<?php echo $question_id; ?>">1</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="responses_<?php echo $question_id ?>" id="inlineRadio2_<?php echo $question_id; ?>" value="2" />
                        <label class="form-check-label" for="inlineRadio2_<?php echo $question_id; ?>">2</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="responses_<?php echo $question_id ?>" id="inlineRadio3_<?php echo $question_id; ?>" value="3" />
                        <label class="form-check-label" for="inlineRadio3_<?php echo $question_id; ?>">3</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="responses_<?php echo $question_id ?>" id="inlineRadio4_<?php echo $question_id; ?>" value="4" />
                        <label class="form-check-label" for="inlineRadio4_<?php echo $question_id; ?>">4</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="responses_<?php echo $question_id ?>" id="inlineRadio5_<?php echo $question_id; ?>" value="5" />
                        <label class="form-check-label" for="inlineRadio5_<?php echo $question_id; ?>">5</label>
                    </div>

                    <div class="d-inline me-6">
                        Excellent
                    </div>
                </div>

                <div>
                    <label class="q_label" for="question_text">
                        <strong>
                            <?php echo "上記のQ" . $count . "に対してご意見・ご要望がございましたら、ご自由にご書きください。"; ?>
                        </strong>
                    </label>
                    <textarea class="form-control q_tarea" name="suggestions_<?php echo $question_id; ?>" id="" cols="30" rows="5"></textarea>
                </div>

            </div>

        <?php } ?>


        <div class="text-start">
            <button type="submit" name="send" class="btn btn-primary">送信</button>
        </div>

    </form>

</div>