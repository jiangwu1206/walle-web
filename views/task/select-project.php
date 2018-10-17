<?php
/**
 * @var yii\web\View
 */
$this->title = yii::t('task', 'select project title');
use app\models\Project;
use yii\helpers\Url;

?>
<div class="box">
    <!-- 测试环境 -->
    <div class="widget-box transparent">
        <div class="widget-header">
            <h4 class="lighter"><?= yii::t('w', 'conf_level_1'); ?></h4>

            <div class="widget-toolbar no-border"><a href="javascript:;" data-action="collapse">
                    <i class="icon-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main padding-6 no-padding-left no-padding-right">
            <a class="btn btn-inline btn-info test-all-push" style="min-width:120px;margin:auto auto 20px 40px;" href="javascript:;">一键全量全部提交</a>
                <?php foreach ($projects as $project) {
    ?>
                    <?php if ($project['level'] == Project::LEVEL_TEST) {
        ?>
                    <a class="btn btn-inline btn-info" style="min-width:120px;margin:auto auto 20px 40px;" href="<?= Url::to("@web/task/submit?projectId={$project['id']}"); ?>"><?= $project['name']; ?></a>
                    <input name="test" type="checkbox" value=<?=$project['id'];?>></input>
                    <?php
    } ?>
                <?php
} ?>
            <input type="submit" value="提交" onclick="te('test')"></input>
            </div>
        </div>
    </div>
    <!-- 测试环境 -->
    <br>
    <!-- 仿真环境 -->
    <div class="widget-box transparent">
        <div class="widget-header">
            <h4 class="lighter"><?= yii::t('w', 'conf_level_2'); ?></h4>

            <div class="widget-toolbar no-border"><a href="javascript:;" data-action="collapse">
                    <i class="icon-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main padding-6 no-padding-left no-padding-right">
            <a class="btn btn-inline btn-warning pre-all-push" style="min-width:120px;margin:auto auto 20px 40px;" href="javascript:;">一键全量全部提交</a>
                <?php foreach ($projects as $project) {
        ?>
                    <?php if ($project['level'] == Project::LEVEL_SIMU) {
            ?>
                        <a class="btn btn-inline btn-warning" style="min-width:120px;margin: auto auto 20px 40px;" href="<?= Url::to("@web/task/submit?projectId={$project['id']}"); ?>"><?= $project['name']; ?></a>
                        <input name="pre" type="checkbox" value=<?=$project['id'];?>></input>
                    <?php
        } ?>
                <?php
    } ?>
            <input type="submit" value="提交" onclick="te('pre')"></input>
            </div>
        </div>
    </div>
    <!-- 仿真环境 -->
    <br>
    <!-- 线上环境 -->
    <div class="widget-box transparent">
        <div class="widget-header">
            <h4 class="lighter"><?= yii::t('w', 'conf_level_3'); ?></h4>

            <div class="widget-toolbar no-border"><a href="javascript:;" data-action="collapse">
                    <i class="icon-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main padding-6 no-padding-left no-padding-right">
            <a class="btn btn-inline btn-success prod-all-push" style="min-width:120px;margin:auto auto 20px 40px;" href="javascript:;">一键全量全部提交</a>
                <?php foreach ($projects as $project) {
        ?>
                    <?php if ($project['level'] == Project::LEVEL_PROD) {
            ?>
                        <a class="btn btn-inline btn-success" style="min-width:120px;margin: auto auto 20px 40px;" href="<?= Url::to("@web/task/submit?projectId={$project['id']}"); ?>"><?= $project['name']; ?></a>
                        <input name="pro" type="checkbox" value=<?=$project['id'];?>></input>
                    <?php
        } ?>
                <?php
    } ?>
            <input type="submit" value="提交" onclick="te('pro')"></input>
            </div>
        </div>
    </div>
    <!-- 线上环境 -->
    <br>
        <!-- 开发环境 -->
    <div class="widget-box transparent">
        <div class="widget-header">
            <h4 class="lighter"><?= yii::t('w', 'conf_level_4'); ?></h4>

            <div class="widget-toolbar no-border"><a href="javascript:;" data-action="collapse">
                    <i class="icon-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main padding-6 no-padding-left no-padding-right">
            <a class="btn btn-inline btn-info dev-all-push" style="min-width:120px;margin:auto auto 20px 40px;" href="javascript:;">一键全量全部提交</a>                
                <?php foreach ($projects as $project) {
        ?>
                    <?php if ($project['level'] == Project::LEVEL_DEV) {
            ?>
                    <a class="btn btn-inline btn-info" style="min-width:120px;margin:auto auto 20px 40px;" href="<?= Url::to("@web/task/submit?projectId={$project['id']}"); ?>"><?= $project['name']; ?></a>
                    <input name="dev" type="checkbox" value=<?=$project['id'];?>></input>
                    <?php
        } ?>
                <?php
    } ?>
                <input type="submit" value="提交" onclick="te('dev')"></input>
            </div>
        </div>
    </div>
    <!-- 开发环境 end-->
    <br>
    <div class="modal fade" id="loadingModal">
    <div style="width: 200px;height:20px; z-index: 20000; position: absolute; text-align: center; left: 50%; top: 50%;margin-left:-100px;margin-top:-10px">
        <div class="progress progress-striped active" style="margin-bottom: 0;">
            <div class="progress-bar" style="width: 100%;"></div>
        </div>
        <h5>正在提交...</h5>
    </div>
</div>
</div>



<script>

//勾选提交

function te(env){
    project_id=document.getElementsByName(env)
    DallPush(env,project_id)
}

async function DallPush(env,project_id){
       
       $("#loadingModal").modal('show');
       //if(loading) return;
       //loading = true
        switch(env){
            case 'test':
                d_branch = 'dev'
                break;
            case 'pre':
                d_branch = 'master'
                break;
            case 'pro':
                d_branch = 'master'
                break;
            case 'dev':
                d_branch = 'dev'
                break;
        }
       var promiseArr = [];
       for(var i = 0,item;i<project_id.length;i++){
           if(! project_id[i].checked){continue;};
           try {
               item=project_id[i].value
               var commitLastLog = await dgetCommitList(item,d_branch)
           } catch(e){
              alert('发布失败,获取提交记录失败')
              break
           }
           var formData = new FormData();
           formData.append('Task[branch]', d_branch);
           formData.append('Task[title]', '多选发布TEST');
           formData.append('Task[commit_id]', commitLastLog);
           formData.append('Task[file_transmission_mode]', 1);
           formData.append('_csrf', '<?= Yii::$app->request->csrfToken; ?>');
           var promiseFunc = function(resolve, reject){
               $.ajax({
               url: `/task/submit?projectId=${item}`,
               type: 'POST',
               data: formData,
               contentType: false,
               processData: false,
               cache: false,
               success: function(data){
                   resolve({
                       id: item,
                       status: 'success'
                   })
               },
               error: function(err){
                   resolve({
                       id: item,
                       status: err.status === 302 ? 'success' : 'fail'
                   })
               }
           })
           }
          promiseArr.push(new Promise(promiseFunc))
       }
       Promise.all(promiseArr)
       .then((...arg) => {
           var success = 0,fail = 0,failArr = [];
           arg[0].map(item => {
               if(item.status === 'success'){
                   success++
               } else {
                   fail++
                   failArr.push(item.id)
               }
           })
           console.log(failArr)
           alert(`提交成功：${success}个, 提交失败：${fail}个 失败名单：${failArr.join(',')}`)
           loading = false
           $("#loadingModal").modal('hide');
       })
       .catch(e => {
           console.log(e)
           alert('提交失败，请联系管理员查看原因')
           loading = false
           $("#loadingModal").modal('hide');
       })
   }

   
function dgetCommitList(projectId,version) {
    return new Promise(function(resolve, reject){
        $.ajax({
            type:'GET',
            url: "<?= Url::to('@web/walle/get-commit-history?projectId='); ?>" + projectId +"&branch="+version,
            success: function (data) {
                // 获取commit log失败
                data.code && reject(new Error('获取提交记录失败'))
                resolve(data.data[0].id)
            },
            error: function(e){
                console.log(e)
                reject(e)
            }
        });
    })  
}
//勾选提交 end




//一键批量提交
    $(function(){        
        var testIdArr = [],
            preIdArr = [],
            prodIdArr = [],
            devIdArr = [],
            loading = false
        <?php foreach ($projects as $project) {
        ?>
            <?php if ($project['level'] == Project::LEVEL_TEST) {
            ?>
                testIdArr.push("<?php echo $project['id']; ?>")
            <?php
        } ?>
            <?php if ($project['level'] == Project::LEVEL_SIMU) {
            ?>
                preIdArr.push("<?php echo $project['id']; ?>")
            <?php
        } ?>
            <?php if ($project['level'] == Project::LEVEL_PROD) {
            ?>
                prodIdArr.push("<?php echo $project['id']; ?>")
            <?php
        } ?>
            <?php if ($project['level'] == Project::LEVEL_DEV) {
            ?>
                devIdArr.push("<?php echo $project['id']; ?>")
            <?php
        } ?>
        <?php
    } ?>

       

        $('.test-all-push').click(function(){
            allPush('test')
        })
        $('.pre-all-push').click(function(){
            allPush('pre')
        })
        $('.prod-all-push').click(function(){
            allPush('prod')
        })
        $('.dev-all-push').click(function(){
            allPush('dev')
        })

        async function allPush(type){
            $("#loadingModal").modal('show');
            if(loading) return;
            loading = true
            var arr, promiseArr = [],pre_branch;
            switch(type){
                case 'test':
                    arr = testIdArr;
                    pre_branch = 'dev'
                    break;
                case 'pre':
                    arr = preIdArr;
                    pre_branch = 'master'
                    break;
                case 'prod':
                    arr = prodIdArr;
                    pre_branch = 'master'
                    break;
                case 'dev':
                    arr = devIdArr;
                    pre_branch = 'dev'
                    break;
            }
            for(var i = 0,item;item = arr[i++];){
                try {
                    var commitLastLog = await getCommitList(item,pre_branch)
                } catch(e){
                   alert('发布失败,获取提交记录失败')
                   break
                }
                var formData = new FormData();
                formData.append('Task[branch]', pre_branch);
                formData.append('Task[title]', '一键全量全部发布-TEST');
                formData.append('Task[commit_id]', commitLastLog);
                formData.append('Task[file_transmission_mode]', 1);
                formData.append('_csrf', '<?= Yii::$app->request->csrfToken; ?>');
                var promiseFunc = function(resolve, reject){
                    $.ajax({
                    url: `/task/submit?projectId=${item}`,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function(data){
                        resolve({
                            id: item,
                            status: 'success'
                        })
                    },
                    error: function(err){
                        resolve({
                            id: item,
                            status: err.status === 302 ? 'success' : 'fail'
                        })
                    }
                })
                }
               promiseArr.push(new Promise(promiseFunc))
            }
            Promise.all(promiseArr)
            .then((...arg) => {
                var success = 0,fail = 0,failArr = [];
                arg[0].map(item => {
                    if(item.status === 'success'){
                        success++
                    } else {
                        fail++
                        failArr.push(item.id)
                    }
                })
                console.log(failArr)
                alert(`提交成功：${success}个, 提交失败：${fail}个 失败名单：${failArr.join(',')}`)
                loading = false
                $("#loadingModal").modal('hide');
            })
            .catch(e => {
                console.log(e)
                alert('提交失败，请联系管理员查看原因')
                loading = false
                $("#loadingModal").modal('hide');
            })
        }

        function getCommitList(projectId,version) {
            return new Promise(function(resolve, reject){
                $.ajax({
                    type:'GET',
                    url: "<?= Url::to('@web/walle/get-commit-history?projectId='); ?>" + projectId +"&branch="+version,
                    success: function (data) {
                        // 获取commit log失败
                        data.code && reject(new Error('获取提交记录失败'))
                        resolve(data.data[0].id)
                    },
                    error: function(e){
                        console.log(e)
                        reject(e)
                    }
                });
            })  
        }
    })
</script>
