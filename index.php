<?php
ob_start();
session_start();
$title = "African Roll Ball Federation";
$active = "home";
require_once 'partials/init.php';
 ?>
    <div class="container">
        <div id="slidercontainer">
            <div id="SliderOne" class="carousel slide" data-ride="carousel">
                <div class="overlay text-white w-100 position-absolute d-flex justify-content-center align-items-center flex-column text-center">
                    <h2 class="font-weight-bold mb-5">African Roll Ball Federation</h2>

                    <a class="btn btn-dark btn-lg text-white my-4" href="#touch">Get in touch</a>
                    <a class="btn btn-dark btn-lg text-white" href="register.php">Join us now</a>

                </div>
                <ol class="carousel-indicators">
                    <li data-target="#SliderOne" data-slide-to="0" class="active"></li>
                    <li data-target="#SliderOne" data-slide-to="1"></li>
                    <li data-target="#SliderOne" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
<!--                        <img class="d-block w-100" src="roll.jpg" alt="First slide">-->
                    </div>
                    <div class="carousel-item">
<!--                        <img class="d-block w-100" src="12645152_800727103390300_783724127642302295_n.jpg"                             alt="Second slide">-->
                    </div>
                    <div class="carousel-item">
<!--                        <img class="d-block w-100" src="http://picsum.photos/1920" alt="placeholder image">-->
                    </div>
                </div>
                <a class="carousel-control-prev" href="#SliderOne" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#SliderOne" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <?php
            $query = $con->prepare("SELECT * FROM news LIMIT 4");
            $query->execute(array());
            if ($query->rowCount() > 0) {
                $news = $query->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <section class="news-section mb-5">
                    <h2 class="my-4 h1">
                        <span class="badge badge-warning">New !</span>
                        <?php if (isset($_SESSION['admin']) && intval($_SESSION['admin']) === 1) { ?>
                            <a href="news.php?action=addnews">
                                <div class="btn btn-success">Add News</div>
                            </a>
                        <?php } ?>
                    </h2>
                    <div class="row">
                        <?php foreach ($news as $new) { ?>
                            <div class="col-12 col-sm-6 col-lg-3 mb-5">
                                <div class="card">
                                    <img class="card-img-top" src="<?php echo $new['image'];?>"
                                         alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-text"><?php echo substr($new['description'],0,100);?>...</p>
                                        <a href="news.php?id=<?php echo $new['id'];?>" class="card-link">Read More.</a>
                                    <?php if (isset($_SESSION['admin']) && intval($_SESSION['admin']) === 1) { ?>
                                        <a href="news.php?action=delete&id=<?php echo $new['id'];?>">
                                            <span class="btn btn-danger">Delete News</span>
                                        </a>
                                    <?php }?>
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
                        <a href="news.php?action=addnews">
                            <div class="btn btn-success">Add News</div>
                        </a>
                    <?php } ?>
                </h2>
            <?php } ?>

        <section class="members-section mb-5">
            <h2 class="h1 mb-5">MEMBERS</h2>
            <div class="row">
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src= "images/members/flag-of-Egypt.png" alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=egypt'> Egypt</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Kenya.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=kenya'>Kenya</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Benin.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=benin'>Benin</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Ghana.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=ghana'>Ghana</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Guinea.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=guinea'>Guinea</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Rwanda.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=rwanda'>Rwanda</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Senegal.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=sengal'>Sengal</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Sudan.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=sudan'>Sudan</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Tanzania.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=tanzania'>Tanzania</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Uganda.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=uganda'>Uganda</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Zimbabwe.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=zimbabwe'>Zimbabwe</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag-of-Mali.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=mali'>Mali</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/flag_of_guyana.png"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=guyana'>Guyana</a>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4 d-flex justify-content-center align-items-center">
                    <div class="contain">
                        <img src="images/members/ivory-coast-flag.jpg"
                             alt="Avatar" class="phto">
                        <div class="middle">
                            <a class="txt btn btn-dark" href='cntry.php?cntry=ivory'>Ivory Coast</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
    </div>
    <?php

require_once 'partials/footer.html';
ob_end_flush();
?>