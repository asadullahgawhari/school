  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Clock -->
       <a class="btn hidden-xs" style="font-weight:bold;color:#343a40">

       <body onload="startTime()">

        <div id="txt"></div>

            <script>
            function startTime() {
            const today = new Date();
            let h = today.getHours();
            let m = today.getMinutes();
            let s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =  h + ":" + m + ":" + s;
            setTimeout(startTime, 1000);
            }

            function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
            }
            </script>

        </body>

       </a>
       <!-- End Clock-->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      @php
        $AllChatUserCount = App\Models\ChatModel::getAllChatUserCount();
      @endphp
      <!-- Messages Dropdown Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{ url('chat') }}">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{ !empty($AllChatUserCount) ? $AllChatUserCount : '' }}</span>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <!-- Logout -->
      <li class="nav-item">
        <a class="nav-link" href="{{ url('logout') }}">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      <!-- Fullscreen -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('') }}" class="brand-link" style="text-align: left;">
      <img src="{{ $getHeaderSetting->getLogo() }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-2">
      <span class="brand-text font-weight-light" style="font-weight: bold !important">&nbsp;&nbsp;&nbsp;&nbsp; School MIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(Auth::user()->getProfile())
            <img src="{{ Auth::user()->getProfile() }}" style="height: 33px; width: 33px; border-radius: 50px;">
          @else
            <img src="{{ url('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="https://www.linkedin.com/in/asadullahgawhari/" class="d-block" target="_blank">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Admin -->
          @if(Auth::user()->user_type == 1)

          <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Admin
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/teacher/list') }}" class="nav-link @if(Request::segment(2) == 'teacher') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Teacher
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/student/list') }}" class="nav-link @if(Request::segment(2) == 'student') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Student
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/parent/list') }}" class="nav-link @if(Request::segment(2) == 'parent') active @endif">
              <i class="nav-icon far fa-user"></i>
              <p>
                Parent
              </p>
            </a>
          </li>
          
          <li class="nav-item @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'class' || Request::segment(2) == 'subject' || Request::segment(2) == 'assign_subject' || Request::segment(2) == 'assign_class_teacher' || Request::segment(2) == 'class_timetable') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Academics
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/subject/list') }}" class="nav-link @if(Request::segment(2) == 'subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/assign_subject/list') }}" class="nav-link @if(Request::segment(2) == 'assign_subject') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Subject</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/class_timetable/list') }}" class="nav-link @if(Request::segment(2) == 'class_timetable') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Class Timetable</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/assign_class_teacher/list') }}" class="nav-link @if(Request::segment(2) == 'assign_class_teacher') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign Class Teacher</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'fees_collection') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'fees_collection') active @endif">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                  Fees Collection
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/fees_collection/collect_fees') }}" class="nav-link @if(Request::segment(3) == 'collect_fees') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collect Fees</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/fees_collection/collect_fees_report') }}" class="nav-link @if(Request::segment(3) == 'collect_fees_report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collect Fees Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'examinations') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'examinations') active @endif">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Examinations
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/examinations/exam/list') }}" class="nav-link @if(Request::segment(3) == 'exam') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/examinations/exam_schedule') }}" class="nav-link @if(Request::segment(3) == 'exam_schedule') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/examinations/marks_register') }}" class="nav-link @if(Request::segment(3) == 'marks_register') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Register</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/examinations/marks_grade/list') }}" class="nav-link @if(Request::segment(3) == 'marks_grade') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Grade</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
              <i class="nav-icon fas fa-file"></i>
              <p>
                  Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'communicate') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'communicate') active @endif">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                  Communicate
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/communicate/notice_board') }}" class="nav-link @if(Request::segment(3) == 'notice_board') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Notice Board</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('admin/communicate/send_email') }}" class="nav-link @if(Request::segment(3) == 'send_email') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send Email</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                  Homework
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/homework/homework_report') }}" class="nav-link @if(Request::segment(3) == 'homework_report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework Report</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/setting') }}" class="nav-link @if(Request::segment(2) == 'setting') active @endif">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Setting
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

          <!-- Teacher -->
          @elseif(Auth::user()->user_type == 2)

          <li class="nav-item">
            <a href="{{ url('teacher/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('teacher/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Student
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('teacher/my_class_subject') }}" class="nav-link @if(Request::segment(2) == 'my_class_subject') active @endif">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                My Class & Subject
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('teacher/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                My Exam Timetable
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('teacher/my_calendar') }}" class="nav-link @if(Request::segment(2) == 'my_calendar') active @endif">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                My Calendar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('teacher/marks_register') }}" class="nav-link @if(Request::segment(2) == 'marks_register') active @endif">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Marks Register
              </p>
            </a>
          </li>
          <li class="nav-item @if(Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'attendance') active @endif">
              <i class="nav-icon fas fa-file"></i>
              <p>
                  Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('teacher/attendance/student') }}" class="nav-link @if(Request::segment(3) == 'student') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('teacher/attendance/report') }}" class="nav-link @if(Request::segment(3) == 'report') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item @if(Request::segment(2) == 'homework') menu-is-opening menu-open @endif">
            <a href="#" class="nav-link @if(Request::segment(2) == 'homework') active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                  Homework
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('teacher/homework/homework') }}" class="nav-link @if(Request::segment(3) == 'homework') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Homework</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('teacher/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                My Notice Board
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('teacher/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('teacher/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

          <!-- Student -->
          @elseif(Auth::user()->user_type == 3)

          <li class="nav-item">
            <a href="{{ url('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/fees_collection') }}" class="nav-link @if(Request::segment(2) == 'fees_collection') active @endif">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Fees Collection
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_calendar') }}" class="nav-link @if(Request::segment(2) == 'my_calendar') active @endif">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                My Calendar
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_subject') }}" class="nav-link @if(Request::segment(2) == 'my_subject') active @endif">
              <i class="nav-icon fas fa-book"></i>
              <p>
                My Subject
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_timetable') active @endif">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                My Timetable
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_exam_timetable') }}" class="nav-link @if(Request::segment(2) == 'my_exam_timetable') active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                My Exam Timetable
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_exam_result') }}" class="nav-link @if(Request::segment(2) == 'my_exam_result') active @endif">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                My Exam Result
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_attendance') }}" class="nav-link @if(Request::segment(2) == 'my_attendance') active @endif">
              <i class="nav-icon fas fa-file"></i>
              <p>
                My Attendance
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                My Notice Board
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_homework') }}" class="nav-link @if(Request::segment(2) == 'my_homework') active @endif">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                My Homework
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/my_submitted_homework') }}" class="nav-link @if(Request::segment(2) == 'my_submitted_homework') active @endif">
              <i class="nav-icon fas fa-upload"></i>
              <p>
                Submitted Homework
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('student/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

          <!-- Parent -->
          @elseif(Auth::user()->user_type == 4)

          <li class="nav-item">
            <a href="{{ url('parent/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('parent/my_student') }}" class="nav-link @if(Request::segment(2) == 'my_student') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Student
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('parent/my_notice_board') }}" class="nav-link @if(Request::segment(2) == 'my_notice_board') active @endif">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                My Notice Board
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('parent/account') }}" class="nav-link @if(Request::segment(2) == 'account') active @endif">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                My Account
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('parent/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
              <i class="nav-icon fas fa-unlock"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

          @endif

          <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>