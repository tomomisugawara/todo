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
            $complate_msg_time = 3000; // 表示時間
        var $arr_msg = [
            ["/image/neko1.png", "応援してるのにゃ。"],
            ["/image/neko2.png", "タスク達成おめでとうにゃ！"],
            [ "/image/neko3.png", "リンカーンは「たいていの人は、決意した程度だけ幸福になれる」と言ったそうにゃ～。",],
            ["/image/neko4.png", "・・・。"],
            ["/image/neko5.png", "来世は人ににゃりたいの。"],
            ["/image/neko6.png", "素晴らしいのにゃ！"],
            ["/image/neko7.png", "天才にゃ!"],
            ["/image/neko8.png", "ルルル～。"],
            ["/image/neko9.png","ららら～。"],
            ["/image/nekotumuri.png", "おつかれさまにゃ！"],
        ];

        let $timer;

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
                    // if (!$complate_msg.hasClass("animate")) {
                    //何回押してもアニーメーションが表示されない
                    $complate_msg.addClass("animate");
                    // $complate_msg
                    //     .clearQueue()
                    //     .stop(true, true)
                    //     .fadeIn(200, function () {
                    //         var $messageNo = Math.floor(
                    //             Math.random() * $arr_msg.length
                    //         );
                    //         $(".complete-msg__img img").attr(
                    //             "src",
                    //             $arr_msg[$messageNo][0]
                    //         );
                    //         $(".complete-msg__text").text(
                    //             $arr_msg[$messageNo][1]
                    //         );

                    //         // if ($timer != false) clearTimeout($timer);
                    //         // $timer = setTimeout(function () {
                    //         //     $complate_msg
                    //         //         .stop(true, true)
                    //         //         .fadeOut(200, function () {
                    //         //             $complate_msg.removeClass("animate");
                    //         //             // $(".complete-msg__img img").attr('src','');
                    //         //             $(".complete-msg__text").empty();
                    //         //         });
                    //         // }, $complate_msg_time);
                    //     })
                    //     .delay($complate_msg_time)
                    //     .fadeOut(200, function () {
                    //         $complate_msg.removeClass("animate");
                    //         // $(".complete-msg__img img").attr('src','');
                    //         $(".complete-msg__text").empty();
                    //     });

                    $complate_msg
                        .css("opacity", "0")
                        .clearQueue()
                        .stop()
                        .animate(
                            {
                                opacity: 1,
                            },
                            100,
                            function () {
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
                            }
                        )
                        .animate(
                            // delayでも可？
                            {
                                opacity: 1,
                            },
                            $complate_msg_time
                        )
                        .animate(
                            {
                                opacity: 0,
                            },
                            100,
                            function () {
                                $complate_msg.removeClass("animate");
                                $(".complete-msg__img img").attr("src", "");
                                $(".complete-msg__text").empty();
                            }
                        );

                    // .fadeOut(200, function () {
                    //     $complate_msg.removeClass("animate");
                    //     // $(".complete-msg__img img").attr('src','');
                    //     $(".complete-msg__text").empty();
                    // });

                    // }
                    
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
