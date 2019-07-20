<?php $this->load->view('admin/header'); ?>
<style type="text/css">
        ul>li, a{cursor: pointer;}
</style>
<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55; height: 70vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h1 class="text-center text-uppercase">LEADERBOARD (TOP 10)</h1>
                        <!-- <?php echo $this->session->userdata['user_name'];?> -->
            <div class="" ng-app="App1">

                <div class="tab-pane active" id="tab_default_1" ng-controller="toplist">
                    <div class="row clearfix">
                        <div class="col-md-12 column">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="thumbnail">
                                        <div ng-show="filteredItems > 0">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <th class='hidden-xs hidden-sm sortClass("id")'  ng-click='sort_by("id")'>POSITION&nbsp;</th>
                                                <th ng-click='sortColumn("name")'>USERNAME&nbsp;</th>
                                                <th ng-click='sortColumn("bet")'>BALANCE&nbsp;</th>
                                                </thead>
                                                <tbody>
                                                    <tr ng-repeat="data in filtered = (list| filter:search | orderBy : predicate :reverse) | startFrom:(currentPage - 1) * entryLimit | limitTo:entryLimit">
                                                        <td class="hidden-xs hidden-sm">{{$index + 1}}</td>
                                                        <td style="display: flex;align-items: center;align-content: center;">
                                                            <div style="text-align: center;margin: 0 auto;cursor: pointer;" onclick="javascript:showProfile(this);" data-email="{{data.email}}" data-uname="{{data.uname}}" data-photo="{{data.photo}}" data-bio="{{data.bio}}">
                                                                <div ng-if="data.photo != ''" style="width: 30px;height: 30px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;float: left;">
                                                                    <img src="<?php echo base_url()?>/uploads/photo/{{data.photo}}" style="display: inline;margin: 0 auto;margin-left: 0%; height: 100%;width: auto;"/>
                                                                </div>
                                                                <div ng-if="data.photo == ''" style="width: 30px;height: 30px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;float: left;">
                                                                    <img src="<?php echo base_url()?>/asset/images/account.png" style="display: inline;margin: 0 auto;margin-left: 0%; height: 100%;width: auto;"/>
                                                                </div>{{data.uname}}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div ng-if="data.balance.indexOf('.') > -1">
                                                                &pound;{{data.balance.split('.')[0]}}+
                                                            </div>
                                                            <div ng-if="data.balance.indexOf('.') == -1">
                                                                &pound;{{data.balance.split('.')[0]}}
                                                            </div>
                                                        </td>
                                                       <!-- <td><form method="post" id="{{data.password}}" action="<?php echo base_url()?>confirmWin"><input type="hidden" name="idval" value="{{data.id}}"/><input type="hidden" name="gamekind" value="{{data.game_kind}}"/>
                                                            <button type="{{data.status == 1 ? 'button':'submit'}}" onclick="javascript:test($(this));">JOIN GAME</button></form></td>-->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div  ng-show="filteredItems == 0">
                                            <div class="col-md-12">
                                                <h4>No Top Users Found.</h4>
                                            </div>
                                        </div>
                                        <div ng-show="filteredItems > 0" class="text-center">
                                            <ul pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;"></ul>
                                        </div>
                                        <p class="text-center"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="privatedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Please Enter Room's password.</h3>
        
      </div>
      <div class="modal-body">
            <input type="password" id="password" name="password" value=""/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="javascript:condition();" id="submitEditModal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="profileLabel">Pdasfrd.</h3>
      </div>
      
      <div class="modal-body">
            <table id="account-modal" style="width:100%">
                <tr>
                    <td style="width: 320px;">
                        <img src="" id="profile_photo" style="display: inline;   margin: 0 auto; height: 300px;width: 300px;"/>
                    </td>
                    <td>
                        <textarea class="form-control"  name="bio" id="bio_me" rows="3" maxlength="200" readonly style="resize:none;margin-bottom: 30px;"></textarea>
                        <table style="width: 100%; font-size: x-large;">
                            <tbody style="color: white;">
                                <tr>
                                    <td style="text-align: center;">Wins</td>
                                    <td style="text-align: center;">Draws</td>
                                    <td style="text-align: center;">Losses</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;" id="wins"></td>
                                    <td style="text-align: center;" id="draws"></td>
                                    <td style="text-align: center;" id="loose"></td>
                                </tr>
                            </thead>
                        </table>
                        
                        <p style="text-align: center; font-size: x-large; font-weight: 900;"> You have played against <font color="red" id="game_cnt"></font> different people </p>
                    </td>
                </tr>
            </table>
      </div>
      <div class="modal-footer">
        <form method="post" action="<?php echo base_url()?>chat/chat_func">
            <input type="hidden" value ="'.$people->sender_email.'" id="email_addr" name="email_addr"/>
            <button type="submit" class="btn btn-primary" id="activity_button">Activities</button>
            <button type="button" class="btn btn-primary" id="report_button" onclick="report_player(this)" name="">Report Player</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
    var condValue = '';
    var formObj;
    function test(form) {
        if (form.prop("type") == "button") {
            formObj = form.parent();
            condValue = formObj.prop("id");

            $("#privatedModal").modal('show');
        } else {
        }
    }
    
    function showProfile(element) {
        var uname = element.getAttribute("data-uname");
        var photo = element.getAttribute("data-photo");
        var email = element.getAttribute("data-email");
        
        if(photo == '') 
            photo = "<?php echo base_url()?>/asset/images/account.png";
        else
            photo = "<?php echo base_url()?>/uploads/photo/"+photo;
            
        var bio = element.getAttribute("data-bio");
        
        $("#profileLabel").text(uname);
        $("#profile_photo").attr("src", photo);
        $("#bio_me").html(bio);
        $("#report_button").prop('name', email);
        $("#report_button").prop('value', uname);
        $("#email_addr").prop('value', email);
        
        $.ajax({
            url:'<?php echo base_url()?>'+'ajax_admin/getGameLogsByEmail',
            type:'GET',
            data:'id='+ email
        }).done(function (data){
            res = JSON.parse(data);
            $("#wins").html(res['wins_cnt']);
            $("#draws").html(res['draws_cnt']);
            $("#loose").html(res['losses_cnt']);
            $("#game_cnt").html(res['game_cnt']);
        });
        
        $("#userModal").modal('show');
    }

    function report_player(element) {
        var email = element.getAttribute("name");
        var name = element.getAttribute("value");
        
        $.ajax({
            url:'<?php echo base_url()?>'+'ajax_admin/sendReport',
            type:'GET',
            data:'id='+ email + '&name=' + name 
        }).done(function (data){
            alert("You have reported this player.");
            $("#userModal").modal('hide');
        });
    }
    
    function condition() {
        val = document.getElementById('password').value;

        if (condValue == val) {
            $("#privatedModal").modal('hide');
            formObj.submit();                        
        } else {
            $("#privatedModal").modal('hide');
            alert("Invalid your password.");            
        }

    }
   
</script>

<?php
$this->load->view('admin/footer');?>
