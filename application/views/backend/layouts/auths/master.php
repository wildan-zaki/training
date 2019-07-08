<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view('backend/layouts/auths/meta'); ?>
</head>
<body>
<div class="mask-submitted-container">
    <div class="mask-submitted-bg">
        <p class="mask-submitted-txt">Please wait</p>
    </div>
</div>

<div class="login_container">
    <?php $this->load->view($view); ?>
</div>

<script>
    $(document).ready(function() {
        $('.mask-submitted-container').hide();

        $('form').submit(function(e) {
            $('.mask-submitted-container').show();
            $(this).find('button[type=submit]').prop('disabled', true);
        });
    });
</script>
</body>
</html>