window.addEventListener('DOMContentLoaded', function(){

  $('.label').on('click',function(){
    //データを変数にしまう

    // 特定のクラスを取得
    var $target = $(this);
    // 特定のIDを取得
    var $folderId = $(this).data('folderid');
    var $taskId = $(this).data('taskid');
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'post',
      url: '/folders/' + $folderId + '/tasks/' + $taskId + '/update',
      data: {
      },

      success: function (data) {
       if(data['status'] === 3) {
        // あまりいい方法じゃない（栗岩）
        // クラスを消す　$target.removeClass(label-danger);
        $target.removeClass();
        ////////////////////////////
        // クラスを追加する
        $target.addClass(data['statusClass'] + ' label');
        $target.text(data['statusLabel']);
        // $($flgbtn).addClass('お祝いのｱﾆﾒｰｼｮﾝクラス');
       }else if(data['status'] === 1) {
        // あまりいい方法じゃない（栗岩）
        $target.removeClass();
        ////////////////////////////
        $target.addClass(data['statusClass'] + ' label');
        $target.text(data['statusLabel']);
       }
      }
    })
  });
});
// .label-dangerアクティブクラス



