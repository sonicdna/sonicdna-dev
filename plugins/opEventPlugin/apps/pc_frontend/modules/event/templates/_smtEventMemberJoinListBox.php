<?php use_helper('Javascript') ?>
<script id="eventMemberJoinListTemplate" type="text/x-jquery-tmpl">
  <div class="span3">
    <div class="row_memberimg row"><div class="span3 center"><a href="${profile_url}"><img src="${profile_image}" class="rad10" width="57" height="57"></a></div></div>
    <div class="row_membername font10 row"><div class="span3 center"><a href="${profile_url}">${name}</a> (${friends_count})</div></div>
  </div>
</script>
<script type="text/javascript">
$(function(){
  $.getJSON( openpne.apiBase + 'member/search.json?target=event&target_id=<?php echo $event->getId() ?>&apiKey=' + openpne.apiKey, function(json) {
    $('#eventMemberJoinListTemplate').tmpl(json.data).appendTo('#eventMemberJoinList');
    $('#eventMemberJoinList').show();
    $('#eventMemberJoinListLoading').hide();
  });
  $('#eventMemberJoinListSearch').keypress(function(){
    $('#eventMemberJoinListLoading').show();
    $('#eventMemberJoinList').hide();
    $('#eventMemberJoinList').empty();
  });
  $('#eventMemberJoinListSearch').blur(function(){
    var keyword = $('#eventMemberJoinListSearch').val();
    var requestData = { target: 'event', target_id: <?php echo $event->getId(); ?>, keyword: keyword, apiKey: openpne.apiKey };
    $.getJSON( openpne.apiBase + 'member/search.json', requestData, function(json) {
      $result = $('#eventMemberJoinListTemplate').tmpl(json.data);
      $('#eventMemberJoinList').html($result);
      $('#eventMemberJoinList').show();
      $('#eventMemberJoinListLoading').hide();
    });
  });
});
</script>

<hr class="toumei" />
<div class="row">
  <div class="gadget_header span12"><?php echo __('%event% Members', array('%event%' => $op_term['event'])) ?></div>
</div>
<hr class="toumei" />
<div class="row" id="eventMemberJoinListSearchBox">
<div class="input-prepend span12">
<span class="add-on"><i class="icon-search"></i></span>
<input type="text" id="eventMemberJoinListSearch" class="realtime-searchbox" value="" />
</div>
</div>
<div class="row hide" id="eventMemberJoinList">
</div>
<div class="row center" id="eventMemberJoinListLoading" style="margin-left: 0;">
<?php echo op_image_tag('ajax-loader.gif') ?>
</div>
