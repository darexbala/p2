<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Damilare Oladosu P2 - DWA15 Password Generator">
    <meta name="author" content="Damilare Oladosu">
    <title>Damilare Oladosu P2 - DWA15 Password Generator</title>
    <?php require 'server/service.php' ?>
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jumbotron-narrow.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header clearfix">
            <nav>
                <ul class="nav nav-pills pull-right">
                    <li class="active">
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/about.html">About</a>
                    </li>
                </ul>
            </nav>
            <div>
                <a href="/" class="text-muted">
                    <img src="/images/Drawing.png" alt="P1"/>
                </a>
            </div>
        </div>
        <div class="row">

            <div class="col-md-8 col-md-offset-3">
                <h2 class="form-signin-heading"></h2>
                <div class="well offset2"><h3><?php if(isset($password)){ echo $password; } ?></h3></div>
                <div class="col-md-6 center col-md-offset-2">
                <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <label for="size"># of words</label>
                    <select class="form-control" name="size">
                        <?php
                            foreach($numbers as $number){
                                echo '<option value="'.$number.'"'.($_POST['size']==$number?' selected="selected"':'').'>'.$number.'</option>';
                            }
                        ?>
                    </select>
                    <label for="separator">Separator (Special characters only #!-$)</label>
                    <input type="text" name="separator" class="form-control" value="<?php echo $separator;?>" placeholder="-">
                    <span class="error"><?php echo $separatorErr;?></span>
                    <label for="maxlength">Max length</label>
                    <select class="form-control" name="maxlength">
                        <?php
                            foreach($maxLengths as $number){
                                echo '<option value="'.$number.'"'.($_POST['maxlength']==$number?' selected="selected"':'').'>'.$number.'</option>';
                            }
                        ?>
                    </select>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="Add Number" <?php if (isset($Add_Number) && $Add_Number=="on") echo "checked";?>> Add Number
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="Add Symbol" <?php if (isset($Add_Symbol) && $Add_Symbol=="on") echo "checked";?>> Add Symbol
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="case" value="None" checked> None
                        </label>
                        <label>
                            <input type="radio" name="case" value="First upper" <?php if (isset($case) && $case=="First upper") echo "checked";?>> First letter upper case
                        </label>
                        <label>
                            <input type="radio" name="case" value="All upper" <?php if (isset($case) && $case=="All upper") echo "checked";?>> All upper case
                        </label>
                        <label>
                            <input type="radio" name="case" value="All lower" <?php if (isset($case) && $case=="All lower") echo "checked";?>> All lower case
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Generate Password</button>
                </form>
                </div>
            </div>
        </div>
        <br />
        <a href="http://xkcd.com/936/">
            <img class="comic" src="http://imgs.xkcd.com/comics/password_strength.png" alt="xkcd style passwords">
        </a>
        <footer class="footer">
            <p>&copy; 2016 DWA15 Password Generator.</p>
        </footer>

    </div>
</body>
</html>
