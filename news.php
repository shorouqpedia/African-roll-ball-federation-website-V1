<?php
ob_start();
session_start();
$title = "News | African Roll Ball Federation";
$active = "news";
require_once 'partials/init.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $date = date('Y-m-d',strtotime(filter_var($_POST['date'], FILTER_SANITIZE_STRING)));
    $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
    $image = 'images/news/' . generateSerial() . '_' . $_FILES['img']['name'];
    move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . '/' . $image);
    $coverImg = 'images/news/' . generateSerial() . '_' . $_FILES['coverImg']['name'];
    move_uploaded_file($_FILES['coverImg']['tmp_name'], __DIR__ . '/' . $coverImg);
    $query = $con->prepare("INSERT INTO `news`(`title`,`description`, `image`,`cover`,`date`,`location`) VALUES (?,?,?,?,?,?)");
    $query->execute(array($title,$description, $image,$coverImg,$date,$location));
    if ($query->rowCount() > 0) { ?>
        <div class="container py-5 mb-5">
            <div class="alert alert-success text-center py-1">
                <h2 class="h1 pb-5">
                    Event Added Successfully.
                </h2>
                <p class="lead">You will be redirected in 2 seconds</p>
            </div>
        </div>
        <?php
        header("refresh:2;url=index.php");
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
} else {
    ?>
    <div class="container">
        <?php
        if (isset($_GET['action']) && isset($_SESSION['admin']) && $_SESSION['admin'] === 1 && $_GET['action'] === 'delete') {
            if (isset($_GET['id'])) {
                $id = filter_var(intval($_GET['id']), FILTER_SANITIZE_NUMBER_INT);
                $query = $con->prepare("DELETE FROM news WHERE id=?");
                $query->execute(array($id));
                if ($query->rowCount() > 0) { ?>
                    <div class="container py-5 mb-5">
                        <div class="alert alert-warning text-center py-1">
                            <h2 class="h1 pb-5">Event deleted Successfully.</h2>
                            <p class="lead">You will be redirected in 2 seconds</p>
                        </div>
                    </div>
                    <?php
                    header("refresh:2;url=news.php");
                } else {
                    ?>
                    <div class="container py-5 mb-5">
                        <div class="alert alert-danger text-center py-1">
                            <h2 class="h1 py-5">An Error has happened, Please try again.</h2>
                        </div>
                    </div>
                <?php }
            }
        } elseif (isset($_GET['action']) && isset($_SESSION['admin']) && $_SESSION['admin'] === 1 && $_GET['action'] === 'addnews') { ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
                <div class="container">
                    <h2 class="h1 text-center mb-5">Add News</h2>
                    <div class="form-group">
                        <input name="title" type="text" class="form-control" placeholder="Title"/>
                    </div>
                    <div class="form-group">
                        <input name="date" type="date" class="form-control" placeholder="MM/DD/YYYY"/>
                    </div>
                    <div class="form-group">
                        <input name="location" type="text" class="form-control" placeholder="Location"/>
                    </div>
                    <div class="form-group">
                        <textarea name="description" style="resize:vertical;" cols="30" rows="10" class="form-control"
                                  placeholder="Description"></textarea>
                    </div>
                    <div class="form-group mb-5">
                        <label class="control-label">Image</label>
                        <div class="custom-file">
                            <input name="img" type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <label class="control-label">Cover Image</label>
                        <div class="custom-file">
                            <input name="coverImg" type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group mb-5">
                        <input type="submit" value="Add News" class="btn btn-info mx-auto d-block">
                    </div>
                </div>
            </form>
        <?php } elseif (isset($_GET['id']) && is_numeric(intval($_GET['id']))) {
            $id = $_GET['id'];
            $query = $con->prepare("SELECT * FROM news WHERE id=?");
            $query->execute(array($id));
            if ($query->rowCount() > 0) {
                $new = $query->fetch(PDO::FETCH_ASSOC); ?>
                <section class="news-section mb-5">
                    <div class="card border-0">
                        <div class="card-title h1"><?php echo $new['title']; ?></div>
                        <div class="news-img" style="background-image:url(<?php echo $new['cover']; ?>)"></div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $new['description']; ?>...</p>
                            <div class="row text-center">
                                <span class="col card-text"><?php echo $new['location'];?></span>
                                <span class="col card-text"><?php echo $new['date'];?></span>
                                <?php if (isset($_SESSION['admin']) && intval($_SESSION['admin']) === 1) { ?>
                                    <a class="col" href="<?php echo $_SERVER['PHP_SELF'] ?>?action=delete&id=<?php echo $new['id']; ?>">
                                        <span class="btn btn-danger">Delete News</span>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php } else {
                header("Location: news.php");
                exit();
            }
        } else {
            $query = $con->prepare("SELECT * FROM news");
            $query->execute(array());
            if ($query->rowCount() > 0) {
                $news = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <h1 class="text-center mb-5">All News</h1>
                <section class="news-section mb-5">
                    <h2 class="my-4 h1">
                        <span class="badge badge-warning">New !</span>
                        <?php if (isset($_SESSION['admin']) && intval($_SESSION['admin']) === 1) { ?>
                            <a href="index.php?action=addnews">
                                <div class="btn btn-success">Add News</div>
                            </a>
                        <?php } ?>
                    </h2>
                    <div class="row">
                        <?php foreach ($news as $new) { ?>
                            <div class="col-12 col-sm-6 col-lg-3 mb-5">
                                <div class="card">
                                    <img class="card-img-top" src="<?php echo $new['image']; ?>"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo substr($new['description'], 0, 100); ?>...</p>
                                        <div class="card-text"><?php echo $new['location'];?></div>
                                        <div class="card-text"><?php echo $new['date'];?></div>
                                        <a href="news.php?id=<?php echo $new['id']; ?>" class="card-link">Read More.</a>
                                        <?php if (isset($_SESSION['admin']) && intval($_SESSION['admin']) === 1) { ?>
                                            <a href="<?php echo $_SERVER['PHP_SELF'] ?>?action=delete&id=<?php echo $new['id']; ?>">
                                                <span class="btn btn-danger">Delete News</span>
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </section>
            <?php } else { ?>
                <h2 class="my-4 h1 text-center">
                    <span class="badge badge-warning">No News Added.</span>
                    <?php if (isset($_SESSION['admin']) && intval($_SESSION['admin']) === 1) { ?>
                        <a href="index.php?action=addnews">
                            <div class="btn btn-success">Add News</div>
                        </a>
                    <?php } ?>
                </h2>
            <?php }
        } ?>
    </div>

    <?php
}
    require_once 'partials/footer.html';
    ob_end_flush();
?>