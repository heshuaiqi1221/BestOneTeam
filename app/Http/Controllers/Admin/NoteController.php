<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Note;
use App\Http\Models\Course;
class NoteController extends Controller
{
    // 笔记添加
    public function note_add_do(Request $request){
    	$date=$request->all();
        $date['u_id'] = 1;
        $date['cou_id'] = 1;
        $date['create_time'] = time();
        if(empty($date['note_desc'])){
        	echo ("<script>alert('请输入完整信息');location='/admin/note/note_add'</script>");
        }
        $res = Note::insert($date);
        if($res){
    		echo ("<script>alert('添加成功,跳转到列表页面');location='/admin/note/note_list'</script>");
    	}else{
    		echo ("<script>alert('添加失败,系统错误');location='/admin/note/note_add'</script>");
    	}
    }

    // 展示笔记
    public function note_list(){
    	$date = Course::join('Note','Course.course_id','=','Note.cou_id')->join('User','User.u_id','=','Note.u_id')
        ->where(['Note.note_del'=>1])
    	->get();
        //dd($date);
    	return view('admin.note.list',['date'=>$date]);
    }

    // 删除笔记(软删除)
    public function note_del(Request $request){
    	$note_id = $request->all()['note_id'];
        //修改状态
        $date = Note::where(['note_id'=>$note_id])->update(['note_del'=>2]);
        if($date){
            header("Refresh:2,url=/admin/note/note_list");
            die("删除成功,2秒后自动跳到展示页面");
        }else{
            echo ("<script>alert('添加失败,系统错误');location='/admin/note/note_list'</script>");
        }
    }


    // 笔记修改
    public function note_update (Request $request){
        $data = $request->all();
        $info = Note::where(['note_id'=>$data['note_id']])->first();
        return view('admin.note.update',['info'=>$info]);
    }

    // 笔记修改执行
    public function note_update_do(Request $request){
        $data = $request->all();
        $res = Note::where(['note_id'=>$data['note_id']])->update([
            'note_desc' => $data['note_desc'],
        ]);
        if($res){
            echo ("<script>alert('修改成功');location='/admin/note/note_list'</script>");
        }else{
            echo ("<script>alert('添加失败,系统错误');location='/admin/note/note_list'</script>");
        }
    }

}
