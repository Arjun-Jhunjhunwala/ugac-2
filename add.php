<?php 

    include 'config/db_connect.php';

    $name = $roll = $dept = $hostel = '';
    $errors = array('name'=>'','roll'=>'','dept'=>'','hostel'=>'');

    if (isset($_POST['submit'])){
        if (empty($_POST['name'])){
            $errors['name'] = 'A name is required';
        }else{
            $name = $_POST['name'];
            if(!preg_match('/^[a-zA-Z\s]*$/',$name)){
                $errors['name'] = 'Enter a valid name';
            }
        }

        if (empty($_POST['roll'])){
            $errors['roll'] = 'Roll no. is required';
        }else{
            $roll = $_POST['roll'];
            if(!preg_match('/^[A-Za-z0-9]+$/',$roll)){
                $errors['roll'] = 'Enter a valid roll no.';
            }
        }

        if (empty($_POST['dept'])){
            $errors['dept'] = 'The department is required';
        }else{
            $dept = $_POST['dept'];
            if(!preg_match('/^[a-zA-Z\s]*$/',$dept)){
                $errors['dept'] = 'Enter a valid department';
            }
        }

        if (empty($_POST['hostel'])){
            $errors['hostel'] = 'Hostel is required';
        }else{
            $hostel = $_POST['hostel'];
        }

        if(!array_filter($errors)){
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $roll = mysqli_real_escape_string($conn, $_POST['roll']);
            $dept = mysqli_real_escape_string($conn, $_POST['dept']);
            $hostel = mysqli_real_escape_string($conn, $_POST['hostel']);

            $sql = "INSERT INTO data(name,roll,department,hostel) VALUES('$name','$roll','$dept','$hostel')";

            if(mysqli_query($conn,$sql)){
                header('Location: index.php');
            }else{
                echo 'query error' . mysqli_error($conn);
            }
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
    <p class="text-center my-5 text-3xl text-gray-800 font-mono font-semibold">Add student</p>
    <div class="flex justify-center  ">
        <div class="backdrop-blur-lg p-10 sm:shadow rounded-lg">
        <form action="add.php" method="POST" class="w-48 sm:w-64  flex flex-col gap-6  ">
            <div class="flex flex-col w-full">
                <label class="text-gray-500 text-md" for="add-name">Name</label>
                <input class="border-b-2 border-gray-400 focus:outline-none text-sm py-1 bg-transparent text-gray-600" value="<?php echo htmlspecialchars($name) ?>" autocomplete="off" name="name" type="text" id="add-name">
                <div class="text-red-500 text-xs mt-1"><?php echo $errors['name']; ?></div>
            </div>
            <div class="flex flex-col w-full">
                <label class="text-gray-500 text-md" for="add-name">Roll No</label>
                <input class="border-b-2 border-gray-400 focus:outline-none text-sm py-1 bg-transparent text-gray-600" value="<?php echo htmlspecialchars($roll) ?>" autocomplete="off" name="roll" type="text" id="add-name">
                <div class="text-red-500 text-xs mt-1"><?php echo $errors['roll']; ?></div>
            </div>
            <div class="flex flex-col w-full">
                <label class="text-gray-500 text-md" for="add-name">Department</label>
                <select class="border-b-2 border-gray-400 focus:outline-none text-sm py-1 bg-transparent text-gray-600" name="dept" id="add-dept">
                    <option value="Aerospace Engineering">Aerospace Engineering</option>
                    <option value="Chemical Engineering">Chemical Engineering</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                    <option value="Computer Science and Engineering">Computer Science and Engineering</option>
                    <option value="Environmental Science and Engineering">Environmental Science and Engineering</option>
                    <option value="Electrical Engineering">Electrical Engineering</option>
                    <option value="Energy Science and Engineering">Energy Science and Engineering</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Metallurgical Engineering and Materials Science">Metallurgical Engineering and Materials Science</option>
                </select>
                <div class="text-red-500 text-xs mt-1"><?php echo $errors['dept']; ?></div>
            </div>
            <div class="flex flex-col w-full">
                <label class="text-gray-500 text-md" for="add-name">Hostel</label>
                <select class="border-b-2 border-gray-400 focus:outline-none text-sm py-1 bg-transparent text-gray-600" name="hostel" id="add-hostel">
                    <option value="Hostel 1">Hostel 1</option>
                    <option value="Hostel 2">Hostel 2</option>
                    <option value="Hostel 3">Hostel 3</option>
                    <option value="Hostel 5">Hostel 5</option>
                    <option value="Hostel 6">Hostel 6</option>
                    <option value="Hostel 9">Hostel 9</option>
                    <option value="Hostel 15">Hostel 15</option>
                    <option value="Hostel 16">Hostel 16</option>
                    <option value="Hostel 17">Hostel 17</option>
                    <option value="Hostel 18">Hostel 18</option>
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