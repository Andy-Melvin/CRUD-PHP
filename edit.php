<?php
$servername='localhost';
$username='root';
$password='melvin123';
$database='students';

$connection=new mysqli($servername,$username,$password,$database);
   $id="";
   $name="";
   $email="";
   $phone="";
   $address="";
   $successMessage="";
   $errorMessage="";

if($_SERVER['REQUEST_METHOD']=='GET'){

    if(!isset($_GET["id"])){
        header("location: /class_CRUD/index.php");
        exit;
    }
    $id=$_GET["id"];
    $sql="SELECT * FROM class WHERE ID=$id";
    $result=$connection->query($sql);
    $row=$result->fetch_assoc();
    if(!$row){
        header("location:/class_CRUD/index.php");
        exit;
    }
    $first_name=$row["first_name"];
    $last_name=$row["last_name"];
    $email=$row["email"];
    $password=$row["password"];
}else{
    $id=$_POST["id"];
    $first_name=$_POST["fname"];
    $last_name=$_POST["lname"];
    $email=$_POST["email"];
    $password=$_POST["password"];

    do {
        if(empty($id)||empty($first_name)||empty($email)||empty($last_name)||empty($password)){
            $errorMessage="Error: Please fill out all the fields";
            break;
        }
     $sql="UPDATE class SET first_name='$first_name',last_name='$last_name', email='$email',password='$password' "."WHERE id =$id";
     $result=$connection->query ($sql);

     if(!$result){
        $errorMessage="Invalid query: ".$connection->error;
        break;
       }
       $successMessage="Student;s INFO updated successfully!";
       header("location: /class_CRUD/index.php");
       exit;

    } while (true);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class INFO</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
</head>
<body>
    <div class="container my-5">
        <h2>Update Student INFO</h2>

          <?php
                if(!empty($errorMessage)){
                    echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button>
                 </div>
                    ";
                }          
          ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="fname" value="<?php echo $first_name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Last name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="lname" value="<?php echo $last_name;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="password" value="<?php echo $address;?>">
                </div>
            </div>

            <?php
              if(!empty($successMessage)){
                echo "
            <div class='row mb-3'>
                <div class='offset-sm-3 col-sm-3 d-grid'> 
                   <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='Close'></button>
                   </div>
                </div>
            </div>
                ";
              }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="/class_CRUD/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>