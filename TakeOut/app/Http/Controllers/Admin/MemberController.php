<?php

namespace App\Http\Controllers\admin;

use App\Grade;
use App\Member;
use App\MemberMsg;
use http\Client\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class memberController extends Controller
{
    //会员列表
    public function list(){
        //闪存查询条件
        request() -> flash();
        //接受数据
        $username = trim(request('username'));
        $active = request('active');
        $start_time = request('start_time');
        $end_time = request('end_time');

        $member = Member::where(function ($query)use ($username){
            //查询会员名称
            if ($username){
                $query -> where('username','like','%'.$username.'%');
            }
            })
            ->where(function ($query)use ($active){
            //查询会员状态
                if ($active == 1 || $active == 2){
                    $query -> where('active',$active);
                }
            })
            ->where(function ($query)use ($start_time,$end_time){
            //查询会员添加时间
                if ($start_time && $end_time){
                    //都查询
                    $query -> whereBetween('add_time',[strtotime($start_time),strtotime($end_time)]);
                }elseif ($start_time && !$end_time){
                    $query -> whereBetween('add_time',[strtotime($start_time),time()]);
                }elseif (!$start_time && $end_time){
                    $query -> where('add_time','<=',strtotime($end_time));
                }
            })
            ->paginate(15);
        return view('admin/member/user_list',compact('username','active','start_time','end_time','member'));
    }

    //激活/禁用会员
    public function active($id,$active){
        $a = $active == 1 ? '2' : '1';
        $text = $a == 1 ? '激活' : '禁用';

        if(Member::where('id',$id) -> update(['active' => $a])){
            $href = route('admin.member.active',['id' => $id,'active' => $a]);
            return response() -> json(['status'=>'ok','msg'=>$text.'成功','href'=>$href,'text'=>$text]);
        }else{
            return response() -> json(['status'=>'error','msg'=>$text.'失败']);
        }
    }

    //展示会员收货地址
    public function show($id){
        //查询对应会员的所有收货地址
        $site = MemberMsg:: where('mid',$id)
                         -> orderby('active') -> get();
        return view('admin.member.show',compact('site'));
    }

    //会员等级管理
    public function grade(){
        $detail = '';
        if (\request() -> has('detail')){
            \request() -> flashOnly('detail');
            $detail =  trim(\request('detail'));
        }
        $grades = Grade:: orderBy('score')
                       -> where(function ($query) use($detail){
                           if (!empty($detail)){
                               $query -> where('detail','like',"%$detail%");
                           }
                       })
                       -> get();
        return view('admin.member.grade',compact('grades'));
    }

    //添加会员等级
    public function add(){
        if (\request() -> ajax()){
            $this -> validate(\request(),[
                'grade_name' => 'bail|required|unique:grade',
                'score' => 'bail|required|unique:grade'
            ],[
                'grade_name.required' => '等级名称不能为空',
                'score.required' => '等级需求积分不能为空',
                'grade_name.unique' => '等级名称已存在',
                'score.unique' => '等级已存在'
            ]);

            //接受表单数据
            $grade_name = trim(\request('grade_name'));
            $score = trim(\request('score'));
            $detail = trim(\request('detail'));

            if (Grade::insert(['grade_name' => $grade_name,'score' => $score,'detail' => $detail])){
                return response() -> json(['status' => 'ok','msg' => '添加成功',]);
            }else{
                return \response() -> json(['status' => 'error','msg' => '添加失败']);
            }
        }else{
            return view('admin.member.add');
        }
    }

    //修改会员等级规则
    public function edit($id){
        if (\request() -> ajax()){
            $this -> validate(\request(),[
                'grade_name' => 'bail|required|unique:grade,id,'.$id,
                'score' => 'bail|required|unique:grade,id,'.$id
            ],[
                'grade_name.required' => '等级名称不能为空',
                'score.required' => '等级需求积分不能为空',
                'grade_name.unique' => '等级名称已存在',
                'score.unique' => '等级已存在'
            ]);

            $data['grade_name'] = trim(\request('grade_name'));
            $data['score'] = trim(\request('score'));
            $data['detail'] = trim(\request('detail'));

            if (Grade:: where('id',$id) -> update($data)){
                return response() -> json(['status' => 'ok','msg' => '修改成功']);
            }else{
                return response() -> json(['status' => 'error','msg' => '修改失败',]);
            }
        }else{
            $grade = Grade:: find($id);
            return view('admin.member.edit',compact('grade'));
        }
    }

    //删除会员等级
    public function delete($id){
        if(Grade::destroy($id)){
            return \response() -> json(['status' => 'ok','msg' => '删除成功']);
        }else{
            return \response() -> json(['status' => 'error','msg' => '删除失败']);
        }
    }

    //会员等级管理
    public function memberGrade(){
        //接受搜索条件
        if (\request() -> has('knum')){
            $knum = \request('knum');
        }else{
            $knum = '0';
        }
        //更新并获取会员等级人数
        Grade:: getMemberNum();
        $grades = Grade:: orderBy('score') -> get() -> toarray();
        $member = Member::where(function ($query) use($knum,$grades){
                           if ($knum != 0){
                               if ($knum == count($grades)){
                                   $query -> where('grade','>=',$grades[$knum-1]['score']);
                               }else{
                                   $query -> whereBetween('grade',[ $grades[$knum-1]['score'],$grades[$knum]['score']-1 ]);
                               }
                           }
                       })
                       -> paginate(15);
        $total = Member:: count('id');
        return view('admin.member.memberGrade',compact('grades','total','member','knum'));
    }

    //会员等级图表
    public function getChart(){
        /* x => ['普通用户','铁牌用户','铜牌用户','银牌用户','金牌用户','钻石用户','蓝钻用户','红钻用户'],
           y => [
                {value:1200, name:'普通用户'},
                {value:1100, name:'铁牌用户'},
                {value:1300, name:'铜牌用户'},
                {value:1000, name:'银牌用户'},
                {value:980, name:'金牌用户'},
                {value:850, name:'钻石用户'},
                {value:550, name:'蓝钻用户'},
                {value:220, name:'红钻用户'},
                ] */
        //查询数据库
        $grades = Grade:: orderBy('score') -> get();
        $data = [];
        foreach ($grades as $k => $v){
            $data['x'][$k] = $v['grade_name'];
            $data['y'][$k] = ['value' => $v['member_num'],'name' => $v['grade_name']];
        }
            return \response() -> json($data);
    }

    //导出会员Excel表
     public function excel(){
         $data = Member::orderBy('grade','desc')
             ->get()->toArray();
         foreach($data as $k => $v){
             $data[$k]['grade'] = getGrade($v['grade']);
         }
         Excel::create('商品列表', function($excel) use($data){
             $excel -> sheet('工作表1', function($sheet) use($data){
                 $sheet -> loadView( 'admin.member.exportExcel',['member'=>$data] );
             });
         }) -> export('xls');

     }

}





