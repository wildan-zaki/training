<form id="login_form" action="<?=base_url('backend/forgot/process')?>" method="post">
    <div class="text-center">
        <h1 class="login_heading"><b>FORGOT PASSWORD</b></h1>
    </div>
    <?php
    if($this->session->flashdata('validated') == 'error'){
        $this->load->view('backend/layouts/auths/error_card');
    }
    ?>
    <div class="form-group">
        <input type="email" class="form-control input-lg" placeholder="Email" id="login_email" name="fuseremail" value="<?=set_value('fuseremail')?>">
    </div>
    <div class="submit_section">
        <button id="submit_login" class="btn btn-lg btn-primary btn-block" type="submit">Continue</button>
    </div>
    <br>
    <div class="text-center">
        <p class="login_heading"><b>This will send something to your verified email</b></p>
    </div>
</form>

<script>
$(document).ready(function(e){
    $("#submit_login").click(function(){        
        $("#login_form").submit(); // Submit the form
    });
});
</script>