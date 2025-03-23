<?php
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
    <!--`` Font Awesome -->
    <link href="./assets/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<!-- <style>
    .activeList {
        background-color: lightgrey;
        color: white;
        font-weight: bold;
    }
</style> -->

<body class="bg-gradient-to-br from-green-500 to-teal-600 text-white min-h-screen flex box-border">

    <!-- Left Sidebar --------------------------------------------------------------------------->
    <nav
        class="w-1/5 h-screen overflow-hidden  bg-teal-700 pl-2 pt-3 pb-4 flex flex-col space-y-4 border-r border-white  ">
        <div class="flex items-center space-x-3">
            <div
                class=" border-b-amber-800 border h-10 w-10 text-center bg-orange-400 font-bold rounded-full text-2xl text-white">
                <?php echo ($_SESSION['loginuserData']['name'][0]);
                ?>
            </div>
            <div>
                <p class="font-bold text-white">
                    <?php echo ($_SESSION['loginuserData']['name']) ?>
                </p>
                <p class=" text-gray-300">
                    <?php echo ($_SESSION['loginuserData']['mobileno']) ?>
                </p>
            </div>
        </div>

        <input
            class="w-[97%]  max-md p-2 -mr-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-300  focus:ring focus:ring-teal-500 focus:outline-none"
            type="text" placeholder="Search">

        <ul class="space-y-2 ">
            <li class="p-2 defaultList hover:bg-teal-600 activeList bg-teal-500 text-white font-bold cursor-pointer flex items-center mr-2 "
                data-id="MyDAY"><i class=" fas fa-sun text-yellow-400 mr-2"></i> My Day</li>
            <li class="p-2 defaultList hover:bg-teal-600 cursor-pointer flex items-center mr-2" data-id="important"><i
                    class="fas fa-star text-yellow-400 mr-2"></i> Important</li>
            <li class="p-2 defaultList hover:bg-teal-600 cursor-pointer flex items-center mr-2" data-id="planned"><i
                    class="fas fa-calendar-alt text-blue-400 mr-2"></i> Planned</li>
            <li class="p-2 defaultList hover:bg-teal-600 cursor-pointer  flex items-center mr-2" data-id="Assigned"><i
                    class="fas fa-user text-green-400 mr-2"></i> Assigned to me</li>
            <li class="p-2 defaultList hover:bg-teal-600  cursor-pointer  flex items-center mr-2" data-id="Tasks">
                <i class="fas fa-tasks text-gray-400 mr-2"></i> Tasks
            </li>
        </ul>
        <hr>
        <!-- Scrollable List -->
        <input type="hidden" class="activeInput">
        <ul class="custom-lists space-y-2 overflow-y-auto max-h-60  
        scrollbar-thin scrollbar-thumb-teal-400 scrollbar-track-transparent 
        hover:scrollbar-thumb-teal-500">
        </ul>
        <!-- <li class="p-2 rounded  hover:bg-teal-500 cursor-pointer  flex items-center ">
            <i class="fa-solid fa-bars text-gray-400 mr-2"></i>Untitled list
        </li> -->
        </ul>

        <!-- untitlelist contestmenu......................................................... -->

        <div id="listcontextMenu"
            class="hidden absolute bg-white/70 backdrop-blur-lg shadow-2xl rounded-xl p-2 border border-gray-300 w-64 transition-all duration-200 ease-in-out">
            <ul class="text-gray-800 font-medium">
                <li
                    class="flex items-center p-2 hover:bg-gradient-to-r from-gray-300 to-blue-300 cursor-pointer rounded-lg transition-all duration-300 rename-list">
                    <i class="fa-solid fa-pen mr-3 text-blue-600"></i> Rename list
                </li>
                <li
                    class="flex items-center p-2 hover:bg-gradient-to-r from-green-100 to-green-300 cursor-pointer rounded-lg transition-all duration-300">
                    <i class="fa-solid fa-user-plus mr-3 text-green-600"></i> Share list
                </li>
                <li
                    class="flex items-center p-2 hover:bg-gradient-to-r from-indigo-100 to-indigo-300 cursor-pointer rounded-lg transition-all duration-300">
                    <i class="fa-solid fa-print mr-3 text-indigo-600"></i> Print list
                </li>
                <li
                    class="flex items-center p-2 hover:bg-gradient-to-r from-purple-100 to-purple-300 cursor-pointer rounded-lg transition-all duration-300">
                    <i class="fa-solid fa-envelope mr-3 text-purple-600"></i> Email list
                </li>
                <li
                    class="flex items-center p-2 hover:bg-gradient-to-r from-yellow-100 to-yellow-300 cursor-pointer rounded-lg transition-all duration-300">
                    <i class="fa-solid fa-thumbtack mr-3 text-yellow-600"></i> Pin to Start
                </li>
                <li
                    class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-gray-300 cursor-pointer rounded-lg transition-all duration-300">
                    <i class="fa-solid fa-copy mr-3 text-gray-600"></i> Duplicate list
                </li>
            </ul>
            <div class="border-t border-gray-400 mt-1 pt-1">
                <li type="submit"
                    class="flex items-center p-2 text-red-600 hover:bg-gradient-to-r from-red-100 to-red-300 cursor-pointer rounded-lg transition-all duration-300 delete-list">
                    <i class="fa-solid fa-trash mr-3"></i> Delete list
                </li>
            </div>
        </div>
        <!-- <button class="mt-auto bg-teal-600 hover:bg-teal-500 text-white py-2 px-4  flex items-center justify-center"
            id="new-list-btn">
            <i class="fas fa-plus mr-2"></i> New List
        </button> -->
        <button class="relative mt-auto group bg-gradient-to-r from-teal-500 to-cyan-500 text-white font-bold     py-2 px-8 rounded-md 
            transition-all duration-300 transform hover:shadow-lg hover:shadow-cyan-400/60 active:scale-95 
            border border-white/20 backdrop-blur-xl overflow-hidden mr-2 flex items-center justify-center"
            id="new-list-btn">
            <span class="absolute inset-0 bg-white opacity-10 group-hover:opacity-20 rounded-sm"></span>
            <span class="relative flex items-center justify-center space-x-2">
                <i class="fas fa-plus text-lg"></i>
                <span>New List</span>
            </span>
        </button>




    </nav>

    <!-- Main Content -->
    <main class="p-3 flex flex-col w-4/5 manageSection " is_open="0">
        <div class="flex justify-end  space-x-2">
            <div class="space-x-2">
                <button class="bg-white text-gray-700 p-2 rounded shadow hover:bg-gray-200"><i
                        class="fas fa-image"></i></button>
                <button class="bg-white text-gray-700 p-2 rounded shadow hover:bg-gray-200"><i
                        class="fas fa-lightbulb"></i></button>
                <button class="bg-white text-gray-700 p-2 rounded shadow hover:bg-gray-200"><i
                        class="fas fa-ellipsis-h"></i></button>
            </div>
            <?php if (isset($_SESSION['loginId']) && $_SESSION['loginId'] !== '') { ?>
                <form action="./congfig/server.php" method="post">
                    <button class="bg-red-500 text-white px-4 py-2 rounded-sm hover:bg-red-600"
                        name="logout">Logout</button>
                </form>
            <?php } else { ?>

                <button class="bg-blue-500 text-black px-4 py-2 rounded-sm hover:bg-blue-600">login</button>

                <button class="bg-blue-500 text-black px-4 py-2 rounded-sm hover:bg-blue-600">signUP</button>

            <?php } ?>

        </div>
        <!-- task container -->
        <div class="mt-1 h-screen overflow-y space-y-1 p-2" id="taskListContainer">
            <!-- <div class="flex justify-between bg-white text-black p-3 rounded shadow items-center">
                <input type="checkbox" class="w-5 h-5">
                <div class="flex items-center space-x-3">
                    <span class="text-yellow-400 text-lg"><i class="fas fa-star"></i></span>
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600" id="delete-btn">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div> -->
        </div>
        <!-- add task input -->
        <div class="mt-auto">
            <form class="flex space-x-2" action="./congfig/server.php" method="POST" id="task_form">
                <input type='hidden' name="taskBtn" value="1">
                <input type='hidden' name="userid" value="<?php echo $_SESSION['loginId'] ?>">
                <input type="text" class="flex-1 p-2 rounded-sm bg-white text-black focus:ring " placeholder="Add task"
                    name="task" id="task">
                <button type="submit" id="taskBtn"
                    class="bg-green-500 text-white px-4 py-2 rounded-sm hover:bg-green-600">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div>



    </main>

    <!-- right sidebar -->
    <div class="fixed top-0 right-0 w-1/5 mx-auto text-black hidden sidebar-btn ">
        <div class="flex justify-end">
            <div
                class="w-full max-w-xs h-screen bg-white shadow-2xl  overflow-y-auto  hover:shadow-3xl transition-shadow duration-300">

                <!-- Task Header -->
                <div class="border px-4 py-3 mb-4  bg-gray-100 hover:bg-gray-100 transition">
                    <div class="flex items-center mb-3">
                        <input type="checkbox" class="form-checkbox text-blue-500 mr-2">
                        <p class="text-lg"> task</p>
                        <i class="fa fa-star text-yellow-500 ml-auto"></i>
                    </div>
                    <a href="#" class="text-blue-500 block mb-1 hover:underline">+ Add step</a>
                </div>

                <!-- Quick Actions -->
                <div class="flex items-center px-4 p-2 bg-gray-100  hover:bg-gray-300 cursor-pointer transition">
                    <i class="fa fa-sun mr-2"></i> Add to My Day
                </div>

                <!-- Task Options -->
                <div class="border  px-3 py-2 mb-4 bg-gray-100 space-y-2 hover:shadow-md transition">
                    <div class="flex items-center px-2 py-2  hover:bg-gray-300 cursor-pointer transition">
                        <i class="fa fa-bell mr-2"></i> Remind me
                    </div>
                    <div class="flex items-center px-2 py-2  hover:bg-gray-300 cursor-pointer transition">
                        <i class="fa fa-calendar mr-2"></i> Add due date
                    </div>
                    <div class="flex items-center px-2 py-2 hover:bg-gray-300 cursor-pointer transition">
                        <i class="fa fa-redo mr-2"></i> Repeat
                    </div>
                </div>

                <!-- Additional Actions -->
                <div class="flex flex-col space-y-2">
                    <div class="flex items-center px-4 p-3 bg-gray-100  hover:bg-gray-300 cursor-pointer transition">
                        <i class="fa fa-user mr-2"></i> Assign to
                    </div>
                    <div class="flex items-center px-4 p-3 bg-gray-100  hover:bg-gray-300 cursor-pointer transition">
                        <i class="fa fa-paperclip mr-2"></i> Add file
                    </div>
                    <div class="flex items-center px-4 p-3 bg-gray-100  hover:bg-gray-300 cursor-pointer transition">
                        <i class="fa fa-sticky-note mr-2"></i> Add note
                    </div>
                </div>

                <div
                    class="w-1/5 px-4 py-2 bg-gray-100 hover:bg-gray-300 cursor-pointer transition fixed bottom-4 right-0 shadow-md flex items-center justify-between">
                    <span class="text-black/70 text-sm flex-grow text-center">Created today</span>
                    <i class="fa fa-trash text-red-400 hover:text-red-600 cursor-pointer transition"></i>
                </div>

            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        $(document).ready(function () {
            let activeListId = $(".activeList").data("id")
            // alert(activeListId);
            getTasks(activeListId);

            listDataRender();
            // renderDefaultList();
        })


        $(document).on("click", "#taskBtn", function (e) {
            e.preventDefault();
            let task = $('#task').val().trim();
            // alert(task);
            // return false;
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
                let activeListId = $(".activeList").data("id")

                let formData = form.serialize();
                formData += "&activeListId=" + activeListId,

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        success: function (response) {
                            let arr = JSON.parse(response);
                            console.log(arr);
                            if (arr.success) {
                                rander(arr.tasklist);
                            } else {
                                alert("tasks not updated");
                            }
                            $('#task').val('');
                        }
                    })
            }
        })
        function getTasks(id = "") {
            let request = {
                getdata: true
            }
            if (id != "") {
                request.id = id
                // console.log(request.Id)
            }

            $.ajax({
                url: "./congfig/server.php",
                type: "post",
                data: request,
                success: function (response) {
                    let arr = JSON.parse(response);

                    if (arr.success) {
                        let getTaskList = arr.tasklist;

                        rander(getTaskList);

                    }
                }
            });
        }

        function rander(getTaskList) {
            $('#taskListContainer').empty();
            let html = "";

            getTaskList.forEach(element => {
                let isimp = "text-gray-400"
                if (element.important == "1") {
                    isimp = "text-yellow-500"
                }
                html += `
                        
                <div class="flex justify-between bg-white text-black p-2 rounded-sm shadow items-center sidebar mr-3  removeImp${element.id}  rightClick"  >
                        <div class="flex items-center space-x-3 max-w-xs"data-id="${element.id}">
                            <input type="checkbox" class="w-4 h-4    ">
                            <span class="flex-grow text-lg text-gray-900 font-[5px]">${element.task_name}</span>
                        </div>
                            
                        <div class="flex items-center space-x-2">
                                <span class="${isimp} text-lg star isImp${element.id}  "data-id="${element.id}" data-imp="${element.important}"><i class="fas fa-star"></i></span>
                        </div>
                                
                        <div class="w-64 bg-white/70 backdrop-blur-lg shadow-2xl rounded-xl p-2 hidden absolute contextMenu 
                                    border border-gray-300 transition-all duration-200 ease-in-out">
                            
                            <ul class="text-gray-800 font-medium">
                                <li class="flex items-center p-2 hover:bg-gradient-to-r from-gray-400 to-yellow-300 
                                        cursor-pointer rounded-lg transition-all duration-300">
                                    <i class="fa-solid fa-star mr-3 text-yellow-500"></i> Remove from My Day
                                </li>
                                
                                <li class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-yellow-300 
                                        cursor-pointer rounded-lg transition-all duration-300">
                                    <i class="fa-solid fa-star-half-stroke mr-3 text-yellow-500"></i> Mark as Important
                                </li>
                                
                                <li class="flex items-center p-2 hover:bg-gradient-to-r from-green-100 to-green-300 
                                        cursor-pointer rounded-lg transition-all duration-300">
                                    <i class="fa-solid fa-check mr-3 text-green-600"></i> Mark as Completed
                                </li>
                                
                                <li class="flex items-center p-2 hover:bg-gradient-to-r from-indigo-100 to-indigo-300 
                                        cursor-pointer rounded-lg transition-all duration-300">
                                    <i class="fa-solid fa-calendar-day mr-3 text-indigo-600"></i> Due Tomorrow
                                </li>
                                
                                <li class="flex items-center p-2 hover:bg-gradient-to-r from-purple-100 to-purple-300 
                                        cursor-pointer rounded-lg transition-all duration-300">
                                    <i class="fa-solid fa-calendar-alt mr-3 text-purple-600"></i> Pick a Date
                                </li>
                                
                                <li class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-gray-300 
                                        cursor-pointer rounded-lg transition-all duration-300">
                                    <i class="fa-solid fa-calendar-xmark mr-3 text-gray-600"></i> Remove Due Date
                                </li>
                                
                                <li class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-gray-300 
                                        cursor-pointer rounded-lg transition-all duration-300">
                                    <i class="fa-solid fa-folder-open mr-3 text-gray-600"></i> Move Task To...
                                </li>
                            </ul>
                            
                            <div class="border-t border-gray-400 mt-1 pt-1">
                                <li type="submit" class="flex items-center p-2 text-red-600 hover:bg-gradient-to-r 
                                        from-red-100 to-red-300 cursor-pointer rounded-lg transition-all duration-300" 
                                    id="delete-btn" data-id="${element.id}">
                                    <i class="fa-solid fa-trash mr-3"></i> Delete Task
                                </li>
                            </div>
                        </div>
                        
                </div>  `;
            });

            $('#taskListContainer').append(html);
            // scrollToTop();
        }
        function scrollToTop() {
            let container = $('#taskListContainer');
            container.scrollTop(0);
        }
        // deletetask function with ajax................................
        // $(document).on("click", "#delete-btn", function () {
        //     let taskid = $(this).data("id");
        //     // console.log(taskid);
        //     if (confirm("Are you sure you want to delete this task?")) {
        //         $.ajax({
        //             url: "./congfig/server.php", // Corrected URL
        //             type: "post",
        //             data: { deleteTask: true, id: taskid },
        //             success: function (response) {
        //                 let arr = JSON.parse(response);
        //                 console.log(arr)

        //                 if (arr.success) {
        //                     alert("Task deleted successfully");

        //                     getTasks();
        //                 } else {
        //                     alert("Something went wrong"); // Corrected error message
        //                 }
        //             },

        //         });
        //     }
        // });
        $(document).on("click", "#delete-btn", function () {
            let taskid = $(this).data("id");
            $(".contextMenu").fadeOut("fast");
            Swal.fire({
                title: "Are you sure?",
                text: `You want to be delete this task ${taskid}!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./congfig/server.php", // Corrected URL
                        type: "post",
                        data: { deleteTask: true, id: taskid },
                        success: function (response) {
                            let arr = JSON.parse(response);
                            console.log(arr);

                            if (arr.success) {
                                $(".contextMenu").hide();
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Task has been deleted.",
                                    icon: "success",
                                    timer: 2000, // Auto-close after 2 seconds
                                    showConfirmButton: false
                                });
                                getTasks(); // Refresh task list
                            } else {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Something went wrong.",
                                    icon: "error"
                                });
                            }
                        }
                    });
                }
            });
        });
        // right sidebar logic ...................................................................................

        $(document).on('click', '.sidebar', function (e) {
            // Agar context menu active hai to sidebar event trigger na ho
            if ($(".contextMenu").hasClass("active")) {
                return false;
            }

            let is_open = $('.manageSection').attr("is_open");

            $(".sidebar-btn").fadeToggle();

            if (is_open == "0") {
                $(".manageSection").removeClass("w-4/5").addClass("w-3/5").attr("is_open", "1");
            } else {
                $(".manageSection").removeClass("w-3/5").addClass("w-4/5").attr("is_open", "0");
            }

            e.stopPropagation(); // Sidebar ke andar click ka propagation roko
        });

        // **Checkbox aur delete button click pe sidebar event na ho**
        $(document).on('click', 'input[type="checkbox"], .star', function (e) {
            e.stopPropagation();
        });

        // **Context menu open logic**..........................................................
        $(document).on('contextmenu', '.rightClick', function (e) {
            e.preventDefault();

            // Pehle sabhi context menus ko hide karo
            $(".contextMenu").removeClass("active").addClass("hidden");

            // Current element ka context menu
            let menu = $(this).find('.contextMenu');

            // Window aur mouse position fetch karo
            let windowHeight = $(window).height(); // Window ki height
            let menuHeight = menu.outerHeight(); // Context menu ki height
            let clickY = e.pageY; // Mouse click ki Y position

            // Agar bottom me jagah kam hai, to menu UP open hoga
            let topPosition = (clickY + menuHeight > windowHeight) ? (clickY - menuHeight) : clickY;

            // Context menu show karo correct position pe
            menu.addClass('active').removeClass('hidden').css({
                top: topPosition + "px",
                left: e.pageX + "px"
            });

            e.stopPropagation(); // Context menu ka propagation roko
        });

        // **Jab kahi aur click ho, tab context menu band ho jaye**
        $(document).on("click", function () {
            $(".contextMenu").removeClass("active").addClass("hidden");
        });

        // **Agar rightClick pe click karein to context menu band ho, lekin sidebar toggle ho**
        $(document).on("click", ".rightClick", function (e) {
            let menu = $(this).find('.contextMenu');

            // Agar context menu already active hai, to close kar do
            if (menu.hasClass("active")) {
                $(".contextMenu").removeClass("active").addClass("hidden");
            } else {
                //  Sidebar toggle karne ka function call karo
                $(".sidebar-btn").toggleClass("open");
            }

            e.stopPropagation();
        });

        // **Context menu ke andar click karne pe kuch na ho**
        $(document).on("click", ".contextMenu", function (e) {
            e.stopPropagation();
        });

        // **Sidebar ka event tabhi chale jab context menu active na ho**
        $(document).on("click", ".rightClick", function (e) {
            if ($(".contextMenu").hasClass("active")) {
                return false; // Sidebar event trigger hone se rokta hai

            }
            e.stopPropagation();
        });

        // add new list ......................................................
        $(document).on('click', '#new-list-btn', function () {
            $.ajax({
                url: "./congfig/server.php",
                type: "post",
                data: {
                    addNewList: true,
                    list: 'Untitled list'
                },
                success: function (response) {
                    let array = JSON.parse(response);
                    console.log(array);
                    if (array.success) {
                        renderlist(array.list, 1);
                    }
                },
                error: function () {
                    alert("AJAX request failed!");
                }
            });
        });

        function listDataRender() {
            $.ajax({
                url: "./congfig/server.php",
                type: "post",
                data: {
                    fetch_list: true
                },
                success: function (response) {
                    let array = JSON.parse(response);
                    // console.log(typeof array)
                    if (array.success) {
                        // Filter lists where is_default == 0
                        let filteredList = array.list.filter(item => item.is_default == 0);

                        if (filteredList.length > 0) {
                            renderlist(filteredList);
                        }
                    }
                },
                error: function () {
                    alert(" listDataRender AJAX request failed!");
                }
            });
        }
        function renderlist(data, isInput = '') {
            // console.log(data);
            if (isInput == 1) {
                var input = '';
                var span = 'hidden';

            } else {
                var input = 'hidden';
                var span = '';
            }
            // $(".custom-lists").html(''); // Pehle existing list clear karni
            data.map((element, index) => {
                let html = `
                                <li class="p-1 mr-2     cursor-pointer flex items-center list-item hover:bg-teal-500" data-id="${element.id} ">
                                    <i class="fa-solid fa-bars  text-blue-300 mr-2"></i>
                                    <span class=" list-text ${span} px-1  py-1 listSpan listSpan${element.id}">
                                        ${element.list_name} 
                                    </span>
                                    <input type="text" 
                                        class="list-text px-2 py-1 ${input} listInput${element.id} listInput listInputActive 
                                        dark:placeholder-gray-400 text-black  outline-none border-b-4 border-blue-800
                                        bg-gray-100 dark:bg-gray-800 rounded-sm transition-all duration-300 hover:bg-gray-200 
                                        dark:hover:bg-gray-700"
                                        value="${element.list_name} ">
                                </li>
                            `;

                // List ko container mein append karna
                $(".custom-lists").append(html);

                // Active input ka data-id set karna
                $(".activeInput").attr("data-id", element.id);

                // Input field ka background color set karna aur focus dena
                $(".listInput" + element.id).focus().select()
            });

        }
        // Page ke kisi bhi aur jagah click hone par focus hatane aur background color reset karne ke liye
        $(document).on('click', function (e) {

            let activeInput = $(".activeInput").data('id');
            // alert(activeInput)
            // if (activeInput !== undefined) {
            if (!$(e.target).closest('.listInputActive, #listcontextMenu, .swal2-container').length) {
                $('.listInput').addClass('hidden');
                $('.listSpan').removeClass('hidden');
                $(".listInput" + activeInput).select().focus();
                let listName = $('.listInput' + activeInput).val();
                // updateList(activeInput, listName);
            }
            // }
        });
        //   ContextMenu  open when rightclik willbe  untitled list............................................... 
        $(document).ready(function () {
            // Right-click event on list item
            $(document).on("contextmenu", ".list-item", function (event) {
                event.preventDefault();

                let itemId = $(this).data("id");

                // console.log(itemId);
                let menu = $("#listcontextMenu").fadeIn("slow");

                // Get cursor position
                let mouseX = event.pageX;
                let mouseY = event.pageY;
                let menuHeight = menu.outerHeight();

                // Positioning: Open above cursor
                let topPosition = mouseY - menuHeight - 50; // 5px padding

                // Ensure menu stays within viewport
                if (topPosition < 0) {
                    topPosition = 10; // Minimum margin from top
                }
                menu.css({
                    display: "block",
                    left: mouseX - "px",
                    top: topPosition + "px"
                }).attr("data-id", itemId);
            });
            // Hide context menu when clicking anywhere else
            // Hide context menu when clicking anywhere else (but not inside the menu)
            $(document).on("click", function (e) {
                if (!$(e.target).closest("#listcontextMenu").length) {
                    $("#listcontextMenu").fadeOut("fast");

                }
            });

        });
        //untitled list (Context Menu)  delete-ajax........................................
        $(document).on("click", ".delete-list", function () {
            let deleteListId = $("#listcontextMenu").attr("data-id");
            // let activeInput = $(".activeInput").data('id');

            if (!deleteListId) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Error: No List ID found!",
                });
                return;
            }

            //  Pehle context menu hide karo
            $("#listcontextMenu").fadeOut("fast");

            //  Modern confirm box
            Swal.fire({
                title: "Are you sure?",
                text: `You are about to delete list #${deleteListId}!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./congfig/server.php",
                        type: "post",
                        data: { deletelist: true, id: deleteListId },
                        success: function (response) {
                            let array = JSON.parse(response);
                            if (array.success) {
                                //  Modern Success Message
                                Swal.fire({
                                    icon: "success",
                                    title: "Deleted!",
                                    text: "Your list has been deleted.",
                                    showConfirmButton: true,
                                    // background: none!important,

                                    timer: 1500, // Auto-close after 1.5 sec
                                });

                                //  Pehle specific item remove karo
                                $(".custom-lists").empty();
                                listDataRender();

                                // Agar list empty ho gayi, to context menu bhi hide karo
                                if ($(".list-item").length === 0) {
                                    $("#listcontextMenu").hide();
                                }
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Something went wrong!",
                                    text: "Unable to delete the list.",
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: "error",
                                title: "Server Error!",
                                text: "Please try again later.",
                            });
                        },
                    });
                }
            });
        });
        //defaultList ajax..................................
        // function renderDefaultList() {
        //     $.ajax({
        //         url: "./congfig/server.php",
        //         type: "post",
        //         data: {
        //             getDefaultList: true
        //         },
        //         success: function (response) {
        //             let array = JSON.parse(response);
        //             console.log(array)
        //             if (array.success) {

        //                 let defaultList = array.defaultList;
        //                 // console.log(defaultList)
        //                 defaultList.map((ele, index) => {
        //                     let html = `
        //                                  <li class="p-2  hover:bg-teal-500 cursor-pointer flex items-center mr-2"data-id="${ele.id}">
        //                                 <i class="${ele.icon_class} mr-2 "></i> ${ele.list_name}</li>
        //                              `;


        //                     console.log($(".defaultList").append(html))
        //                 })


        //             }
        //         },
        //         error: function () {
        //             alert(" getDefaultList AJAX request failed!");
        //         }
        //     });
        // }
        $(document).on("click", ".defaultList ", function () {
            // Pehle sabhi list items se active class hatao
            $(".defaultList").removeClass("activeList bg-teal-500 text-white font-bold");

            // Ab jispe click kiya hai usko active class add karo
            $(this).addClass("activeList bg-teal-500 text-white font-bold");
            let Id = $(this).attr("data-id")
            getTasks(Id)
        });
        $(document).on("click", ".star", function () {
            let star = $(this)

            let starId = star.attr("data-id")
            let impValue = star.attr("data-imp")


            let newimpValue;
            if (impValue == 0) {
                newimpValue = 1;
            } else {
                newimpValue = 0;
            }
            $.ajax({
                url: "./congfig/server.php",
                type: "post",
                data: { isImportant: true, id: starId, important: newimpValue },
                success: function (response) {
                    let arr = JSON.parse(response);
                    console.log(arr)
                    if (arr.success) {
                        if (impValue == '1') {
                            $(".isImp" + starId).removeClass("text-yellow-500").addClass("text-gray-400");
                            $(".isImp" + starId).attr("data-imp", 0)
                            let implistId = $(".activeList").attr("data-id")

                            if (implistId == "important") {
                                setTimeout(() => {
                                    $(".removeImp" + starId).remove()

                                }, 500)
                            }
                        } else {
                            $(".isImp" + starId).attr("data-imp", 1)
                            $(".isImp" + starId).addClass("text-yellow-500").removeClass("text-gray-400");

                        }
                    }
                }
            });
        });
        // rename-list jquary with ajax............................................................................

        // $(document).on("click", ".rename-list", function () {
        // let listId = $("#listcontextMenu").attr("data-id")
        // $("#listcontextMenu").fadeOut("fast");
        // $(".activeInput").attr("data-id", listId);
        // $('.listInput' + listId).removeClass('hidden');
        // $('.listSpan' + listId).addClass('hidden');
        // $(".listInput" + listId).focus().select();
        // });
        // function updateList(listId, listName) {
        // $.ajax({
        // url: "./congfig/server.php", // Corrected URL
        // type: "post",
        // data: { renamelist: true, listId: listId, listName: listName },
        // success: function (response) {
        // console.log("Server Response:", response);
        // let res = JSON.parse(response);
        // if (res.success) {
        // $(".custom-lists").empty();
        // listDataRender();

        // Swal.fire({
        // icon: "success",
        // title: "Renamed!",
        // text: "List name updated successfully.",
        // timer: 2000,
        // showConfirmButton: false
        // });
        // } else {
        // Swal.fire({
        // icon: "error",
        // title: "Error!",
        // text: "Failed to rename the list.",
        // });
        // }
        // }
        // })
        // }

        // $(document).on("click", ".rename-list1", function () {
        // let updatelist;
        // let renameListId = $("#listcontextMenu").attr("data-id");

        // if (!renameListId) {
        // Swal.fire({
        // icon: "error",
        // title: "Oops...",
        // text: "Error: No rename List ID found!",
        // });
        // return;
        // }

        // $("#listcontextMenu").fadeOut("fast");
        // $('.listInput' + renameListId).removeClass('hidden');
        // $('.listSpan' + renameListId).addClass('hidden');
        // $(".listInput" + renameListId).focus().select();
        // $(document).on("keypress", ".listInput", function (e) {
        // if (e.which === 13) {
        // renameListId = $("#listcontextMenu").attr("data-id");
        // alert(renameListId)
        // updatelist = $(this).val();
        // // console.log(updatelist);
        // if (updatelist === "") {
        // Swal.fire({
        // icon: "error",
        // title: "Oops...",
        // text: "List name cannot be empty!",
        // });
        // return;
        // }
        // $.ajax({
        // url: "./congfig/server.php", // Corrected URL
        // type: "post",
        // data: { renamelist: true, id: renameListId, list: updatelist },
        // success: function (response) {
        // console.log("Server Response:", response);
        // let res = JSON.parse(response);
        // if (res.success) {
        // $(".custom-lists").empty();
        // listDataRender();
        // Swal.fire({
        // icon: "success",
        // title: "Renamed!",
        // text: "List name updated successfully.",
        // timer: 2000,
        // showConfirmButton: false
        // });
        // } else {
        // Swal.fire({
        // icon: "error",
        // title: "Error!",
        // text: "Failed to rename the list.",
        // });
        // }
        // }
        // })
        // }


        // })

        // })
    </script>

</body>

</html>