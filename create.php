<?php
$servername='localhost';
$username='root';
$password='melvin123';
$database='students';

$connection=new mysqli($servername,$username,$password,$database);
    $first_name="";
    $last_name="";
    $email="";
    $password="";
    $successMessage="";
    $errorMessage="";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $first_name=$_POST["fname"];
        $last_name=$_POST["lname"];
        $email=$_POST["email"];
        $password=sha1($_POST["password"]);

        do{
                if(empty($first_name)||empty($last_name)||empty($email)||empty($password)){
                    $errorMessage="Error: Please Fill all the fields";
                    break;
                }
                $sql = "INSERT INTO class (first_name,last_name,email,password)". "VALUES('$first_name','$last_name','$email','$password')";
                $result=$connection->query($sql);
               if(!$result){
                $errorMessage="Invalid query: ".$connection->error;
                break;
               }

                $first_name="";
                $last_name="";
                $email="";
                $password="";
                $successMessage="Client added successfully!";
               
                header("location:/class_CRUD/index.php");
                exit;

        }while(false);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
</head>
<body>
    <div class="container my-5">
        <h2>New Student</h2>

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
                    <input type="text" class="form-control" name="password" value="<?php echo $password;?>">
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