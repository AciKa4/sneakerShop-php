
<div class="col-lg-12 " id="register">
    <table>
        <tr>
            <th colspan="2">Register</th>
        </tr>
        <tr>
            <td colspan="2" id="obavestenje">*First and last name must start with a capital letter</td>
        </tr>
        <tr>
            <td class="pt-4">First Name</td>
            <td class="pt-4"> <input type="text" id="firstName" name="firstName" class="form-control"/></td>
            <td colspan="2" id="imeGreska" class="textcenter text-danger"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td> <input type="text" id="lastName" name="lastName" class="form-control"/></td>
            <td colspan="1" id="prezimeGreska" class="text-center text-danger"></td>
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
            <td>Confirm password</td>
            <td><input type="password" id="confPass" name="confPass" class="form-control"/></td>
            <td colspan="2" id="sifraPotvrdiGreska" class="text-center text-danger"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="button" id="submitRegister" name="submitRegister" value="Register" class="btn btn-outline-dark mb-3" /></td>
        </tr>
    </table>
    <div class="row" id="popup">
        <p id="textModal"></p>
            <input type="button" id="ok" value="OK" class="btn btn-outlinedark" />
    </div>
</div>

  