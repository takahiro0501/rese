<x-admin-layout>
    <div class="send">
        <div class="manager__shop send-content">
            <div>
                <p>メール送信が完了しました</p>
            </div>
            <form action="{{ route('manager.home') }}" method="GET" class="admin__header-logout">
                @csrf
                <input type="submit" value="ホーム画面へ" name="back">
            </form>

        </div>
    </div>
</x-admin-layout>

