<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleSort extends Model
{
    ////表
        protected $table = 'article_sort';
    //    //关闭自动维护时间戳
        public $timestamps;
}
