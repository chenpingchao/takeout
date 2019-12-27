<?php
namespace App\Http\Controllers\admin;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Feedback;//意见反馈
use App\Guestbook;//留言板
use App\GuestbookReply;//回复表
use function PHPSTORM_META\elementType;


class MessageController extends Controller{
    //留言板
    public function ad_Guestbook(){
        //存入闪存
        request()->flush();
        $username = trim(request("username"));
        $add_time = strtotime(request("add_time"));
        $active = trim(request('active'));
        //var_dump($username);
        $Guestbook=Guestbook::join('member','Guestbook.mid','=','member.id')
            ->select('Guestbook.*','username')
            //会员留言姓名
            ->where(function ($query) use($username){
                if( $username ){
                    $query -> where('username', 'like', "%$username%" );
                }
            })
            //留言添加时间
            ->where(function ($query) use($add_time){
                if( $add_time ){
                    $query -> where('Guestbook.add_time', '>=', $add_time );
                }
            })
            //已回复 未回复 active
            ->where(function ($query) use ($active){
                if( $active==1 || $active==2){
                    $query -> where("Guestbook.active" , $active);
                }
            })
            ->paginate(3);
        return view('admin.Message.Guestbook',compact('Guestbook','username','add_time','active'));
    }
    //留言删除 id删除
    public function ad_GDelete($id){
        if (Guestbook::destroy($id)){
            return response()->json(['status'=>'ok','msg'=>'删除成功','url'=>route('bg.mess.Guestbook')]);
        }else{
            return response()->json(['status'=>'error','msg'=>'删除失败']);
        }
    }
    //批量删除
    public function ad_GDeletes(){
        if(Guestbook::destroy( request('chk') ) ){
            return response() -> json( ['status'=>'ok','msg'=>'删除成功','url'=>route('bg.mess.Guestbook')]);
        }else{
            return response() -> json( ['status'=>'error','msg'=>'删除失败']);
        }
    }
    //用户查看
    public function ad_MemberShow($id){

        return view('admin.Message.MemberShow');
    }
    //意见反馈
    public function ad_Feedback(){
        //request() 存入闪存
        request() -> flash();
        //接受表单数据
        $content = trim(request("content"));
        $add_time = strtotime(request("add_time"));
        $active = request("active");
        $type = request("type");
        $Feedback=Feedback::join('member','feedback.mid','=','member.id')
            ->select('Feedback.*','username','mobile','email','member.add_time as addtime','score')
            //留言内容
            ->where(function ($query) use($content){
                if( $content ){
                    $query -> where('content', 'like', "%$content%" );
                }
            })
            //时间
            ->where(function ($query) use($add_time){
                if ($add_time){
                    $query->where('Feedback.add_time','>=',$add_time);
                }
            })
            //状态
            ->where(function ($query) use($active){
                if( $active==1 || $active==2){
                    $query -> where("Feedback.active" , $active);
                }
            })
            //类型
            ->where(function ($query) use($type){
                if ($type){
                    $query->where('type','like',$type);
                }
            })
            ->paginate(1);
//        dd($Feedback);
        return view('admin.Message.Feedback',compact('Feedback','content','add_time','active','type'));
    }
    //意见删除 id删除
    public function ad_FDelete($id){
        if (Feedback::destroy($id)){
            return response()->json(['status'=>'ok','msg'=>'删除成功','url'=>route('bg.mess.Feedback')]);
        }else{
            return response()->json(['status'=>'error','msg'=>'删除失败']);
        }
    }
    //批量删除
    public function ad_FDeletes(){
        if(Feedback::destroy( request('chk') ) ){
            return response() -> json( ['status'=>'ok','msg'=>'删除成功','url'=>route('bg.mess.Feedback')]);
        }else{
            return response() -> json( ['status'=>'error','msg'=>'删除失败']);
        }
    }
    //留言状态
    public function ad_GuestActive($id,$active){
        $a = $active == 1 ? 2 : 1;
        $text = $active == 1 ? '未回复' : '已回复';
        //更新状态
        if(Guestbook::where('id',$id) -> update( ['active'=>$a] )){
            return response() -> json( ['status'=>'ok','msg'=>$text,'href'=>route('bg.mess.GuestActive',['id'=>$id,'active'=>$a]),'text'=>$text]);
        }else{
            return response() -> json( ['status'=>'error','msg'=>$text]);
        }
    }
    //意见状态ad_FeedActive
    public function ad_FeedActive($id,$active){
        $a = $active == 1 ? 2 : 1;
        $text = $active == 1 ? '未浏览' : '已浏览';
        //更新状态
        if(Feedback::where('id',$id) -> update( ['active'=>$a] )){
            return response() -> json( ['status'=>'ok','msg'=>$text,'href'=>route('bg.mess.FeedActive',['id'=>$id,'active'=>$a]),'text'=>$text]);
        }else{
            return response() -> json( ['status'=>'error','msg'=>$text]);
        }
    }

    //单个留言
    public function ad_GuestReply(){
        if (request()->ajax()){
//            dd(request('reply'));
//            dd(request('id'));
            $this->validate(request(),[
                'reply'=> 'bail|required|between:1,200',
            ],[
                'reply.required' => '用户名不能为空',
                'reply.between' => '内容长度1-100'
            ]);
            //业务逻辑处理
            $data['Gid'] = trim(request('id'));
            $data['reply'] = trim(request('reply'));
            $guesid=Guestbook::find(request('id'));
            //dd($data);

            if ($guesid['active']==2){
                if (GuestbookReply::insert($data)){
                    Guestbook::where('id',request('id'))->update( ['active'=>1] );
                    return response() -> json( ['status'=>'ok','msg' => '回复成功|ू･ω･` )','url' => route('bg.mess.GuestReply')]);
                }else{
                    return response() -> json( ['status'=>'error','msg'=>'回复失败凸(｀0´)凸']);
                }
            }else{
                return response() -> json( ['status'=>'error','msg'=>'已经回复─=≡Σ(((つ•̀ω•́)つ']);
            }

        }else{
            return view('admin.Message.Guestbook');
        }
    }


}