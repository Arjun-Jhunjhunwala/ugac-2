<?php 

include 'config/db_connect.php';

$name = $roll = $dept = $hostel = '';

if (isset($_GET['roll'])){
    $roll = mysqli_real_escape_string($conn, $_GET['roll']);

    $sql = "SELECT * FROM data WHERE roll = '$roll'";

    $result = mysqli_query($conn, $sql);

    $student = mysqli_fetch_assoc($result);

    $name = $student['name'];
    $dept = $student['department'];
    $hostel = $student['hostel'];

    mysqli_free_result($result);
}

$errors = array('name'=>'','dept'=>'','hostel'=>'');

if (isset($_POST['submit'])){
    if (empty($_POST['name'])){
        $errors['name'] = 'A name is required';
    } else {
        $name = $_POST['name'];
        if(!preg_match('/^[a-zA-Z\s]*$/',$name)){
            $errors['name'] = 'Enter a valid name';
        }
    }

    if (empty($_POST['dept'])){
        $errors['dept'] = 'The department is required';
    } else {
        $dept = $_POST['dept'];
        if(!preg_match('/^[a-zA-Z\s]*$/',$dept)){
            $errors['dept'] = 'Enter a valid department';
        }
    }

    if (empty($_POST['hostel'])){
        $errors['hostel'] = 'Hostel is required';
    } else {
        $hostel = $_POST['hostel'];
    }

    if(!array_filter($errors)){
        include 'config/db_connect.php'; // Reopen the connection

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $dept = mysqli_real_escape_string($conn, $_POST['dept']);
        $hostel = mysqli_real_escape_string($conn, $_POST['hostel']);
        $roll = mysqli_real_escape_string($conn, $_POST['roll']);

        $sql = "UPDATE data SET name='$name', department='$dept', hostel='$hostel' WHERE roll='$roll'";

        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body> 

<nav class="w-full px-2 bg-teal-500">
    <div class="flex gap-x-96 justify-center items-center flex-col sm:flex-row">
        <div class="my-2 sm:my-4">
            <a href="index.php"><h1 class="text-2xl font-mono font-semibold text-gray-800 sm:text-3xl"><p class="drop-shadow-2xl">AcadHub</p></h1></a>
        </div>
        <div class="w-48 mb-2 sm:w-48 md:w-64 lg:w-80">
            <form action="index.php" method="POST" class="flex hidden rounded-full">
                <input name="value_to_search" type="text" placeholder="Search" class="bg-white w-full rounded-l-full px-4 py-1 text-sm text-gray-700 focus:outline-none" value="<?php echo htmlspecialchars($value_to_search) ?>" autocomplete="off">
                <button class="rounded-r-full py-1 px-2 text-sm focus:outline-none bg-white flex items-center" type="submit" name="search" ><span class='material-symbols-outlined text-teal-500'>search</span></button>
            </form>
        </div>
    </div>
</nav>
    <p class="text-center my-5 text-3xl text-gray-800 font-mono font-semibold">Edit student</p>
    <div class="flex justify-center w-full">
        <div class="backdrop-blur-lg p-10 sm:shadow rounded-lg">
        <form action="edit.php?roll=<?php echo $roll; ?>" method="POST" class="w-48 sm:w-64 flex flex-col gap-6">
            <div class="flex flex-col w-full">
                <label class="text-gray-500 text-md" for="add-name">Name</label>
                <input class="border-b-2 border-gray-400 focus:outline-none text-sm py-1 bg-transparent text-gray-600" value="<?php echo htmlspecialchars($name) ?>" autocomplete="off" name="name" type="text" id="add-name">
                <div class="text-red-500 text-xs mt-1"><?php echo $errors['name']; ?></div>
            </div>
            <div class="flex flex-col w-full">
                <label class="text-gray-500 text-md" for="add-roll">Roll No</label>
                <input disabled class="bg-transparent border-b-2 border-gray-400 focus:outline-none bg-transparent text-sm py-1 text-gray-950 cursor-not-allowed" value="<?php echo htmlspecialchars($roll) ?>" autocomplete="off" name="roll" type="text" id="add-roll">
                <input type="hidden" name="roll" value="<?php echo htmlspecialchars($roll) ?>">
            </div>
            <div class="flex flex-col w-full">
                <label class="text-gray-500 text-md" for="add-dept">Department</label>
                <select class="border-b-2 border-gray-400 focus:outline-none text-sm py-1 bg-transparent text-gray-600"  name="dept" id="add-dept">
                    <option value="Aerospace Engineering"<?php if ($dept == 'Aerospace Engineering') echo 'selected'; ?>>Aerospace Engineering</option>
                    <option value="Chemical Engineering"<?php if ($dept == 'Chemical Engineering') echo 'selected'; ?>>Chemical Engineering</option>
                    <option value="Civil Engineering"<?php if ($dept == 'Civil Engineering') echo 'selected'; ?>>Civil Engineering</option>
                    <option value="Computer Science and Engineering"<?php if ($dept == 'Computer Science and Engineering') echo 'selected'; ?>>Computer Science and Engineering</option>
                    <option value="Environmental Science and Engineering"<?php if ($dept == 'Environmental Science and Engineering') echo 'selected'; ?>>Environmental Science and Engineering</option>
                    <option value="Electrical Engineering"<?php if ($dept == 'Electrical Engineering') echo 'selected'; ?>>Electrical Engineering</option>
                    <option value="Energy Science and Engineering"<?php if ($dept == 'Energy Science and Engineering') echo 'selected'; ?>>Energy Science and Engineering</option>
                    <option value="Mechanical Engineering"<?php if ($dept == 'Mechanical Engineering') echo 'selected'; ?>>Mechanical Engineering</option>
                    <option value="Metallurgical Engineering and Materials Science"<?php if ($dept == 'Metallurgical Engineering and Materials Science') echo 'selected'; ?>>Metallurgical Engineering and Materials Science</option>
                </select>
                <div class="text-red-500 text-xs mt-1"><?php echo $errors['dept']; ?></div>
            </div>
            <div class="flex flex-col w-full">
                <label class="text-gray-500 text-md" for="add-hostel">Hostel</label>
                <select class="border-b-2 border-gray-400 focus:outline-none text-sm py-1 bg-transparent text-gray-600" name="hostel" id="add-hostel">
                    <option value="Hostel 1" <?php if ($hostel == 'Hostel 1') echo 'selected'; ?>>Hostel 1</option>
                    <option value="Hostel 2" <?php if ($hostel == 'Hostel 2') echo 'selected'; ?>>Hostel 2</option>
                    <option value="Hostel 3" <?php if ($hostel == 'Hostel 3') echo 'selected'; ?>>Hostel 3</option>
                    <option value="Hostel 5" <?php if ($hostel == 'Hostel 5') echo 'selected'; ?>>Hostel 5</option>
                    <option value="Hostel 6" <?php if ($hostel == 'Hostel 6') echo 'selected'; ?>>Hostel 6</option>
                    <option value="Hostel 9" <?php if ($hostel == 'Hostel 9') echo 'selected'; ?>>Hostel 9</option>
                    <option value="Hostel 15" <?php if ($hostel == 'Hostel 15') echo 'selected'; ?>>Hostel 15</option>
                    <option value="Hostel 16" <?php if ($hostel == 'Hostel 16') echo 'selected'; ?>>Hostel 16</option>
                    <option value="Hostel 17" <?php if ($hostel == 'Hostel 17') echo 'selected'; ?>>Hostel 17</option>
                    <option value="Hostel 18" <?php if ($hostel == 'Hostel 18') echo 'selected'; ?>>Hostel 18</option>
                </select>
                <div class="text-red-500 text-xs mt-1"><?php echo $errors['hostel']; ?></div>
            </div>
            <div class="flex flex-col w-full">
                <input type="submit" name="submit" value="Submit" class="hover:bg-teal-600 bg-teal-500 text-gray-100 py-1 w-full duration-300 rounded-full cursor-pointer">
            </div>
        </form>
        </div>
    </div>
    <div class="h-16"></div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>
