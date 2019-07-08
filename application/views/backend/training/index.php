<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?=base_url('backend/training/create')?>">
            <div class="btn btn-success float-md-right float-sm-left">
                <i class="ion-edit"></i> Create
            </div>
        </a>
    </div>

    <div class="panel-body">
        <table id="training_tbl" class="table table-striped table-hover" width="100%">
            <thead>
            <th>Training ID</th>
            <th>Training Name</th>
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
            var url = '<?=base_url('backend/training/getall/')?>' + role_id;
            table.ajax.url(url).load();
            $('.mask-submitted-container').hide();

            return true;
        }

        $('.tabs').click(function (e) {
            loadTable($(this));
        });
        
        var table = $('#training_tbl').DataTable({
            ajax: {
                url: '<?=base_url('backend/training/getall/')?>',
                dataSrc: ''
            },
            columns: [
                {data:'ftrainplanid'},
                {data: 'ftrainplanname'},
                {data: null,
                    render: function(data){
                        if(data.ftrainingstatus == 0) {
                            return "Not active";
                        }else {
                            return "Active";
                        }
                    }
                },
                {data: null,
                    render: function(data){
                        var items = '';
                        items += '<a href="<?=base_url('backend/training/view/')?>'+data.ftrainplanid+'"><div class="btn btn-info btn-sm update"><i class="ion-eye"></i></div></a> ';
                        items += '<a href="<?=base_url('backend/training/update/')?>'+data.ftrainplanid+'"><div class="btn btn-warning btn-sm update"><i class="ion-edit"></i></div></a> ';
                        items += '<button class="btn btn-danger btn-sm delete" data-id="'+data.ftrainplanid+'" data-name="'+data.ftrainplanname+'"><i class="ion-trash-a"></i></button>';

                        return items;
                    }}
            ]
        });

        $('#training_tbl').on('click', '.delete', function(){
            var confirm = window.confirm('Delete training: ' + $(this).data('name') + ' ?');

            if (confirm){
                $('.mask-submitted-container').show();
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '<?=base_url('backend/training/delete/')?>' + $(this).data('id'),
                    success: function( res ) {
                        if(res.status == 1){
                            var url = '<?=base_url('backend/training/getall/')?>' + role_id;
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