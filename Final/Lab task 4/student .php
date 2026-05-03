<!DOCTYPE html>
<html>
<head>
<title>Student Management</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Student Management System</h2>

<?php
$conn = new mysqli("localhost","root","","student_management");

$name = $email = $reg = $dept = "";

if(isset($_POST['add'])){
$name = $_POST['name'];
$email = $_POST['email'];
$reg = $_POST['reg'];
$dept = $_POST['dept'];

$conn->query("INSERT INTO students(name,email,registration_no,department)
VALUES('$name','$email','$reg','$dept')");

echo "<p>Student Added</p>";
}

if(isset($_GET['delete'])){
$id = $_GET['delete'];
$conn->query("DELETE FROM students WHERE id=$id");
echo "<p>Deleted</p>";
}

if(isset($_POST['update'])){
$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$dept = $_POST['dept'];

$conn->query("UPDATE students SET name='$name', email='$email', department='$dept' WHERE id=$id");

echo "<p>Updated</p>";
}

$editData = null;
if(isset($_GET['edit'])){
$id = $_GET['edit'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$editData = $result->fetch_assoc();
}
?>

<h3><?php echo $editData ? "Edit Student" : "Add Student"; ?></h3>

<form method="post">

<input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">

<input type="text" name="name" placeholder="Name"
value="<?php echo $editData['name'] ?? ''; ?>" required><br>

<input type="email" name="email" placeholder="Email"
value="<?php echo $editData['email'] ?? ''; ?>" required><br>

<?php if(!$editData){ ?>
<input type="text" name="reg" placeholder="Registration No" required><br>
<?php } ?>

<input type="text" name="dept" placeholder="Department"
value="<?php echo $editData['department'] ?? ''; ?>" required><br>

<input type="submit" name="<?php echo $editData ? 'update' : 'add'; ?>"
value="<?php echo $editData ? 'Update' : 'Add'; ?>">

</form>

<h3>Student List</h3>

<table border="1">
<tr>
<th>Name</th>
<th>Email</th>
<th>Reg No</th>
<th>Dept</th>
<th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT * FROM students");

while($row = $result->fetch_assoc()){
echo "<tr>
<td>".$row['name']."</td>
<td>".$row['email']."</td>
<td>".$row['registration_no']."</td>
<td>".$row['department']."</td>
<td>
<a href='?edit=".$row['id']."'>Edit</a> |
<a href='?delete=".$row['id']."'>Delete</a>
</td>
</tr>";
}
?>

</table>

</body>
</html>