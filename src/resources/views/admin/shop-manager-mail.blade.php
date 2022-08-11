<x-admin-layout>

<div class="mail">
    <div class="manager__title">
        <p>メール送信画面</p>
        <form action="{{ route('manager.home') }}" method="GET" class="admin__header-logout">
            @csrf
            <input type="submit" value="戻る" name="back">
        </form>
        <form action="{{ route('admin.destroy') }}" method="GET" class="admin__header-logout">
            @csrf
            <input type="submit" value="ログアウト" name="submit">
        </form>
    </div>
    <div class="manager__mail">
        <form action="{{ route('manager.send') }}" method="POST">
            @csrf
            <div class="admin__form-parts">
                <label>お客様アカウント名：</label> 
                <input type="text" name="name" class="admin__form-parts-name"  value="{{ $user->name }}" readonly>
            </div>
            <div class="admin__form-parts">
                <label>お客様メールアドレス：</label> 
                <input type="text" name="email" class="admin__form-parts-email" value="{{ $user->email }}"  readonly>
            </div>
            <div class="admin__form-parts">
                <label>メールタイトル：</label>
                <input type="text" name="title" class="admin__form-parts-mailttl">
            </div>
            <div class="admin__form-parts">
                <label class="mail-center">メール本文：</label> 
                <textarea name="msg" class="admin__form-parts-msg"></textarea>
            </div>
            <div class="admin__form-submit">
                <input type="submit" value="メール送信">
            </div>
        </form>
    </div>
</div>

</x-admin-layout>

