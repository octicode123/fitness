<?php
require_once "../pdo.php"; 
require_once "./check-help.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ero"])) {

    function jsonResponse($status, $message, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];

        if (!empty($data)) {
            $response['data'] = $data;
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }

    if ($_POST["ero"] === 'checkout' && isset($_POST["coach_id"]) && !empty($_POST["coach_id"])) {
        $coach_id = htmlspecialchars($_POST["coach_id"]);

        try {
            // Check if coach_id exists
            $coachQuery = "SELECT COUNT(*) FROM coach_account WHERE coach_id = :coach_id";
            $stmt = $pdo->prepare($coachQuery);
            $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);
            $stmt->execute();
            $coachExists = $stmt->fetchColumn();

            if ($coachExists) {
                // Fetch the last price from coach_price table
                $priceQuery = "SELECT price FROM coach_price WHERE coach_id = :coach_id ORDER BY update_date DESC LIMIT 1";
                $stmt = $pdo->prepare($priceQuery);
                $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);
                $stmt->execute();
                $lastPrice = $stmt->fetchColumn();

                if ($lastPrice !== false) {
                    // Insert into subscription table
                    $insertQuery = "INSERT INTO subscription (user_id, coach_id,status,sub_date, price, temporary) 
                                    VALUES (NULL, :coach_id,'pending',NOW(), :price, :temp)";
                    $stmt = $pdo->prepare($insertQuery);
                    $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);

                    $stmt->bindParam(':price', $lastPrice, PDO::PARAM_STR);
                    $stmt->bindParam(':temp', $cstId, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        jsonResponse('Success', 'Subscription added successfully');
                    } else {
                        jsonResponse('Error', 'Failed to add subscription');
                    }
                } else {
                    jsonResponse('Error', 'Failed to fetch the last price for the coach');
                }
            } else {
                jsonResponse('Error', 'Coach does not exist');
            }
        } catch (PDOException $e) {
            jsonResponse('Error', 'Database error: ' . $e->getMessage());
        }
    } else {
        jsonResponse('Error', 'Invalid coach ID');
    }
}
?>
