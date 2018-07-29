<?php
ob_start();
session_start();
$title = "African Roll Ball Federation";
$active = "players";
require_once 'partials/init.php';
if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {
    if (isset($_GET['action']) && $_GET['action'] === 'player') {
        $id = filter_var(intval($_GET['id']), FILTER_SANITIZE_NUMBER_INT);
        $query = $con->prepare("SELECT * FROM players WHERE id=?");
        $query->execute(array($id));
        if ($query->rowCount() > 0) {
            $player = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            ?>
            <div class="container pb-5">
                <div class="row">
                    <div class="card col-12">
                        <div class="row justify-content-center align-items-center no-gutters">
                            <img src="<?php echo $player['image'];?>" class="border-dark border rounded-circle my-3 card-img-top" style="max-width:18rem;" alt="Player Image">
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($player as $key=>$value) {
                                if (in_array(strtolower($key),['id', 'image'])) {
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
            header("Location: players.php");
            exit();
        }
    } else {
        ?>
                    <div class="container d-flex align-items-end flex-column " >
                        <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <select class="form-control" name="state">
                                <option selected value="null" >Select State</option>
                                <option value="alexandria">Alex</option>
                                <option value="cairo">Cairo</option>
                            </select>
                            <select class="form-control mx-1" name="gender">
                                <option selected value="null" >Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <select class="form-control mx-1" name="age">
                                <option selected value="null" >Select Age category</option>
                                <option value="kids"> less than 10 </option>
                                <option value="young">10-18</option>
                                <option value="adult">greater than 18 </option>
                            </select>
                            
                            <input type=submit class="form-control btn btn-secondary mx-1">
                        </form> 
                    </div>
        <?php
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $state =$_POST['state'];
            $gender =$_POST['gender'];
            $age =$_POST['age'];

            if ($state==='null'&&$gender==='null'&&$age==='null')
            {
                $query = $con->prepare("SELECT * FROM players");
            }
            else if($state!='null'&& $gender==='null' &&$age==='null')
            {
                $query = $con->prepare("SELECT * FROM players WHERE state='$state'");
            }
            else if($state==='null'&& $gender!='null' &&$age==='null')
            {
                $query = $con->prepare("SELECT * FROM players WHERE gendre='$gender'");

            }
            else if($state==='null'&& $gender==='null' &&$age!='null')
            {
                if ($age=='kids')
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age<10");
                }
                else if($age=='young')
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age BETWEEN 10 AND 18 ");
                }
                else
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age>18");
                }
            }
            else if($state!='null'&& $gender!='null' &&$age==='null')
            {
                $query = $con->prepare("SELECT * FROM players WHERE gendre='$gender' AND state='$state'");   
            }
            else if($state!='null'&& $gender==='null' &&$age!='null')
            {
                if ($age=='kids')
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age<10 AND state='$state'");
                }
                else if($age=='young')
                {
                    $query = $con->prepare("SELECT * FROM players WHERE state='$state' AND age BETWEEN 10 AND 18 ");
                }
                else
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age>18 AND state='$state'");
                }
            }
            else if($state==='null'&& $gender!='null' &&$age!='null')
            {
                if ($age=='kids')
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age<10 AND gendre='$gender'");
                }
                else if($age=='young')
                {
                    $query = $con->prepare("SELECT * FROM players WHERE gendre='$gender' AND age BETWEEN 10 AND 18 ");
                }
                else
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age>18 AND gendre='$gender'");
                }
            }
            else
            {
                if ($age=='kids')
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age<10 AND gendre='$gender' AND state='$state'");
                }
                else if($age=='young')
                {
                    $query = $con->prepare("SELECT * FROM players WHERE gendre='$gender' AND state='$state' AND age BETWEEN 10 AND 18 ");
                }
                else
                {
                    $query = $con->prepare("SELECT * FROM players WHERE age>18 AND gendre='$gender' AND state='$state' ");
                }
            }    
        }
        else
        {
            $query = $con->prepare("SELECT * FROM players");
        }
        $query->execute(array());
        if ($query->rowCount() > 0) { ?>
            <div class="container ">
                <div class="row py-5">
                    <?php
                    $players = $query->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <div class="col-12 py-5 d-flex align-items-center flex-column">
                      <h2 class="h1 text-center mb-5">All Players</h2>
                           
                        <div class="card " style="width:69rem;">
                              <ul class="list-group ">
                              <?php foreach ($players as $player) { ?>
                                <li class="lead font-weight-bold list-group-item">
                                      <div class="row no-gutters justify-content-between">
                                          <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=player&id=<?php echo $player['id']; ?>">
                                              <?php echo $player['name']; ?>
                                          </a>
                                          <div><img class="border border-dark rounded-circle" height="60"
                                                        src="<?php echo $player['image']; ?>" alt="Player Image"></div>
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
                    <h2 class="h1 pb-5">No Players Registered</h2>
                </div>
            </div>
            <?php  
        }
    }
}
require_once 'partials/footer.html';
ob_end_flush();
?>