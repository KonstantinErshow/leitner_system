<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?php echo $pageData['title']; ?>

	</title>
	<link rel="stylesheet" href="../leitner_system/css/bootstrap.min.css">
	<link rel="stylesheet" href="../leitner_system/css/fontawesome.min.css">
	<link rel="stylesheet" href="../leitner_system/css/style.css">
</head>
<body>

	<header></header>

	<div id="content">
			<div class="container">
    <div class="row ">
        <div class="col-sm-6 col-md-4 offset-md-4">
            <h1 class="text-center login-title">Вход в личный кабинет</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form class="form-signin" id="form-singin" method="post">
                	<?php if (!empty($pageData['error'])) :?>
                		<p><?php echo $pageData['error']; ?> </p>
                	<?php endif; ?>
                <input type="text" class="form-control" name="login"  id="login" placeholder="Логин" required >
                <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Войти</button>
             
               
                </form>
            </div>
    
        </div>
    </div>
</div>
	</div>

	<footer>
		
	</footer>

	<script src="../leitner_system/js/jquery.min.js"></script>
	<script src="../leitner_system/js/angular.min.js"></script>
	<script src="../leitner_system/js/bootstrap.min.js"></script>
	<script src="../leitner_system/js/script.js"></script>
	
</body>
</html>