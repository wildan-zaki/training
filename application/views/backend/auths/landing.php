    <div class="text-center">
        <h1 class="login_heading"><b>This is a Page</b></h1>
    </div>
    <?php
    if($this->session->flashdata('validated') == 'error'){
        $this->load->view('backend/layouts/auths/error_card');
    }
    ?>
    <div class="text-center">
        <p class="login_heading"><b>Something has been send to your verified email</b></p>
    </div>

<script>
$(document).ready(function(e){
    $("#submit_login").click(function(){        
        $("#login_form").submit(); // Submit the form
    });
});
</script>