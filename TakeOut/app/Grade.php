<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //会员表
    protected $table = 'grade';
    //关闭自动维护时间戳
    public $timestamps = false;

    //更新不同等级会员数量
    public static function getMemberNum()
    {
        $grades = self:: orderBy('score')
            ->get()
            ->toarray();
        foreach ($grades as $k => $v) {
            if ($k < count($grades) - 1) {
                $member_num = Member::whereBetween('grade', [$v['score'], $grades[$k + 1]['score']])
                    ->count('id');
            } else {
                $member_num = Member:: where('grade', '>', [$v['score']])
                    ->count('id');
            }
            self:: where('id', $v['id'])->update(['member_num' => $member_num]);
        }
    }
}