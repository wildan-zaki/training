<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('backend/layouts/meta'); ?>

    <script>
        var base_url = '<?=base_url()?>';
        
        function readURL(input,target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(target).attr('src',e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function handleFileSelect(output_id, class_name) {
            //Check File API support
            if (window.File && window.FileList && window.FileReader) {

                var files = event.target.files; //FileList object
                var output = document.getElementById(output_id);

                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    //Only pics
                    if (!file.type.match('image')) continue;

                    var picReader = new FileReader();
                    picReader.addEventListener("load", function (event) {
                        var picFile = event.target;
                        var div = document.createElement("div");
                        div.className = "images";
                        div.innerHTML = "<img class='"+class_name+"' src='" + picFile.result + "' onerror='imgError(this)'/>";
                        output.insertBefore(div, null);
                    });
                    //Read the image
                    picReader.readAsDataURL(file);
                }
            } else {
                console.log("Your browser does not support File API");
            }
        }

        function imgError(image) {
            image.onerror = "";
            image.src = "<?=base_url('assets/backend/img/examples/big_image_800x600.gif')?>";
            return true;
        }

        $(document).ready(function () {
            $('.mask-submitted-container').hide();

            $('form').submit(function(e) {
                $('.mask-submitted-container').show();
                $(this).find('button[type=submit]').prop('disabled', true);
            });

            // load a locale
            numeral.register('locale', 'id', {
                delimiters: {
                    thousands: '.',
                    decimal: ','
                },
                abbreviations: {
                    thousand: 'k',
                    million: 'juta',
                    billion: 'milyar',
                    trillion: 'triliun'
                },
                ordinal : function (number) {
                    return number === 1 ? 'er' : 'ème';
                },
                currency: {
                    symbol: 'Rp'
                }
            });

            // switch between locales
            numeral.locale('id');
        });
    </script>
</head>
<body>

<body class="fix-header fix-sidebar card-no-border">
<div class="mask-submitted-container">
    <div class="mask-submitted-bg">
        <p class="mask-submitted-txt">Please wait</p>
    </div>
</div>

<!-- top bar -->
<header class="navbar navbar-fixed-top" role="banner">
    <div class="container-fluid">
        <?php $this->load->view('backend/layouts/header'); ?>
    </div>
</header>

<!-- main content -->
<div id="main_wrapper">
    <div class="page_content">
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb -->
            <!-- ============================================================== -->
            <?php $this->load->view('backend/layouts/breadcrumb', $data); ?>

            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <?php
            if($this->session->flashdata('validated') == 'error'){
                $this->load->view('backend/layouts/error_card');
            }
            else if($this->session->flashdata('validated') == 'success'){
                $this->load->view('backend/layouts/success_card');
            }

            $this->load->view($view, $data);
            ?>
        </div>
    </div>
</div>

<!-- side navigation -->
<nav id="side_nav">
    <?php $this->load->view('backend/layouts/sidebar'); ?>
</nav>

<!-- right slidebar -->
<div id="slidebar">
    <div id="slidebar_content">
        <?php $this->load->view('backend/layouts/right_sidebar'); ?>
    </div>
</div>
<script src="//maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyAD5TVBPChrQ8sXPp0Ho5PSNI-Ollb7W8g&libraries=places&callback=initMap" async defer></script>
</body>

</html>