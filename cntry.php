<?php
ob_start();
session_start();
$title = "African Roll Ball Federation";
$active = "Country";
require_once 'partials/init.php';

$country = $_GET['cntry'];
$query = $con->prepare("SELECT * FROM gallery WHERE country='$country'");
$query->execute(array());
if($query->rowCount() == 0){?>
        <div class="container py-5 mb-5 text-center">
            <div class="alert alert-warning py-5">
                <h2 class="h1 pb-5">No Pictures founded for this country</h2>
            </div>
        </div>

<?php
}
if($query->rowCount() > 0){
    $images = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($images as $image) {?>
        <div class="container py-3">
            <div class="col-12 col-sm-6 col-md-4 col-lg-6 mb-4 ">
                <div class="card">
                    <img class="card-img-top" src="<?php echo $image['image'];?>" alt="Gallery Image">
                </div>
            </div>
        </div>
        <?php
                                }
                            }
require_once 'partials/footer.html';
ob_end_flush();
?>