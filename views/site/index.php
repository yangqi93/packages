<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = Yii::$app->params['shopName'];
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>简易快递管理系统</h1>

        <p class="lead">方便店主自主管理快递的入库出库和查询</p>

        <a href="https://time.is/Chongqing" id="time_is_link" rel="nofollow" style="font-size:36px"></a>
        <span id="Chongqing_z43d" style="font-size:36px"></span>
        <script src="//widget.time.is/zh.js"></script>
        <script>
            time_is_widget.init({Chongqing_z43d:{template:"TIME<br>DATE", date_format:"dayname year-monthnum-daynum"}});
        </script>

    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>签收</h2>

                <p>快件签收入库，扫描单号即可</p>

                <p><a class="btn btn-default" href="<?= Url::to(['package/create']) ?>">操作 &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>查询</h2>

                <p>可根据手机尾号、快递公司、单号、入库日期查询</p>

                <p><a class="btn btn-default" href="<?= Url::to(['package/index']) ?>">操作 &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
