<?php
namespace App\Http\Controllers\Home;

use App\Member;
use App\Orders;
use App\MemberMsg;
use App\RedPacket;
use App\Guestbook;
use App\GuestbookReply;
use App\Collection;
use App\MenuComment;
use App\MenuCommentReply;
use App\OrdersMenu;
use function GuzzleHttp\Psr7\str;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller{
    //用户中心
    public function UserCenter(){
        $mem=Member::where('id',session('mid'))
            ->select('username','old_login','score')
            ->get();
        //print_r($mem);

        $order1=Orders::where('active',1)
            ->count();
        //print_r($order1);
        $order2=Orders::where('active',2)
            ->count();
        //print_r($order2);
        $order3=Orders::where('active',3)
            ->count();
        //print_r($order3);
        $order4=Orders::where('active',4)
            ->count();
        //print_r($order4);
        return view('home.member.UserCenter',compact('mem','order1','order2','order3','order4'));
    }
    //我的订单
    public function UserOrder(){
        $orders=Orders::join('member_msg','orders.msg_id','=','member_msg.id')
            ->orderBy('orders.add_time','desc')
            ->where('orders.mid',session('mid'))
            ->select('orders.id','orders.add_time','orders.orders_num','orders.active','orders.orders_price','name')
            ->paginate(3);
//        dd($orders);
        return view('home.member.UserOrder',compact('orders'));
    }
    //订单状态----act=1取消订单delete/付款active=>2 没支付方式/ act=2确认到货update/
    //act=3删除订单delete/ act=4退款申请/
    public function UserOrder_Act($id,$act){
        if  ($act==1){  //删除订单 根据$id进行表操作
            $act1=Orders::destroy($id);
            $OrMe=OrdersMenu::where('oid',$id)
                ->delete();
            if($act1 and $OrMe){
                return response() -> json( ['status'=>'ok','msg'=>'取消成功']);
            }else{
                return response() -> json( ['status'=>'error','msg'=>'取消失败']);
            }
        }elseif ($act==2){//active 3->4
            $act2=Orders::where('id',$id)
                ->update(['active'=>4]);
            if($act2){
                return response() -> json( ['status'=>'ok','msg'=>'签收成功']);
            }else{
                return response() -> json( ['status'=>'error','msg'=>'签收失败']);
            }
        }elseif ($act==3){//删除操作--订单 订单回复 连接表
            $act3=Orders::destroy($id);
            $OrMe=OrdersMenu::where('oid',$id)
                ->delete();
            $MeCo=MenuComment::where('oid',$id)
                ->delete();
            if($act3 and $OrMe and $MeCo){
                return response() -> json( ['status'=>'ok','msg'=>'删除订单成功']);
            }else{
                return response() -> json( ['status'=>'error','msg'=>'删除订单失败']);
            }
        }else{//退款申请 ->6  act=5 'href'=>route('hm.mem.UserAddress_default')
            $act4=Orders::where('id',$id)
                ->update(['active'=>6]);
            if($act4){
                return response() -> json( ['status'=>'ok','msg'=>'申请成功']);
            }else{
                return response() -> json( ['status'=>'error','msg'=>'申请失败']);
            }
        }
    }
    //查询订单评论
    public function UserOrder_Det($id){
        $MenuDet=MenuComment::where('oid',$id)
            ->select('detail','fenshu','id')
            ->get();
        return view('home.member.UserOrder_Det',compact('MenuDet'));
    }
    //添加订单评论 $id=订单id --- oid
    public function UserOrder_Add($id){
        if (\request()->isMethod('post')){
            //orders_menu 根据oid 查询 uid =>add操作---MenuComment
            $OM_uid=OrdersMenu::where('oid',$id)
                ->select('uid')
                ->first();
            $data['detail']=trim(\request('detail'));
            $data['fenshu']=trim(\request('fenshu'));
            $data['oid']=trim($id);
            $data['uid']=trim($OM_uid->uid);
            $data['mid']=trim(session('mid'));
            $data['add_time']=trim(time());
            if (MenuComment::insert($data)){
                Orders::where('id',$id)
                    ->update(['active'=>5]);
                return response() -> json( ['status'=>'ok','msg'=>'添加成功']);
            }else{
                return response() -> json( ['status'=>'error','msg'=>'添加失败']);
            }
        }else{
            return view('home.member.UserOrder_Add',compact('id'));
        }
    }
    //更改订单评论
    public function UserOrder_Upd(){
        if (request()->isMethod('post')){
            $data['fenshu']=trim(\request('fenshu'));
            $data['detail']=trim(\request('detail'));
            $data['id']=trim(\request('id'));
            //修改订单评论
            $MC=MenuComment::where('id',$data['id'])
                ->update(['fenshu'=>$data['fenshu'],'detail'=>$data['detail'],'add_time'=>time()]);
            if ($MC){
                return response() -> json( ['status'=>'ok','msg'=>'修改成功']);
            }else{
                return response() -> json( ['status'=>'error','msg'=>'修改失败']);
            }
        }
    }

    //我的收藏
    public function UserFavorites(){
        $Collection=collection::join('shop','collection.sid','=','shop.id')
            ->where('collection.mid',session('mid'))
            ->select('shop_name','logo','shop.id')
            ->get();
//        dd($Collection);
        return view('home.member.UserFavorites',compact('Collection'));
    }
    //收货地址
    public function UserAddress(){
        $mem_msg=MemberMsg::where('mid',session('mid'))
            ->select('id','name','mobile','site','location','Postcode','active')
            ->get();
        //dd($mem_msg);
        return view('home.member.UserAddress',compact('mem_msg'));
    }
    //设置默认地址
    public function UserAddress_default($id,$active){
//        echo $id;
//        echo $active;
        $a = $active == 1 ? 2 : 1;
        $text = $active == 2 ? '非默认地址' : '默认地址';
        if ($a==1){
            MemberMsg::where('mid',session('mid'))->update(['active'=>2]);
        }
        //更新状态
        if(MemberMsg::where('id',$id) -> update( ['active'=>$a])){
            return response() -> json( ['status'=>'ok','msg'=>'设置'.$text.'成功','href'=>route('hm.mem.UserAddress_default',['id'=>$id,'active'=>$a]),'text'=>$text]);
        }else{
            return response() -> json( ['status'=>'error','msg'=>'设置'.$text.'失败']);
        }
    }
    //添加收货地址
    public function UserAddress_add(){
        if (request()->isMethod('post')){
            //dd(request('username'));
            //无json 调试--500错误显示
            $data['name']=trim(request('name'));
            $data['mobile']=trim(request('mobile'));
            $data['location']=trim(request('province')).'-'.trim(request('city')).'-'.trim(request('town'));
            $data['site']=trim(request('site'));
            $data['Postcode']=trim(request('Postcode'));
            $data['mid']=session('mid');
            if ($id = MemberMsg::insertGetId($data)) {
                $this -> UserAddress_default($id,2);
                return response()->json(['status' => 'ok', 'msg' => '收货地址添加成功' ,'url' => url('/home/member/UserAddress')]);
            }else{
                return response()->json(['status' => 'error', 'msg' => '收货地址添加失败，请稍后再试']);
            }
        }else{
            return view("hm.mem.UserAddress");
        }
    }
    //更新收货地址----------------------------------------
    public function UserAddress_update(){
        if (request()->isMethod('post')){

        }else{
            return view("hm.mem.UserAddress");
        }
    }
    //删除收货地址
    public function UserAddress_del($id){
        if (MemberMsg::destroy($id)){
            return response()->json(['status'=>'ok','msg'=>'删除成功','url' => url('/home/member/UserAddress')]);
        }else{
            return response()->json(['status'=>'error','msg'=>'删除失败']);
        }
    }
    //批量删除收货地址
    public function UserAddress_delS(){
        if(MemberMsg::destroy( request('chk') ) ){
            return response() -> json( ['status'=>'ok','msg'=>'删除成功','url'=>url('/home/member/UserAddress')]);
        }else{
            return response() -> json( ['status'=>'error','msg'=>'删除失败']);
        }
    }


    //我的留言
    public function UserMessage(){
        //---店铺留言
        $Guestbook=Guestbook::orderBy('add_time','desc')
            ->leftjoin('guestbook_reply','guestbook.id','=','guestbook_reply.Gid')
            ->leftjoin('shop','guestbook.sid','=','shop.id')
            ->where('guestbook.mid',session('mid'))
            ->select('guestbook.id','guestbook.content','guestbook.add_time','guestbook_reply.reply','shop.shop_name')
            ->paginate(2);
//        dd($Guestbook);
        //---菜品留言
        $MenuComment=MenuComment::from('menu_comment as mc')
            ->leftjoin('menu_comment_reply as mcr','mc.id','=','mcr.mc_id')//,'mcr.reply'---以左连接为主
            ->join('menu as u','mc.uid','=','u.id')
            ->join('shop as s','u.sid','=','s.id')
            ->where('mc.mid',session('mid'))
            ->select('mc.id','mc.add_time','mc.fenshu','mc.detail','u.menu_name','s.shop_name','mcr.reply')
            ->orderBy('mc.add_time','desc')
            ->paginate(2);
//        dd($MenuComment);
        return view('home.member.UserMessage',compact('Guestbook','MenuComment'));
    }
    //删除我的留言
    public function UserMessage_del($id){
        GuestbookReply::where('Gid',$id)->delete();
        if (Guestbook::destroy($id)){
            return response()->json(['status'=>'ok','msg'=>'删除成功']);
        }else{
            return response()->json(['status'=>'error','msg'=>'删除失败']);
        }
    }
    //删除我的菜品留言---订单
    public function UserMessage_delMC($id){
        //更改订单状态active=>4
        $oid=MenuComment::where('id',$id)
            ->select('oid')
            ->get();
//        dd($oid);
        if (Orders::where('id',$oid[0]['oid'])->update(['active'=>4])){
            //删除回复表
            MenuCommentReply::where('mc_id',$id)->delete();
            //删除评论
            if (MenuComment::destroy($id)){
                return response()->json(['status'=>'ok','msg'=>'删除成功']);
            }else{
                return response()->json(['status'=>'error','msg'=>'删除失败']);
            }
        }else{
            return response()->json(['status'=>'error','msg'=>'订单状态更改失败']);
        }

    }

    //我的优惠券
    public function UserCoupon(){
        //更新优惠券信息
        RedPacket::getNew();
        //查询优惠券信息
        $redpacket = RedPacket:: where('mid',session('mid'))
                              -> orderBy('active')
                              -> get();
        $score = Member:: where('id',session('mid'))
                       -> value('score');

        return view('home.member.UserCoupon',compact('redpacket','score'));
    }
    //账户管理
    public function UserAccount(){
        if(request() -> isMethod('post')){
            //头像修改  姓名修改
            //表单验证
            $this -> validate(request(),[
                'username'=>'required',
            ],[
                'username.required'=>'用户名不能为空',
            ]);
            $data['username'] = trim(request('username'));
            //头像修改 上传  $name=avatar  $dir=avatar_dir
            if (request()->hasFile('avatar')){
                //上传
                if ($imageInfo = upload( request() -> file('avatar'))){
                    $data['avatar_dir'] = $imageInfo['dir'];
                    $data['avatar']=$imageInfo['name'];
                    //获取旧图信息
                    $oldAvatar=Member::select('avatar','avatar_dir')->find(session('mid'));
                    //更新头像信息
                    $Avatar=Member::updateOrInsert(['id' => session('mid')], ['username'=>$data['username'],'avatar_dir'=>$data['avatar_dir'],'avatar'=>$data['avatar']]);

                        //更新是否成功
                        if( ! $Avatar ){
                            return response()->json(['status'=>'error','msg'=>'头像更新失败']);
                        }else{

                            session()->put('mavatar',$data['avatar']);
                            session()->put('mavatar_dir',$data['avatar_dir']);
                            //删除旧图
                            if ($oldAvatar){
                                unlink($oldAvatar['avatar_dir'].$oldAvatar['avatar']);
                                unlink($oldAvatar['avatar_dir'].'100_'.$oldAvatar['avatar']);
                                unlink($oldAvatar['avatar_dir'].'190_'.$oldAvatar['avatar']);
                                unlink($oldAvatar['avatar_dir'].'240_'.$oldAvatar['avatar']);
                                unlink($oldAvatar['avatar_dir'].'350_'.$oldAvatar['avatar']);
                                unlink($oldAvatar['avatar_dir'].'800_'.$oldAvatar['avatar']);
                                return Response()->json(['status'=>'ok','msg'=>'头像更新成功']);
                            }else{
                                return Response()->json(['status'=>'ok','msg'=>'头像更新成功']);
                            }
                        }
                }else{
                    return response()->json(['status'=>'error','msg'=>'商品发布失败']);
                }
            }
        }else{

            $member=Member::find(session('mid'));
            //dd($member);
            return view('home.member.UserAccount',compact('member'));
    }
    }
    //账户管理--修改邮箱
    public function UserAccount_email(){
        if (request()->isMethod('post')){
//            dd(request('email'));
            $data['email']=trim(request('email'));
            //修改邮箱
            $email=Member::updateOrInsert(['id' => session('mid')],['email'=>$data['email']]);
            if ($email){
                return response()->json(['status'=>'ok','msg'=>'邮箱修改成功']);
            }else{
                return response()->json(['status'=>'error','msg'=>'邮箱修改失败']);
            }
        }else{
            $mem=Member::select('email')->find(session('mid'));
            //dd($mem);
            return view('home.member.UserAccount_email',compact('mem'));
        }
    }
    //账户管理--修改手机号
    public function UserAccount_mobile(){
        if (request()->isMethod('post')){
            $data['mobile']= trim(request('mobile'));
            $mobile=Member::updateOrInsert(['id'=>session('mid')],['mobile'=>$data['mobile']]);
            if ($mobile){
                return response()->json(['status'=>'ok','msg'=>'修改手机号成功']);
            }else{
                return response()->json(['status'=>'error','msg'=>'修改手机号失败']);
            }
        }else{
            $mem=Member::select('mobile')->find(session('mid'));
            return view('home.member.UserAccount_mobile',compact('mem'));
        }
    }
    //账户管理--修改密码
    public function UserAccount_pass(){
        if (request()->isMethod('post')){
            //dd(request('password'));
            $data['password']= md5(trim(request('password')));
            $password=Member::updateOrInsert(['id'=>session('mid')],['password'=>$data['password']]);
            if ($password){
                return response()->json(['status'=>'ok','msg'=>'修改密码成功']);
            }else{
                return response()->json(['status'=>'error','msg'=>'修改密码失败']);
            }
        }
        return view('home.member.UserAccount_pass');
    }

}