
<div class="green">
    <span style="position: inherit; margin-top:50px; margin-left: 10px;font-size: 0.5em">Sign up</span>
</div>
<div class="login" >
    <form method="post" action="index.php">
        <input type="text" name="login" placeholder="login" style="margin-left: 50px; margin-top: 55px"/>
    </br>
    <input type="password" name="passwd" placeholder="password" style="margin-left: 50px; margin-top: 10px"/>
    <input type="submit" name="submit" style="margin-left: 50px; margin-top: 10px" value="login"/>
</form>
</div>
<div class="login2" >
    <form method="post" action="index.php">
        <input type="text" name="login" placeholder="login" style="margin-left: 50px; margin-top: 55px"/>
    </br>
    <input type="password" name="passwd" placeholder="password" style="margin-left: 50px; margin-top: 10px"/>
    <input type="submit" name="submit" style="margin-left: 50px; margin-top: 10px" value="signin"/>
</form>
</div>
<div class="arrow" onmouseover="myFunction()">
</div>
<div class="arrow2" onmouseover="myFunction4()">
</div>
<div class="red">
    <span style="position: inherit; margin-top:55px; margin-left:18px; font-size: 0.5em">Log in</span>
</div>
<script type="text/javascript">
function myFunction() {
    var x = document.getElementsByClassName("login");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].style.opacity = "1";
        x[i].style.height = "400px";
    }
}
function myFunction4() {
    var x = document.getElementsByClassName("login2");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].style.opacity = "1";
        x[i].style.height = "400px";
    }
}
function myFunction2() {
    var x = document.getElementsByClassName("login");
    var i;
    for (i = 0; i < x.length; i++) {
        x[i].style.opacity = "0";
        x[i].style.height = "0px";
    }
}
</script>
