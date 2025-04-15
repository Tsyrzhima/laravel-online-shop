<div class="login">

    <div class="login-triangle"></div>

    <h2 class="login-header">Log in</h2>

    <form class="login-container" action={{ route('login.submit') }} method="post">
        @csrf
        @error('email')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <p><input type="email" id="email" name="email" required placeholder="Email" value= {{ old('email') }}>
        @error('password')
            <span style="color: red;">{{ $message }}</span>
        @enderror
        <p><input type="password" id="password" name="password" placeholder="Password" value= {{ old('email') }}>
        @error('Auth')
        <span style="color: red;">{{ $message }}</span>
        @enderror
        <p><input type="submit" value="Log in"></p>
        <a href="/registration">Зарегистрироваться</a>
    </form>
</div>

<style>
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:400,700);

    body {
        background: #f1f1f1;
        font-family: 'Open Sans', sans-serif;
    }

    .login {
        width: 400px;
        margin: 16px auto;
        font-size: 16px;
    }

    /* Reset top and bottom margins from certain elements */
    .login-header,
    .login p {
        margin-top: 0;
        margin-bottom: 0;
    }

    /* The triangle form is achieved by a CSS hack */
    .login-triangle {
        width: 0;
        margin-right: auto;
        margin-left: auto;
        border: 12px solid transparent;
        border-bottom-color: #04AA6D;
    }

    .login-header {
        background: #04AA6D;
        padding: 20px;
        font-size: 1.4em;
        font-weight: normal;
        text-align: center;
        text-transform: uppercase;
        color: #fff;
    }

    .login-container {
        background: #ebebeb;
        padding: 12px;
    }

    /* Every row inside .login-container is defined with p tags */
    .login p {
        padding: 12px;
    }

    .login input {
        box-sizing: border-box;
        display: block;
        width: 100%;
        border-width: 1px;
        border-style: solid;
        padding: 16px;
        outline: 0;
        font-family: inherit;
        font-size: 0.95em;
    }

    .login input[type="email"],
    .login input[type="password"] {
        background: #fff;
        border-color: #bbb;
        color: #555;
    }

    /* Text fields' focus effect */
    .login input[type="email"]:focus,
    .login input[type="password"]:focus {
        border-color: #888;
    }

    .login input[type="submit"] {
        background: #04AA6D;
        border-color: transparent;
        color: #fff;
        cursor: pointer;
    }

    .login input[type="submit"]:hover {
        background: #04AA6D;
    }

    /* Buttons' focus effect */
    .login input[type="submit"]:focus {
        border-color: #04AA6D;
    }

</style>
