<?php
ob_start();
session_start();
if (!empty($_GET)) {
    $_GET   = filter_input_array(INPUT_GET,  FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
}
if (!empty($_POST)) {
    $_POST  = (filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES));
}
include("checksession.php");
include("config/dbconnect.php");
include("config/functions.php");
$id = $_SESSION['Amar_User_Id'];
$scon = '';
$loc_id2 = '';
$location2 = '';
$timezone = "Asia/Calcutta";
extract($_POST);
extract($_GET);
$curr_date=date('Y-m-d H:i:s');
$currentDate=date('Y-m-d H:i:s');

// get_trans_log($ado,basename($_SERVER["PHP_SELF"]),$id);

if(isset($_POST['key']) && $key=="edit")
{  
  $ids = $locid;
  $sel = "SELECT PURPOSE_ID,PURPOSE_OF_SUPPLY,IS_DELETE FROM VMS_PURPOSE_MAST WHERE PURPOSE_ID=$ids";
  $suc = $ado->Execute($sel);
  $loc_id2 = $suc->Fields("PURPOSE_ID");
  $location2 = $suc->Fields("PURPOSE_OF_SUPPLY");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('includes/title.php') ?>
    <style type="text/css">
      body
      {
        font-size: 14px !important;
      }
    </style>
    <style type="text/css">  
      .new1 tr th {
        padding: 5px;
        width: 14.2%;
        text-align: center;
        /*border:1px solid #ccc;*/
        font-weight: 200;
        background-color: #007bff;
        color: #FFF;
        font-weight: bold;
      }
      .new1 tr td {
        padding: 2px 5px;
        width: 14.2%;
        vertical-align: top;
        color: #000;
        border:1px solid #ccc;
        background-color: #FFFFFF;
      }
      .glyphicon
      {
        cursor: pointer;
      }
    </style>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <?php include('fancybox_2/fb.php'); ?>
      <?php include('includes/navbar.php') ?>
      <?php include('includes/sidebar.php') ?>
      <div class="content-wrapper">
        <section class="content-header"><!-- Content Header (Page header) -->
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Purpose Of Supply 
                </h1>
              </div>
              <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active">Purpose Of Supply </li>
                  </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <section class="content">
          <form name="sampleform" id="sampleform"  method="post" >
            <div class="col-md-6" >
              <div class="card">
                <div class="card-body" style="width:100%">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Purpose Of Supply</label>
                        <input type="text" name="location" id="location" class="form-control form-control-sm" maxlength="140" autocomplete="off" value="<?php if(!empty($location2)) { echo $location2; } ?>"  onkeypress="return singlequote(event);" >
                      </div>
                    </div>
                    <div class="col-sm-6" style="">
                      <label ></label>
                      <div class="form-group" style="">
                        <?php if(isset($_POST['key']) && $key=="edit") {?>
                          <input type="button" value="Update" class="btn btn-sm btn-primary " onclick="validation('upd')">
                          <?php } else { ?>
                          <input type="button" value="Save" class="btn btn-sm btn-primary " onclick="validation('sav')">
                          <?php } ?>  
                        <input type="button" value="Cancel" class="btn btn-sm btn-primary " onclick="funclr()">
                        <input type="button" value="Close" class="btn btn-sm btn-primary " onclick="homec()">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card" >
                <div class="card-body" style="width:120%;">
                  <div class="col-md-10">
                    <table class="table table-bordered nowrap" id='example1'>
                      <thead>
                        <tr>
                          <th width="10px">S No</th>
                          <th width="300px">Purpose Of Supply</th>
                          <th width="30px">Edit</th>
                          <th width="30px">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $cnt = 0;
                          $sql = "SELECT PURPOSE_ID,PURPOSE_OF_SUPPLY,IS_DELETE FROM VMS_PURPOSE_MAST ORDER BY PURPOSE_OF_SUPPLY ASC";
                          $qry = $ado->Execute($sql);
                          while(!$qry->EOF)
                          {
                            $cnt++;
                            $loc_id = $qry->Fields("PURPOSE_ID");
                            $location = $qry->Fields("PURPOSE_OF_SUPPLY");
                            $isdeleted = $qry->Fields("IS_DELETE");
                            ?>
                            <tr>
                              <td><?php echo $cnt; ?></td>
                              <td><?php echo $location; ?></td>
                              <td align="center">
                                <a href="#" onclick="onedit('<?php echo $loc_id;?>')">
                                  <i class="fas fa-edit"></i>
                                </a>
                              </td>
                              <td align="center">
                                <?php if ($isdeleted == 1) { ?>
                                  <a href="#" onclick="javaScript:updrecords('<?php echo $loc_id; ?>');"><i class="fa fa-toggle-off" style="color:red"></i></a>
                                  <?php } else { ?>
                                  <a href="#" onclick="javaScript:deleterole('<?php echo $loc_id; ?>');"><i class="fa fa-toggle-on" style="color:green"></i></a>
                                <?php } ?>
                              </td>
                            </tr>
                            <?php $qry->MoveNext(); 
                          } 
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <input type="hidden" name="key" >
                  <input type="hidden" name="locid" value="<?php 
                  if(!empty($loc_id2)) { echo $loc_id2; }
                    ?>">
                </div>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  <!-- </body> -->
    <?php include('includes/footer.php') ?>
    <?php include('includes/control_sidebar.php') ?>
    </div><!-- ./wrapper -->
    <?php
    if(isset($msg))
    {
        if ($msg == 1)
        {
            ?>
            <script type="text/javascript">
            toastr.success('Purpose Of Supply Saved Successfully');
            </script>
            <?php
        }
        if ($msg == 2)
        {
            ?>
            <script type="text/javascript">
            toastr.warning(' Purpose Of Supply Already Exists');
            </script>
            <?php
        }

        if ($msg == 3)
        {
            ?>
            <script type="text/javascript">
            toastr.success('Purpose Of Supply Updated Successfully');
            </script>
            <?php
        }

        if ($msg == 4)
        {
            ?>
            <script type="text/javascript">
            toastr.success('Purpose Of Supply Deleted Successfully');
            </script>
            <?php
        }

        if ($msg == 5)
        {
            ?>
            <script type="text/javascript">
            toastr.success('Purpose Of Supply Activated Successfully');
            </script>
            <?php
        }
      
    }
    ?>
    <script src="temp/t1/dist/js/demo.js"></script>
    <script src="temp/t1/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="temp/t1/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="temp/t1/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="temp/t1/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="temp/t1/plugins/jszip/jszip.min.js"></script>
    <script src="temp/t1/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="temp/t1/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="temp/t1/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="temp/t1/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="temp/t1/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- InputMask -->
    <script src="temp/t1/plugins/moment/moment.min.js"></script>
    <!-- Select2 -->
    <script src="temp/t1/plugins/select2/js/select2.full.min.js"></script>
    <!-- date-range-picker -->
    <script src="temp/t1/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="temp/t1/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>

      $(document).ready(function()
      {
        $("#example1").DataTable({
          "responsive": true,
          "lengthChange": true,
          "autoWidth": true,
          "paging" : false,
          "sScrollX": "100%",
          "sScrollXInner": "100%",
          "bScrollCollapse": true,
          "stateSave": true,
          "fixedHeader": true,
          "stateLoadParams": function (settings, data) 
          {
              data.search.search = "";
          },
      
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
    </script>
    <script>
      function homec()
      {
        self.location = "home.php";
          return true;
      }

      function funclr()
      {
        self.location = "doc_type_mast.php";
          return true;
      }
      function validation(flg)
      {
        var frm= document.sampleform;
        var loc = frm.location.value;
        if(loc==''){
            toastr.error("Please Enter Purpose Of Supply");
            frm.location.focus();
            return false; 
        }
        flg=='sav' ? frm.key.value="save" : frm.key.value="upd";
        // frm.key.value="save";
        frm.action="Purpose_of_supply_save.php";
        frm.submit();
      }

      function onedit(id)
      {
        var frm = document.sampleform;
        frm.locid.value =id;
        frm.key.value = "edit";
        // frm.action="#";
        frm.submit();
      }

      function deleterole(id)
      {
        var frm = document.sampleform;
        if (confirm('Are You sure to Delete this Purpose Of Supply ?'))
        {
          frm.locid.value = id;
          frm.key.value = "delete";
          frm.action="Purpose_of_supply_save.php";
          frm.submit();
        }
      }

      function updrecords(id)
      {
        var frm=document.sampleform;
        if(confirm('Are You sure to Activate this Purpose Of Supply ?'))
        {
          frm.locid.value=id;
          frm.action="Purpose_of_supply_save.php";
          frm.key.value = "activate";
          frm.submit();
        }
      }

    </script>
    <!-- AdminLTE for demo purposes -->
    <script src="temp/t1/dist/js/demo.js"></script>
  </body>
</html>