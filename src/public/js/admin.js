
//画像プレビュー関数
function previewFile(file) {
  //プレビュー要素の取得
  const preview = document.getElementById('preview');
  //オブジェクト生成
  const reader = new FileReader();

  // ファイルが読み込まれたときの実行定義
  reader.onload = function (e) {
    const imageUrl = e.target.result;
    const img = document.createElement("img");
    img.src = imageUrl;
    preview.appendChild(img);
  };
  //ファイル読み込み
  reader.readAsDataURL(file);
}


window.onload = function () {

  //画像プレビュー機能定義
  if (document.getElementById('shop-img') != null) {
    //対象のinput要素取得
    const fileInput = document.getElementById('shop-img');
    //input要素にイベント定義
    fileInput.addEventListener('change', function () {
      const files = fileInput.files;
      for (let i = 0; i < files.length; i++) {
        previewFile(files[i]);
      }
    });
  }

  if (document.getElementById('memu__shop-ins-disable') != null) {
    const disable = document.getElementById('memu__shop-ins-disable');
    disable.addEventListener('click', function () {
      alert('店舗は作成済みです');
    });
  }
  if (document.getElementById('memu__shop-upd-disable') != null) {
    const disable = document.getElementById('memu__shop-upd-disable');
    disable.addEventListener('click', function () {
      alert('店舗が作成されていません');
    });
  }
}