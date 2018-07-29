<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {}else{

        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING);
        $query = $con-> prepare("INSERT INTO `msgs`(`name`, `email`, `msg`) VALUES (?,?,?)");
        $query->execute(array($name, $email,$msg));
            if ($query->rowCount() > 0)         
                $data = $query->fetchAll(PDO::FETCH_ASSOC)[0];
                
                header('Location:index.php');
                exit();
    print_r($_POST);

}


print_r($_POST);

?>