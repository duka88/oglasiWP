<div id="registerForm" class="login__login d-none form">
    <h3>Registruj se</h3>
    <form id="registerFormVal" action="/">
        <div class="input">
            <label for="">
                Name*</label>
            <input class="jsInputReg" type="text" name="name" autocomplete="off">
            <div class="border-black"></div>
            <div class="border-grey"></div>
            <div class="form__errors d-none jsFormErrors">Ime je obavezano!</div>
        </div>
        <div class="input">
            <label for="">
                Email*</label>
            <input class="jsInputReg" type="text" name="email" autocomplete="off">
            <div class="border-black"></div>
            <div class="border-grey"></div>
            <div class="form__errors d-none jsFormErrors">Mejl je obavezan!</div>
        </div>
        <div class="input">
            <label for="">
                Mesto*</label>
            <input class="jsInputReg" type="text" name="city" autocomplete="off">
            <div class="border-black"></div>
            <div class="border-grey"></div>
              <div class="form__errors d-none jsFormErrors">Mesto je obavezano!</div>
        </div>
        <div class="input">
            <label for="">
                Telefon</label>
            <input class="jsInputReg" type="text" name="phone" autocomplete="off">
            <div class="border-black"></div>
            <div class="border-grey"></div>
             <div class="form__errors d-none jsFormErrors"></div>
        </div>
        <div class="input">
            <label for="">
                Password*</label>
            <input class="jsInputReg" type="password" name="password" autocomplete="off">
            <div class="border-black"></div>
            <div class="border-grey"></div>
            <div class="form__errors d-none jsFormErrors">Sifra je obavezana!</div>
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
        <div id="contactMesReg" class="message d-none">
            <p></p>
        </div>
    </form>
</div>