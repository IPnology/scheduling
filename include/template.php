<?php

if (!$_SESSION['user_session'])
	{
		header("Location: ../user");	
	}
else{
	$user = $_SESSION['user_session'];
	
	$have = mysql_fetch_array(mysql_query("select * from user where idnumber='$user'"));
}

?>
<html lang="en">

<head>

    <title>CABECS Dept. Web Based Automated Exam Scheduling System</title>

    <!-- Bootstrap Core CSS -->
    <link href="../include/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../include/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../include/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../include/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../include/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                <a class="navbar-brand" href="../home">CABECS Dept. Web Based Automated Exam Scheduling System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                
				<br>
				Welcome <?=fullname($user);?> (<?=$have['auth']?>)! &nbsp;&nbsp;&nbsp;&nbsp;
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						
						<?php if ($have['auth']=='Admin'){ ?>
						
                        <li>
                            <a href="../user/?view=register"><i class="fa fa-user-plus fa-fw"></i> Register a New User</a>
                        </li>
						
						
						<li>
                            <a href="#"><i class="fa fa-sticky-note-o fa-fw"></i> Exams<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../exam/?view=adminList">List of Exams</a>
                                </li>
                                <li>
                                    <a href="../exam/?view=adminGridList">Grid View (Rooms)</a>
                                </li>
                                <li>
                                    <a href="../exam/?view=adminGridListFaculty">Grid View (Faculty)</a>
                                </li>
								
								<li>
									<a href="../exam/process.php?action=create_exam">Create Exam Schedule</a>
								</li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						
                        <li>
                            <a href="../user/?view=userList"><i class="fa fa-users fa-fw"></i> User List</a>
                        </li>
						
                        <li>
                            <a href="../room/"><i class="fa fa-institution fa-fw"></i> Room List</a>
                        </li>
						
                        <li>
                            <a href="../subject/"><i class="fa fa-book fa-fw"></i> Subjects List</a>
                        </li>
						
                        <li>
                            <a href="../importSubjects/"><i class="fa fa-upload fa-fw"></i> Import Subjects</a>
                        </li>
						
                        <li>
                            <a href="../generaleducation/process.php?action=create_exam"><i class="fa fa-sign-language fa-fw"></i>General Education List</a>
                        </li>
						
						<?php } else if ($have['auth']=='VPAA'){ ?>
						
                        <li>
                            <a href="../exam/?view=vpaaList"><i class="fa fa-sticky-note-o fa-fw"></i> View Exam Request</a>
                        </li>
						
                        <li>
                            <a href="../vpaa/?view=approvedList"><i class="fa fa-thumbs-up fa-fw"></i> Approved Exam Request</a>
                        </li>
						
                        <li>
                            <a href="../vpaa/?view=deniedList"><i class="fa fa-thumbs-down fa-fw"></i> Denied Exam Request</a>
                        </li>
						
						<?php } else if ($have['auth']=='Area Head'){ ?>
						
                        <li>
                            <a href="../exam/?view=areaList"><i class="fa fa-sticky-note-o fa-fw"></i> View Exam Schedule</a>
                        </li>
						
                        <li>
                            <a href="../exam/?view=areaCalendar"><i class="fa fa-calendar fa-fw"></i> View Calendar</a>
                        </li>
						
						<?php } else if ($have['auth']=='Faculty'){ ?>
						
                        <li>
                            <a href="../exam/?view=facultyList"><i class="fa fa-sticky-note-o fa-fw"></i> View Exam schedule</a>
                        </li>
						
                        <li>
                            <a href="../exam/?view=facultyCalendar"><i class="fa fa-calendar fa-fw"></i> View My Calendar</a>
                        </li>
						
                        <li>
                            <a href="../faculty/"><i class="fa fa-book fa-fw"></i> My Subjects</a>
                        </li>
					
						
						<?php } else if ($have['auth']=='Student'){ ?>
						
                        <li>
                            <a href="../exam/?view=studentList"><i class="fa fa-sticky-note-o fa-fw"></i> View My Exam Schedule</a>
                        </li>
						
                        <li>
                            <a href="../exam/?view=studentCalendar"><i class="fa fa-calendar fa-fw"></i> View My Calendar</a>
                        </li>
						
                        <li>
                            <a href="../student/"><i class="fa fa-book fa-fw"></i>My Subjects</a>
                        </li>
						
						<?php
							include '../student/mySubjects.php';
							?>
						
						<?php } else {} ;?>
						
						<li>
							<a href="../user/process.php?action=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
						</li>
                    </ul>
                </div>
				
				
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
			<?php require_once $content;?>
		</div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../include/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../include/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../include/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../include/vendor/raphael/raphael.min.js"></script>
    <script src="../include/vendor/morrisjs/morris.min.js"></script>
    <script src="../include/data/morris-data.js"></script>
	
	 <!-- DataTables JavaScript -->
    <script src="../include/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../include/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../include/vendor/datatables-responsive/dataTables.responsive.js"></script>


    <!-- Custom Theme JavaScript -->
    <script src="../include/dist/js/sb-admin-2.js"></script>
	
	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	<script>
$(document).ready(function(){
    $('#auth').on('change', function() {
      if ( this.value == 'Area Head')
      {
        $("#area").show();
        $("#course").hide();
        $("#year").hide();
        $("#section").hide();
      }
      else if ( this.value == 'Student')
      {
        $("#area").hide();
        $("#course").show();
        $("#year").show();
        $("#section").show();
      }
      else
      {
        $("#area").hide();
        $("#course").hide();
        $("#year").hide();
        $("#section").hide();
      }
    });
});
</script>

</body>

</html>
