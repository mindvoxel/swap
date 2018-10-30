<?php
require_once("profile.php");
require_once("generate.php");
$bottom = "";
$body = <<<EOBODY
        <form action ="{$_SERVER['PHP_SELF']}" method ="post">
            <h1>Sign up for Swap</h1>
            
            <div class="form-group">
                    Username:
                    <input class="form-control" type = 'text' name="username" required>
                    <br>
                    Password:
                    <input class="form-control" type = "password" name="password" required>
                    <br>
                    <button class="btn btn-primary" type="submit"  name ="signup">Sign up!</button>
            </div>
            <p>Already have an account? Click <a href="login.php">here</a> to login.</p>
        </form>
EOBODY;
if (isset($_POST["signup"]) && isset($_POST["username"]) && isset($_POST["password"])) {
    $profile = new Profile($_POST["username"], $_POST["password"] , []);
    if ($profile->add_profile_to_db()) {
        $bottom .= "<p>Account Created! Please <a href=\"login.php\"> login here!</a></p>";
    } else {
        $bottom .= "<p>Too slow, username already exists!</p>";
    }
    echo generatePage($body . $bottom, "Sign Up!");
} else {
    echo generatePage($body, "Sign Up!");
}
?>