<form id="login_form" action="<?=base_url('backend/login/process')?>" method="post">
    <div class="text-center">
        <h1 class="login_heading"><b>LOGIN</b></h1>
    </div>
    <?php
    if($this->session->flashdata('validated') == 'error'){
        $this->load->view('backend/layouts/auths/error_card');
    }
    ?>
    <div class="form-group">
        <input type="email" class="form-control input-lg" placeholder="Email" id="login_email" name="fuseremail" value="<?=set_value('fuseremail')?>">
    </div>
    <div class="form-group">
        <input type="password" class="form-control input-lg" placeholder="Password" id="login_password" name="fuserpassword">
        <span class="help-block"><a href="<?=base_url('backend/forgot/')?>">Forgot password?</a></span>
    </div>
    <div class="form-group checkbox">
        <label for="login_rememberme"><input type="checkbox" id="login_rememberme" name="rememberme"> Remember Me</label>
    </div>
    <div class="submit_section">
        <button id="submit_login" class="btn btn-lg btn-primary btn-block" type="submit">Continue</button>
    </div>
</form>

<script>
$(document).ready(function(e){
    $("#submit_login").click(function(){        
        $("#login_form").submit(); // Submit the form
    });
});
</script>