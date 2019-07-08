<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?=base_url('backend/certificate/create')?>">
            <div class="btn btn-success float-md-right float-sm-left">
                <i class="ion-edit"></i> Create
            </div>
        </a>
    </div>

    <div class="panel-body">
        <table id="certificate_tbl" class="table table-striped table-hover" width="100%">
            <thead>
            <th>Certificate ID</th>
            <th>Certificate Number</th>
            <th>Status</th>
            <th>Actions</th>
            </thead>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(e) {
        var role_id = 1;

        function loadTable($elem){
            $('.mask-submitted-container').show();
            role_id = $elem.data('role');
            var url = '<?=base_url('backend/certificate/getall/')?>' + role_id;
            table.ajax.url(url).load();
            $('.mask-submitted-container').hide();

            return true;
        }

        $('.tabs').click(function (e) {
            loadTable($(this));
        });
        
        var table = $('#certificate_tbl').DataTable({
            ajax: {
                url: '<?=base_url('backend/certificate/getall/1')?>',
                dataSrc: ''
            },
            columns: [
                {data:'fcertificateid'},
                {data: 'fcertificatenumber'},
                {data: null,
                    render: function(data){
                        if(data.fcertificatestatus == 0) {
                            return "Not active";
                        }else {
                            return "Active";
                        }
                    }
                },
                {data: null,
                    render: function(data){
                        var items = '';
                        items += '<a href="<?=base_url('backend/certificate/view/')?>'+data.fcertificateid+'"><div class="btn btn-info btn-sm update"><i class="ion-eye"></i></div></a> ';
                        items += '<a href="<?=base_url('backend/certificate/update/')?>'+data.fcertificateid+'"><div class="btn btn-warning btn-sm update"><i class="ion-edit"></i></div></a> ';
                        items += '<button class="btn btn-danger btn-sm delete" data-id="'+data.fcertificateid+'" data-name="'+data.fcertificatenumber+'"><i class="ion-trash-a"></i></button>';

                        return items;
                    }}
            ]
        });

        $('#certificate_tbl').on('click', '.delete', function(){
            var confirm = window.confirm('Delete certificate: ' + $(this).data('name') + ' ?');

            if (confirm){
                $('.mask-submitted-container').show();
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '<?=base_url('backend/certificate/delete/')?>' + $(this).data('id'),
                    success: function( res ) {
                        if(res.status == 1){
                            var url = '<?=base_url('backend/certificate/getall/')?>' + role_id;
                            table.ajax.url(url).load();
                            $('.mask-submitted-container').hide();
                        }else{
                            alert(res.message);
                            $('.mask-submitted-container').hide();
                        }
                    },
                    error: function ( msg ) {
                        alert("An error occured. Please contact your system administrator");
                        console.log(msg);
                        $('.mask-submitted-container').hide();
                    }
                });
            }
        });
    });
</script>