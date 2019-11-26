<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Admin')->prefix('admin')->group(function () {
    Route::get('login', 'LoginController@index')->name('admin.login.white');
    Route::post('login', 'LoginController@login')->name('admin.login.post.white');
    Route::post('logout', 'LoginController@logout')->name('admin.logout.white');

    Route::middleware(['login', 'menu'])->group(function () {
        Route::get('index', 'AdminController@index')->name('admin.index.white');
        Route::get('modify_pwd', 'AdminController@modifyPwd')->name('admin.modify_pwd.white');
        Route::post('new_pwd', 'AdminController@newPwd')->name('admin.new_pwd.white');
        // Route::get('forbidden', function () {
        //     return view('admin.403');
        // })->name('admin.forbidden.white');

        //Route::middleware('auth.can')->group(function(){
            Route::get('/user', 'UserController@index')->name('admin.user.index');
            Route::get('/user/user_create', 'UserController@user_create')->name('admin.user.user_create');//用户添加
            Route::get('/user/user_index', 'UserController@user_index')->name('admin.user.user_index');//用户列表
            Route::post('/user/user_create_do', 'UserController@user_create_do')->name('admin.user.user_create_do');//用户添加执行
            Route::post('/user/status', 'UserController@status')->name('admin.user.status');
            Route::get('/user/edit', 'UserController@edit')->name('admin.user.edit');
            Route::post('/user/edit_do', 'UserController@edit_do')->name('admin.user.edit_do');
            Route::post('/user/del', 'UserController@del')->name('admin.user.del');

            Route::get('/permission', 'PermissionController@index')->name('admin.permission.index');
            Route::get('/permission/create', 'PermissionController@create')->name('admin.permission.create');
            Route::post('/permission/store', 'PermissionController@store')->name('admin.permission.store');
            Route::get('/permission/edit', 'PermissionController@edit')->name('admin.permission.edit');
            Route::post('/permission/update', 'PermissionController@update')->name('admin.permission.update');
            Route::post('/permission/delete', 'PermissionController@delete')->name('admin.permission.delete');

            Route::get('/roles/roles_index', 'RolesController@roles_index')->name('admin.roles.roles_index');//角色列表
            Route::get('/roles/roles_add', 'RolesController@roles_add')->name('admin.roles.roles_add');//角色添加
            Route::post('/roles/roles_add_do', 'RolesController@roles_add_do')->name('admin.roles.roles_add_do');//角色执行添加
            Route::get('/roles/roles_edit', 'RolesController@roles_edit')->name('admin.roles.roles_edit');//角色修改
            Route::post('/roles/roles_edit_do', 'RolesController@roles_edit_do')->name('admin.roles.roles_edit_do');//角色执行修改
            Route::post('/roles/is_del', 'RolesController@is_del')->name('admin.roles.is_del');//角色禁用

            Route::get('/course_audit', 'AuditController@course_audit')->name('admin.audit.course_audit');//课程审核
            Route::post('/course_audit_close', 'AuditController@course_audit_close')->name('admin.audit.course_audit_close');//课程点击审核
            Route::get('/lect_audit', 'AuditController@lect_audit')->name('admin.audit.lect_audit');//讲师审核
            Route::post('/lect_audit_close', 'AuditController@lect_audit_close')->name('admin.audit.lect_audit_close');//讲师点击审核

            Route::get('/menu', 'MenuController@index')->name('admin.menu.index');
            Route::get('/menu/create', 'MenuController@create')->name('admin.menu.create');
            Route::post('/menu/store', 'MenuController@store')->name('admin.menu.store');
            Route::get('/menu/edit', 'MenuController@edit')->name('admin.menu.edit');
            Route::post('/menu/update', 'MenuController@update')->name('admin.menu.update');
            Route::post('/menu/delete', 'MenuController@delete')->name('admin.menu.delete');

            Route::get('lect/create','LectController@create')->name('admin.lect.create.index');//讲师添加
            Route::any('lect/index','LectController@store')->name('admin.lect.index');//处理讲师添加
            Route::get('lect/list','LectController@index')->name('admin.lect.list.index');//讲师列表
            Route::any('lect/edit','LectController@edit')->name('admin.lect.edit.index');//讲师修改
            Route::any('lect/update','LectController@update')->name('admin.lect.update.index');//讲师处理修改
            Route::get('lect/index_list','LectController@index_list')->name('admin.lect.index_list.index');//讲师列表
            Route::any('lect/destroy','LectController@destroy')->name('admin.lect.destroy.index');//讲师删除

            Route::any('operationLog/index','OperationLogController@index')->name('admin.operationLog.index');//日常操作
            Route::get('operationLog/del','OperationLogController@del')->name('admin.operationLog.del.index');//操作列表

            Route::get('catelog/index','CatelogController@index')->name('admin.catelog.index.index');  //文章添加
            Route::get('catelog/list','CatelogController@cate_list')->name('admin.catelog.list.index');  //文章列表
            Route::any('catelog/catelog_add','CatelogController@catelog_add')->name('admin.catelog.add.index');  //添加执行
            Route::any('catelog/catalog_list','CatelogController@catalog_list')->name('admin.catelog.catelog_list.index');//列表数据

            Route::any('catelog/catelog_del','CatelogController@catelog_del')->name('admin.catelog.del.index');//文章删除
            Route::any('catelog/catelog_upd','CatelogController@catelog_upd')->name('admin.catelog.catelog_upd.index');//文章修改
            Route::any('catelog/catelog_upd_do','CatelogController@catelog_upd_do')->name('admin.catelog.catelog_upd_do.index');//文章修改执行

            // 咨询模块
            Route::prefix('/')->group(function(){
                Route::any('information/info_add','InformationController@info_add')->name('admin.information.info_add.index');// 咨询添加
                Route::any('information/info_add_do','InformationController@information_add')->name('admin.information.info_add_do.index');// 咨询执行添加
                Route::any('information/info_list','InformationController@information_list')->name('admin.information.info_list.index');// 咨询列表
                Route::any('information/info_del','InformationController@information_del')->name('admin.information.info_del.index');// 咨询删除
                Route::any('information/info_update','InformationController@information_update')->name('admin.information.info_update.index');// 咨询删除
                Route::any('information/info_update_do','InformationController@information_update_do')->name('admin.information.info_update_do.index');// 咨询删除
            });

              //试卷
                Route::any('paper/index_add','PaperController@index_add')->name('admin.paper.index_add.index');
                Route::any('paper/add_do','PaperController@add_do')->name('admin.paper.add_do.index');
                Route::any('paper/pa_list','PaperController@pa_list')->name('admin.paper.pa_list.index');
                Route::any('paper/list_de','PaperController@list_de')->name('admin.paper.list_de.index');
                Route::any('paper/pa_del','PaperController@pa_del')->name('admin.paper.pa_del.index');

             //收藏
            Route::prefix('/')->group(function(){
                Route::get('collect_add','CollectController@collect_add')->name('admin.collect.collect_add.index');//收藏添加
                Route::get('collect_list','CollectController@collect_list')->name('admin.collect.collect_list.index');//收藏列表
                Route::any('collect_destroy','CollectController@collect_destroy')->name('admin.collect.collect_destroy.index');//收藏删除
            });

              //用户详情
            Route::prefix('/')->group(function(){
                Route::get('user_desc','UserInfoController@user_desc')->name('admin.user_desc.user_desc.index');//用户详情添加
                Route::post('user_desc_add','UserInfoController@user_desc_add')->name('admin.user_desc.user_desc_add.index');//用户详情执行添加
                Route::any('destroy','UserInfoController@destroy')->name('admin.user_desc.destroy.index');//用户详情删除
                Route::get('user_desc_list','UserInfoController@user_desc_list')->name('admin.user_desc.user_desc_list.index');//详情展示

                Route::post('/user_desc/is_status','UserInfoController@is_status')->name('admin.user_desc.is_status.index');//用户禁用

                Route::post('/upgrade','UserInfoController@upgrade')->name('admin.user_desc.upgrade.index');//升级会员

                Route::post('/lect','UserInfoController@lect')->name('admin.user_desc.lect.index');//升级会员
            });

            //会员管理
            Route::prefix('/')->group(function(){
                Route::any('/vipadd','VipController@vipadd')->name('admin.vip.vipadd.index');//会员添加
                Route::any('/vipadd_do','VipController@vipadd_do')->name('admin.vip.vipadd_do.index');//会员添加
                Route::any('/user_list_vip','VipController@user_list_vip')->name('admin.vip.user_list_vip.index');//会员列表
                Route::any('/vipdel','VipController@vipdel')->name('admin.vip.vipdel.index');//会员列表删除
                Route::any('/vipupd','VipController@vipupd')->name('admin.vip.vipupd.index');//会员非会员设置
                Route::any('/quit_user_vip','VipController@quit_user_vip')->name('admin.vip.quit_user_vip.index');//取消用户vip
            });

            //精彩活动
            Route::prefix('/')->group(function(){
                Route::any('activity_add','ActivityController@activity_add')->name('admin.activity.activity_add.index');//精彩活动添加
                Route::any('activity_add_do','ActivityController@activity_add_do')->name('admin.activity.activity_add_do.index');//精彩活动执行添加
                Route::any('activity_list','ActivityController@activity_list')->name('admin.activity.activity_list.index');//精彩活动列表
                Route::any('activity_destroy','ActivityController@activity_destroy')->name('admin.activity.activity_destroy.index');//精彩活动删除
                Route::any('activity_update','ActivityController@activity_update')->name('admin.activity.activity_update.index');//精彩活动修改
                Route::any('activity_update_do','ActivityController@activity_update_do')->name('admin.activity.activity_update_do.index');//精彩活动执行修改
            });

            //轮播图管理
            Route::prefix('/slideshow')->group(function(){
                Route::any('add','SlideshowController@slideshowAdd')->name('admin.slideshow.add.index');//轮播图添加视图
                Route::any('data','SlideshowController@slideshowData')->name('admin.slideshow.data.index');//轮播图添加执行
                Route::any('list','SlideshowController@slideshowList')->name('admin.slideshow.list.index');//轮播图列表
                Route::any('exit','SlideshowController@slideshowExit')->name('admin.slideshow.exit.index');//轮播图修改视图
                Route::any('exitdo','SlideshowController@slideshowExitdo')->name('admin.slideshow.exitdo.index');//轮播图修改执行
                Route::any('del','SlideshowController@slideshowDel')->name('admin.slideshow.del.index');//轮播图删除
            });

            // 笔记模块
            Route::prefix('/')->group(function(){
                Route::any('note/note_add',function(){
                    return view('admin.note.add');// 笔记添加
                })->name('admin.note.note_add.index');
                Route::any('note/note_add_do','NoteController@note_add_do')->name('admin.note.note_add_do.index');// 笔记添加
                Route::any('note/note_list','NoteController@note_list')->name('admin.note.note_list.index');// 笔记列表
                Route::any('note/note_del','NoteController@note_del')->name('admin.vip.vipupd.index');// 笔记列表
                Route::any('note/note_update','NoteController@note_update')->name('admin.note.note_update.index');// 笔记修改
                Route::any('note/note_update_do','NoteController@note_update_do')->name('admin.note.note_update_do.index');// 笔记修改
            });

            // 作业模块
            Route::prefix('/')->group(function(){
                Route::any('job/job_add','JobController@job_add')->name('admin.job.job_add.index');// 作业添加
                Route::any('job/job_add_do','JobController@job_add_do')->name('admin.job.job_add_do.index');// 作业添加
                Route::any('job/job_list','JobController@job_list')->name('admin.job.job_list.index');// 作业列表
                Route::any('job/job_del','JobController@job_del')->name('admin.job.job_del.index');// 作业列表
                Route::any('job/job_update','JobController@job_update')->name('admin.job.note_update.index');// 作业修改
                Route::any('job/job_update_do','JobController@job_update_do')->name('admin.job.job_update_do.index');// 作业修改
            });

        //考试管理
        Route::prefix('/')->group(function(){
            Route::any('exam_add','ExamController@exam_add')->name('admin.exam.exam_add.index');//考试添加
            Route::any('exam_add_do','ExamController@exam_add_do')->name('admin.exam.exam_add_do.index');//考试执行添加
            Route::any('exam_list','ExamController@exam_list')->name('admin.exam.exam_list.index');//考试列表
            Route::any('exam_destroy','ExamController@exam_destroy')->name('admin.exam.exam_destroy.index');//考试列表删除
            Route::any('exam_update','ExamController@exam_update')->name('admin.exam.exam_update.index');//考试列表修改
            Route::any('exam_update_do','ExamController@exam_update_do')->name('admin.exam.exam_update_do.index');//考试列表执行修改
        });

            //订单
            Route::prefix('/')->group(function(){
                Route::any('blanket_order','OrderController@blanket_order')->name('admin.order.blanket_order.index');//总订单列表
                Route::any('blanket_del','OrderController@blanket_del')->name('admin.order.blanket_del.index');//总订单删除
                Route::any('lect_order','OrderController@lect_order')->name('admin.order.lect_order.index');//讲师订单列表
                Route::any('lect_order_del','OrderController@lect_order_del')->name('admin.order.lect_order_del.index');//讲师订单删除
            });

            //后台导航栏
            Route::prefix('/navigation')->group(function(){
                Route::any('add','NavigationController@navigationAdd')->name('admin.navigation.add.index');//后台导航添加视图
                Route::any('data','NavigationController@navigationData')->name('admin.navigation.data.index');//后台导航添加执行
                Route::any('list','NavigationController@navigationList')->name('admin.navigation.list.index');//后台导航列表
                Route::any('exit','NavigationController@navigationExit')->name('admin.navigation.exit.index');//后台导航修改视图
                Route::any('exitdo','NavigationController@navigationExitdo')->name('admin.navigation.exitdo.index');//后台导航修改执行
                Route::any('del','NavigationController@navigationDel')->name('admin.navigation.del.index');//后台导航删除
            });

            Route::any('ltem/index_add','LtemController@index_add')->name('admin.ltem.index_add.index');
                Route::any('ltem/bank_add','LtemController@bank_add')->name('admin.ltem.bank_add.index');
                Route::any('ltem/warm_add','LtemController@warm_add')->name('admin.ltem.warm_add.index');
                Route::any('ltem/lt_radio','LtemController@lt_radio')->name('admin.ltem.lt_radio.index');
                Route::any('ltem/lt_warm','LtemController@lt_warm')->name('admin.ltem.lt_warm.index');
                Route::any('ltem/lt_danger','LtemController@lt_danger')->name('admin.ltem.lt_danger.index');
                Route::any('ltem/danger_add','LtemController@danger_add')->name('admin.ltem.danger_add.index');
                Route::any('ltem/ltem_list','LtemController@ltem_list')->name('admin.ltem.ltem_list.index');
                Route::any('ltem/lt_del','LtemController@lt_del')->name('admin.ltem.lt_del.index');
                Route::any('ltem/lt_upd','LtemController@lt_upd')->name('admin.ltem.lt_upd.index');
                 Route::any('ltem/lt_upd_do','LtemController@lt_upd_do')->name('admin.ltem.lt_upd_do.index');
                Route::any('ltem/lt_upd_warm_do','LtemController@lt_upd_warm_do')->name('admin.ltem.lt_upd_warm_do.index');
                Route::any('ltem/lt_upd_danger','LtemController@lt_upd_danger')->name('admin.ltem.lt_upd_danger.index');

            //课程
            Route::prefix('/')->middleware(['apiheader'])->group(function(){
                Route::get('course_add','CourseController@course_add')->name('admin.course.course_add.index');//课程添加
                Route::post('course_add_do','CourseController@add_do')->name('admin.course.course_add_do.index');//课程执行添加
                Route::get('course_list','CourseController@course_list')->name('admin.course.list.index');//课程列表

                Route::get('course_list_do','CourseController@course_list_do')->name('admin.course.list_do.index');//课程管理员列表
                Route::any('course_del','CourseController@course_del')->name('admin.course.del.index');//课程删除

                Route::any('course_del_do','CourseController@course_del_do')->name('admin.course.del_do.index');//管理员课程删除
                Route::get('course_update','CourseController@course_update')->name('admin.course.update.index');//课程修改
                Route::post('course_update_do','CourseController@course_update_do')->name('admin.course.update_do.index');//课程执行修改

                Route::post('give_or_take','CourseController@give_or_take')->name('admin.course.give_or_take.index');//课程点击上下架
                Route::get('course_cate','CourseController@course_cate')->name('admin.course.cate.index');//分类添加
                Route::get('course_cate_list_do','CourseController@course_cate_list_do')->name('admin.course.cate_list_do.index');//管理员分类列表
                Route::post('course_cate_do','CourseController@course_cate_do')->name('admin.course.cate_do.index');//分类执行添加
                Route::any('course_cate_list','CourseController@course_cate_list')->name('admin.course.cate_list.index');//分类列表
                Route::post('course_cate_del','CourseController@course_cate_del')->name('admin.course.cate_del.index');//分类禁用
                Route::get('course_cate_update','CourseController@course_cate_update')->name('admin.course.cate_update.index');//分类修改
                Route::post('course_cate_update_do','CourseController@course_cate_update_do')->name('admin.course.cate_update_do.index');//分类执行修改
                Route::any('course_note','CourseController@course_note')->name('admin.course.note.index');//课程笔记
                 //问答模块
                Route::any('question_add','QuestionController@question_add')->name('admin.question_add.index');//问答添加
                Route::any('question_doadd','QuestionController@question_doadd')->name('admin.question_doadd.index');//处理问题添加
                Route::any('question_nameOnly','QuestionController@question_nameOnly')->name('admin.question_nameOnly.index');//处理问题添加
                Route::any('question_list','QuestionController@question_list')->name('admin.question_list.index');//问答展示列表
                Route::get('resposen_add','QuestionController@resposen_add')->name('admin.resposen_add.index');//提交回答入库
                Route::get('questions_del','QuestionController@questions_del')->name('admin.questions_del.index');//删除问题
                //评论模块
                Route::get('exalute_add','ExaluateController@exalute_add')->name('admin.exalute_add.index');//评论添加视图展示
                Route::post('exaluate_doadd','ExaluateController@exaluate_doadd')->name('admin.exaluate_doadd.index');//处理添加视图展示
                Route::any('exalute_index','ExaluateController@exalute_index')->name('admin.exalute_index.index');//评论添加视图展示
                Route::get('exalute_del','ExaluateController@exalute_del')->name('admin.exalute_del.index');//评论软删除

            });

        //});
    });
});






