<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Views/login.css">
    <title>Register</title>
</head>

<body>

<?php 
function registerPage()
{
?>

    <header>
        <div class="logo">Logo</div>
        <nav class="navigation">
            <a href="#">About</a>
            <a href="#">Concat</a>
        </nav>
    </header>

    <div class="wrapper">
        <div class="form-box register">
            <h2>Register</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><em class="fa fa-user"></em></span>
                    <input type="text" value="" name="name" id="name" autocomplete="off" required>
                    <label for="name">Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><em class="fa fa-lock"></em></span>
                    <input type="password" value="" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>
                <input type="submit" class="btn" value="Register">
                <div class="login-register">
                    <p>Hai gia un account? 
                    <a href="../Controller/Login.php">Accedi</a></p>
                </div>
            </form>
        </div>
    </div>
<?php     
}
function loginPage()
{
?>
        <header>
        <div class="logo">Logo</div>
        <nav class="navigation">
            <a href="#">About</a>
            <a href="#">Concat</a>
        </nav>
    </header>

    <div class="wrapper">
        <div class="form-box register">
            <h2>Login</h2>
            <form action="" method="post">
                <div class="input-box">
                    <span class="icon"><em class="fa fa-user"></em></span>
                    <input type="text" value="" name="name" id="name" autocomplete="off" required>
                    <label for="name">Username</label>
                </div>
                <div class="input-box">
                    <span class="icon"><em class="fa fa-lock"></em></span>
                    <input type="password" value="" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>
                <input type="submit" class="btn" value="Accedi">
                <div class="login-register">
                    <p>Sei nuovo?
                    <a href="../Controller/Register.php">Crea un account</a></p>
                </div>
            </form>
        </div>
    </div>
<?php     
}
?>
</body>

</html>