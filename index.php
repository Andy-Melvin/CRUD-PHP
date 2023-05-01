<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
    <title>Student Information</title>
</head>
<body>
    <div class='container my-5'>
         <h2>List Of students & Information.</h2>
         <a href='/class_CRUD/create.php' class='btn btn-primary' role='button'>New client</a><br><br>
         <table class='table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername='localhost';
                $username='root';
                $password='melvin123';
                $database='students';

                $connection=new mysqli($servername,$username,$password,$database);

                if($connection->connect_error){
                    die('Connection failed: ' . $connection->connect_error);
                }
                $sql='SELECT * FROM class';
                $result=$connection->query($sql) ;
                if(!$result){
                    die('Invalid qudeleteery: '.$connection->error);
                };
                while($row=$result->fetch_assoc()){
                    echo "
                      <tr>
                    <td>$row[ID]</td>
                    <td>$row[first_name]</td>
                    <td>$row[last_name]</td>
                    <td>$row[email]</td>
                    <td>$row[password]</td>
                    <td>
                    <a href='/class_CRUD/edit.php?id=$row[ID]' class='btn btn-primary'>Update</a>
                    <a href='/class_CRUD/delete.php?id=$row[ID]' class='btn btn-danger'>Delete</a>
                    </td>
                </tr>
                    ";
                };
               ?>
            </tbody>
         </table>

         <a href='/class_CRUD/exportPDF.php' class='btn btn-primary' role='button'>Export PDF</a><br><br>
         <a href='/class_CRUD/exportCSV.php' class='btn btn-primary' role='button'>Export CSV</a><br><br>
    </div>
</body>
</html>