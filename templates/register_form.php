<div id="registerForm" class="login__login d-none">
    <h3>Registruj se</h3>
    <form id="registerFormVal" action="/">
        <div class="input">
            <label for="">
                Name*</label>
            <input class="jsInput" type="text" name="name" autocomplete="off">
            <div class="border-black"></div>
            <div class="border-grey"></div>
        </div>
        <div class="input">
            <label for="">
                Email*</label>
            <input class="jsInput" type="text" name="email" autocomplete="off">
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
        <div id="buttons" class="btn-wrap ">
            <div id="registerFormSubmit" type="submit" class="btn">
                Prosledi
            </div>
            <div id="activLogin" class="btn">
                Uloguj Se
            </div>
        </div>
        <div id="formSpiner" class="spiner-wrap d-none">
            <div class="loader"></div>
        </div>
        <div id="contactMessage" class="message d-none">
            <p></p>
        </div>
    </form>
</div>