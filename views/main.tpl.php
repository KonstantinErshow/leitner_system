<!DOCTYPE html>
<html lang="ru" >

<head>

    <meta charset="utf-8">
    <base href="/leitner_system/">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $pageData['title']; ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/admin/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                
                            </div> 
                            <div class="lg-offset-6 col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Привет!</h1>

                                        <p><?php if (!empty($pageData['errorLog'])) :?>
                		<p><?php echo $pageData['errorLog']; ?> </p>
                	<?php endif; ?></p>
                                    </div>
                                    <form class="form-signin" id="form-signin" method="post">
                                        <div class="form-group">
                                            <input type="hidden" name="action" value="login">
                                            <input type="text" class="form-control" name="login"  id="login" placeholder="Введите логин" required >
                                        </div>
                                        <div class="form-group">
                                        	
                                            <input type="password" class="form-control form-control-user" name="password"
                                                id="password" placeholder="Введите пароль" required>
                                        </div>
                                       

                                         
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Войти
                                        </button>
                                        
                                    </form>
                                    <hr>
                                    
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Нет аккаунта? Создай!</h1>

                                        <form class="form-signin" id="form-reg" method="post" name="form-reg">
                                        <div class="form-group">
                                            
                                            <input type="hidden" name="action" value = "register">

                                            <?php if(!empty($pageData['regMessages'])): ?>
                                            <p><?php echo $pageData['regMessages']; ?></p>
                                        <?php endif;?>


                                        </div>
                                        <div class="form-group">
                                          
                                            <input type="text" name="fullName" class="form-control" id="regFullName" placeholder="Введите имя, фамилию">
                                        </div>
                                        <div class="form-group">
                                          <input type="text" name="login" class="form-control" id="regLogin" placeholder="Введите желаемый логин">
                                           </div>
                                          <div class="form-group">
                                          <input type="email" name="email" class="form-control" id="regEmail" placeholder="Введите ваш e-mail">
                                           </div>
                                          <div class="form-group">
                                          <input type="password" name="password" class="form-control" id="regPassword" placeholder="Введите пароль">
                                            
                                        </div>
                                       

                                         
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Зарегистрироваться
                                        </button>
                                        
                                    </form>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
	 
   
    <script src="js/script.js"></script>
    <!-- Bootstrap core JavaScript-->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	
    <!-- Custom scripts for all pages-->
    <script src="js/admin/sb-admin-2.min.js"></script>

</body>

</html>