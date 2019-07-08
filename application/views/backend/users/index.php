<div class="panel panel-default">
    <div class="panel-heading">
        <a href="<?=base_url('backend/user/create')?>">
            <div class="btn btn-success float-md-right float-sm-left">
                <i class="ion-edit"></i> Create
            </div>
        </a>
    </div>

    <div class="panel-body">
        <ul class="nav nav-tabs" id="tabs_a">
            <li class="active"><a data-toggle="tab" data-role="1" class="tabs" href="#admin_tab">Admin</a></li>
            <li><a data-toggle="tab" data-role="2" class="tabs" href="#member_tab">Member</a></li>
        </ul>
        <div class="tab-content">
            <div id="" class="tab-pane fade in active">
                <table id="user_tbl" class="table table-striped table-hover" width="100%">
                    <thead>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(e) {
        var role_id = 1;

        function loadTable($elem){
            $('.mask-submitted-container').show();
            role_id = $elem.data('role');
            var url = '<?=base_url('backend/user/getall/')?>' + role_id;
            table.ajax.url(url).load();
            $('.mask-submitted-container').hide();

            return true;
        }

        $('.tabs').click(function (e) {
            loadTable($(this));
        });
        
        var table = $('#user_tbl').DataTable({
            ajax: {
                url: '<?=base_url('backend/user/getall/1')?>',
                dataSrc: ''
            },
            columns: [
                {data:'fuserid'},
                {data: 'fusername'},
                {data: 'fuseremail'},
                {data: null,
                    render: function(data){
                        if(data.fuserstatus == 0) {
                            return "Not active";
                        }else {
                            return "Active";
                        }
                        // switch(data.fuserstatus) {
                        //     case 0:
                        //         return "Not active";
                        //     break;
                        //     case 1:
                        //         return "Active";
                        // }
                    }
                },
                {data: null,
                    render: function(data){
                        var items = '';
                        items += '<a href="<?=base_url('backend/user/view/')?>'+data.fuserid+'"><div class="btn btn-info btn-sm update"><i class="ion-eye"></i></div></a> ';
                        items += '<a href="<?=base_url('backend/user/update/')?>'+data.fuserid+'"><div class="btn btn-warning btn-sm update"><i class="ion-edit"></i></div></a> ';
                        items += '<button class="btn btn-danger btn-sm delete" data-id="'+data.fuserid+'" data-name="'+data.fusername+'"><i class="ion-trash-a"></i></button>';

                        return items;
                    }}
            ]
        });

        $('#user_tbl').on('click', '.delete', function(){
            var confirm = window.confirm('Delete user: ' + $(this).data('name') + ' ?');

            if (confirm){
                $('.mask-submitted-container').show();
                $.ajax({
                    method: 'POST',
                    dataType: 'json',
                    url: '<?=base_url('backend/user/delete/')?>' + $(this).data('id'),
                    success: function( res ) {
                        if(res.status == 1){
                            var url = '<?=base_url('backend/user/getall/')?>' + role_id;
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