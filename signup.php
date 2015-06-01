<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title></title>
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/settings.css">
 -->
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    </head>
    <body>
        <!-- header -->
        <nav class="purple darken-4">
            <div class="nav-wrapper">
                <ul class="logo">
                    <a href="index.php" class="brand-logo white-text">Jumo</a>
                </ul>

                <ul id="nav-mobile" class="right hide-on-med-and-down logout">
                    <!-- <li><a href="settings.php"><i class="mdi-action-settings"></i></a></li> -->
                    <a class="" href="index.php">Have an account? Log in</a>
                </ul>
            </div>
        </nav>

        <!-- body -->
        <div class="whitespace"></div>
        <div class="card-panel signin-card">
            <div class="row">
                <h3 class="join-jumo-title">Join Jumo today.</h3>
            </div>
            <div class="row">
                <form  action = "signupprocess.php" method = "POST" class="col s12">
                    <div class="row">
                        <div class="input-field col s8">
                            <input id="netid" type="text" class="validate" name="username">
                            <label for="netid">UW Net ID</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s8">
                          <input id="email" type="email" class="validate" name="email">
                          <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s8">
                            <input id="password" type="password" class="validate" name="password">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                            <span class="coach-ica">
                                <input type="radio" value = "Coach" class="filled-in " id="coach" name="group1"/>
                                <label for="coach">Coach</label>
                            </span>
                            <span class="coach-ica">
                                <input type="radio" value = "ICA" class="filled-in " id="ica" name="group1"/>
                                <label for="ica">ICA</label>
                            </span>
                        
                            
                    </div>
                    <div class="row">
                        <div class="join-button">
                            <button class="btn waves-effect waves-light amber accent-3 white-text join-btn" type="submit" id="formSubmit" name="formSubmit">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
            

        <!--  Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>