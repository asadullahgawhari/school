<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\ClassTimetableController;
use App\Http\Controllers\ExaminationsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CommunicateController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\FeesCollectionController;
use App\Http\Controllers\ChatController;

// Login, Logout & Forgot password url
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);

// Group Common for Chat
Route::group(['middleware' => 'common'], function () {
    Route::get('chat', [ChatController::class, 'chat']);
    Route::post('submit_message', [ChatController::class, 'submit_message']);
    Route::post('get_chat_windows', [ChatController::class, 'get_chat_windows']);
    Route::post('get_chat_search_user', [ChatController::class, 'get_chat_search_user']);
});

// Group Admin
Route::group(['middleware' => 'admin'], function () {

    // Dashboard Admin url
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    // Admin url
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    // Teacher url
    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);
    // Export to Excel
    Route::post('admin/teacher/export_teacher', [TeacherController::class, 'export_teacher_excel']);

    // Student url
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);
    // Export to Excel
    Route::post('admin/student/export_student', [StudentController::class, 'export_student_excel']);

    // Parent url
    Route::get('admin/parent/list', [ParentController::class, 'list']);
    Route::get('admin/parent/add', [ParentController::class, 'add']);
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    // Export to Excel
    Route::post('admin/parent/export_parent', [ParentController::class, 'export_parent_excel']);

    // Parent assign to student url
    Route::get('admin/parent/my_student/{id}', [ParentController::class, 'myStudent']);
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent']);
    Route::get('admin/parent/assign_student_parent_delete/{student_id}', [ParentController::class, 'AssignStudentParentDelete']);

    // Class url
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

    // Subject url
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    // Class Assign Subject url
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);

    // Assign Class to Teacher url
    Route::get('admin/assign_class_teacher/list', [AssignClassTeacherController::class, 'list']);
    Route::get('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'add']);
    Route::post('admin/assign_class_teacher/add', [AssignClassTeacherController::class, 'insert']);
    Route::get('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'edit']);
    Route::post('admin/assign_class_teacher/edit/{id}', [AssignClassTeacherController::class, 'update']);
    Route::get('admin/assign_class_teacher/delete/{id}', [AssignClassTeacherController::class, 'delete']);
    Route::get('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'edit_single']);
    Route::post('admin/assign_class_teacher/edit_single/{id}', [AssignClassTeacherController::class, 'update_single']);

    // Fees Collection
    Route::get('admin/fees_collection/collect_fees', [FeesCollectionController::class, 'collect_fees']);
    Route::get('admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesCollectionController::class, 'collect_fees_add']);
    Route::post('admin/fees_collection/collect_fees/add_fees/{student_id}', [FeesCollectionController::class, 'collect_fees_insert']);
    Route::get('admin/fees_collection/collect_fees_report', [FeesCollectionController::class, 'collect_fees_report']);
    // Fees Collection Export to Excel
    Route::post('admin/fees_collection/export_collect_fees_report', [FeesCollectionController::class, 'export_collect_fees_report']);

    // Class Timetable url
    Route::get('admin/class_timetable/list', [ClassTimetableController::class, 'list']);
    Route::post('admin/class_timetable/get_subject', [ClassTimetableController::class, 'get_subject']);
    Route::post('admin/class_timetable/add', [ClassTimetableController::class, 'insert_update']);

    // Examinations
    Route::get('admin/examinations/exam/list', [ExaminationsController::class, 'exam_list']);
    Route::get('admin/examinations/exam/add', [ExaminationsController::class, 'exam_add']);
    Route::post('admin/examinations/exam/add', [ExaminationsController::class, 'exam_insert']);
    Route::get('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_edit']);
    Route::post('admin/examinations/exam/edit/{id}', [ExaminationsController::class, 'exam_update']);
    Route::get('admin/examinations/exam/delete/{id}', [ExaminationsController::class, 'exam_delete']);

    Route::get('admin/my_exam_result/print', [ExaminationsController::class, 'myExamResultPrint']);

    // Exam Schedule - Exam Timetable
    Route::get('admin/examinations/exam_schedule', [ExaminationsController::class, 'exam_schedule']);
    Route::post('admin/examinations/exam_schedule_insert', [ExaminationsController::class, 'exam_schedule_insert']);

    // Marks Register
    Route::get('admin/examinations/marks_register', [ExaminationsController::class, 'marks_register']);
    Route::post('admin/examinations/submit_marks_register', [ExaminationsController::class, 'submit_marks_register']);
    Route::post('admin/examinations/single_submit_marks_register', [ExaminationsController::class, 'single_submit_marks_register']);

    // Marks Grade
    Route::get('admin/examinations/marks_grade/list', [ExaminationsController::class, 'marks_grade_list']);
    Route::get('admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_add']);
    Route::post('admin/examinations/marks_grade/add', [ExaminationsController::class, 'marks_grade_insert']);
    Route::get('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_edit']);
    Route::post('admin/examinations/marks_grade/edit/{id}', [ExaminationsController::class, 'marks_grade_update']);
    Route::get('admin/examinations/marks_grade/delete/{id}', [ExaminationsController::class, 'marks_grade_delete']);

    // Attendance
    Route::get('admin/attendance/student', [AttendanceController::class, 'StudentAttendance']);
    Route::post('admin/attendance/student/save', [AttendanceController::class, 'StudentAttendanceSubmit']);
    Route::get('admin/attendance/report', [AttendanceController::class, 'AttendanceReport']);
    // Export to Excel
    Route::post('admin/attendance/export_Attendance_report', [AttendanceController::class, 'export_attendance_report_to_excel']);

    // Communicate
    // Notice Board
    Route::get('admin/communicate/notice_board', [CommunicateController::class, 'NoticeBoard']);
    Route::get('admin/communicate/notice_board/add', [CommunicateController::class, 'AddNoticeBoard']);
    Route::post('admin/communicate/notice_board/add', [CommunicateController::class, 'InsertNoticeBoard']);
    Route::get('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'EditNoticeBoard']);
    Route::post('admin/communicate/notice_board/edit/{id}', [CommunicateController::class, 'UpdateNoticeBoard']);
    Route::get('admin/communicate/notice_board/delete/{id}', [CommunicateController::class, 'DeleteNoticeBoard']);

    // Send Email
    Route::get('admin/communicate/send_email', [CommunicateController::class, 'SendEmail']);
    Route::post('admin/communicate/send_email', [CommunicateController::class, 'SendEmailUser']);

    Route::get('admin/communicate/search_user', [CommunicateController::class, 'SearchUser']);

    // Homework
    Route::get('admin/homework/homework', [HomeworkController::class, 'homework']);
    Route::get('admin/homework/homework/add', [HomeworkController::class, 'add']);
    Route::post('admin/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::post('admin/homework/homework/add', [HomeworkController::class, 'insert']);
    Route::get('admin/homework/homework/edit/{id}', [HomeworkController::class, 'edit']);
    Route::post('admin/homework/homework/edit/{id}', [HomeworkController::class, 'update']);
    Route::get('admin/homework/homework/delete/{id}', [HomeworkController::class, 'delete']);

    // Homework
    Route::get('admin/homework/homework_report', [HomeworkController::class, 'HomeworkReport']);

    // Submitted Homework
    Route::get('admin/homework/homework/submitted/{id}', [HomeworkController::class, 'submitted']);

    // Setting
    Route::get('admin/setting', [UserController::class, 'Setting']);
    Route::post('admin/setting', [UserController::class, 'UpdateSetting']);

    // Edit My Account
    Route::get('admin/account', [UserController::class, 'MyAccount']);
    Route::post('admin/account', [UserController::class, 'UpdateMyAccountAdmin']);

    // Change Password url
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);

});

// Group Teacher
Route::group(['middleware' => 'teacher'], function () {

    // Dashboard Teacher url
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

    // Edit My Account
    Route::get('teacher/account', [UserController::class, 'MyAccount']);
    Route::post('teacher/account', [UserController::class, 'UpdateMyAccount']);

    // Change Password url
    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);

    // My Class & Subject
    Route::get('teacher/my_class_subject', [AssignClassTeacherController::class, 'MyClassSubject']);

    // My Student Timetable
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimetableController::class, 'MyTimetableTeacher']);

    // My Student Exam Timetable
    Route::get('teacher/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetableTeacher']);
    Route::get('teacher/my_exam_result/print', [ExaminationsController::class, 'myExamResultPrint']);

    // Marks Register
    Route::get('teacher/marks_register', [ExaminationsController::class, 'marks_register_teacher']);
    Route::post('teacher/submit_marks_register', [ExaminationsController::class, 'submit_marks_register']);
    Route::post('teacher/single_submit_marks_register', [ExaminationsController::class, 'single_submit_marks_register']);

    // Attendance
    Route::get('teacher/attendance/student', [AttendanceController::class, 'StudentAttendanceTeacher']);
    Route::post('teacher/attendance/student/save', [AttendanceController::class, 'StudentAttendanceSubmit']);
    Route::get('teacher/attendance/report', [AttendanceController::class, 'AttendanceReportTeacher']);

    // Homework
    Route::get('teacher/homework/homework', [HomeworkController::class, 'HomeworkTeacher']);
    Route::get('teacher/homework/homework/add', [HomeworkController::class, 'AddTeacher']);
    Route::post('teacher/ajax_get_subject', [HomeworkController::class, 'ajax_get_subject']);
    Route::post('teacher/homework/homework/add', [HomeworkController::class, 'InsertTeacher']);
    Route::get('teacher/homework/homework/edit/{id}', [HomeworkController::class, 'EditTeacher']);
    Route::post('teacher/homework/homework/edit/{id}', [HomeworkController::class, 'UpdateTeacher']);
    Route::get('teacher/homework/homework/delete/{id}', [HomeworkController::class, 'Delete']);

    //Submitted Homework
    Route::get('teacher/homework/homework/submitted/{id}', [HomeworkController::class, 'submittedTeacher']);

    // My Notice Board
    Route::get('teacher/my_notice_board', [CommunicateController::class, 'MyNoticeBoardTeacher']);

    // My Calendar
    Route::get('teacher/my_calendar', [CalendarController::class, 'MyCalendarTeacher']);

    // My Student
    Route::get('teacher/my_student', [StudentController::class, 'MyStudent']);

});

// Group Student
Route::group(['middleware' => 'student'], function () {

    // Dashboard Student url
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

    // My Fees Collection
    Route::get('student/fees_collection', [FeesCollectionController::class, 'CollectFeesStudent']);
    Route::post('student/fees_collection', [FeesCollectionController::class, 'CollectFeesStudentPayment']);

    // Paypal - Paypal payment don't working - when we make the acount paypal just see the record 95 school mis
    Route::get('student/paypal/payment-error', [FeesCollectionController::class, 'PaymentError']);
    Route::get('student/paypal/payment-success', [FeesCollectionController::class, 'PaymentSuccess']);

    // Stripe - // Stripe also don't working - Invalid API Key provided error
    Route::get('student/stripe/payment-error', [FeesCollectionController::class, 'PaymentError']);
    Route::get('student/stripe/payment-success', [FeesCollectionController::class, 'PaymentSuccessStripe']);

    // My Calendar
    Route::get('student/my_calendar', [CalendarController::class, 'MyCalendar']);

    // My Subject
    Route::get('student/my_subject', [SubjectController::class, 'MySubject']);

    // My Timetable
    Route::get('student/my_timetable', [ClassTimetableController::class, 'MyTimetable']);

    // My Exam Timetable
    Route::get('student/my_exam_timetable', [ExaminationsController::class, 'MyExamTimetable']);

    // Exam Result and Print - Marks Register
    Route::get('student/my_exam_result', [ExaminationsController::class, 'myExamResult']);
    Route::get('student/my_exam_result/print', [ExaminationsController::class, 'myExamResultPrint']);

    // My Attendance
    Route::get('student/my_attendance', [AttendanceController::class, 'MyAttendanceStudent']);
    Route::get('student/my_notice_board', [CommunicateController::class, 'MyNoticeBoardStudent']);

    // My Homework
    Route::get('student/my_homework', [HomeworkController::class, 'MyHomeworkStudent']);
    Route::get('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomework']);
    Route::post('student/my_homework/submit_homework/{id}', [HomeworkController::class, 'SubmitHomeworkInsert']);

    // My Submitted Homework
    Route::get('student/my_submitted_homework', [HomeworkController::class, 'MySubmittedHomework']);

    // Edit My Account
    Route::get('student/account', [UserController::class, 'MyAccount']);
    Route::post('student/account', [UserController::class, 'UpdateMyAccountStudent']);

    // Change Password url
    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);

});

// Group Parent
Route::group(['middleware' => 'parent'], function () {

    // Dashboard Parent url
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

    // My Student or Son
    Route::get('parent/my_student', [ParentController::class, 'MyStudentParent']);

    // Parent Student Subject
    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class, 'ParentStudentSubject']);

    // My Son - Student Exam Timetable
    Route::get('parent/my_student/exam_timetable/{student_id}', [ExaminationsController::class, 'MyExamTimetableParent']);

    // My Son - Student Exam Result
    Route::get('parent/my_student/exam_result/{student_id}', [ExaminationsController::class, 'MyExamResultParent']);
    Route::get('parent/my_exam_result/print', [ExaminationsController::class, 'myExamResultPrint']);

    // My Son | Student Timetable
    Route::get('parent/my_student/subject/{student_id}', [SubjectController::class, 'ParentStudentSubject']);
    Route::get('parent/my_student/subject/class_timetable/{class_id}/{subject_id}/{student_id}', [ClassTimetableController::class, 'MyTimetableParent']);

    // My Son | Student Exam Timetable Calendar
    Route::get('parent/my_student/calendar/{student_id}', [CalendarController::class, 'MyCalendarParent']);

    // My Son - Student Attendance
    Route::get('parent/my_student/attendance/{student_id}', [AttendanceController::class, 'MyAttendanceParent']);

    // My son | Homework
    Route::get('parent/my_student/homework/{student_id}', [HomeworkController::class, 'MyHomeworkParent']);
    Route::get('parent/my_student/submitted_homework/{student_id}', [HomeworkController::class, 'MySubmittedHomeworkParent']);

    // My Notice Board
    Route::get('parent/my_notice_board', [CommunicateController::class, 'MyNoticeBoardParent']);

    // Edit My Account
    Route::get('parent/account', [UserController::class, 'MyAccount']);
    Route::post('parent/account', [UserController::class, 'UpdateMyAccountParent']);

    // Change Password url
    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);

});