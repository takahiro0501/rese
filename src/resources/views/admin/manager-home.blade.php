<x-admin-layout>

    <div class="admin">
        <div class="admin__header">
            <p class="admin__header-ttl">店舗代表者作成画面</p>
            <form action="{{ route('admin.destroy') }}" method="GET" class="admin__header-logout">
                @csrf
                <input type="submit" value="ログアウト" name="submit">
            </form>
        </div>

        <form action="{{ route('admin.create') }}" method="POST" class="admin__form">
            @csrf
            <div class="admin__form-parts">
                <label class="namelabel">店舗代表者アカウント名</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name') 
                    <div class="admin__form-error">{{ $errors->first('name') }}</div>
                @enderror
            </div>

            <div class="admin__form-parts">
                <label class="emaillabel">店舗代表者メールアドレス</label>
                <input type="email" name="email" value="{{ old('email') }}">
                @error('email') 
                    <div class="admin__form-error">{{ $errors->first('email') }}</div>
                @enderror

            </div>

            <div class="admin__form-parts">
                <label class="passwordlabel">パスワード</label>
                <input type="password" name="password" value="{{ old('password') }}">
                @error('password') 
                    <div class="admin__form-error">{{ $errors->first('password') }}</div>
                @enderror
            </div>

            <div class="admin__form-submit">
                <input type="submit" value="新規作成" name="submit">
            </div>
        </form>

        <div class="admin__result">
            <div class="admin__result-ttl">
                <p>アカウント一覧</p>
                <p>全{{ count($shopManagers) }}件</p>
            </div>
            <table>
                <tr>
                    <th>アカウント名</td>
                    <th>メールアドレス</td>
                    <th>店舗権限</td>
                    <th>作成日</td>                    
                </tr>
                @foreach ( $shopManagers as $shopManager )
                    <tr>
                        <td>
                            {{ $shopManager->name }}
                        </td>
                        <td>
                            {{ $shopManager->email }}
                        </td>
                        <td>
                            @if( $shopManager->role->name == 'dammy' )
                                －
                            @else
                                {{ $shopManager->role->name }}
                            @endif
                        </td>
                        <td>
                            {{ $shopManager->updated_at }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


</x-admin-layout>
