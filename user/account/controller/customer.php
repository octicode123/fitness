<?php
require_once "security.php";

if(isset($_POST["ero"])){
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
    if($_POST["ero"]==='customer'){

        $customer=$pdo->prepare("SELECT s.*,u.* FROM subscription as s INNER JOIN user_info as u ON s.user_id=u.user_id WHERE s.coach_id=:coach_id ");
        $customer->bindParam(':coach_id',$coach_id);
        $customer->execute();
        $result_customer=$customer->fetchAll();
        if(count($result_customer)>0){

            foreach($result_customer as $row){
                ?>
                 <tr>
                                    <td>  <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li
                                          data-bs-toggle="tooltip"
                                          data-popup="tooltip-custom"
                                          data-bs-placement="top"
                                          class="avatar avatar-xs pull-up"
                                          title="Lilian Fuller"
                                        >
                                          <img src="../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle" />
                                        </li>
                                       
                                      
                                      </ul></td>
                                    <td><?php echo $row["full_name"]; ?></td>
                                    
                                    <td><?php
                                    switch($row["status"]){
                                        case 'pending':
                                            echo "<span class=\"badge bg-label-warning me-1\">Pending</span>";
                                            break;
                                        case 'cancelled':
                                                echo "<span class=\"badge bg-label-danger me-1\">Cancelled</span>";
                                            break;   
                                        case 'accepted':
                                                echo "<span class=\"badge bg-label-danger me-1\">accepted</span>";
                                            break; 
                                        case 'end':
                                                echo "<span class=\"badge bg-label-danger me-1\">end of training</span>";
                                            break; 
                                    }
                                    ?>
                                        
                               </td>
                                    <td>
                                      <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                          <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                          <a class="dropdown-item" href="progress.php?id=<?php echo $row["user_id"]; ?>"
                                            ><i class='bx bxs-show me-1'></i>Progress</a
                                          >
                                          <a class="dropdown-item" href="javascript:void(0);"
                                            ><i class='bx bxs-hand me-1'></i> End training</a
                                          >
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                <?php
            }

        }else{
            echo "You don't have any customer yet";
        }

    }
    if($_POST["ero"]==='customer_details'){
        if(isset($_POST["customer_id"]) && !empty($_POST["customer_id"])){
            $id_customer = htmlspecialchars($_POST["customer_id"]);
            $customer = $pdo->prepare("SELECT s.*,u.* FROM subscription as s INNER JOIN user_info as u ON s.user_id=u.user_id WHERE s.coach_id=:coach_id and s.user_id=:user_id LIMIT 1 ");
            $customer->bindParam(':coach_id', $coach_id);
            $customer->bindParam(':user_id', $id_customer);
          
            $customer->execute();
            $result_customer = $customer->fetch();
            if ($result_customer) {

                ?>
      <h5 class="pb-2 border-bottom mb-4">Details</h5>
                      <div class="info-container">
                        <ul class="list-unstyled">
                          <li class="mb-3">
                            <span class="fw-medium me-2">Full Name:</span>
                            <span><?php echo $result_customer["full_name"]; ?></span>
                          </li>
                          <li class="mb-3">
                            <span class="fw-medium me-2">Phone:</span>
                            <span><?php echo $result_customer["phone"]; ?></span>
                          </li>
                          <li class="mb-3">
                            <span class="fw-medium me-2">Status:</span>
                            <?php
                            switch ($result_customer["status"]) {
                              case 'pending':
                                echo "<span class=\"badge bg-label-warning me-1\">Pending</span>";
                                break;
                              case 'cancelled':
                                echo "<span class=\"badge bg-label-danger me-1\">Cancelled</span>";
                                break;
                              case 'accepted':
                                echo "<span class=\"badge bg-label-success me-1\">accepted</span>";
                                break;
                              case 'end':
                                echo "<span class=\"badge bg-label-danger me-1\">end of training</span>";
                                break;
                            }
                            ?>
                          </li>
                          <li class="mb-3">
                            <span class="fw-medium me-2">Begin date:</span>
                            <span><?php echo $result_customer["sub_date"]; ?></span>
                          </li>

                        </ul>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                          Once you have accepted or cancelled the order, you cannot change the status
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                        if($result_customer["status"]!='accepted' && $result_customer["status"]!='cancelled'){
                            ?>
                             <div class="d-flex justify-content-center pt-3">
                          <a href="javascript:;" class="btn btn-success me-3" onclick="accept('<?php echo $result_customer['id_subscription']; ?>')">Accept</a>
                          <a href="javascript:;" class="btn btn-danger me-3" onclick="deny('<?php echo $result_customer['id_subscription']; ?>')">Deny</a>
                        </div>
                            <?php
                        }elseif($result_customer["status"]=='accepted'){?>
                            <a href="javascript:;" class="btn btn-warning me-3" onclick="end_training('<?php echo $result_customer['id_subscription']; ?>')">End training</a>
<?php
                        }
                        ?>
                       
                      </div>
                <?php

            }
        }
    }
    if ($_POST["ero"] === 'accept_subscription') {
        if (isset($_POST['id_subscription']) && !empty($_POST['id_subscription'])) {
            $id_subscription = htmlspecialchars($_POST['id_subscription']);

            try {
                $query = "UPDATE subscription SET status = 'accepted' WHERE id_subscription = :id_subscription AND coach_id = :coach_id AND status!='cancelled'" ;
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);
                $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    jsonResponse('Success', 'Subscription accepted successfully');
                } else {
                    jsonResponse('Error', 'Failed to accept the subscription');
                }
            } catch (PDOException $e) {
                jsonResponse('Error', 'Database error: ' . $e->getMessage());
            }
        } else {
            jsonResponse('Error', 'Subscription ID is missing');
        }
    }
    if ($_POST["ero"] === 'deny_subscription') {
        if (isset($_POST['id_subscription']) && !empty($_POST['id_subscription'])) {
            $id_subscription = htmlspecialchars($_POST['id_subscription']);

            try {
                $query = "UPDATE subscription SET status = 'cancelled' WHERE id_subscription = :id_subscription AND coach_id = :coach_id AND status!='accepted'" ;
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);
                $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    jsonResponse('Success', 'Subscription denied successfully');
                } else {
                    jsonResponse('Error', 'Failed to deny the subscription');
                }
            } catch (PDOException $e) {
                jsonResponse('Error', 'Database error: ' . $e->getMessage());
            }
        } else {
            jsonResponse('Error', 'Subscription ID is missing');
        }
    }
    if ($_POST["ero"] === 'end_subscription') {
        if (isset($_POST['id_subscription']) && !empty($_POST['id_subscription'])) {
            $id_subscription = htmlspecialchars($_POST['id_subscription']);

            try {
                $query = "SELECT sub_date FROM subscription WHERE id_subscription = :id_subscription AND coach_id = :coach_id AND status = 'accepted'";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);
                $stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);
                $stmt->execute();
                $subscription = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($subscription) {
                    $sub_date = new DateTime($subscription['sub_date']);
                    $current_date = new DateTime();
                    $interval = $sub_date->diff($current_date);

                    if ($interval->m >= 1 || ($interval->y >= 1 && $interval->m == 0)) {

                        $update_query = "UPDATE subscription SET status = 'end' WHERE id_subscription = :id_subscription AND coach_id = :coach_id";
                        $update_stmt = $pdo->prepare($update_query);
                        $update_stmt->bindParam(':id_subscription', $id_subscription, PDO::PARAM_INT);
                        $update_stmt->bindParam(':coach_id', $coach_id, PDO::PARAM_INT);

                        if ($update_stmt->execute()) {
                            jsonResponse('Success', 'Subscription ended successfully');
                        } else {
                            jsonResponse('Error', 'Failed to end the subscription');
                        }
                    } else {
                        jsonResponse('Error', 'Subscription must be at least one month old to end');
                    }
                } else {
                    jsonResponse('Error', 'No such accepted subscription found');
                }
            } catch (PDOException $e) {
                jsonResponse('Error', 'Database error: ' . $e->getMessage());
            }
        } else {
            jsonResponse('Error', 'Subscription ID is missing');
        }
    }
}
?>