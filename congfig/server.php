<?php
include('database.php'); // Ensure the correct path for database.php
$checkapi = 1;
if (isset($_POST['submit'])) {
    $checkapi = 0;
    // Get the form inputs and trim unnecessary spaces
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mobileno = trim($_POST['mobileno'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confpassword = trim($_POST['confpassword'] ?? '');

    // Initialize an array to store errors

    // $errors = [];
    // //Server-side validation
    // //Validate name
    // if (empty($name)) {
    //     $errors[] = "Full name is required.";
    // } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
    //     $errors[] = "Full name must contain only letters and spaces.";
    // }

    // //Validate email
    // if (empty($email)) {
    //     $errors[] = "Email is required.";
    // } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     $errors[] = "Invalid email format.";
    // }

    // //Validate mobile number
    // if (empty($mobileno)) {
    //     $errors[] = "Mobile number is required.";
    // } elseif (!preg_match("/^[6-9]\d{9}$/", $mobileno)) {
    //     $errors[] = "Mobile number must be a 10-digit number starting with 6-9.";
    // }

    // //Validate password
    // if (empty($password)) {
    //     $errors[] = "Password is required.";
    // } elseif (strlen($password) < 6) {
    //     $errors[] = "Password must be at least 6 characters long.";
    // } elseif (!preg_match("/[A-Za-z]/", $password) || !preg_match("/\d/", $password) || !preg_match("/[@$!%*?&]/", $password)) {
    //     $errors[] = "Password must include at least one letter, one number, and one special character.";
    // }

    // //Validate confirm password
    // if (empty($confpassword)) {
    //     $errors[] = "Confirmation password is required.";
    // } elseif ($password !== $confpassword) {
    //     $errors[] = "Passwords do not match.";
    // }

    // //Check for validation errors
    // if (!empty($errors)) {
    //     // Display errors
    //     foreach ($errors as $error) {
    //         echo "<p style='color:red;'>$error</p>";

    //     }
    //     // echo "<pre>";
    //     // print_r($errors);
    // } else {
    //     //Hash the password
    //     $hashedPassword = password_hash($password, algo: PASSWORD_DEFAULT);

    //     //Prepare the SQL query
    //     $sql = "INSERT INTO users_table_data (name, email, mobileno, password) 
    //         VALUES('$name', '$email', '$mobileno', '$hashedPassword')";

    //     //Execute the query and check for success
    //     if (mysqli_query($conn, $sql)) {
    //         echo "<span style='color:green;'>Data inserted successfully! </span>";
    //     } else {
    //         echo "<span style='color:red;'>Error: " . mysqli_error($conn) . "</span> <br>";
    //     }
    // }


    $errorcount = 0;
    $returndata = [];
    $returndata["success"] = false;
    if (empty($_POST["name"])) {
        $returndata['nameError'] = "fullname is required";
        $errorcount++;
    }
    if (empty($_POST["email"])) {
        $returndata['emailError'] = "email is required";
        $errorcount++;

    }
    if (empty($_POST["mobileno"])) {
        $returndata['mobilenoError'] = "mobile is required";
        $errorcount++;
    }
    if (empty($_POST["password"])) {
        $returndata['passwordError'] = "password is required";
        $errorcount++;
    }
    if (empty($_POST["confpassword"])) {
        $returndata['comfirmpasswordError'] = "comfirmpassword is required";
        $errorcount++;
    } else if ($password !== $confpassword) {
        $returndata['passwordMismatchError'] = 'Passwords donot match';
        $errorcount++;
    }
    if ($errorcount == 0) {
        // Email ko check karne ki query
        $checkEmail = "SELECT id FROM users WHERE email = '$email'";

        $emailResult = mysqli_query($conn, $checkEmail);

        // Mobile number ko check karne ki query
        $checkMobile = "SELECT id FROM users WHERE mobileno = '$mobileno'";
        $mobileResult = mysqli_query($conn, $checkMobile);

        if (mysqli_num_rows($emailResult) > 0) {
            $returndata['emailError'] = "email already exists!";
        } else if (mysqli_num_rows($mobileResult) > 0) {
            $returndata['mobilenoError'] = "mobile number already exists!";
        } else {
            // Data insert karne ki query
            $tabledata = "INSERT INTO users(name, email, mobileno, password) VALUES ('$name', '$email', '$mobileno', '$password')";
            $tabledataResult = mysqli_query($conn, $tabledata);

            if ($tabledataResult) {
                $Id = mysqli_insert_id($conn);
                $sql = "SELECT id,name,email,mobileno FROM users WHERE id ='$Id'";
                $result = mysqli_query($conn, $sql);
                $userData = mysqli_fetch_assoc($result);
                // print_r($userData);
                // die;
                $_SESSION['loginId'] = $Id;
                $_SESSION['loginuserData'] = $userData;
                $returndata["success"] = true;
                $returndata["msg"] = "data inserted successfully";
            } else {
                $returndata["msg"] = "data not inserted successfully";
            }
        }
    }
    // Response ko JSON mein return karein
    echo json_encode($returndata, true);
}
//logout session destroy

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ../login.php');
}

// login fatch data.......................................................................
if (isset($_POST['login'])) {
    $checkapi = 0;
    $email = trim(($_POST['email']) ?? '');
    $password = trim(($_POST['password']) ?? '');

    $errorcount = 0;
    $returndata["success"] = false;
    if (empty($email)) {
        $returndata['emailError'] = "email is required";
        $errorcount++;
    }
    if (empty($_POST["password"])) {
        $returndata['passwordError'] = "password is required";
        $errorcount++;
    }
    if ($errorcount == 0) {
        $userEmail = "SELECT email,password FROM users where email='$email'";

        $emailResult = mysqli_query($conn, $userEmail);

        $userPassword = "SELECT email,password  FROM users where password='$password'";
        $passwordresult = mysqli_query($conn, $userPassword);

        if (mysqli_num_rows($emailResult) == 0) {
            $returndata['emailError'] = "email does not found!";
        } else if (mysqli_num_rows($passwordresult) == 0) {
            $returndata['passwordError'] = "password does not match!";

        } else {
            $userData = "SELECT id,name,email,mobileno,password FROM users where email='$email'And password ='$password'";
            $resultUserdata = mysqli_query($conn, $userData);
            if (mysqli_num_rows($resultUserdata) > 0) {
                $row = mysqli_fetch_assoc($resultUserdata);
                $_SESSION['loginId'] = $row['id'];
                $_SESSION['loginuserData'] = $row;
                $returndata["success"] = true;
                $returndata["msg"] = "Login Successfully";
            } else {
                $returndata["msg"] = "Login Failed!";
            }
        }
    }
    echo json_encode($returndata, true);
}
// add task ..............................................................................................
if (isset($_POST["taskBtn"])) {
    $checkapi = 0;
    $task = $_POST["task"] ?? '';
    $userid = $_POST['userid'] ?? '';
    $activeListId = $_POST["activeListId"] ?? '';
    $errorcount = 0;
    // $returndata = [];
    $returndata["success"] = false;
    if ($task == '') {
        $returndata["taskError"] = " task is reqired";
        $errorcount++;
    }
    if ($userid == '') {
        $returndata['useridError'] = 'userid is required';
        $errorcount++;
    }

    $query = mysqli_query($conn, "SELECT id from users where id ='$userid'");
    if (mysqli_num_rows($query) < 1) {
        $returndata[''] = "userid not found";
        $errorcount++;

    }
    if ($errorcount == 0) {
        $Sql = "INSERT INTO tasks (task_name,list_id,created_by,updated_by)values('$task', '$activeListId','$userid','$userid')";
        $result = mysqli_query($conn, $Sql);
        if ($result) {
            $fetch_sql = "SELECT * FROM tasks where  created_by ='$userid' AND list_id ='$activeListId' ORDER BY id DESC";
            $fetch_result = mysqli_query($conn, $fetch_sql);
            if ($fetch_result) {
                $data = [];
                while ($row = mysqli_fetch_assoc($fetch_result)) {
                    $data[] = $row;
                }
                $returndata["tasklist"] = $data;

                $returndata["success"] = true;
                $returndata["msg"] = "data inserted successfully";
            } else {
                $returndata["msg"] = "data inserted not successfully";
            }
        }
    }
    echo json_encode($returndata, true);
}
if (isset($_POST["getdata"])) {
    $checkapi = 0;
    $returndata['success'] = false;
    // $where = " AND (list_id = 'MyDAY' OR important = 1)";   
    $where = '';
    $id = $_POST['id'];
    if (isset($_POST['id'])) {
        if ($id == "important") {
            $where = "and important='1'";
        } else {

            $where = "and list_id= '$id'";
        }
    }
    $sql = "SELECT * FROM tasks where created_by ='$_SESSION[loginId]'$where ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;

        }
        $returndata['tasklist'] = $data;
        $returndata['success'] = true;
        $returndata['msg'] = 'data found';

    } else {
        $returndata['msg'] = 'data not found';
    }
    echo json_encode($returndata, true);
}
// delet api................................................................................
if (isset($_POST['deleteTask'])) {
    $checkapi = 0;
    $taskId = $_POST['id'];

    $returndata['success'] = false;
    $query = "DELETE FROM tasks WHERE id =   '$taskId' ";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $returndata['success'] = true;
        $returndata['msg'] = 'task delete successfully';

    } else {
        $returndata['msg'] = 'task delete not success';
    }
    echo json_encode($returndata, true);
}

// newlistdata api..........................................................................
// if (isset($_POST['addNewList'])) {
//     $checkapi = 0;
//     $list = $_POST['list'] ?? '';

//     $errorcount = 0;
//     $returndata["success"] = false;
//     if ($list == "") {
//         $returndata["listError"] = "list is required";
//         $errorcount++;
//     }
//     if ($errorcount == 0) {
//         $Sql = "INSERT INTO lists (list)values(' $list')";
//         $result = mysqli_query($conn, $Sql);
//         //     if ($result) {
//         //         $last_id = mysqli_insert_id($conn);

//         //         $fetch_sql = "SELECT id,list FROM lists where id = '$last_id'";
//         //         $fetch_result = mysqli_query($conn, $fetch_sql);
//         //         $row = mysqli_fetch_assoc($fetch_result);
//         //         $data[] = $row;
//         //         $returndata["success"] = true;

//         //         $returndata["list"] = $data;
//         //     } else {
//         //         $returndata["error"] = "Database error!";
//         //     }
//         // }
//         if ($result) {
//             $last_id = mysqli_insert_id($conn);
//             $check_sql = "SELECT list FROM lists WHERE list LIKE 'Untitled list%' ORDER BY list ASC";
//             $check_result = mysqli_query($conn, $check_sql);
//             $count_row = mysqli_fetch_assoc($check_result);
//             $count = $count_row['count'];
//             $new_list_name = ($count == 0) ? "Untitled list" : "Untitled list ($count)";
//             $update_sql = "UPDATE lists SET list = '$new_list_name' WHERE id = '$last_id'";
//             mysqli_query($conn, $update_sql);
//             $fetch_sql = "SELECT id, list FROM lists WHERE id = '$last_id'";
//             $fetch_result = mysqli_query($conn, $fetch_sql);
//             $row = mysqli_fetch_assoc($fetch_result);
//             $data[] = $row;
//             $returndata["success"] = true;
//             $returndata["list"] = $data;
//         } else {
//             $returndata["error"] = "Database error!";
//         }


//     }

//     echo json_encode($returndata, true);
// }

if (isset($_POST['addNewList'])) {
    $checkapi = 0;
    $list = $_POST['list'] ?? '';
    $errorcount = 0;

    $returndata["success"] = false;
    if ($list == "") {
        $returndata["listError"] = "list is required";
        $errorcount++;
    }


    //  Check karo ki "Untitled list" exist karti hai ya nahi
    $check_sql = "SELECT list_name FROM lists WHERE list_name LIKE 'Untitled list%'  ";

    $check_result = mysqli_query($conn, $check_sql);


    $maxNumber = 0;
    $exists = false;

    while ($row = mysqli_fetch_assoc($check_result)) {
        $name = $row['list_name'];
        if ($name == "Untitled list") {
            $exists = true;

        } else {
            if ($name != "Untitled list") {
                $num = filter_var($name, FILTER_SANITIZE_NUMBER_INT);
                if (is_numeric($num)) {
                    $maxNumber = max($maxNumber, (int) $num);
                }
            }
        }
    }
    //  Agar koi "Untitled list" nahi hai, toh pehle ek insert karo
    if (!$exists) {
        $new_list_name = "Untitled list";
    } else {
        $new_list_name = "Untitled list (" . ($maxNumber + 1) . ")";
    }
    if ($errorcount == 0) {
        //  Insert karo new list
        $insert_sql = "INSERT INTO lists (list_name) VALUES ('$new_list_name')";
        $insert_result = mysqli_query($conn, $insert_sql);

        if ($insert_result) {
            $last_id = mysqli_insert_id($conn);

            //  Latest inserted list fetch karo
            $fetch_sql = "SELECT id, list_name FROM lists WHERE id = '$last_id'";
            $fetch_result = mysqli_query($conn, $fetch_sql);
            $row = mysqli_fetch_assoc($fetch_result);

            $returndata["success"] = true;
            $returndata["list"] = [$row];
        } else {
            $returndata["error"] = "Database error!";
        }

    }
    echo json_encode($returndata);

}



if (isset($_POST['fetch_list'])) {
    $checkapi = 0;
    $returndata["success"] = false;
    $fetch_sql = "SELECT * FROM lists  ";
    $fetch_result = mysqli_query($conn, $fetch_sql);

    if (mysqli_num_rows($fetch_result) > 0) {
        $data = [];
        while ($row = mysqli_fetch_assoc($fetch_result)) {
            $data[] = $row;
        }

        $returndata["success"] = true;
        $returndata["list"] = $data;
    }
    echo json_encode($returndata, true);
}

//untitled list Context Menu  delete-list Api........................................
if (isset($_POST['deletelist'])) {
    $checkapi = 0;
    $deletelistId = $_POST['id'] ?? '';

    // echo $deletelistId;
    $returndata['success'] = false;
    if (empty($deletelistId)) {
        $returndata['msg'] = 'Invalid ID';
        echo json_encode($returndata);
        exit;
    }
    $query = "DELETE FROM lists WHERE id ='$deletelistId' ";

    $result = mysqli_query($conn, $query);
    if ($result) {
        $returndata['success'] = true;
        $returndata['msg'] = "List deleted successfully (ID: $deletelistId)";


    }
    echo json_encode($returndata, true);
}
// rename-list api......................................................................................
if (isset($_POST['renamelist'])) {
    $checkapi = 0;
    $renamelistId = $_POST['listId'] ?? '';
    $list = $_POST['listName'] ?? '';


    // echo $deletelistId;
    $returndata['success'] = false;
    if (empty($renamelistId)) {
        $returndata['msg'] = 'Invalid ID';
        echo json_encode($returndata);
        exit;
    }
    $query = "UPDATE lists SET list = '$list' WHERE id = $renamelistId";

    $result = mysqli_query($conn, $query);
    if ($result) {
        $fetch_sql = "SELECT * FROM lists ";
        $fetch_result = mysqli_query($conn, $fetch_sql);
        $row = mysqli_fetch_assoc($fetch_result);
        $data[] = $row;
        $returndata["success"] = true;
        $returndata['msg'] = "List updated successfully (ID: $renamelistId)";
        $returndata["list"] = $data;
    } else {
        $returndata['msg'] = "List updated not successfully ";

    }
    echo json_encode($returndata, true);
}

if (isset($_POST['isImportant'])) {
    $checkapi = 0;
    $id = $_POST['id'] ?? '';
    $important = $_POST['important'] ?? '';
    $returndata['success'] = false;
    if ($important == 1) {

        $query = "UPDATE tasks SET important = ' 1' WHERE id = $id";
    } else {
        $query = "UPDATE tasks SET important = ' 0' WHERE id = $id";

    }
    $result = mysqli_query($conn, $query);

    if ($result) {

        $returndata["success"] = true;
        $returndata['msg'] = "Task $id marked  important successfully.";
        $returndata["important"] = $important;
    } else {
        $returndata['msg'] = "Task $id has been removed from Important successfully ";

    }
    echo json_encode($returndata, true);
}




if ($checkapi) {
    $returndata['msg'] = 'invalid api';
    echo json_encode($returndata, true);
}













?>