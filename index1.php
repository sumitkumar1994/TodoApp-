<!-- <?php
include("./congfig/database.php");

if (!isset($_SESSION['loginId'])) {

    header('Location: ./login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App</title>
    <link rel="stylesheet" href="./assets/css/sidebar.css ">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
<!-- Google Fonts -->
<link href="./assets/css/swap.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="./assets/css/all.min.css" rel="stylesheet">
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head> -->
<!-- 
<body class="bg-light">
    <div class="container-fluid">
        <div class="row vh-100">

            <!-- sidebar -->
<nav class="col-md-3 col-lg-2 d-md-block bg-whited border-end px-3 position-relative">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-user-circle fa-3x text-light"></i>
        <div class="ms-2">
            <p class="fw-bold mb-0"> <?php echo ($_SESSION['loginuserData']['name']) ?> </p>
            <p class="text-muted mb-0"> <?php echo ($_SESSION['loginuserData']['mobileno']) ?> </p>
        </div>
    </div>
    <input class="form-control mb-3" type="text" placeholder="Search">
    <ul class="nav flex-column">
        <li class="nav-item bg-lighted p-2 rounded"><i class="fas fa-sun text-warning me-2"></i>My Day</li>
        <li class="nav-item p-2"><i class="fas fa-star text-warning me-2"></i>Important</li>
        <li class="nav-item p-2"><i class="fas fa-calendar-alt text-primary me-2"></i>Planned</li>
        <li class="nav-item p-2"><i class="fas fa-user text-success me-2 border-bottom"></i>Assigned to me
        </li>
        <li class="nav-item p-2"><i class="fas fa-tasks text-secondary me-2"></i>Tasks</li>
        <li class=" border-bottom p-2 "></li>
        <li class="nav-item p-2 mt-2"><i class="fas fa-rocket text-warning me-2 "></i>Getting
            started</li>
        <li class="nav-item p-2"><i class="fas fa-shopping-cart text-success me-2"></i>Groceries</li>
    </ul>
    <button class="btn btn-outline-primary w-100 mb-2 text-white position-absolute bottom-0 start-0"><i
            class="fas fa-plus me-2"></i>New
        List</button>
</nav>
<!-- Main Content -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex flex-column">
    <div class="d-flex justify-content-end py-3">
        <div>
            <button class="btn btn-light"><i class="fas fa-image text-muted"></i></button>
            <button class="btn btn-light"><i class="fas fa-lightbulb text-muted"></i></button>
            <button class="btn btn-light"><i class="fas fa-ellipsis-h text-muted"></i></button>
        </div>
        <div>
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['loginId']) && !empty($_SESSION['loginId'])) { ?>
                    <li class="nav-item">
                        <form action="./congfig/server.php" method="post">
                            <span class="mt-2 mx-2"></span>
                            <button class="btn btn-danger" name="logout">logout</button>
                        </form>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a href="login.php" class="btn btn-primary">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="signup.php" class="btn btn-outline-success">Sign Up</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <div class="container">
        <div class="row" id="taskListContainer" style="max-height: 550px; overflow-y: auto;  padding: 10px;">

            <div class=" col-12 col-sm-10 col-md-8 mx-auto w-100">
                <div class="task-item d-flex align-items-center justify-content-between border-bottom p-2">
                    <input type="checkbox" class="task-checkbox me-2">
                    <span class="task-text flex-grow-1">Buy groceries</span>
                    <span class="important-icon text-warning fs-5"><i class="fas fa-star"></i></span>
                    <!-- <button class="delete-btn btn btn-danger btn-sm ms-2">Delete</button> -->
                </div>
            </div>

        </div>
    </div>
    <div class="flex-grow-1 d-flex justify-content-center align-items-end pb-2  ">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-10 col-md-8 mx-auto  w-100">
                    <form action="./congfig/server.php" method="post" id="task_form">
                        <input type='hidden' name="taskBtn" value="1">
                        <div class="input-group shadow-sm">
                            <input type="text" class="form-control" placeholder="Add task" name="task" id="task">
                            <!-- <span class="task_error text-danger d-none"></span> -->
                            <button type="submit" class="  input-group-text bg-success text-white" name="" id="taskBtn">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>

</div>
</div> -->
<!-- Bootstrap JS -->
<!-- <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- <script>
        $(document).ready(function () {
            getTasks();

            $(document).on("click", "#taskBtn", function (e) {
                e.preventDefault();
                let task = $('#task').val().trim();
                let error = 0;
                if (task === '') {
                    $('#task').css({
                        'border': '2px solid red',
                        'box-shadow': '0px 0px 8px red',
                        'border-radius': '5px',
                        'transition': 'all 0.3s ease-in-out'
                    });
                    error++;
                }
                $(document).on("keyup", "#task", function (e) {
                    if ($(this).val() !== '') {
                        $('#task').css({
                            'border': '',
                            'box-shadow': '',
                            'border-radius': '',
                            'transition': 'all 0.3s ease-in-out'
                        });
                    }
                })

                if (error === 0) {
                    let form = $('#task_form');
                    let url = form.attr('action');
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: form.serialize(),
                        success: function (response) {
                            let arr = JSON.parse(response);
                            console.log(arr);
                            if (arr.success) {
                                getTasks();
                            } else {
                                alert("tasks not updated");
                            }
                            $('#task').val('');
                        }
                    })
                }
            })
        })
        function getTasks() {
            $.ajax({
                url: "./congfig/server.php",
                type: "post",
                data: { getdata: true },
                success: function (response) {
                    let arr = JSON.parse(response);

                    if (arr.success) {
                        let getTaskList = arr.tasklist;
                        $('#taskListContainer').empty();
                        let html = "";

                        getTaskList.forEach(element => {
                            html += `
                            <div class="col-12 col-sm-10 col-md-8 mx-auto w-100">
                                <div class="task-item d-flex align-items-center justify-content-between border-bottom p-2">
                                    <input type="checkbox" class="task-checkbox me-2">
                                    <span class="task-text flex-grow-1">${element.task_name}</span>
                                    <span class="important-icon text-warning fs-5"><i class="fas fa-star"></i></span>
                                    <button class="delete-btn btn btn-outline-danger btn-sm" id="delete-btn" data-id="${element.id}">
                                        <i class="fas fa-trash" ></i> 
                                    </button> 
                                </div>
                            </div>`;
                        });

                        $('#taskListContainer').append(html);
                        scrollToTop();
                    }
                }
            });
        }
        function scrollToTop() {
            let container = $('#taskListContainer');
            container.scrollTop(0);
        }
        //ajax of delete function
        $(document).on("click", "#delete-btn", function () {
            let taskid = $(this).data("id");

            if (confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: "./congfig/server.php", // Corrected URL
                    type: "post",
                    data: { deleteTask: true, id: taskid },
                    success: function (response) {
                        let arr = JSON.parse(response);

                        if (arr.success) {
                            console.log("Task deleted successfully");

                            getTasks();
                        } else {
                            alert("Something went wrong"); // Corrected error message
                        }
                    },

                });
            }
        });
    </script>
</body>

</html>  -->