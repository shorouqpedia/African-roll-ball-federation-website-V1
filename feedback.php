<?php
ob_start();
session_start();
$title = "African Roll Ball Federation";
$active = "messages";
require_once 'partials/init.php';
if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) 
{
    if (isset($_GET['action']) && $_GET['action'] === 'messages') 
    {
        $id = filter_var(intval($_GET['id']), FILTER_SANITIZE_NUMBER_INT);
        $query = $con->prepare("SELECT * FROM msgs WHERE id=?");
        $query->execute(array($id));
        if ($query->rowCount() > 0) {
            $msg = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            ?>
            <div class="container pb-5">
                <div class="row">
                    <div class="card col-12">
                        <div class="row justify-content-center align-items-center no-gutters">
                            <img src=" < ?php echo $msg['image'];?>" class="border-dark border rounded-circle my-3 card-img-top" style="max-width:18rem;" alt="Player Image">
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($msg as $key=>$value) {
                                if (in_array(strtolower($key),['id', 'name'])) {
                                    continue;
                                }
                                ?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 font-weight-bold">
                                            <?php echo ucfirst($key);?>
                                        </div>
                                        <div class="col-8">
                                            <?php echo $value;?>
                                        </div>
                                    </div>
                                </li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>

        <?php } else {
            header("Location: feedback.php");
            exit();
        }
    }
    
    if (isset($_GET['action']) && $_GET['action'] === 'delete') 
    {
    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = $con->prepare("DELETE FROM msgs WHERE id=?");
        $query->execute(array($id));
        if ($query->rowCount() > 0) { ?>
            <div class="container py-5 mb-5">
                <div class="alert alert-warning text-center py-1">
                    <h2 class="h1 pb-5">
                        Message Deleted Successfully.
                    </h2>
                    <p class="lead">You will be redirected in 2 seconds</p>
                </div>
            </div>
            <?php
            header("refresh:2;url=feedback.php");
            exit();
        } else {
            ?>
            <div class="container py-5 mb-5">
                <div class="alert alert-danger text-center py-1">
                    <h2 class="h1 py-5">
                        An Error has happened, Please try again.
                    </h2>
                </div>
            </div>
        <?php }
        }
    }
    
        else {
        $query = $con->prepare("SELECT * FROM msgs");
        $query->execute(array());
        if ($query->rowCount() > 0) { ?>
            <div class="container py-3">
                <div class="row py-2">
                    <?php
                    $msgs = $query->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="col-12 py-5">
                        <h2 class="h1 text-center mb-5">All Messages</h2>
                        
                        
                        
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <?php foreach ($msgs as $msg) { ?>
                                    <li class="lead font-weight-bold list-group-item">
                                        <div  class="row no-gutters justify-content-between align-items-center">
                                            <p>
                                                Name : <?php echo $msg['name']; ?>
                                            
                                                <br>Email : <?php echo $msg['email']; ?>
                                                <br>Message : <?php echo $msg['msg']; ?>
                                            </p>
                                <a href="<?php echo $_SERVER['PHP_SELF'];?>?action=delete&id=<?php echo $msg['id'];?>">
                                    <span class="btn btn-danger">Delete</span>
                                </a>                    
<!--
                                            <div><img class="border border-dark rounded-circle" height="60"
                                                      src="< ?php echo $msg['image']; ?>" alt="Player Image"></div>
-->
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="container py-5 mb-5 text-center">
                <div class="alert alert-warning py-1">
                    <h2 class="h1 pb-5">No Messages found</h2>
                </div>
            </div>
            <?php
        }
    }
}


    
    
require_once 'partials/footer.html';
ob_end_flush();
?>