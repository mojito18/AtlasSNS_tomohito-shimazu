//$(function () { // if document is ready
//alert('hello world')
//});

//ハンバーガメニューのモーダル
jQuery(function ($) {
  const accordionTitle = $(".js-accordion-title");
  const accordionContent = $(".js-accordion-content"); // ulにjs-accordion-contentクラスがあることを前提
  const arrowSvg = $('#arrowSvg'); // SVG要素全体を参照
  const arrowSvgPath = $('#arrowSvg path'); // SVG内のpath要素を参照

  // ページの読み込み時にメニューを非表示にする
  accordionContent.hide();

  // アコーディオンタイトルクリック時の処理
  accordionTitle.on("click", function () {
    accordionContent.slideToggle(200); // メニューの表示・非表示を切り替える

    // アコーディオンタイトルにopenクラスを付け外し
    $(this).toggleClass("open");

    // 矢印の向きを切り替える
    // .is(':visible') はアニメーション終了前の状態を返す可能性があるので、
    // slideToggleの完了コールバックを使うか、openクラスの状態を確認するのが確実
    if ($(this).hasClass("open")) { // openクラスが付与されたら上向き（開いた状態）
      arrowSvg.css('transform', 'rotate(180deg)'); // SVG全体を回転
    } else { // openクラスがなければ下向き（閉じた状態）
      arrowSvg.css('transform', 'rotate(0deg)'); // SVG全体を回転解除
    }
  });

  // メニュー外をクリックしたら閉じる処理
  $(document).on('click', function (event) {
    const isClickInsideAccordion = accordionTitle.is(event.target) || accordionTitle.has(event.target).length ||
      accordionContent.is(event.target) || accordionContent.has(event.target).length;

    if (!isClickInsideAccordion && accordionContent.is(':visible')) {
      accordionContent.slideUp(200); // メニューを閉じる
      accordionTitle.removeClass("open"); // openクラスを削除
      arrowSvg.css('transform', 'rotate(0deg)'); // 矢印を下向きに戻す
    }
  });
});


//削除時のモーダル
$(function () {
  // アイコンクリックで削除用画像に変更
  $('.js-delete-modal-open').on('click', function () {
    var $icon = $(this);
    $icon.attr('src', '/images/trash.png'); // 削除モードの画像に切り替え
    $('.js-delete-modal').fadeIn();

    // モーダルが閉じられたときに元に戻す処理を登録
    $('.js-delete-modal-close').one('click', function () {
      $icon.attr('src', '/images/trash-h.png'); // 元の画像に戻す
      $('.js-delete-modal').fadeOut();
    });

    document.querySelectorAll('.js-delete-modal-open').forEach(btn => {
      btn.addEventListener('click', function () {
        const postId = this.getAttribute('data-post-id');
        document.getElementById('deleteForm').action = `/post/delete/${postId}`;
      });
    });

    return false;
  });
});


//モーダル部分(投稿編集機能)
$(function () {
  $('.js-modal-open').on('click', function () {
    var post_id = $(this).data('post-id');
    var post = $(this).data('post');

    $('.modal_post').text(post);
    $('.modal_id').val(post_id);
    $('.js-modal').fadeIn();
  });

  // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
  $('.js-modal-close').on('click', function () {
    // モーダルの中身(class="js-modal")を非表示
    $('.js-modal').fadeOut();
    return false;
  });


  // 🔽 ここから削除用モーダル
  $('.js-delete-modal-open').on('click', function () {
    var post_id = $(this).data('post-id');
    console.log("削除対象ID:", post_id); // デバッグ出力
    $('#deleteForm').attr('action', '/post/' + post_id);
    $('.js-delete-modal').fadeIn();
    return false;
  });

  $('.js-delete-modal-close').on('click', function () {
    $('.js-delete-modal').fadeOut();
    return false;
  });


});
