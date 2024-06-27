<?php 

    include ('config/db_connect.php');

    $sql = 'SELECT * FROM data ORDER BY roll';

    $result = mysqli_query($conn,$sql);

    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    

    if(isset($_POST['delete'])){

        $roll_to_delete = mysqli_real_escape_string($conn, $_POST['roll_to_delete']);

        $sql = "DELETE FROM data WHERE roll = '$roll_to_delete'";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else {
            echo 'query error: '. mysqli_error($conn);
        }

    }

    $value_to_search = '';

    if(isset($_POST['search'])){
        $value_to_search = mysqli_real_escape_string($conn, $_POST['value_to_search']);

        $sql = "SELECT * FROM data WHERE name LIKE '%$value_to_search%' OR roll LIKE '%$value_to_search%' OR department LIKE '%$value_to_search%' OR hostel LIKE '%$value_to_search%' ORDER BY roll ";

        $result = mysqli_query($conn,$sql);

        $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

        mysqli_free_result($result);
    }

    mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="style.css" />
    
</head>
<body> 

<nav class="w-full px-2 bg-teal-500">
    <div class="flex gap-x-96 justify-center items-center flex-col sm:flex-row">
        <div class="my-2 sm:my-4">
            <a href="index.php"><h1 class="text-2xl font-mono font-semibold text-gray-800 sm:text-3xl"><p class="drop-shadow-2xl">AcadHub</p></h1></a>
        </div>
        <div class="w-48 mb-2 sm:w-48 md:w-64 lg:w-80">
            <form action="index.php" method="POST" class="flex  rounded-full">
                <input name="value_to_search" type="text" placeholder="Search" class="bg-white w-full rounded-l-full px-4 py-1 text-sm text-gray-700 focus:outline-none" value="<?php echo htmlspecialchars($value_to_search) ?>" autocomplete="off">
                <button class="rounded-r-full py-1 px-2 text-sm focus:outline-none bg-white flex items-center" type="submit" name="search" ><span class='material-symbols-outlined text-teal-500'>search</span></button>
            </form>
        </div>
    </div>
</nav>

    <div class="mt-10 mx-5 sm:mx-10 lg:mx-16 flex justify-between items-center flex-col md:flex-row gap-x-16">
        <p class="text-sm text-gray-700 ">AcadHub is the student information management system of IIT Bombay. You can view, add, edit and delete all information relating to students.</p>
        
        <a href="add.php"><button class="bg-teal-500 px-5 py-3 rounded-lg text-sm w-full md:w-auto mt-5 md:mt-0 text-sky-50 hover:bg-teal-600 hover:text-gray-100 duration-300">Add</button></a>
        
    </div>

    <div class="shadow ring-1 ring-black ring-opacity-5 mx-5 mt-10 sm:mx-10 lg:mx-16 overflow-x-auto max-h-screen ">
        <table class="min-w-full divide-y divide-gray-300 relative" id="myTable">
            <thead class="bg-teal-500 sticky top-0 z-10">
                <tr class="">
                    <th class="py-3.5 pl-3 pr-3 text-left text-sm font-semibold text-gray-900 leading-7">
                        Name
                    </th>
                    <th class="py-3.5 pl-3 pr-3 text-left text-sm font-semibold text-gray-900">
                        Roll No. 
                    </th>
                    <th class="py-3.5 pl-3 pr-3 text-left text-sm font-semibold text-gray-900">
                        Department
                    </th>
                    <th class="py-3.5 pl-3 pr-3 text-left text-sm font-semibold text-gray-900">
                        Hostel 
                    </th>
                    <th class="py-3.5 pl-3 pr-3 text-left text-sm font-semibold text-gray-900">
                    </th>
                    
            </thead>
            <tbody class="divide-y divide-gray-200 backdrop-blur-xl">
                <?php foreach($students as $student): ?>
                <tr class="even:bg-transparent odd:bg-gray-50">
                    <td class="whitesapce-nowrap py-2 pl-4 pr-3 text-sm font-semibold text-gray-900 leading-7"><?php echo htmlspecialchars($student['name']) ?></td>
                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500"><?php echo htmlspecialchars($student['roll']) ?></td>
                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500"><?php echo htmlspecialchars($student['department']) ?></td>
                    <td class="whitespace-nowrap px-3 py-2 text-sm text-gray-500"><?php echo htmlspecialchars($student['hostel']) ?></td>
                    <td class="whitespace-nowrap pl-3 py-4 flex gap-2 flex justify-center items-center justify-center h-full leading-7">
                        <a href="edit.php?roll=<?php echo $student['roll'] ?>" class=" h-full text-sm text-teal-500 duration-300">Edit</a>
                        <form action="index.php" method="POST" class="h-full">
                            <input type="hidden" name="roll_to_delete" value="<?php echo $student['roll']; ?>">
                            <input type="submit" name="delete" value="Delete" class="text-sm text-teal-500 mr-1 h-full duration-300 cursor-pointer">
                        </form>
                    </td>
                </tr>    
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <div class="h-16"></div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({paging: false,
            searching: false,
            info: false,
            lengthChange: false
    });
} );
</script>
</body>
</html>