<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/3fb3f86d64.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/registration.css">
    <title>Registration</title>
</head>

<body>
    
    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">E-Sport Coaching</h1>
            </div>
            <nav>
                <ul>
                    <li> <a href="index.php">Home</a></li>
                    <li> <a href="registration.php">Sign Up</a></li>
                    <li> <a href="login.php">Log in</a></li>
                </ul>
            </nav>
        </div>
        </header>
        <div class="containers">
            <div class="header">
                <h2>Create Account</h2>
            </div>
            <form class="form" id="form" >
                <div class="form-control">
                    <label>Username</label>
                    <input type="text" placeholder="Username" id="username" onkeyup="usernameCheck()">
                    <i class="fas fa-exclamation-circle"></i>
                    <i class="fas fa-check-circle"></i>
                    <small>Error Message</small>
                </div>
                
                <div class="form-control">
                    <label>Full Name</label>
                    <input type="text" placeholder="Name" id="name" onkeyup="nameCheck()">
                    <i class="fas fa-exclamation-circle"></i>
                    <i class="fas fa-check-circle"></i>
                    <small>Error Message</small>
                </div>
                
                <div class="form-control">
                    <label>Email</label>
                    <input type="email" placeholder="Email" id="email" onkeyup="emailCheck()">
                    <i class="fas fa-exclamation-circle"></i>
                    <i class="fas fa-check-circle"></i>
                    <small>Error Message</small>
                </div>
                
                <div class="form-control">
                    <label>Password</label>
                    <input type="password" placeholder="Password" id="password" onkeyup="passwordCheck()">
                    <i class="fas fa-exclamation-circle"></i>
                    <i class="fas fa-check-circle"></i>
                    <small>Error Message</small>
                </div>
                
                <div class="form-control">
                    <label>Confirm Password</label>
                    <input type="password" placeholder="Retype Password" id="password2" onkeyup="password2Check()">
                    <i class="fas fa-exclamation-circle"></i>
                    <i class="fas fa-check-circle"></i>
                    <small>Error Message</small>
                </div>
                
                <div class="form-control">
                    <label>User Type</label>
                    <select name="comboBox" id="comboBox">
                        <option value="Student">Student</option>
                        <option value="Coach">Coach</option>
                    </select>
                </div>
                <input type="button" value="Submit" onclick="submits()" id="button">
            </form>
        </div>


    <footer>
        <div class = "container">
            <p>Copyright &copy; 2020 E-Sports Coaching</p>
            <h4>Contact Information</h4>
            <h5>Mail</h5>
            <p>esportc@gmail.com</p>
            <h5>Phone</h5>
            <p>01745122222</p>

            <h5><a href="service.php">Service</h5>

            <ul class = "links">
                <li> <a href="https://www.facebook.com/">
                <img src="../res/facebook_50px.png" width="50px" height="50px"></li>

                <li> <a href="https://www.discord.com/">
                <img src="../res/discord_50px.png" width="50px" height="50px"></li>

                <li> <a href="https://www.instagram.com/">
                <img src="../res/instagram_50px.png" width="50px" height="50px"></li>

                <li><a href="https://www.twitch.com/">
                <img src="../res/twitch_50px.png" width="50px" height="50px"></li>
            
            </ul>
        </div>
    </footer>


        <script src="../assets/js/registration.js"></script>
        
    </body>
    
    </html>