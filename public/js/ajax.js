// 完了コメント

window.addEventListener("DOMContentLoaded", function () {
    $(".label").on("click", function () {
        //データを変数にしまう
        // 特定のクラスを取得
        var $target = $(this);
        // 特定のIDを取得
        var $folderId = $(this).data("folderid");
        var $taskId = $(this).data("taskid");

        var $complate_msg = $(".complete-msg"), // 完了メッセージ
            $complate_msg_time = 2000; // 表示時間
        var $arr_msg = [
            //// '素晴らしいのにゃ！','生きてるだけでほめられたいのにゃ。','コアラのマーチより、パックンチョの方が先輩にゃ。','天才なにゃの？'"'毎日寝て過ごしたいにゃ、もう何もする気が起きないにゃ。'
            ["/image/kuroneko-back.png", "おつかれさまにゃ！"],
            [ "/image/neko.png",
                "リンカーンは「たいていの人は、決意した程度だけ幸福になれる」と言ったそうにゃ。",],
			["/image/nikukyuu-onehand.png", "タスク達成おめでとうにゃ！",],
        ];

        let $re;

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "post",
            url: "/folders/" + $folderId + "/tasks/" + $taskId + "/update",
            data: {},

            success: function (data) {
                if (data["status"] === 3) {
                    // +++++ 完了 +++++
                    // あまりいい方法じゃない（栗岩）
                    // クラスを消す
                    $target.removeClass();
                    ////////////////////////////
                    // クラスを追加する
                    $target.addClass(data["statusClass"] + " label");
                    $target.text(data["statusLabel"]);
                    $target.addClass("complete");

                    // 表示アニメーション
                    if (!$complate_msg.hasClass("animate")) {
                        //何回押してもアニーメーションが表示されない
                        $complate_msg.addClass("animate");
                        $complate_msg.fadeIn(200, function () {
                            var $messageNo = Math.floor(
                                Math.random() * $arr_msg.length
                            );
                            $(".complete-msg__img img").attr(
                                "src",
                                $arr_msg[$messageNo][0]
                            );
                            $(".complete-msg__text").text(
                                $arr_msg[$messageNo][1]
                            );

                            // clearTimeout($re);
                            $re = setTimeout(function () {
                                $complate_msg.removeClass("animate");
                                // $(".complete-msg__img img").attr('src','');
                                $(".complete-msg__text").empty();
                                $complate_msg.fadeOut(200);
                            }, $complate_msg_time);
                        });
                    }

                    /* //////////////////////////////////////
					現状、メッセージ表示中は、何回押しても設定した秒数のみ表示される。
					他にやるとしたら、ボタンを押したタイミングで表示時間のカウント再スタート。
					////////////////////////////////////// */
                } else if (data["status"] === 1) {
                    // +++++ 未 +++++
                    // あまりいい方法じゃない（栗岩）
                    $target.removeClass();
                    ////////////////////////////
                    $target.addClass(data["statusClass"] + " label");
                    $target.text(data["statusLabel"]);
                    $target.removeClass("complete");
                }
            },
        });
    });

    $("#imageUpload").on("change", function (e) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $("#preview").attr("src", e.target.result);
        };
        reader.readAsDataURL(e.target.files[0]);
    });
});
