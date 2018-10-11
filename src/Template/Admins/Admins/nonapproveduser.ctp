<body class="">
  <!--<![endif]-->

  <style>
  .aligncenter
  {
     text-align:center;
  }
  .table td, .table th
  {
     padding: 0.75rem 0.10rem;
  }
  </style>
    <?php
use Cake\Routing\Router;
$baseurl = Router::url('/');
$getmsg = $this->request->pass;
?>


<div class="content">
 	<div class="row page-titles">
        <div class="col-md-12 col-12 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0"><?php echo __d('admin', 'Users'); ?></h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo $baseurl; ?>	dashboard"><?php echo __d('admin', 'Home'); ?></a></li>
                     <li class="breadcrumb-item active"><?php echo __d('admin', 'Users'); ?></li>
                 </ol>
         </div>
    </div>
</div>
<div class="col-lg-12 p-0">
            <div class="card card-outline-info">
                <div class="card-header">
                        <h4 class="m-b-0 text-white"><?php echo __d('admin', 'Non Approved Users'); ?></h4>
                 </div>
                 <div class="card-block">
                    <div class="form-body">

<div class="btn-toolbar">
    <!--<a  href="<?php echo $baseurl.'addmember/'; ?>" ><input type="button" class="btn btn-info" value="+ Add User"></a>-->
    <!--button class="btn">Import</button>
    <button class="btn">Export</button-->

</div>
</div>
<?php
if (!empty($getmsg)) {

     if($getmsg[0] == 'nonappusreditsuccess')
     {
      $succmsg = __d("admin", "User updated successfully");
     echo '<div id="alertmsg" class="successmsg">'.$succmsg.'</div>';
     }

}
?>
<?php
 echo  '<div class="table-responsive m-t-0">';
                    echo '<table id="nonapproveduserstable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">';
                        echo '<thead>';
                        ?>


        <?php
        echo '<tr>';
            echo '<th class="aligncenter">ID</th>';
            echo '<th>'.__d('admin','User Name').'</th>';
            //echo '<th>City</th>';
            echo '<th class="aligncenter">'.__d('admin', 'Email').'</th>';
            echo '<th class="aligncenter">'.__d('admin', 'Registered On').'</th>';
            echo '<th class="aligncenter" data-orderable="false">'.__d('admin', 'Status').'</th>';
            echo '<th class="aligncenter" data-orderable="false">'.__d('admin', 'Action').'</th>';
        echo '</tr>';
        ?>

      </thead>
      <tbody>

      <?php if(count($userdet->toArray())!=0){

            foreach($userdet as $user_det){
                $id=$user_det['id'];
                /*if($user_det['User']['user_level']=='god' && $user_det['User']['admin_menus']=='')
                {
                    $style = "font-weight:bold;color:#0040FF;";
                }
                else if($user_det['User']['user_level']=='god' && $user_det['User']['admin_menus']!='')
                {
                    $style = "font-weight:bold;";
                }
                else
                {
                    $style = "";
                }*/
                echo '<tr id="del_'.$id.'" style="'.$style.'">';
                    echo '<td class="aligncenter">'.$user_det['id'].'</td>';
                    echo '<td class="aligncenter">'.$user_det['username'].'</td>';
                    //echo '<td>'.$user_det['User']['city'].'</td>';
                    echo '<td class="aligncenter">'.$user_det['email'].'</td>';
                    $day=date('m/d/Y',strtotime($user_det['created_at']));
                    echo '<td class="aligncenter">'.$day.'</td>';
                    echo '<td class="aligncenter" id="status'.$id.'">';
                    if ($user_det['user_status'] == 'enable') {
                        echo '<button class="btn btn-rounded btn-outline-warning" onclick="changeUserStatus('.$id.',\''.$user_det['user_status'].'\',\''.$user_det['user_level'].'\')">'.__d('admin', 'Disable').'</button></td>';
                    } else {
                        echo '<button class="btn btn-rounded btn-outline-success" onclick="changeUserStatus('.$id.',\''.$user_det['user_status'].'\',\''.$user_det['user_level'].'\')">'.__d('admin', 'Enable').'</button></td>';
                    }
                    echo '<td class="aligncenter" width="20%">
                    <a href="'.$baseurl.'edituser/'.$id.'"><input type="button" class="btn btn-rounded btn-outline-info" style="width:auto; font-size: 11px;" value="'.__d('admin', 'Edit').'"></a>';
                    if($demo_active!='yes')
                    echo '<a onclick="deleteusrlists('.$id.',\'nonapproveduser\')"><input type="button" class="btn btn-rounded btn-outline-danger" style="width:auto; font-size: 11px;" value="'.__d('admin', 'Delete').'"></a>';
                    echo ' </td>';
                echo '</tr>';
            }
            }else{
                echo '<tr><td colspan="5" align="center">'.__d('admin', 'No Users Found').'</td></tr>';
            }
        ?>






 </tbody>
   </table>


    </div></div></div>    </div>
    </div>
    </div>


    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
        setTimeout(function() {
              $('#alertmsg').fadeOut('slow');
            }, 5000);
    </script>

   <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#nonapproveduserstable').DataTable({
    "bInfo" : false,
        dom: '<"usertoolbar">frtip',
          "order": [
                    [0, 'desc']
                ]
    });
    $("div.usertoolbar").html('<a  href="<?php echo $baseurl.'addmember/'; ?>" ><input type="button" class="btn btn-info" value="+ <?php echo __d('admin', 'Add User'); ?>"></a>');
    </script>



  </body>
</html>





