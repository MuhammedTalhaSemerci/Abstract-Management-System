


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $abstracter_language[0]; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/view/user-panel-assets/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/view/user-panel-assets/dist/css/adminlte.min.css">
</head>


<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav" >
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
   
      <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link"><?php echo $user_name; ?></a></li>
      <li class="nav-item  d-sm-inline-block">
        <a href="/cikis" class="nav-link"><?php echo $abstracter_language[1]; ?></a>
      </li>
     
    </ul>

  <div class="col-lg-3 col-md-3"></div>

   
      <li class="nav-item  d-sm-inline-block" style="all:unset;float:left; margin-left:auto;">
          <button onclick="language_changer_tr()" name="language_changer_tr" style="all:unset;border:0px;border-radius:5px;width:50px;height:50px;" class="menubar"><img src="/view/user-panel-assets/dist/img/turkey-flag.png" style="width:40px;height:40px;"></button>
      </li>
      <li class="nav-item  d-sm-inline-block"  style="all:unset;float:left;">
          <button onclick="language_changer_en()" name="language_changer_en" style="all:unset;border:0px;border-radius:5px;width:50px;height:50px;"><img src="/view/user-panel-assets/dist/img/america-flag.png" style="width:45px;height:32px;"></button>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" >
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
 
     
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
   <?php
   include(__DIR__."/menu.php");
   ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $abstracter_language[13]; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/abstract_index"><?php echo $abstracter_language[14]; ?></a></li>
              <li class="breadcrumb-item"><?php echo $abstracter_language[15]; ?></li>
              <li class="breadcrumb-item active"><?php echo $user_name; ?></li>
            
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content"  >
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-12">
            <div class="card" >
           
            <!-- /.card -->

<?php




if(isset($_GET["sayfa"])){

  if($_GET["sayfa"] == "abstract_upload" && $abstract_websites[0]["abstract_time_limit"] > date('U')){

    include(__DIR__."/abstract_upload.php");

  }


  if($_GET["sayfa"] == "my_abstracts"){

    include(__DIR__."/my_abstracts.php");


  }

  if($_GET["sayfa"] == "main_author_abstracts"){

    include(__DIR__."/main_author_abstracts.php");


  }

  if($_GET["sayfa"] == "abstract_update"){

    include(__DIR__."/abstract_update.php");


  }

  if($_GET["sayfa"] == "abstract_author_update"){

    include(__DIR__."/abstract_author_update.php");


  }


  if($_GET["sayfa"] == "abstract_category_update"){

    include(__DIR__."/abstract_category_update.php");


  }

  if($_GET["sayfa"] == "abstract_presentations"){

    include(__DIR__."/abstract_presentations.php");


  }

  
  if($_GET["sayfa"] == "scientific_program_viewer"){

    include(__DIR__."/scientific_program_viewer.php");


  }


  if($_GET["sayfa"] == "session_abstract_info"){

    include(__DIR__."/session_abstract_info.php");


  }

  if($_GET["sayfa"] == "profile_update"){

    include(__DIR__."/profile_update.php");


  }


  if($_GET["sayfa"] == "congress_register_status"){

    include(__DIR__."/congress_register_status.php");


  }


  if($_GET["sayfa"] == "congress_register"){

    include(__DIR__."/congress_register.php");


  }


  if($_GET["sayfa"] == "congress_document_upload"){

      include(__DIR__."/congress_document_upload.php");

  }

  if($_GET["sayfa"] == "virtual_congress_sponsor_pages"){

    include(__DIR__."/virtual_congress_sponsor_pages.php");
  }

  if($_GET["sayfa"] == "virtual_congress_sponsor_documents"){

    include(__DIR__."/virtual_congress_sponsor_documents.php");
  }
  
  if($_GET["sayfa"] == "virtual_congress_sponsor_videos"){

    include(__DIR__."/virtual_congress_sponsor_videos.php");
  }
}

?>
            <!-- /.card -->
          </div>
     
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<!-- Bootstrap -->
<script src="/view/user-panel-assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="/view/user-panel-assets/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="/view/user-panel-assets/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/view/user-panel-assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/view/user-panel-assets/dist/js/pages/dashboard3.js"></script>


<script>


function postForm(path, params, method) {
    method = method || 'post';

    var form = document.createElement('form');
    form.setAttribute('method', method);
    form.setAttribute('action', path);

    for (var key in params) {
        if (params.hasOwnProperty(key)) {
            var hiddenField = document.createElement('input');
            hiddenField.setAttribute('type', 'hidden');
            hiddenField.setAttribute('name', key);
            hiddenField.setAttribute('value', params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}



 function language_changer_tr (){

    postForm("/main_language_changer?page=<?php echo $_GET["sayfa"]; ?>",{language:"tr"});

}




 function language_changer_en (){

postForm("/main_language_changer?page=<?php echo $_GET["sayfa"]; ?>",{language:"en"});

}

</script>



	
<script src="https://kit.fontawesome.com/a9da6c256f.js" crossorigin="anonymous"></script>
<script src="view/js/mobilemask.debug.js" type="text/javascript"></script>
</body>
</html>
