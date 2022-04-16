<div class="col-lg-12" id="login">
    <table class="mx-auto">
        <tr>
            <th colspan="2">Login</th>
        </tr>
        <tr>
            <td colspan="2" id="obavestenje">* First and last name must start with a capital letter</td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" id="regEmail" name="email" class="form-control"/></td>
            <td colspan="2" id="emailGreska" class="textcenter text-danger"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td> <input type="password" id="regPass" name="pass" class="form-control"/></td>
            <td colspan="2" id="sifraGreska" class="textcenter text-danger"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" id="submit" name="tbSubmit" value="Login" class="btn btn-outline-dark mb-3" /></td>
        </tr>
    </table>
    <div class="col-lg-12 text-center">
        <span id="poruka" class="text-danger"> </span>
    </div>
    <div class="row" id="popup">
        <p id="textModal"></p>
            <input type="button" id="ok" value="OK" class="btn btn-outlinedark" />
    </div>
</div>
    