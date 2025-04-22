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


<body class="bg-gradient-to-br from-rose-700 to-rose-900 text-white min-h-screen flex box-border  overflow-hidden ">

    <!-- <body class="bg-gray-200 text-white min-h-screen flex box-border"> -->
    <!-- Left Sidebar --------------------------------------------------------------------------->
    <nav class="w-1/5 h-screen overflow-hidden  bg-pink-900 pl-2  pt-3 flex flex-col space-y-4 border-r border-white  ">
        <!-- <nav class="w-1/5 h-screen overflow-hidden bg-pink-900 pl-2 pt-3 pb-4 flex flex-col space-y-4 border-r border-white transition-all duration-300 
     max-md:fixed max-md:left-0 max-md:top-0 max-md:z-50 max-md:w-64 max-md:-translate-x-full" id="leftSidebar"> -->

        <!-- <button id="toggleSidebar"
            class="md:hidden fixed top-4 left-0 z-50 bg-white text-black p-2 rounded shadow hover:bg-gray-200">
            <i class="fas fa-bars"></i>
        </button> -->
        <div class="flex items-center space-x-3  loginUser  ">
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
                    <?php echo ($_SESSION['loginuserData']['email']) ?>
                </p>
            </div>
        </div>



        <input
            class="w-[97%]  max-md p-2 -mr-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-300  focus:ring focus:ring-teal-500 focus:outline-none"
            type="text" placeholder="Search">


        <div class="scrol-lists overflow-y-auto max-h-[80vh] ">
            <ul class="space-y-2 ">
                <!-- <li class="p-1 defaultList hover:bg-teal-600 activeList bg-teal-500 text-white font-bold cursor-pointer flex items-center mr-2 "
                    data-id="MyDAY"><i class=" fas fa-sun text-yellow-400 mr-2"></i> My Day</li> -->
                <li class="p-1 defaultList hover:bg-rose-500 activeList bg-rose-500 text-white font-bold cursor-pointer flex items-center justify-between mr-2"
                    data-id="MyDAY" data-name="My Day" data-icon="fas fa-sun text-yellow-400 mr-2">
                    <!-- Left Side: Icon + Text -->
                    <div class="flex items-center">
                        <i class="fas fa-sun text-yellow-400 mr-2"></i>
                        <span>My Day</span>
                    </div>
                    <!-- Right Side: Count -->
                    <span class="text-sm  textwhite w-6 h-6 flex items-center justify-center rounded-full font-semibold"
                        id="countMyDay">

                    </span>
                </li>

                <li class="p-1 defaultList hover:bg-rose-600  cursor-pointer flex items-center mr-2 justify-between"
                    data-id="important" data-name="Important" data-icon="fas fa-star text-yellow-400 mr-2">

                    <div class="flex items-center">
                        <i class="fas fa-star text-yellow-400 mr-2"></i>
                        <span>Important</span>
                    </div>
                    <!-- Right Side: Count -->
                    <span
                        class="text-sm  text-white w-6 h-6 flex items-center justify-center rounded-full font-semibold"
                        id="countImportant">

                    </span>
                </li>
                <li class="p-1 defaultList hover:bg-rose-600 cursor-pointer flex items-center mr-2 justify-between"
                    data-id="planned" data-name="Planned" data-icon="fas fa-calendar-alt text-blue-800 mr-2">

                    <div class="flex items-center">
                        <i class="fas fa-calendar-alt text-blue-800 mr-2"></i>
                        <span>Planned</span>
                    </div>
                    <!-- Right Side: Count -->
                    <span class="text-sm text-white w-6 h-6 flex items-center justify-center rounded-full font-semibold"
                        id="countPlanned">

                    </span>
                </li>

                <li class="p-1 defaultList hover:bg-rose-600 cursor-pointer flex items-center mr-2 justify-between"
                    data-id="complete" data-name="Completed" data-icon="fas fa-check-circle  text-red-500 mr-2">

                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-red-500 mr-2"></i>
                        <span> Completed</span>
                    </div>
                    <!-- Right Side: Count -->

                    <span
                        class="text-sm  text-white w-6 h-6 flex items-center justify-center rounded-full font-semibold"
                        id="countComplete">

                    </span>
                </li>

                <li class="p-1 defaultList hover:bg-rose-600 cursor-pointer flex items-center mr-2 justify-between"
                    data-id="all" data-name="All" data-icon="fas fa-infinity text-green-300 mr-2">
                    <div class="flex items-center">
                        <i class="fas fa-infinity text-green-300 mr-2"></i>
                        <span> All </span>
                    </div>
                    <span class="text-s text-white w-6 h-6 flex items-center justify-center rounded-full font-semibold"
                        id="countAll">

                    </span>
                </li>
                <li class="p-1 defaultList hover:bg-rose-600 cursor-pointer flex items-center mr-2 justify-between"
                    data-id="Assigned" data-icon="fas fa-user text-green-400 mr-2">

                    <div class="flex items-center">
                        <i class="fas fa-user text-green-400 mr-2"></i>
                        <span> Assigned to me</span>
                    </div>

                    <span
                        class="text-sm  text-black/70 w-6 h-6 flex items-center justify-center rounded-full font-semibold">

                    </span>
                </li>

                <li class="p-1 defaultList hover:bg-rose-600 cursor-pointer flex items-center mr-2 justify-between"
                    data-id="Tasks" data-name="Tasks" data-icon="fas fa-calendar-check text-rose-950 mr-2">

                    <div class="flex items-center">
                        <i class="fas fa-calendar-check text-rose-950 mr-2"></i>
                        <span> Tasks</span>
                    </div>
                    <!-- Right Side: Count -->
                    <span
                        class="text-sm  text-white w-6 h-6 flex items-center justify-center rounded-full font-semibold"
                        id="countTasks">

                    </span>

                </li>
            </ul>
            <hr>
            <!-- Scrollable List -->
            <input type="hidden" class="activeInput">
            <ul class="custom-lists    max-h-[245px] ">
                <!-- <li class="p-2 rounded  hover:bg-teal-500 cursor-pointer  flex items-center ">
                    <i class="fa-solid fa-bars text-gray-400 mr-2"></i>Untitled list
                </li> -->
            </ul>

            <button
                class=" w-[19%] fixed bottom-2 py-1  bg-gradient-to-r from-rose-500 to-rose-900 text-white font-bold rounded-md"
                id="new-list-btn">

                <span class=" text-white font-bold text-xl">+</span>
                <span>New List</span>
            </button>

        </div>


    </nav>
    <!-- Modal Background (Hidden by default) -->
    <div id="modalBg" class="fixed inset-0 bg-black/50 hidden flex justify-center items-center">

        <!-- Modal Box -->
        <div id="modalBox"
            class=" bg-white/70 backdrop-blur-lg p-1  rounded-lg shadow-xl w-96 opacity-0 scale-95 transition-all duration-300">

            <h2 class="text-xl text-black text-center font-bold mb-4">Manage Accounts</h2>
            <!-- <p class="text-gray-700 mb-4">This is a simple popup modal using Tailwind CSS and jQuery.</p> -->
            <div class="flex items-center justify-between   space-x-6 p-2  hover:bg-gray-300 ">
                <div
                    class=" border-b-amber-800 border h-10 w-16 text-center bg-orange-400 font-bold rounded-full text-2xl text-white">
                    <?php echo ($_SESSION['loginuserData']['name'][0]);
                    ?>
                </div>
                <div>
                    <p class=" text-black">
                        <?php echo ($_SESSION['loginuserData']['name']) ?>
                        <span class=" text-gray-600">
                            <?php echo ($_SESSION['loginuserData']['email']) ?>
                        </span>
                    </p>

                </div>
                <div>
                    <p> <?php if (isset($_SESSION['loginId']) && $_SESSION['loginId'] !== '') { ?>
                        <form action="./congfig/server.php" method="post">
                            <button class="bg-red-500 text-white  px-3 py-1 rounded-md hover:bg-red-600"
                                name="logout">LogOut</button>
                        </form>
                    <?php } else { ?>

                        <button class="bg-blue-500 text-black px-4 py-2 rounded-sm hover:bg-blue-600">login</button>

                        <button class="bg-blue-500 text-black px-4 py-2 rounded-sm hover:bg-blue-600">signUP</button>

                    <?php } ?></p>
                </div>
            </div>

            <!-- Close Button -->
            <div class="flex justify-end mt-4  ">
                <button id="closeModal" class="px-3 py-2 bg-gray-200 text-black rounded-md hover:bg-red-600">
                    Close
                </button>
            </div>

        </div>

    </div>


    <!-- Main Content -->
    <main class="p-3 flex flex-col w-4/5 manageSection changeColor  opacity-100  " is_open="0">
        <!-- <main
        class="p-3 flex flex-col w-4/5 manageSection changeColor flex-grow md:w-[200px]w-full ml-0 md:ml-[10%] transition-all duration-300"
        is_open="0"> -->
        <!-- <div class="flex justify-end  space-x-2"> -->
        <div class="flex justify-between  space-x-2">
            <!-- <div  class="text-xl font-semibold mb-3"> </div> -->
            <div id="activeListName" class="flex items-center text-xl font-semibold mb-3"">
             <i class=" fas fa-sun text-yellow-400 mr-2"></i> My Day
            </div>
            <div class=" space-x-2 ">
                <button class="bg-white text-gray-700 p-2 rounded shadow hover:bg-gray-200"><i
                        class="fas fa-image"></i></button>
                <button class="bg-white text-gray-700 p-2 rounded shadow hover:bg-gray-200"><i
                        class="fas fa-lightbulb"></i></button>
                <button class="bg-white text-gray-700 p-2 rounded shadow hover:bg-gray-200"><i
                        class="fas fa-ellipsis-h"></i></button>
            </div>


        </div>
        <!-- task container -->
        <div class="mt-1 max-h-[82vh] overflow-auto" id="taskListscrollbar">
            <div class=" " id="taskListContainer">
                <!-- <div class=" mt-4 overflow-y-auto max-h-[550px]" id="taskListContainer"> -->

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
            <div class="w-36  bg-gray-200 p-1 rounded-sm hover:bg-white" id="completeHeader">

                <i id="downIcon" class="fas fa-chevron-down text-gray-500 ml-2"></i>
                <i id="rightIcon" class="fas fa-angle-right text-gray-500 ml-2 hidden"></i>
                <span class="text-green-700 font-semibold pl-2">Completed</span>
                <span id="checkedCount" class="text-gray-500  font-semibold"></span>

            </div>
            <!-- completetask append this container -->
            <div id="completeTask"> </div>
        </div>
        <!-- add task input -->
        <!-- <div class="mt-auto  ">
            <form class="flex space-x-2" action="./congfig/server.php" method="POST" id="task_form">
                <input type='hidden' name="taskBtn" value="1">
                <input type='hidden' name="userid" value="<?php echo $_SESSION['loginId'] ?>">

                <input type="text" class="flex-1 p-2 rounded-sm bg-white text-black focus:ring " placeholder="Add task"
                    name="task" id="task">
                <button type="submit" id="taskBtn"
                    class="bg-rose-400 text-white px-4 py-2 rounded-sm hover:bg-rose-600">
                    <i class="fas fa-plus"></i>
                </button>
            </form>
        </div> -->
        <div class="  rounded  w-full max-w-6xl  mt-auto">
            <form action="./congfig/server.php" method="POST" id="task_form">

                <div
                    class="flex items-center justify-between bg-white px-2 py-2 rounded-sm shadow-sm  taskInputWrapper">
                    <!-- Left section: Add icon + text input -->
                    <div class="flex items-center space-x-1 w-full">
                        <input type='hidden' name="taskBtn" value="1">
                        <input type='hidden' name="userid" value="<?php echo $_SESSION['loginId'] ?>">
                        <div
                            class="w-7 h-7 rounded-full border-2 border-gray-400 mr-3 flex items-center justify-center  taskBtnWrapper">
                            <button type="submit" id="taskBtn"
                                class="bg-rose-400 text-white w-5 h-5 rounded-full flex items-center justify-center hover:bg-rose-600 transition hidden ">
                                <i class="fas fa-plus text-sm"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Add a task"
                            class="w-full focus:outline-none bg-transparent text-gray-800 py-2" name="task" id="task">
                    </div>

                    <!-- Right section: Icons -->
                    <div class="flex items-center space-x-4 text-gray-600 text-xl ml-4 hidden rightIcons ">
                        <div class="flex items-center space-x-1 px-2 py-2 hover:bg-gray-100">
                            <i class="fas fa-home"></i>
                            <span class="text-sm">Tasks</span>
                        </div>

                        <i class="fas fa-calendar-alt"></i>
                        <i class="fas fa-clock"></i>
                        <i class="fas fa-sync-alt"></i>
                    </div>

                </div>
            </form>
        </div>
    </main>
    <!--  right click task container contextmenu list-->
    <div
        class="w-64 bg-white/70 backdrop-blur-lg shadow-2xl rounded-sm p-2 hidden absolute contextMenu border border-gray-300 transition-all duration-200 ease-in-out">

        <ul class="text-gray-800 font-medium">
            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-gray-400 to-yellow-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-star mr-3 text-yellow-500"></i> Remove from My Day
            </li>

            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-yellow-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-star-half-stroke mr-3 text-yellow-500"></i> Mark as Important
            </li>

            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-green-100 to-green-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-check mr-3 text-green-600"></i> Mark as Completed
            </li>

            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-indigo-100 to-indigo-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-calendar-day mr-3 text-indigo-600"></i> Due Tomorrow
            </li>

            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-purple-100 to-purple-300  cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-calendar-alt mr-3 text-purple-600"></i> Pick a Date
            </li>

            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-gray-300  cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-calendar-xmark mr-3 text-gray-600"></i> Remove Due Date
            </li>

            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-gray-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-folder-open mr-3 text-gray-600"></i> Move Task To...
            </li>
        </ul>

        <div class="border-t border-gray-400 mt-1 pt-1">
            <li type="submit"
                class="flex items-center p-2 text-red-600 hover:bg-gradient-to-r   from-red-100 to-red-300 cursor-pointer rounded-sm transition-all duration-300"
                id="delete-btn" data-id="${element.id}">
                <i class="fa-solid fa-trash mr-3"></i> Delete Task
            </li>
        </div>
    </div>
    <!-- user manage acount -->
    <div
        class="w-64 bg-white/70 backdrop-blur-lg shadow-2xl rounded-sm p-2 hidden absolute top-[70px] left-[10px]   manageAcount  border border-gray-300 ">

        <ul class="text-gray-800 font-medium ">
            <li class="flex items-center p-2 hover:bg-gradient-to-r from-gray-400 to-yellow-300 
                        cursor-pointer rounded-sm " id="openModal" type="button"><i
                    class="fa-solid  fa-users fa-flip mr-3 text-yellow-500"></i>ManageAccounts
            </li>
            <hr>

            <li class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-yellow-300 
                        cursor-pointer rounded-sm  ">
                <i class="fa-solid fa-cog fa-spin mr-3 text-yellow-700"></i> Satting
            </li>
            <hr>

            <li class="flex items-center p-2 hover:bg-gradient-to-r from-green-100 to-green-300 
                        cursor-pointer rounded-sm  ">
                <i class="fa-solid fa-sync fa-spin mr-3 text-green-600"></i> Sync
            </li>
        </ul>

    </div>
    <!-- untitlelist contestmenu......................................................... -->

    <div id="listcontextMenu"
        class="hidden absolute bg-white/70 backdrop-blur-lg shadow-2xl rounded-sm p-2 border border-gray-300 w-64 transition-all duration-200 ease-in-out">
        <ul class="text-gray-800 font-medium">
            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-gray-300 to-blue-300 cursor-pointer rounded-sm transition-all duration-300 rename-list">
                <i class="fa-solid fa-pen mr-3 text-blue-600"></i> Rename list
            </li>
            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-green-100 to-green-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-user-plus mr-3 text-green-600"></i> Share list
            </li>
            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-indigo-100 to-indigo-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-print mr-3 text-indigo-600"></i> Print list
            </li>
            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-purple-100 to-purple-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-envelope mr-3 text-purple-600"></i> Email list
            </li>
            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-yellow-100 to-yellow-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-thumbtack mr-3 text-yellow-600"></i> Pin to Start
            </li>
            <li
                class="flex items-center p-2 hover:bg-gradient-to-r from-gray-100 to-gray-300 cursor-pointer rounded-sm transition-all duration-300">
                <i class="fa-solid fa-copy mr-3 text-gray-600"></i> Duplicate list
            </li>
        </ul>
        <div class="border-t border-gray-400 mt-1 pt-1">
            <li type="submit"
                class="flex items-center p-2 text-red-600 hover:bg-gradient-to-r from-red-100 to-red-300 cursor-pointer rounded-sm transition-all duration-300 delete-list">
                <i class="fa-solid fa-trash mr-3"></i> Delete list
            </li>
        </div>
    </div>

    <!-- right sidebar -->
    <div class="fixed top-0 right-0 w-1/5 mx-auto text-black hidden sidebar-Menu ">


        <!-- <div
        class="fixed top-0 right-0 sm:w-1/3 md:w-1/3 w-full h-screen text-black hidden sidebar-Menu z-50 bg-white shadow-2xl"> -->
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
        // Jab pura page load ho jaaye
        $(document).ready(function () {
            // Jo list active hai uska ID le rahe hain
            let activeListId = $(".activeList").data("id");
            // Us list ke tasks ko fetch kar rahe hain
            getTasks(activeListId);
            // List data ko render kar rahe hain (left sidebar etc.)
            listDataRender();
        });
        // Jab "Add Task" wala button  ke div pe click ho
        $(document).on("click", ".taskBtnWrapper", function (e) {
            e.preventDefault(); // Form submit hone se rok rahe hain

            let task = $('#task').val().trim(); // Input se task ka value le rahe hain aur trim kar rahe hain (extra space hata ke)
            let error = 0; // Error ka count shuru mein 0 hai
            // Agar task input khaali hai to error show karo
            if (task === '') {
                // Red border aur shadow se input ko highlight karo
                if ($('#taskBtn').hasClass('hidden')) {
                    $('#taskBtn').removeClass('hidden');
                    $(this).closest('.taskInputWrapper').removeClass('bg-white').addClass('bg-gray-300');
                } else {
                    $('#taskBtn').addClass('hidden');
                    $(this).closest('.taskInputWrapper').addClass('bg-white').removeClass('bg-gray-300');
                }

                error++; // Error count badha do
            }
            // Agar koi error nahi hai to form submit karo
            if (error === 0) {
                let form = $('#task_form'); // Form element ko le rahe hain
                let url = form.attr('action'); // Form ke action URL ko le rahe hain
                let activeListId = $(".activeList").attr("data-id"); // Active list ka ID le rahe hain

                let formData = form.serialize(); // Form data ko serialize (string mein convert) kar rahe hain

                // Active list ka ID bhi form data mein jod rahe hain
                formData += "&activeListId=" + activeListId;

                // Agar "important" list par hain to task ko important mark karo
                if (activeListId === "important") {
                    formData += "&important=1";
                }

                // Agar "checked" list par hain to task ko complete mark karo
                if (activeListId === "checked") {
                    formData += "&checked=1";
                }

                // AJAX call se data server par bhej rahe hain
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        let arr = JSON.parse(response); // Server ka response JSON mein convert kar rahe hain
                        console.log(arr); // Console mein output dekh rahe hain (debug ke liye)

                        if (arr.success) {
                            // Task successfully add ho gaya to list ko dobara fetch karo
                            let listId = $('.activeList').attr('data-id');
                            getTasks(listId);
                        } else {
                            alert("tasks not updated"); // Error message
                        }

                        // Task input field ko empty kar do
                        $('#task').val('');
                    }
                });
            }
        });
        // Jaise hi user kuch type kare, red border hata do agar input khaali nahi hai
        $(document).on("keyup focus", "#task", function () {
            if ($(this).val().trim() !== '') {
                $('#taskBtn').addClass('hidden');
                $('.taskInputWrapper').removeClass('bg-gray-300').addClass('bg-white');
                $('.rightIcons').removeClass('hidden')
            } else {
                $('.rightIcons').addClass('hidden')
            }
            //  Jab user input field pe click (focus) kare aur taskBtn dikh raha ho, toh usse hide karo
            if (!$('#taskBtn').hasClass('hidden')) {
                $('#taskBtn').addClass('hidden');
                $('.taskInputWrapper').removeClass('bg-gray-300').addClass('bg-white');
            }
        });

        function getTasks(id = "") {

            let request = {
                getdata: true
            }
            if (id != "") {
                request.id = id
                // alert(request.Id)
            }

            $.ajax({
                url: "./congfig/server.php",
                type: "post",
                data: request,
                success: function (response) {
                    let arr = JSON.parse(response);

                    if (arr.success) {
                        let getTaskList = arr.tasklist;
                        $('#countMyDay').text(arr.counts.myDay);
                        $('#countImportant').text(arr.counts.important);
                        $('#countComplete').text(arr.counts.complete);
                        $('#countAll').text(arr.counts.all);
                        $('#countTasks').text(arr.counts.Tasks);
                        $('#countPlanned').text(arr.counts.planned)

                        rander(getTaskList);

                    }
                }
            });
        }

        function rander(getTaskList) {
            $('#taskListContainer').empty();
            $('#completeTask').empty();


            let html = "";
            let iscompleteTask = ""
            let completedCount = ""


            getTaskList.forEach(element => {

                let isimp = "text-gray-400"
                // let completeid = $(".checkbox").attr("data-id")
                if (element.important == "1") {
                    isimp = "text-yellow-500"
                }
                let ischeck;
                if (element.checked == 1) {
                    ischeck = "checked"

                } else {
                    ischeck = ""
                }
                let taskNameSpan;
                if (ischeck === "checked") {
                    taskNameSpan = "line-through leading-tight "
                } else {
                    taskNameSpan = ""
                }

                let subText = "";
                let currentListId = $(".activeList").attr("data-id");
                // alert(currentListId);
                // Agar current list wahi list hai jisme task add hua tha → subText empty rahe
                if (currentListId == 'MyDAY' || currentListId === "planned" || (element.important == 1 && currentListId != 'complete' && currentListId != 'all')) {
                    subText = `<div class="text-sm text-gray-500 ">Task</div>`;
                } else if (currentListId == 'all' || currentListId == 'Tasks') {
                    if (element.list_id == 'MyDAY') {
                        subText = `<div class="text-sm text-gray-500 ">My Day</div>`
                    }
                } else if (currentListId == 'complete') {
                    subText = `<div class="text-sm text-gray-500 "></div>`;
                }
                let taskTemplate = `    
                    
                      <div class=" flex justify-between bg-white  text-black p-1 rounded-sm shadow-sm items-start sidebar mr-5 mt-1 mb-1 removeCheck${element.id} rightClick" data-id="${element.id}">

                                        <!-- Left Side: Checkbox + Task Info -->
                                        <div class="flex items-start space-x-3 w-full max-w-sm ">

                                           
                                            <div class="w-6 h-6 relative rounded-full border-2 border-gray-400 mr-3 flex   mt-1  items-center justify-center">
                                                <input 
                                                    type="checkbox" 
                                                    class=" custom-checkbox appearance-none w-6 h-6 mt-1 rounded-full checkbox checked:border-transparent focus:outline-none cursor-pointer ischeck${element.id}" 
                                                    ${ischeck} 
                                                    data-id="${element.id}" 
                                                    data-check="${element.checked}"
                                                >
                                            </div>


                                            <!-- Task Name + Sub Info -->
                                            <div class="flex flex-col">
                                            <span class="text-[16px] font-medium text-gray-900 ${taskNameSpan}" data-id="${element.list_id}">
                                                ${element.task_name}
                                            </span>
                                            <span class="text-sm text-gray-500 mt-0.5 h-5">${subText}</span>
                                            </div>
                                        </div>

                                        <!-- Right Side: Star -->
                                        <div class="flex items-center space-x-2 ml-4">
                                            <span class="${isimp} text-lg star isImp${element.id}" data-id="${element.id}" data-imp="${element.important}">
                                            <i class="fas fa-star"></i>
                                            </span>
                                        </div>
                                    </div>

                    `;
                if (element.checked == 1) {
                    iscompleteTask += taskTemplate;
                    completedCount++

                } else {
                    html += taskTemplate;
                }
            });

            if (iscompleteTask === "") {
                $('#completeHeader').addClass('hidden');

            } else {
                $('#completeHeader').removeClass('hidden');
            }
            $('#taskListContainer').append(html);
            $('#completeTask').append(iscompleteTask);
            $('#checkedCount').text(completedCount)

        }

        $(document).on('click', '#completeHeader', function () {

            if ($('#completeTask').hasClass('hidden')) {
                $('#completeTask').removeClass('hidden');
                $('#downIcon').removeClass('hidden');
                $('#rightIcon').addClass('hidden');
            } else {
                $('#completeTask').addClass('hidden');
                $('#downIcon').addClass('hidden');
                $('#rightIcon').removeClass('hidden');
            }
        })

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
            let taskid = $(".contextMenu").attr("data-id");

            // $(".contextMenu").fadeOut("fast");
            if (!taskid) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Error: No List ID found!",
                });
                return;
            }
            $(".contextMenu").addClass("hidden  ");
            Swal.fire({
                title: "Are you sure?",
                text: `You want to be delete this task ${taskid}!`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                // $(".contextMenu").remove()
                if (result.isConfirmed) {
                    $.ajax({
                        url: "./congfig/server.php", // Corrected URL
                        type: "post",
                        data: { deleteTask: true, id: taskid },
                        success: function (response) {
                            let arr = JSON.parse(response);
                            console.log(arr);

                            if (arr.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Task has been deleted.",
                                    icon: "success",
                                    timer: 2000, // Auto-close after 2 seconds
                                    showConfirmButton: false
                                });
                                //  Close sidebar if open
                                activeTaskId === taskid
                                if (activeTaskId === taskid) {
                                    if ($(".manageSection").attr("is_open") === "1") {
                                        $(".sidebar-Menu").fadeOut();
                                        $(".manageSection")
                                            .removeClass("w-3/5")
                                            .addClass("w-4/5")
                                            .attr("is_open", "0");
                                        $('.sidebar').removeClass('bg-gray-200').addClass('bg-white');
                                        activeTaskId = null;
                                    }
                                }
                                let activeList = $('.activeList').attr('data-id');
                                getTasks(activeList); // Refresh task list
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
        // right sidebar logic .........................................
        // Active task ID ko globally store karne ke liye variable
        let activeTaskId = null; // Store currently active task's ID
        // Jab kisi task (sidebar element) par click hota hai
        $(document).on('click', '.sidebar', function (e) {
            // Agar context menu active hai, fristclick pe comtextMenu ko close 
            if ($(".contextMenu").hasClass("active")) {
                $(".contextMenu").removeClass("active").addClass("hidden");
                return;
            }
            // Current clicked task ka ID lo
            const clickedId = $(this).attr("data-id");
            // Sidebar ka current state (open/close) check karo
            let is_open = $('.manageSection').attr("is_open");
            // Agar sidebar abhi band hai
            if (is_open == "0") {
                // Sidebar ko dikhayein
                $(".sidebar-Menu").fadeIn();
                // Sidebar width chhoti karo aur status update karo
                $(".manageSection").removeClass("w-4/5").addClass("w-3/5").attr("is_open", "1");
                // Pehle sabhi tasks ko white background do
                $('.sidebar').removeClass('bg-gray-200').addClass('bg-white');
                // Clicked task ko gray background do (highlight)
                $(this).removeClass('bg-white').addClass('bg-gray-200');
                // Active task ID set karo
                activeTaskId = clickedId;

            } else {
                // Agar sidebar already open hai
                if (activeTaskId === clickedId) {
                    // Agar wahi task dobara click kiya gaya
                    // Sidebar ko hide karo
                    $(".sidebar-Menu").fadeOut();
                    // Sidebar width wapas original karo aur status update
                    $(".manageSection").removeClass("w-3/5").addClass("w-4/5")
                        .attr("is_open", "0");
                    // Sabhi tasks ko white background do
                    $('.sidebar').removeClass('bg-gray-200').addClass('bg-white');
                    // Active task ID reset karo
                    activeTaskId = null;
                } else {
                    // Agar kisi aur task par click kiya gaya
                    // Sabhi tasks ko white background do
                    $('.sidebar').removeClass('bg-gray-200').addClass('bg-white');
                    // Clicked task ko highlight karo
                    $(this).removeClass('bg-white').addClass('bg-gray-200');
                    // Active task ID update karo
                    activeTaskId = clickedId;
                }
            }
            // Click ka propagation roko taaki kisi outer element par click event na jaaye
            e.stopPropagation();
        });


        // **Checkbox aur delete button click pe sidebar event na ho**
        $(document).on('click', 'input[type="checkbox"], .star,.defaultList', function (e) {
            e.stopPropagation();
        });
        // jb loginUser pe click ho to manageAcount toggle ho
        $(document).on('click', '.loginUser', function () {
            $('.manageAcount ').toggle('hidden')
        });
        // **Context menu open logic**..........................................................
        $(document).on('contextmenu', '.rightClick', function (e) {
            e.preventDefault(); // Default right-click menu ko disable kar diya

            let menu1 = $(this).find('.contextMenu');

            // Agar context menu already active hai, to usko band kar do
            if (menu1.hasClass("active")) {
                $(".contextMenu").removeClass("active").addClass("hidden"); // Sabhi menus ko hide karo
                e.stopPropagation(); // Event ko aur aage propagate hone se roko
            } else {
                // Sidebar toggle karne ka function call karo (agar koi sidebar open/close karna ho)
                $(".sidebar-Menu").toggleClass("open");
            }

            // Pehle sabhi context menus ko hide kar do (agar pehle se open ho koi aur)
            // $(".contextMenu").removeClass("active").addClass("hidden"); // Ye line commented hai abhi

            let itemId = $(this).data("id"); // Right clicked item ka ID fetch karo

            let menu = $('.contextMenu'); // Context menu element

            // Window aur mouse ki position le lo
            let windowHeight = $(window).height(); // Puri window ki height
            let menuHeight = menu.outerHeight();   // Context menu ki height
            let clickY = e.pageY; // Mouse click ki Y position

            // Agar niche jagah kam hai, to menu upar khulega
            let topPosition = (clickY + menuHeight > windowHeight) ? (clickY - menuHeight) : clickY;

            // Context menu ko show karo sahi position par
            menu.addClass('active').removeClass('hidden').css({
                top: topPosition + "px",
                left: e.pageX + "px"
            }).attr("data-id", itemId); // Us item ka ID bhi attach kar diya

            e.stopPropagation(); // Context menu ka propagation roko taaki dusre elements trigger na ho
        });


        // **Jab kahi aur click ho, tab context menu band ho jaye**
        $(document).on("click", function () {
            $(".contextMenu").removeClass("active").addClass("hidden");


        });

        // **Agar rightClick pe click karein to context menu band ho, lekin sidebar toggle ho**
        // $(document).on("click", ".rightClick", function (e) {
        //     let menu = $(this).find('.contextMenu');

        //     // Agar context menu already active hai, to close kar do
        //     if (menu.hasClass("active")) {
        //         $(".contextMenu").removeClass("active").addClass("hidden");
        //     } else {
        //         //  Sidebar toggle karne ka function call karo
        //         $(".sidebar-Menu").toggleClass("open");
        //     }

        //     e.stopPropagation();
        // });

        // **Context menu ke andar click karne pe kuch na ho**
        $(document).on("click", ".contextMenu", function (e) {
            e.stopPropagation();
        });

        // **Sidebar ka event tabhi chale jab context menu active na ho**
        // $(document).on("click", ".rightClick", function (e) {
        //     if ($(".contextMenu").hasClass("active")) {
        //         return false; // Sidebar event trigger hone se rokta hai

        //     }
        //     e.stopPropagation();
        // });

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
                        // let filteredList = array.list.filter(item => item.is_default == 0);

                        // if (filteredList.length > 0) {
                        // }
                        renderlist(array.list);
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
                                <li class="p-1 mr-2     cursor-pointer flex items-center list-item hover:bg-rose-600" data-id="${element.id} ">
                                    <i class="fa-solid fa-bars  text-blue-300 mr-2"></i>
                                    <span class=" list-text ${span} px-1  py-1 listSpan listSpan${element.id} ">
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
            // alert(deleteListId)
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

        $(document).on("click", ".defaultList ", function () {
            // Pehle sabhi list items se active class hatao
            $(".defaultList").removeClass("activeList bg-rose-500 text-white font-bold");
            // Ab jispe click kiya hai usko active class add karo
            $(this).addClass("activeList bg-rose-500 text-white font-bold");
            let Id = $(this).attr("data-id")
            getTasks(Id)
            let listid = $(this).attr("data-id")
            if (listid == "complete" || listid == "Assigned") {
                $("#task_form").hide()
            } else {
                $("#task_form").show()
            }
            // let listName = $(this).attr("data-name");
            let iconClass = $(this).attr("data-icon");
            // alert(iconClass);
            $("#activeListName").html(` <i class="${iconClass}"> </i>${Id} `);
            let randomColor = getRandomColor();
            $('.changeColor').css('background-color', randomColor);
            document.documentElement.style.setProperty('--checkbox-color', randomColor);
            function getRandomColor() {
                let letters = '0123456789ABCDEF';
                let color = '#';
                for (let i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                // let opacityHex = '80'; // 40% opacity (66 in hex)
                // return color + opacityHex;   
                return color
            }


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
                        let activeList = $('.activeList').attr('data-id')
                        getTasks(activeList)

                    }
                }
            });
        });
        $(document).on("click", ".checkbox", function () {
            let check = $(this);
            let checkboxId = check.attr("data-id");

            let checkValue = check.attr("data-check");
            // console.log(checkValue)
            let newcheckValue;
            if (checkValue == 0) {
                newcheckValue = 1;
            } else {
                newcheckValue = 0;
            }

            $.ajax({
                url: "./congfig/server.php",
                type: "post",
                data: { ischecked: true, id: checkboxId, checkedTask: newcheckValue },
                success: function (response) {
                    let arr = JSON.parse(response);
                    // console.log(arr)

                    if (arr.success) {
                        let listId = $('.activeList').attr('data-id')
                        // console.log(listId)
                        getTasks(listId)

                    }
                    // if (arr.completedCount) {
                    //     $('#checkedCount').text(arr.completedCount);
                    // }
                }

            })
        })

        // $(document).on("change", ".checkbox", function () {
        //     let taskText = $(this).next("span");
        //     let taskId = $(".complete").attr("data-id");
        //     // alert(taskId)
        //     if ($(this).prop("checked")) {
        //         taskText.css("text-decoration", "line-through");
        //         $(".complete" + taskId).removeClass("hidden");
        //     } else {
        //         $(".complete" + taskId).addClass("hidden");
        //         taskText.css("text-decoration", "none");
        //     }

        // });
        $(document).ready(function () {
            // Open Modal
            $("#openModal").click(function () {
                $(".manageAcount").css('display', 'none')
                $("#modalBg").removeClass("hidden"); // Show background
                $("#modalBox").removeClass("opacity-0 scale-95").addClass("opacity-100 scale-100"); // Animate modal
            });

            // Close Modal
            $("#closeModal").click(function (e) {
                if (e.target !== this) return; // Prevent closing when clicking inside modal
                $("#modalBox").removeClass("opacity-100 scale-100").addClass("opacity-0 scale-95"); // Animate close
                setTimeout(() => $("#modalBg").addClass("hidden"), 300); // Hide background after animation
            });
        });

        $(document).ready(function () {
            $('#toggleSidebar').click(function () {
                $('#leftSidebar').toggleClass('-translate-x-full');
            });

            // Optional: Close sidebar if user clicks outside it (on small screens)
            $(document).click(function (e) {
                if ($(window).width() <= 768) {
                    if (!$(e.target).closest('#leftSidebar, #toggleSidebar').length) {
                        $('#leftSidebar').addClass('-translate-x-full');
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