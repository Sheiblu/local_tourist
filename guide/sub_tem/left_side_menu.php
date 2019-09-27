
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
       <!--  <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">   -->
        <img src="image/guide/<?php echo $_SESSION['image'];?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['tour_by_local_guid_name']; ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
 


<?php if($_SESSION['status'] == "active"){ ?>

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"></li>
      <li>
        <a href="index.php">
          <i class="fa fa-dashboard"></i> <span>Home</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Tour</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="tour_list.php"><i class="fa fa-circle-o"></i>List</a></li>
          <li><a href="tour_create_new.php"><i class="fa fa-circle-o"></i>Create New Tour</a></li>
          <li><a href="tour_history.php"><i class="fa fa-circle-o"></i>History</a></li>
          <li><a href="tour_upcoming.php"><i class="fa fa-circle-o"></i>Upcoming</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Enroll Request</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="enroll_request_ture.php"><i class="fa fa-circle-o"></i>For Tour</a></li>
          <li><a href="guide_hiring_request.php"><i class="fa fa-circle-o"></i>For Guide</a></li>
        </ul>
      </li>
         <li class="treeview">
        <a href="#">
          <i class="fa fa-edit"></i> <span>Guide Hiring</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="recent_hiring_list.php"><i class="fa fa-circle-o"></i>Recent Hiring</a></li>
          <li><a href="hiring_history.php"><i class="fa fa-circle-o"></i>Previous Hiring History</a></li>
        </ul>
      </li>
      <!-- <li>
        <a href="calendar.php">
          <i class="fa fa-calendar"></i> <span>Calendar</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-red">3</small>
            <small class="label pull-right bg-blue">17</small>
          </span>
        </a>
      </li> -->
     <!--  <li class="treeview">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Comment and Rating</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Arranged Tour </a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Personal Guide</a></li>
        </ul>
      </li> -->
    </ul>

  <?php } else {?>
  <ul class="sidebar-menu" data-widget="tree">
      <li class="header"></li>
      <li>
        <a href="index.php">
          <i class="fa fa-dashboard"></i> <span>Home</span>
        </a>
      </li>
      <li>
        <a href="update_profile.php">
          <i class="fa fa-laptop"></i> <span>Update Profile</span>
        </a>
      </li>
    </ul>
 <?php } ?>
  </section>
  <!-- /.sidebar -->
</aside>
