<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 1px solid #D14B54; background: #f5f5f5f5; height: 100vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h1 class="text-center text-uppercase">Activities</h1>
            <hr/>
            <div class="row">
                <div class="col-xs-12">
                    <!-- Tab panes -->
                    <h3 class="red-title">Open</h1>
                    <div class="tab-content">
                        <div class="tab-pane active" id="OD">
                            
                            <table class="table table-hover">
                                <thead><tr><th>Room ID</th><th>Bet / PR</th><th>Winnings</th><th>Action</th></tr></thead>
                                <tbody id="open_room"></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <h3 class="red-title recentact">Recent[0]</h1>
                    <div class="tab-content">
                        <div class="tab-pane active" id="recent_activity">
                            <table class="table table-activity">
                                <?php
                                    $email = $this->session->userdata['user_email'];
                                   
                                    foreach($peoples as $people) {
                                        if ($people->sender_email == $email) { continue;
                                            $photo = $people->receivephoto;
                                            if ($people->receivephoto == '')
                                                $photo = 'asset/images/account.png';
                                            else
                                                $photo = 'uploads/photo/'.$photo;
                                                
                                            echo '<tr class="1241">
                                                <form method="post" action="'.base_url().'chat/chat_func">
                                                <input type="hidden" value ="'.$people->receiver_email.'" name="email_addr"/>
                                                <td style="display: flex;align-items: right;align-content: right;">
                                                    <div style="margin: 0 auto;width: 50px;height: 50px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;">
                                                        <img src="'.base_url().$photo.'" style="display: inline;margin: 0 auto;margin-left: 0%; height: 100%;width: auto;"/>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle; text-align:left; font-size: larger;">'.$people->receivename.'<br>
                                                '.$people->message_content.'</td>
                                                <td style="vertical-align: middle;">
                                                    <ol class="breadcrumb">
                                                        <li class="pull-right" style="margin-right:10px;">
                                                            <p class="btn-infomation" id="'.$people->receivename.'" style="display:none; width: 15px;height: 15px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;">
                                                            </p>
                                                        </li>
                                                    </ol>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <button type="submit" >Open</button>
                                                </td>
                                                </form>
                                            </tr>';    
                                        } else {
                                            $photo = $people->sendphoto;
                                            if ($people->sendphoto == '')
                                                $photo = 'asset/images/account.png';
                                            else
                                                $photo = 'uploads/photo/'.$photo;
                                                
                                            echo '<tr class="1241">
                                                <form method="post" action="'.base_url().'chat/chat_func">
                                                <input type="hidden" value ="'.$people->sender_email.'" name="email_addr"/>
                                                <td style="display: flex;align-items: right;align-content: right;">
                                                    <div style="margin: 0 auto;width: 50px;height: 50px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;">
                                                        <img src="'.base_url().$photo.'" style="display: inline;margin: 0 auto;margin-left: 0%; height: 100%;width: auto;"/>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle; text-align:left;font-size: larger;"><Strong>'.$people->sendname.'</strong><br>
                                                '.$people->message_content.'&nbsp;&nbsp;&nbsp;&nbsp;'.$people->created_at.'</td>
                                                <td style="vertical-align: middle;">
                                                    <ol class="breadcrumb">
                                                        <li class="pull-right" style="margin-right:10px;">
                                                            <p class="btn-infomation" id="'.$people->sendname.'" style="display:none; width: 15px;height: 15px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;">
                                                            </p>
                                                        </li>
                                                    </ol>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <button type="submit" >Open</button>
                                                </td>
                                                </form>
                                            </tr>';
                                        }
                                        
                                    }
                                ?>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    var OD = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showOpenRooms'
        }).done(function (data){
            $("#open_room").html(data);
        });
    };
    //wins history
    var ED = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showWinsHistory'
        }).done(function (data){
            $("#exp_res").html(data);
        });
    };
    
    //loose history
    var EM = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showLooseHistory'
        }).done(function (data){
            $("#ins_res").html(data);
        });
    };
    
    //draws history
    var DI = function (){
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/showDrawsHistory'
        }).done(function (data){
            $("#memexp_res").html(data);
        });
    };
    
    function open_activity() {
        
    }
    
    //cross wins
    function cross_win(obj, kind) {
        parentObj = obj.parent().parent();
        var amount = $(obj).parent().attr("class");
        var roomID = $(parentObj).attr("class");
        
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/deleteWinHistory?id='+roomID + '&amount=' + amount + '&kind=' + kind
        }).done(function (data){
            if(data !='') {
                $(".class_balance").html(data);
                $(parentObj).remove();
            } else 
                alert(/*'This room has already closed.'*/data);
                $(parentObj).remove();
        });    
    }
    
    /*//cross loose
    function cross_loose(obj) {
        parentObj = obj.parent().parent();
        var amount = $(obj).parent().attr("class");
        var roomID = $(parentObj).attr("class");
        
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/deleteWinHistory?id='+roomID + '&amount=' + amount
        }).done(function (data){
            if(data=='success')
                $(parentObj).remove();
            else 
                alert('Fatal Error.');
        });    
    }
    
    //cross draws
    function cross_draws(obj) {
        parentObj = obj.parent().parent();
        var amount = $(obj).parent().attr("class");
        var roomID = $(parentObj).attr("class");
        
        $.ajax({
            type:'GET',
            url:'<?php echo base_url()?>admin/deleteWinHistory?id='+roomID + '&amount=' + amount
        }).done(function (data){
            if(data=='success')
                $(parentObj).remove();
            else 
                alert('Fatal Error.');
        });    
    }*/
    
    $(document).ready(function (){
        OD();
        
        $(".od").on('click', function (){
           OD();
        });

        $(".ed").on('click', function (){
           ED();
        });
        
        $(".di").on('click', function (){
           DI();
        });
        
        $(".em").on('click', function (){
           EM();
        });
    });
</script>
<?php
$this->load->view('admin/footer');
