<?php
require_once "security.php";

if(isset($_POST["ero"])){
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
                                echo "<span class=\"badge bg-label-danger me-1\">accepted</span>";
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
                        <div class="d-flex justify-content-center pt-3">
                          <a href="javascript:;" class="btn btn-success me-3" data-bs-target="#editUser" data-bs-toggle="modal">Accept</a>
                          <a href="javascript:;" class="btn btn-danger me-3" data-bs-target="#editUser" data-bs-toggle="modal">Deny</a>
                        </div>
                      </div>
                <?php

            }
        }
    }
}
?>