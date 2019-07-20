<!-- PRICE ITEM -->
<!-- <a href="<?php echo base_url()?>memberList" class="btn btn-default hover">
    <div class="panel-body text-center">
        <p class="lead" style="font-size:40px"><strong><i class="glyphicon glyphicon-list-alt"></i></strong></p>
    </div>
    <span class=""><i class="icon-ok text-danger"></i> START_A_NEW_BET</span>
</a> 
<i class="glyphicon glyphicon-list-alt"></i>
-->
<!-- /PRICE ITEM -->

<!-- PRICE ITEM -->
<a href="<?php echo base_url() ?>register" class="btn btn-default hover">
    <div class="panel-body text-center">
        <p class="lead" style="font-size:40px"><strong><img src="<?php base_url()?>/asset/images/new-bet.png" class="user_icon"/></strong></p>
    </div>
    <span class=""><i class="icon-ok text-danger"></i>START NEW BET</span>
</a>

<a href="<?php echo base_url() ?>memberList" class="btn btn-default hover">
    <div class="panel-body text-center">
        <p class="lead" style="font-size:40px"><strong><img src="<?php base_url()?>/asset/images/my-bets.png" class="user_icon"/></strong></p>
    </div>
    <span class=""><i class="icon-ok text-danger"></i>JOIN GAME</span>
</a>

<a href="<?php echo base_url() ?>showLog" class="btn btn-default hover my-bets">
  <!--  <div class="panel-body text-center">
        <p class="lead" style="font-size:40px"><strong><img src="<?php base_url()?>/asset/images/my-bets.png" class="user_icon"/></strong></p>
    </div> -->
    <span class="activities">ACTIVITIES</span>
</a>

<!-- /PRICE ITEM -->

<!-- script --->
<script>
    isNewMessage();
    
    function isNewMessage() {
        setTimeout(function () {
          //do something once
          isGetNewMessage();
        }, 500); 
    }
    
    function isGetNewMessage() {
        $.ajax({
            url:'<?php echo base_url()?>chat/isGetNewMessage',
            type:'GET'
        }).done(function (data){
            res = JSON.parse(data);
            
            if(res['cnt'] > 0) {
                $(".activities").html('ACTIVITIES ['+res['cnt']+']');
                $(".recentact").html('Recent ['+res['cnt']+']');
            }
            for(i=0; i <res['cnt']; i++) {
                id = "#" + res[i]['id'];
                $(id).show();
            }
            isNewMessage();
            /*if (html != 'same')
                $(".class_balance").html("&pound;" + html);
                $(".balance_val").html("&pound;" + html);
            checkBalance();*/
        });
    }
</script>