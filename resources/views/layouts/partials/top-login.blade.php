<form id="navbar-login-form" class="navbar-form navbar-right" method="post" action="/login">
    <div class="form-group">
        <input id="login-username" class="form-control" name="username" type="text" value=""
               placeholder="Username" maxlength="255"/>
    </div>
    <div class="form-group">
        <input id="login-password" class="form-control" name="password" type="password" value=""
               placeholder="Password" maxlength="255"/>
    </div>

    <input type="hidden" name="action" value="logIn"/>
    <input type="hidden" name="nextPage" value=""/>

    <button id="global-sign-in-button" type="submit" class="btn btn-success">Sign in</button>
</form>