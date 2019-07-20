<?php $this->load->view('admin/header'); ?>

<div class="container" style="border-top: 2px solid #c73128; background: #ffffff55;height: 75vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
<?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h1 class="text-center text-uppercase">RECENT GAMES</h1>
            <div class="text-center" >
                <div class="" ng-app="App1">
                    <div class="tab-pane active" id="tab_default_1" ng-controller="recent_activtiy">
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
                                                                <div style="text-align: center;margin: 0 auto;cursor: pointer;" onclick="javascript:showProfile(this);" data-uname="{{data.uname}}" data-photo="{{data.photo}}" data-bio="{{data.bio}}">
                                                                    <div ng-if="data.photo != ''" style="width: 30px;height: 30px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;float: left;">
                                                                        <img src="<?php echo base_url()?>/uploads/photo/{{data.photo}}" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
                                                                    </div>
                                                                    <div ng-if="data.photo == ''" style="width: 30px;height: 30px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;float: left;">
                                                                        <img src="<?php echo base_url()?>/asset/images/account.png" style="display: inline;margin: 0 auto;margin-left: -25%; height: 100%;width: auto;"/>
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
</div>

<script>
    console.log(window.login);
</script>

<?php $this->load->view('admin/footer'); 