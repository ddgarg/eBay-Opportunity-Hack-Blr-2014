<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventory Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-multiselect.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        function fetchLocations(){
                $.ajax({
                    type:"POST",
                    url:"../fetchLocations.php",
                    data:{},
                    success:function(data){
                        $("#location").html(data);
                    }
                });
            }

            function fetchTags(){
                $.ajax({
                    type:"POST",
                    url:"../fetchTags.php",
                    data:{},
                    success:function(data){
                        $("#tags").html(data);
                    }
                });
            }

            fetchLocations();
            fetchTags();

            function searchInventoryByLocation($location){
                $.ajax({
                    type:"POST",
                    url:"../searchInventoryByLocation.php",
                    data:{location:$location},
                    success:function(data){
                        
                        $("#searchresults").append(data);
                        $('#searchModal').modal(
                            {
                              show:true
                            });
                    }
                });
            }

            function searchInventoryByTag($tag){
                $.ajax({
                    type:"POST",
                    url:"../searchInventoryByTag.php",
                    data:{tag:$tag},
                    success:function(data){
                        $("#searchresults").append(data);
                        $('#searchModal').modal(
                            {
                              show:true
                            });
                    }
                });
            }

            $("#searchButton").click(function(){
                $("#searchresults").html('');
                $location = $("#location").val();
                if($location != "select")
                    searchInventoryByLocation($location);

                $tag = $("#tags").val();

                if($tag != "select")
                    searchInventoryByTag($tag);
            });

            $('#searchModal').on('shown.bs.modal', function () {
                $(this).find('.modal-dialog').css({width:'auto',
                                           height:'auto', 
                                          'max-height':'100%'});
});
    
});
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="rawmaterials.php">Nirmaan Inventory Management System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#" role="button" data-toggle="modal" data-target="#viewUserModal"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#" role="button" data-toggle="modal" data-target="#editUserModal"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <!--<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            
                        </li>-->
                        <li>
                            <a class="active" href="rawmaterials.php"><i class="fa fa-dashboard fa-fw"></i> Current Status</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-search fa-fw"></i> Search Raw Materials<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <!--<li>
                                   <label>
                                        &nbsp;<input type="checkbox"> Out Of Stock
                                    </label>
                                </li>-->
                                <li>
                                    &nbsp;<label> Tags:
                                    <select class="form-control" id="tags">
                                        
                                  </select>
                                </label>
                                </li>
                                <li>
                                    &nbsp;<label> Locations:
                                    <select class="form-control" id="location">
                                    
                                    </select>
                                    </label>
                                </li>
                                <br>
                                <li>
                                   <center><button id="searchButton" class="btn btn-primary" >Search</button></center>
                                </li> 
                                <br>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> View Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Graphical Representation</a>
                                </li>
                                <li>
                                    <a href="morris.html">Tabular Representation</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                   
                </div>
                <!-- /.sidebar-collapse -->
                <br>
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Current status of raw materials in inventory</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Tags</th>
                                            <th>Location</th>
                                            <th>Quantity Available </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            include '../connection.php';
                                            $query = "select i.name, i.image, i.price, i.tags, i.location, iss.final_quantity from inventory_status iss join inventory i on i.id = iss.i_id where iss.t_id in
(select max(iss2.t_id) from inventory_status iss2 group by iss2.i_id)";
                                            //$query = "select * from inventory";
                                            $result=mysql_query($query,$connection);
                                            
                                            while($row = mysql_fetch_array($result))
                                            {
                                                echo '<tr>';
                                                echo '<td>'.$row[0].'</td>';
                                                echo '<td>'.$row[1].'</td>';
                                                echo '<td>'.$row[3].'</td>';
                                                echo '<td>'.$row[4].'</td>';
                                                echo '<td>'.$row[2].'</td>';
                                                echo '</tr>';
                                            }
                                            

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>

<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="searchModalLabel">Search Results</h4>
      </div>
      <div class="modal-body">
        <div class="container" id="searchresults">

                    
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-multiselect.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Morris Charts JavaScript -->


    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

</body>

</html>
