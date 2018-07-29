<?php
ob_start();
session_start();
$title = "Register";
$active = "register";
require_once 'partials/init.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = sha1(filter_var($_POST['password'], FILTER_SANITIZE_STRING));

        $query = $con->prepare("SELECT * FROM users WHERE email = ?");
        $query->execute(array($email));
        if ($query->rowCount() > 0) {
            $data = $query->fetchAll(PDO::FETCH_ASSOC)[0];
            if ($password === $data['password']) {
                $_SESSION['admin'] = 1;
            }
        }
        header('Location: index.php');
        exit();
    } else {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        if (!checkDB('players', 'email', $email)) {
            $gender = filter_var($_POST['gendre'], FILTER_SANITIZE_STRING);        
            $birthday = date(filter_var($_POST['birthdate'], FILTER_SANITIZE_STRING));
            $a = time()-strtotime($birthday);
            $age = floor($a/60/60/24/365.25);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $country = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
            if ($country === 'egypt') {
            	$state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
            }
            $state = isset($state) ? $state : 'null';
            $weight = filter_var(floatval($_POST['weight']), FILTER_SANITIZE_NUMBER_FLOAT);
            $tall = filter_var(floatval($_POST['tall']), FILTER_SANITIZE_NUMBER_FLOAT);
            $phone = filter_var(intval($_POST['phone']), FILTER_SANITIZE_NUMBER_INT);
            $image = 'images/players/' . generateSerial() . '_' . $_FILES['img']['name'];
            move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . '/' . $image);
            $query = $con->prepare("INSERT INTO `players` (`name`, `email`, `gendre`, `birthdate`,`age`, `country`, `state`,`address`, `weight`, `tall`, `phone`, `image`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
            $query->execute(array($name, $email, $gender, $birthday,$age, $country,$state, $address, $weight, $tall, $phone, $image));
            if ($query->rowCount() > 0) {
                header('Location:index.php');
                exit();
            }
        } else { ?>
            <div class="container py-5 mb-5">
                <div class="alert alert-danger text-center py-1">
                    <h2 class="h1 py-5">
                        Email Already Exists
                    </h2>
                </div>
            </div>
        <?php }
    }
} elseif (isset($_GET['action']) && $_GET['action']==='login') {?>
    <form id="loginForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="py-3">
        <div class="container">
            <div class="form-group">
                <label class="control-label">Email: </label>
                <input required data-check="[^A-Za-z0-9_@\\.\\-]" name="email" type="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group mb-5">
                <label class="control-label">Password: </label>
                <input required data-check="[^A-Za-z0-9_]" name="password" type="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group mb-5">
                <input type="submit" value="Login" class="btn btn-primary">
            </div>
        </div>
    </form>
    <script>
        document.body.onload = function () {
            var Form = $('#registerForm');
            Form.on('submit', function (e) {
                formValidation(e, e.target);
            });
        };
        function formValidation (e, F) {
            var errorInputs = validateInputs(F.id);
            if (errorInputs) {
                e.preventDefault();
            }
        }
        function validateInputs(Form) {
            var error = false;
            $('input[type="password"], input[type="email"]', $('#' + Form)).each(function () {
                var input = $(this),
                    regEx = input.data('check'),
                    v = input.val();
                if (v === '' || v.match(regEx)) {
                    input.addClass('border-danger');
                    error = true;
                } else {
                    input.removeClass('border-danger');
                }
            });
            return error;
        }
    </script>
<?php } else { ?>
    <div class="container pt-3 reg-form">
        <form class="col-12 col-sm-10 col-md-8 col-xl-6" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
              id="registerForm" name="registerForm" enctype="multipart/form-data">

            <div class="form-group">
                <label for="name" class="control-label">Name</label>
                <input required data-check="[^A-Za-z ]" id="name" name="name" type="text" class="form-control" placeholder="Your Name">
            </div>

            <div class="form-group">
                <label for="email" class="control-label">Email</label>
                <input required data-check="[^A-Za-z0-9_@\\.\\-]" id="email" name="email" type="email" class="form-control" placeholder="Your Email">
            </div>

            <div class="form-group">
                <label class="control-label">Gendre</label>
                <div class="row no-gutters justify-content-start">
                    <div class="form-check-inline">
                        <label class="form-check-label mr-2" for="exampleRadios1">
                            Male
                        </label>
                        <input data-check="[^A-Za-z]" id="exampleRadios1" class="form-check-input" type="radio" name="gendre" value="male"
                               checked>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label mr-2" for="exampleRadios2">
                            Female
                        </label>
                        <input data-check="[^A-Za-z]" class="form-check-input" type="radio" name="gendre" id="exampleRadios2" value="female">
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="birthdate" class="control-label">Birthdate</label>
                <input required name="birthdate" type="date" class="form-control">
            </div>
            <div class="form-group">
                <label for="country" class="control-label">Country</label>
                <select id="countrySelect" class="custom-select" name="country">
                    <option selected value="">Choose Your Country</option>
                    <option value="egypt">Egypt</option>
                    <option value="kenya">Kenya</option>
                    <option value="ghana">Ghana</option>
                    <option value="rwanda">Rwanda</option>
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
                    <option value="ivory coast">Ivory Coast</option>
                </select>
            </div>
	        <div class="form-group d-none" id="state">
		        <label class="control-label">State</label>
		        <div class="row no-gutters justify-content-start">
			        <div class="form-check-inline">
				        <label class="form-check-label mr-2" for="exampleRadios3">Alexandria</label>
				        <input data-check="[^A-Za-z]" id="exampleRadios3" class="form-check-input" type="radio" name="state" value="alexandria"
				               checked>
			        </div>
			        <div class="form-check-inline">
				        <label class="form-check-label mr-2" for="exampleRadios4">Cairo</label>
				        <input data-check="[^A-Za-z]" class="form-check-input" type="radio" name="state" id="exampleRadios4" value="cairo">
			        </div>
		        </div>
	        </div>

            <div class="form-group">
                <label for="address" class="control-label">Address</label>
                <input required data-check="[^A-Za-z0-9 ,\\-]" name="address" type="text" class="form-control" placeholder="Your Address">
            </div>
            <div class="form-group">
                <div class="form-inline mb-1">
                    <label for="weight" class="control-label ">Weight
                        <pre>   </pre>
                    </label>
                    <input required name="weight" data-check="[^0-9\\.]" type="number" class="form-control col-2" placeholder="gm">
                    <div class="input-group-append">
                        <div class="input-group-text">gm</div>
                    </div>
                </div>

                <div class="form-inline">
                    <label for="tall" class="control-label">Tall in cm
                        <pre> </pre>
                    </label>
                    <input required name="tall" data-check="[^0-9\\.]" type="number" class="form-control col-2" placeholder="cm">
                    <div class="input-group-append">
                        <div class="input-group-text">cm</div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="phone" class="control-label">Phone</label>
                <input required data-check="[^0-9\\+]" type="text" id="phone" placeholder="01xxxxxxxxx" name="phone" class="form-control">
            </div>

            <div class="form-group mb-4">
                <label class="control-label">Please attach your Photo</label>
                <div class="custom-file">
                    <input required name="img" type="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="form-group mb-5">
                <input type="submit" class="form-control btn btn-success" value="Sign Up">
            </div>

        </form>
    </div>
    <script src="validation.js"></script>
	<script>
		document.body.onload = function () {
			var selectBox = $("#countrySelect");
			selectBox.on('change', function () {
				if ($(this).val() === 'egypt') {
					$("#state").removeClass('d-none');
				} else {
					$('#state').addClass('d-none');
				}
			});
		}
	</script>
    <?php
}
require_once 'partials/footer.html';
ob_end_flush();
?>