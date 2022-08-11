
window.onload = function () {

  const open = document.getElementById('header__logo');
  const close = document.getElementById('menu__logo');
  const modal = document.getElementById('modal');
  
  //メニュー用モーダルウィンドウ画面イベント定義
  open.addEventListener('click', function (el) {
      modal.style.display='block';
  })
  close.addEventListener('click', function (el) {
      modal.style.display='none';
  })

  //もし検索要素がある場合は、イベントを定義する
  if (document.getElementById('header__search') != null) { 

    //エリア、ジャンル、検索ワードの要素を取得する
    const area = document.getElementById('search-area');
    const genre = document.getElementById('search-genre');
    const word = document.getElementById('keyword');

    //エリアのselect要素にイベント定義
    area.addEventListener('change', function (event) {
      //エリアとジャンルドロップダウン要素の選択状態を取得する
      const areaSelected = area.options[area.selectedIndex].value;
      const genreSelected = genre.options[genre.selectedIndex].value;
      //genru_idのみ取り出す
      const genruId = genreSelected.slice(-1);
      //aria_idと、genre_idを持ってコントローラーへ遷移
      location.href = areaSelected + '&genre_id=' + genruId;
    })

    //ジャンルのselect要素にイベント定義
    genre.addEventListener('change', function (event) {
      //エリアとジャンルドロップダウン要素の選択状態を取得する
      const areaSelected = area.options[area.selectedIndex].value;
      const genreSelected = genre.options[genre.selectedIndex].value;
      //area_idのみ取り出す
      const areaId = areaSelected.slice(-1);
      //aria_idと、genre_idを持ってコントローラーへ遷移s
      location.href = genreSelected + '&area_id=' + areaId;
    })

    //検索ワードのinput要素にイベント定義
    word.addEventListener('change', function (event) {
      //エリアとジャンルドロップダウン要素の選択状態を取得する
      const areaSelected = area.options[area.selectedIndex].value;
      const genreSelected = genre.options[genre.selectedIndex].value;
      //genru_idのみ取り出す
      const genruId = '&genre_id=' + genreSelected.slice(-1);
      //検索ワード追加
      const keyword = '&keyword=' + word.value;
      //aria_idと、genre_idと検索ワードを持ってコントローラーへ遷移
      location.href = areaSelected + genruId + keyword;
    })
  }

  //予約確認フォームの定義
  if (document.getElementById('detail_reserve') != null) {
    //予約Input要素取得
    const reserveFormDates = document.getElementsByClassName('reserve-form-date');
    const reserveFormTimes = document.getElementsByClassName('reserve-form-time');
    const reserveFormNumbers = document.getElementsByClassName('reserve-form-number');
    //確認領域の要素取得
    const reserveComfirmDates = document.getElementsByClassName('detail_reserve-comfirm-date');
    const reserveComfirmTimes = document.getElementsByClassName('detail_reserve-comfirm-time');
    const reserveComfirmNumbers = document.getElementsByClassName('detail_reserve-comfirm-number');

    //「Date」部分のイベント定義
    for (let i = 0; i < reserveFormDates.length; i++) {
      reserveFormDates[i].addEventListener('change', function (event) {
        reserveComfirmDates[i].textContent = reserveFormDates[i].value;
      })
    }
    //「Time」部分のイベント定義
    for (let i = 0; i < reserveFormTimes.length; i++) {
      reserveFormTimes[i].addEventListener('change', function (event) {
        reserveComfirmTimes[i].textContent = reserveFormTimes[i].value;
      })
    }
    //「Number」部分のイベント定義
    for (let i = 0; i < reserveFormNumbers.length; i++) {
      reserveFormNumbers[i].addEventListener('change', function (event) {
        reserveComfirmNumbers[i].textContent = reserveFormNumbers[i].value;
      })
    }
  }

  //ゲストに対するアラート通知定義
  if (document.getElementById('loginAlert') != null) {
    const detailReserveSubmit = document.getElementById('detail_reserve-submit');
    detailReserveSubmit.addEventListener('click', function (event) {
      alert('予約はログイン後に行ってください。');
    })
  }

  //予約日時バリデーションを行う為,dateとtimeを結合
  if (document.getElementById('detail_reserve-btn') != null) {
    const submit = document.getElementById('detail_reserve-btn');    
    const datetime = document.getElementById('reserve-form-datetime');
    const date = document.getElementById('reserve-form-date');
    const time = document.getElementById('reserve-form-time');

    submit.addEventListener('click', function (event) {
      datetime.value = date.value + ' ' +time.value;
    })
  }
    

  //マイページ評価機能：切り替えタブ設定
  if (document.getElementById('mypage__status') != null) {
    //切り替えタブの取得
    const statusTabs = document.getElementsByClassName('mypage__status-ttl-item');
    //切り替えコンテンツの取得
    const statusContents = document.getElementsByClassName('mypage__status-cards');

    for (let i = 0; i < statusTabs.length; i++) {
      statusTabs[i].addEventListener('click', function () {
        //activeクラスを削除
        for (let i = 0; i < statusTabs.length; i++) {
          statusTabs[i].classList.remove('active');
        }
        for (let i = 0; i < statusContents.length; i++) {
          statusContents[i].classList.remove('active');
        }
        //クリックされたタブにactiveを付与
        this.classList.add('active');
        //タブリストを配列に変換
        const aryTabs = Array.prototype.slice.call(statusTabs);
        //クリックされたタブが格納されてあるindexを取得
        const index = aryTabs.indexOf(this);
        //クリックされたタブに対応したコンテンツにactiveを付与
        statusContents[index].classList.add('active');
      });
    }
  }

/* バリデーション問題等によりモーダル廃止　動作確認後削除予定　2022/07/17
  //マイページ評価機能：評価モーダルウィンドウ
  if (document.getElementById('mypage__status-card-rateBtn') != null) {
    ////「評価する」ボタンにイベントを設定する
    //イベントを設定する要素を取得
    const rateModals = document.getElementsByClassName('mypage__status-card-rateBtn');
    //collectionから配列へ変換
    let rateModalsArr = Array.from(rateModals);
    //取得要素がクリックされた場合
    rateModalsArr.forEach(function (modal) {
      modal.addEventListener('click', function () {
        //兄弟要素を取得しモーダルを出現させる
        const target = modal.nextElementSibling;
        target.style.display = 'block';
      })
    });
    //評価画面の×ボタン押下時の動作を設定
    const rateClose = document.getElementsByClassName('detail_rate-ttl-close');
    let rateCloseArr = Array.from(rateClose);
    rateCloseArr.forEach(function (close) {
      close.addEventListener('click', function () {
        const target = close.closest('.rate-modal');
        target.style.display = 'none';
      })
    });
  }
*/

  //評価機能機能（店舗詳細ページ「口コミタブ」）：切り替えタブ設定追加
  if (document.getElementById('detail__shop-ttl') != null) {
    //切り替えタブの取得
    const reviewTabs = document.getElementsByClassName('detail__shop-ttl-item');
    //切り替えコンテンツの取得
    const reviewContents = document.getElementsByClassName('detail__shop-review-item');

    for (let i = 0; i < reviewTabs.length; i++) {
      reviewTabs[i].addEventListener('click', function () {
        //activeクラスを削除
        for (let i = 0; i < reviewTabs.length; i++) {
          reviewTabs[i].classList.remove('active');
        }
        for (let i = 0; i < reviewContents.length; i++) {
          reviewContents[i].classList.remove('active');
        }
        //クリックされたタブにactiveを付与
        this.classList.add('active');
        //タブリストを配列に変換
        const aryTabs = Array.prototype.slice.call(reviewTabs);
        //クリックされたタブが格納されてあるindexを取得
        const index = aryTabs.indexOf(this);
        //クリックされたタブに対応したコンテンツにactiveを付与
        reviewContents[index].classList.add('active');
      });
    }
  }

}