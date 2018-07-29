<?php
ob_start();
session_start();
$title = "African Roll Ball Federation";
$active = "gallery";
require_once 'partials/init.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $errors = 0;
    foreach($_FILES as $img) {
        $image = 'images/news/' . generateSerial() . '_' . $img['name'];
        $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
        move_uploaded_file($img['tmp_name'], __DIR__ . '/' . $image);
        $query = $con->prepare("INSERT INTO `gallery`(`image`,`country`) VALUES (?,?)");
        $query->execute(array($image,$country));
        if (!($query->rowCount() > 0)) {
            $errors++;
        }
    }
    if ($errors === 0) { ?>
        <div class="container py-5 mb-5">
            <div class="alert alert-success text-center py-1">
                <h2 class="h1 pb-5">
                    Images Added Successfully.
                </h2>
                <p class="lead">You will be redirected in 2 seconds</p>
            </div>
        </div>
        <?php
        header("refresh:2;url=gallery.php");
        exit();
    } else {
        ?>
        <div class="container py-5 mb-5">
            <div class="alert alert-danger text-center py-1">
                <h2 class="h1 py-5">
                    Error uploading <?php echo $errors;?> has happened, Please try again.
                </h2>
            </div>
        </div>
    <?php }
} elseif (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_SESSION['admin']) && intval($_SESSION['admin']) === 1) { ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="py-5" method="post" enctype="multipart/form-data">
        <div class="container py-4">
            <div class="form-group">
                <input type="file" class="form-control" name="image_1">
            </div>      
            <div class="form-group">
                <select class="form-control" name="country">
                    <option selected value="">Choose Country</option>
                    <option value="egypt">Egypt</option>
                    <option value="kenya">Kenya</option>
                    <option value="ghana">Ghana</option>
                    <option value="tanzania">Tanzania</option>
                    <option value="uganda">Uganda</option>
                    <option value="guyana">Guyana</option>
                    <option value="guinea">Guinea</option>
                    <option value="mali">Mali</option>
                    <option value="rwanda">Rwanda</option>
                    <option value="benin">Benin</option>
                    <option value="sengal">Sengal</option>
                    <option value="sudan">Sudan</option>
                    <option value="zimbabwe">Zimbabwe</option>
                    <option value="ivory">Ivory Coast</option>
                
                </select>
            </div>
            <div class="form-group">
                <input class="btn btn-primary" type="submit" value="Insert Pictures">
                <div class="btn btn-success" id="addPic">Another Picture</div>
            </div>
        </div>
    </form>
    <script>
        document.body.onload = function () {
            $('#addPic').on('click', function () {
                var mainInput = $(this).parent().siblings().eq(0),
                    nameNumber = mainInput.siblings().length + 1;
                mainInput.after($('<div class="form-group"><input type="file" class="form-control" name="image_' + nameNumber + '"></div>'));
            });
        }
    </script>
<?php } elseif (isset($_SESSION['admin']) && intval($_SESSION['admin'])===1 && isset($_GET['action']) && $_GET['action'] === 'delete') {
    if(isset($_GET['id'])) {
        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
        $query = $con->prepare("DELETE FROM gallery WHERE id=?");
        $query->execute(array($id));
        if ($query->rowCount() > 0) { ?>
            <div class="container py-5 mb-5">
                <div class="alert alert-warning text-center py-1">
                    <h2 class="h1 pb-5">
                        Images Deleted Successfully.
                    </h2>
                    <p class="lead">You will be redirected in 2 seconds</p>
                </div>
            </div>
            <?php
            header("refresh:2;url=gallery.php");
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
    header("Location: index.php");
    exit();
} else {
    $query = $con->prepare("SELECT * FROM gallery");
    $query->execute(array());
    if ($query->rowCount() > 0) { ?>
        <div class="container py-3">
            
                                    
            <div class="container text-center py-5 ">                        
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {?>            
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=add">
                        <div class="btn btn-warning btn-lg">Add Picture</div>
                    </a>
                <?php }?>   
            </div>

            
            <div class="row py-5"> 
                <?php
                    $images = $query->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($images as $image) {
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo $image['image'];?>" alt="Gallery Image">
                        <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {?>
                            <div class="card-body">
                                <a href="<?php echo $_SERVER['PHP_SELF'];?>?action=delete&id=<?php echo $image['id'];?>">
                                    <span class="btn btn-danger">Delete</span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                        <?php } ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="container py-5 mb-5 text-center">
            <div class="alert alert-warning py-1">
                <h2 class="h1 pb-5">No Pictures Added</h2>
            </div>

                <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] === 1) {?>            
                    <a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=add">
                        <div class="btn btn-warning btn-lg">Add Picture</div>
                    </a>
                <?php } ?>

        </div>
        <?php
    }
}
require_once 'partials/footer.html';
ob_end_flush();
?>