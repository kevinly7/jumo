<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <meta name="team" content="Jumo">
        <meta name="description" content="This is a website application for UW ICA to log and audit athlete CARA hours.">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
        <title>Jumo</title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
        <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
    

    </head>

    <body>
        <!-- parallax section -->
         <div id="index-banner" class="parallax-container">
            <div class="section no-pad-bot">
                <div class="container">
                    <br><br>
                    <h1 class="header center purple-text text-darken-4 brand-logo">Jumo</h1>
                    <div class="row center">
                    </div>

                    <div class="row right black-text">
                          <div class="col s12">
                                <div class="card white">
                                    <div class="card-content">
                                        <span class="card-title black-text">Sign in</span>
                                        <form action="" id="loginForm" method = "POST">
                                            <div class="input-field">
                                                <input id="first_name" type="text" class="validate" name='netid'>
                                                <label for="first_name">UW NetID</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="password" type="password" name='password' class="validate">
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="card-action row right">
                                                <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" value="Login" name="action">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                          </div>
                    </div>
                </div>
            </div>
            <div class="parallax"><img src="background2.jpg" alt="Unsplashed background img 2"></div>
        </div>
        <?php include("login.php") ?> 

        <!-- header section -->
        <!-- <div id="hero1" class="hero">
            <div class="inner">
                <div class="copy">
                    <br><br>
                    <h1 class="header center purple-text text-darken-4 brand-logo">Jumo</h1>
                    <div class="row center">
                    </div>

                    <div class="row right black-text">
                          <div class="col s12">
                                <div class="card white">
                                    <div class="card-content">
                                        <span class="card-title black-text">Sign in</span>
                                        <form action="" id="loginForm" method = "POST">
                                            <div class="input-field">
                                                <input id="first_name" type="text" class="validate" name='netid'>
                                                <label for="email">UW NetID</label>
                                            </div>
                                            <div class="input-field">
                                                <input id="password" type="password" name='password' class="validate">
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="card-action row right">
                                                <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" value="Login" name="action">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                          </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- description section -->
        <div class="section description-section">
            <div class="container">

                <!--   Icon Section   -->
                <div class="row">
                    <div class="col s12 m4">
                        <div class="icon-block">
                            <h2 class="center purple-text text-darken-4"><i class="mdi-image-flash-on"></i></h2>
                            <h5 class="center">Automated logging</h5>

                            <p class="light">Jumo utilizes RFID technology to log student athlete's Countable Athletically
                                Related Activities (CARA hours). Since time logging and calculations are handled server-side,
                                coaches now only need to tap in and out of practices with an RFID card and we do the rest.
                            </p>
                        </div>
                    </div>

                    <div class="col s12 m4">
                        <div class="icon-block">
                            <h2 class="center purple-text text-darken-4"><i class="mdi-social-group"></i></h2>
                            <h5 class="center">Designed for coaches</h5>

                            <p class="light">Logging practice hours for a whole team is not only a hassle for coaches,
                                but it also cuts into their busy schedule. With Jumo, coaches no longer need to spend hours
                                of their time remembering when Johnny and for how many hours.
                            </p>
                        </div>
                    </div>

                    <div class="col s12 m4">
                        <div class="icon-block">
                            <h2 class="center purple-text text-darken-4"><i class="mdi-action-settings"></i></h2>
                            <h5 class="center">Maximum accuracy</h5>

                            <p class="light">RFID technology minimizes human error that tends to occur with repetitive data
                                entry. The old days of mistakenly logging incorrect log sheets are no more.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section purple darken-4">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <h5 class="white-text">About</h5>
                        <p class="grey-text text-lighten-4 light">
                            Jumo was created by a team of Informatics students from the iSchool at the University of Washington.
                            Partnered with the UW Intercollegiate Athletic department we aim to create a replacement CARA
                            logging system that enhances user experience, saves time, and minimizes error.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <section id="hero2" class="hero">
          <div class="inner2">
            <div class="copy2">
            
            </div>
          </div>
        </section>
        <!-- <footer class="page-footer purple darken-4">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <h5 class="white-text">About</h5>
                        <p class="grey-text text-lighten-4 light">
                            Jumo was created by a team of Informatics students from the iSchool at the University of Washington.
                            Partnered with the UW Intercollegiate Athletic department we aim to create a replacement CARA
                            logging system that enhances user experience, saves time, and minimizes error.
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <h5 class="white-text">Team</h5>
                        <p class="grey-text text-lighten-4 light">
                            Howard Lin | Kevin Ly | Tuvshin Tulga | Kevin Yang
                        </p>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    Made by <a class="brown-text text-lighten-3" href="http://materializecss.com">Materialize</a>
                </div>
            </div>
        </footer> -->

        <!--  Scripts-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="js/materialize.js"></script>
        <script src="js/init.js"></script>
    </body>
</html>