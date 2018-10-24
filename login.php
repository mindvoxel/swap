<?php
require_once("generate.php");
require_once("profile.php");

$top = <<<EOBODY
    <form action="{$_SERVER['PHP_SELF']}" method="post">
    <h1>Login to Swap!</h1>
        <div class="form-group">
            <strong>Username: </strong><input class = "form-control" id="username" type="text" name="username" placeholder="TheSwapKing"
                                          required/><br/><br/>
            <strong>Password: </strong><input class = "form-control" id="password" type="password" name="password"
                                                   placeholder="Password" required/><br/><br/>

            <button type="submit" name="login" class="btn btn-danger">Login!</button>
         </div>
    </form>
<p>
<form action = "signup.php" method = "post">
    <div class="form-group">
            <button type="submit" name="signup" class="btn btn-outline-warning">Create a Swap Account!</button>
    </div>
</form>
</p>
EOBODY;

$bottom = "";

if (isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["username"])) {
    $usernameValue = trim($_POST["username"]);
    $passwordValue = trim($_POST["password"]);

    $temp = new Profile("", "", []);
    $profile = $temp->find_profile_on_db($usernameValue);

    if ($profile == null) {
        $bottom .= "<strong>Sorry, we couldn't find a profile in our database with the username you provided :(</strong><br />";
        $body = $top . $bottom;
        $page = generatePage($body, "Login");
        echo $page;
    } else {
        $username = $profile->get_username();
        $password_encrypted = $profile->get_password();
        if (password_verify($passwordValue, $password_encrypted)) {
            //just placeholder for what to do when a user successfully logs in
            $body = <<<EOBOD
            
<strong>Profile found on the database with the following values:</strong><br />
 <p>
    <strong>Username: </strong>$username</br>
    <strong>Inventory: Still need to display inventory</strong> // display the inventory
</p>
<p>
<form action = "signup.php" method = "post">
    <div class="form-group">
            <button type="submit" name="signup" class="btn btn-outline-warning">Create a Swap Account!</button>
    </div>
</form>
</p>
EOBOD;
            $page = generatePage($body, "Login");
            echo $page;
        } else {
            $bottom .= "<strong>No profile exists in the database for the specified username and password.</strong><br />";
            $body = $top . $bottom;
            $page = generatePage($body, "Login");
            echo $page;
        }
    }
} else {
    $body = $top . $bottom;
    $page = generatePage($body, "Login");
    echo $page;
}
?>