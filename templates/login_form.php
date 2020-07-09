<div id="loginForm" class="login__login form">
    <h3>Uloguj se</h3>
    <form id="logInFormVal" action="/">
        <div class="input">
            <label for="">
                Mail*</label>
            <input class="jsInput" type="text" name="name" autocomplete="off">
            <div class="border-black"></div>
            <div class="border-grey"></div>
        </div>
        <div class="input">
            <label for="">
                Password*</label>
            <input class="jsInput" type="password" name="password" autocomplete="off">
            <div class="border-black"></div>
            <div class="border-grey"></div>
        </div>
        <div id="contactMesLog" class="form__error d-none">
            <p>Uneti podaci nisu ispravni!</p>
        </div>
        <div id="buttons" class="btn-wrap  ">
            <div id="logiInSubmit" type="submit" class="btn">
                Prosledi
            </div>
            <div id="activRegister" class="btn">
                Registruj Se
            </div>
        </div>
        <div id="formSpiner" class="spiner-wrap d-none">
            <div class="loader"></div>
        </div>
    </form>
</div>