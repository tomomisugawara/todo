window.addEventListener('DOMContentLoaded', function(){

  $('.label').on('click',function(){
    //データを変数にしまう
    var $flgbtn = $(this);
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'post',
      url: '/folders/1/tasks/1/update',
      data: {
      },
      success: function (flag) {
        alert(flag);
      //  if(flag == 1) {
      //   $($flgbtn).addClass('active');
      //   $($flgbtn).addClass('お祝いのｱﾆﾒｰｼｮﾝクラス');
      //  } else {
      //   $($flgbtn).removeClass('active');
      //  }
      }
    })
  });
});
// .label-dangerアクティブクラス