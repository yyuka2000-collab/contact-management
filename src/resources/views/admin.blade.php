<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Admin</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <form action="/logout" method="post" class="logout-form">
                @csrf
                <button type="submit" class="header__logout-button">logout</button>
            </form>
        </div>
    </header>

    <main>
        <div class="admin__content">
            <div class="admin__heading">
                <h2 class="admin-title">Admin</h2>
            </div>

            <!-- 削除成功メッセージ -->
            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <!-- 検索フォーム -->
            <form action="/search" method="get" class="search__form">
                <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}" class="search__input">

                <select name="gender" class="search__select">
                    <option value="">性別</option>
                    <option value="">全て</option>
                    <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                    <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                    <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
                </select>

                <select name="categry_id" class="search__select">
                    <option value="">お問い合わせの種類</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('categry_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                    @endforeach
                </select>

                <input type="date" name="date" value="{{ request('date') }}" class="search__date">

                <button type="submit" class="btn-search">検索</button>
                <a href="/reset" class="btn-reset">リセット</a>
            </form>

            <!-- エクスポートとページネーション -->
            <div class="control__row">
                <div class="export__container">
                    <form action="/export" method="get">
                        @foreach(request()->all() as $key => $value)
                            @if($value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <button type="submit" class="btn-export">エクスポート</button>
                    </form>
                </div>

                <div class="pagination__container">
                    {{ $contacts->appends(request()->query())->links('vendor.pagination.custom') }}
                </div>
            </div>

            <!-- データテーブル -->
            <div class="table__container">
                <table class="data__table">
                    <thead>
                        <tr>
                            <th>お名前</th>
                            <th>性別</th>
                            <th>メールアドレス</th>
                            <th>お問い合わせの種類</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
                            <td>
                                @if($contact->gender == 1)
                                    男性
                                @elseif($contact->gender == 2)
                                    女性
                                @else
                                    その他
                                @endif
                            </td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->category->content }}</td>
                            <td>
                                <button type="button" class="btn-detail" onclick="openModal({{ $contact->id }})">詳細</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- モーダル表示時 -->
    @foreach($contacts as $contact)
    <div id="modal-{{ $contact->id }}" class="modal">
        <div class="modal__content">
            <span class="modal__close" onclick="closeModal({{ $contact->id }})">&times;</span>
            <div class="modal__body">
                <div class="modal__row">
                    <div class="modal__label">お名前</div>
                    <div class="modal__value">{{ $contact->last_name }} {{ $contact->first_name }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">性別</div>
                    <div class="modal__value">
                        @if($contact->gender == 1)
                            男性
                        @elseif($contact->gender == 2)
                            女性
                        @else
                            その他
                        @endif
                    </div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">メールアドレス</div>
                    <div class="modal__value">{{ $contact->email }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">電話番号</div>
                    <div class="modal__value">{{ $contact->tel }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">住所</div>
                    <div class="modal__value">{{ $contact->address }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">建物名</div>
                    <div class="modal__value">{{ $contact->building }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">お問い合わせの種類</div>
                    <div class="modal__value">{{ $contact->category->content }}</div>
                </div>
                <div class="modal__row">
                    <div class="modal__label">お問い合わせ内容</div>
                    <div class="modal__value">{{ $contact->detail }}</div>
                </div>
                <form class="delete-form" action="/delete" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="delete-form__button">
                        <input type="hidden" name="id" value="{{ $contact->id }}">
                        <button class="delete-form__button-submit" type="submit">削除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        // 詳細モーダル表示
        function openModal(id) {
            document.getElementById('modal-' + id).style.display = 'block';
        }

        // 詳細モーダル閉じる
        function closeModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }

        // 削除成功メッセージを3秒後に自動的に消す
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('.alert-success');
            if (alert) {
                setTimeout(function() {
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 300);
                }, 3000);
            }
        });
    </script>
</body>
</html>