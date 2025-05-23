<form action="{{route('registrate')}}" method="POST">
    @csrf
    <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <div>
            <label for="name"><b>Name:</b></label>
            @error('name')
            <span style="color: red;">{{ $message }}</span>
            @enderror
            <input type="text" id="name" name="name" required value="{{ old('name') }}">
        </div>
        <div>
            <label for="email"><b>Email:</b></label>
            @error('email')
            <span style="color: red;">{{ $message }}</span>
            @enderror
            <input type="text" id="email" name="email" required value="{{ old('email') }}">
        </div>
        <div>
            <label for="password">Password:</label>
            @error('password')
            <span style="color: red;">{{ $message }}</span>
            @enderror
            <input type="password" id="password" name="password" required value="{{ old('password') }}">
        </div>
        <div>
            <label for="password_confirmation">Repeat Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <hr>

        <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
        <button type="submit" class="registerbtn">Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="#">Sign in</a>.</p>
    </div>
</form>

<style>
    * {box-sizing: border-box}

    /* Add padding to containers */
    .container {
        padding: 16px;
    }

    /* Full-width input fields */
    input[type=text], input[type=password] {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
        background-color: #ddd;
        outline: none;
    }

    /* Overwrite default styles of hr */
    hr {
        border: 1px solid #f1f1f1;
        margin-bottom: 25px;
    }

    /* Set a style for the submit/register button */
    .registerbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        opacity: 0.9;
    }

    .registerbtn:hover {
        opacity:1;
    }

    /* Add a blue text color to links */
    a {
        color: dodgerblue;
    }

    /* Set a grey background color and center the text of the "sign in" section */
    .signin {
        background-color: #f1f1f1;
        text-align: center;
    }
</style>
