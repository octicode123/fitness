<?php
require_once "security.php";

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

if (isset($_POST["ero"])) {
    if ($_POST["ero"] === 'add_exercice') {
        if (
            isset($_POST['title'], $_POST['target_muscle'], $_POST['description']) &&
            !empty($_POST['title']) && !empty($_POST['target_muscle']) && !empty($_POST['description'])
        ) {
            $title = htmlspecialchars($_POST['title']);
            $target_muscle = htmlspecialchars($_POST['target_muscle']);
            $yt_video = isset($_POST['yt_video']) ? htmlspecialchars($_POST['yt_video']) : null;
            $description = htmlspecialchars($_POST['description']);

            // Validate lengths
            if (strlen($title) >= 100) {
                jsonResponse('Error', 'Title must be less than 100 characters');
            }
            if (strlen($target_muscle) >= 20) {
                jsonResponse('Error', 'Target muscle must be less than 20 characters');
            }
            if (strlen($yt_video) >= 255) {
                jsonResponse('Error', 'YouTube video link must be less than 255 characters');
            }
            if (strlen($description) >= 255) {
                jsonResponse('Error', 'Description must be less than 255 characters');
            }

            try {
                $query = "INSERT INTO exercises (coach_id, title, description, target_muscle, yt_video) 
                          VALUES (:coach_id, :title, :description, :target_muscle, :yt_video)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);
                $stmt->bindParam(':title', $title, PDO::PARAM_STR);
                $stmt->bindParam(':target_muscle', $target_muscle, PDO::PARAM_STR);
                $stmt->bindParam(':yt_video', $yt_video, PDO::PARAM_STR);
                $stmt->bindParam(':description', $description, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    jsonResponse('Success', 'Exercise added successfully');
                } else {
                    jsonResponse('Error', 'Failed to add exercise');
                }
            } catch (PDOException $e) {
                jsonResponse('Error', 'Database error: ' . $e->getMessage());
            }
        } else {
            jsonResponse('Error', 'All required fields must be filled out');
        }
    }
    if ($_POST["ero"] === 'add_program') {
        // Validate required fields
        $requiredFields = ['customer', 'day_of_week', 'title', 'duration', 'exercise_id', 'sets', 'reps'];
        foreach ($requiredFields as $field) {
            if (!isset($_POST[$field]) || empty($_POST[$field])) {
                jsonResponse('Error', ucwords(str_replace('_', ' ', $field)) . ' is required.');
            }
        }
    
        $customer = htmlspecialchars($_POST['customer']);
        $day_of_week = htmlspecialchars($_POST['day_of_week']);
        $title = htmlspecialchars($_POST['title']);
        $duration = htmlspecialchars($_POST['duration']);
        $exercise_ids = $_POST['exercise_id'];
        $sets = $_POST['sets'];
        $reps = $_POST['reps'];
    
        // Validate lengths
        if (strlen($title) > 100) {
            jsonResponse('Error', 'Title must be less than 100 characters');
        }
    
        // Validate exercise data
        foreach ($exercise_ids as $key => $exercise_id) {
            if (!is_numeric($exercise_id) || !is_numeric($sets[$key]) || !is_numeric($reps[$key])) {
                jsonResponse('Error', 'Exercise IDs, sets, and reps must be numeric');
            }
            if ($sets[$key] <= 0 || $reps[$key] <= 0) {
                jsonResponse('Error', 'Sets and reps must be positive numbers');
            }
        }
        $stmt = $pdo->prepare("SELECT status FROM subscription WHERE user_id = :user_id AND coach_id=:coach_id AND status = 'accepted'");
        $stmt->bindParam(':user_id', $customer, PDO::PARAM_INT);
        $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);

        $stmt->execute();
        $subscriptionStatus = $stmt->fetchColumn();
    
        if (!$subscriptionStatus) {
            jsonResponse('Error', 'Customer does not have an accepted subscription status.');
        }
    
        // Check if a program with the same title and day_of_week already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM training_program WHERE coach_id = :coach_id AND user_id = :user_id AND day_of_week = :day_of_week");
        $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $customer, PDO::PARAM_INT);
        $stmt->bindParam(':day_of_week', $day_of_week, PDO::PARAM_STR);
        $stmt->execute();
        $existingProgramCount = $stmt->fetchColumn();
    
        if ($existingProgramCount > 0) {
            jsonResponse('Error', 'A program with the same  day of the week already exists for the same client.');
        }
        
    
        // Validate nutrition program data
        $meals = [];
        $errors = [];
        $planCounter = 1; // Default plan counter
    
        // Iterate over the POST data to collect meal information
        foreach ($_POST as $key => $value) {
            if (preg_match('/^meal_name(\d+)$/', $key, $matches)) {
                $mealId = $matches[1];
                for ($j = 0; $j < count($_POST["meal_name" . $mealId]); $j++) {
                    $meals[] = [
                        'name' => $_POST["meal_name" . $mealId][$j],
                        'portion' => $_POST["meal_portion" . $mealId][$j],
                        'kcal' => $_POST["meal_kcal" . $mealId][$j],
                        'plan_id' => $planCounter // Use a single plan ID for all meals
                    ];
                }
                $planCounter++; // Increment the plan counter for each set of meals
            }
        }
    
        $numMeals = count($meals);
    
        if ($numMeals == 0) {
            $errors[] = "You must add meals.";
        } else {
            foreach ($meals as $index => $meal) {
                // Validate meal name
                if (empty($meal['name'])) {
                    $errors[] = "You must add a meal name for meal " . ($index + 1) . ".";
                } elseif (strlen($meal['name']) > 255) {
                    $errors[] = "Meal name for meal " . ($index + 1) . " must be less than 255 characters.";
                }
    
                // Validate meal portion
                if (empty($meal['portion'])) {
                    $errors[] = "You must add a dish portion for meal " . ($index + 1) . ".";
                } elseif (!is_numeric($meal['portion']) || $meal['portion'] <= 0) {
                    $errors[] = "Dish portion for meal " . ($index + 1) . " must be a positive number.";
                }
    
                // Validate meal kcal
                if (empty($meal['kcal'])) {
                    $errors[] = "You must add kcal per 100 g for meal " . ($index + 1) . ".";
                } elseif (!is_numeric($meal['kcal']) || $meal['kcal'] < 0) {
                    $errors[] = "Kcal per 100 g for meal " . ($index + 1) . " must be a non-negative number.";
                }
            }
        }
    
        // If there are errors, display them and exit
        if (!empty($errors)) {
            foreach ($errors as $error) {
                jsonResponse('Error', $error);
            }
        }
    
        // If all data is valid, proceed with database insertion
        try {
            // Assuming $pdo is your PDO connection
            // Begin transaction
            $pdo->beginTransaction();
    
            // Insert training program
            $query = "INSERT INTO training_program (coach_id,user_id, title, day_of_week,created_at, duration) 
                      VALUES (:coach_id,:user_id, :title,:day_of_week ,NOW(), :duration)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $customer, PDO::PARAM_INT);
            $stmt->bindParam(':day_of_week', $day_of_week, PDO::PARAM_STR);

            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                $program_id = $pdo->lastInsertId();
    
                // Insert exercises for the program
                $exerciseQuery = "INSERT INTO exercice_training_program (id_training, id_exercice, sets, reps) 
                                  VALUES (:program_id, :exercise_id, :sets, :reps)";
                $exerciseStmt = $pdo->prepare($exerciseQuery);
    
                foreach ($exercise_ids as $key => $exercise_id) {
                    $exerciseStmt->bindParam(':program_id', $program_id, PDO::PARAM_INT);
                    $exerciseStmt->bindParam(':exercise_id', $exercise_id, PDO::PARAM_INT);
                    $exerciseStmt->bindParam(':sets', $sets[$key], PDO::PARAM_INT);
                    $exerciseStmt->bindParam(':reps', $reps[$key], PDO::PARAM_INT);
                    $exerciseStmt->execute();
                }
    
                // Insert nutrition data if meals are provided
                if (!empty($meals)) {
                    // Group meals by nutrition plan
                    $nutritionPlans = [];
                    foreach ($meals as $meal) {
                        $planId = $meal['plan_id'];
                        if (!isset($nutritionPlans[$planId])) {
                            $nutritionPlans[$planId] = [];
                        }
                        $nutritionPlans[$planId][] = $meal;
                    }
    
                    foreach ($nutritionPlans as $planId => $planMeals) {
                        // Insert into nutrition table
                        $nutritionQuery = "INSERT INTO nutrition (coach_id, created_at) VALUES (:coach_id, NOW())";
                        $nutritionStmt = $pdo->prepare($nutritionQuery);
                        $nutritionStmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);
                        if ($nutritionStmt->execute()) {
                            $nutrition_id = $pdo->lastInsertId();
    
                            // Insert into nutrition_training_program table
                            $nutritionTrainingQuery = "INSERT INTO nutrition_training_program (id_training, id_nutrition) 
                                                       VALUES (:program_id, :nutrition_id)";
                            $nutritionTrainingStmt = $pdo->prepare($nutritionTrainingQuery);
                            $nutritionTrainingStmt->bindParam(':program_id', $program_id, PDO::PARAM_INT);
                            $nutritionTrainingStmt->bindParam(':nutrition_id', $nutrition_id, PDO::PARAM_INT);
                            $nutritionTrainingStmt->execute();
    
                            // Insert each meal into nutrition_food table
                            $foodQuery = "INSERT INTO nutrition_food (id_nutrition, food_name, weight, kcal) 
                                          VALUES (:nutrition_id, :food_name, :weight, :kcal)";
                            $foodStmt = $pdo->prepare($foodQuery);
    
                            foreach ($planMeals as $mealData) {
                                $foodStmt->bindParam(':nutrition_id', $nutrition_id, PDO::PARAM_INT);
                                $foodStmt->bindParam(':food_name', $mealData['name'], PDO::PARAM_STR);
                                $foodStmt->bindParam(':weight', $mealData['portion'], PDO::PARAM_STR);
                                $foodStmt->bindParam(':kcal', $mealData['kcal'], PDO::PARAM_STR);
                                $foodStmt->execute();
                            }
                        }
                    }
                }
    
                // Commit transaction
                $pdo->commit();
    
                jsonResponse('Success', 'Program added successfully');
            } else {
                $pdo->rollBack();
                jsonResponse('Error', 'Failed to add program');
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            jsonResponse('Error', 'Database error: ' . $e->getMessage());
        }
    }
    
    function jsonResponse($status, $message) {
        header('Content-Type: application/json');
        echo json_encode(['status' => $status, 'message' => $message]);
        exit;
    }
   
}
?>
