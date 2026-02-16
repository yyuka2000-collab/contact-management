<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}" />
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
        </div>
    </header>

    <main>
        <div class="confirm__content">
            <div class="contact-form__heading">
                <h2 class="contact-title">Confirm</h2>
            </div>
            <form action="/thanks" method="POST">
                @csrf
                <div class="confirm-table">
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text">
                                {{ $contact['last_name'] }}  {{ $contact['first_name'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                @if($contact['gender'] == 1)
                                    男性
                                @elseif($contact['gender'] == 2)
                                    女性
                                @else
                                    その他
                                @endif
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                {{ $contact['email'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                {{ $contact['tel'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                {{ $contact['address'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                {{ $contact['building'] ?? '' }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせの種類</th>
                            <td class="confirm-table__text">
                                {{ $contact['category'] }}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__text confirm-table__text--detail">{{ trim($contact['detail']) }}</td>
                        </tr>
                    </table>
                </div>

                <!-- hiddenで全データを保持 -->
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
                <input type="hidden" name="email" value="{{ $contact['email'] }}">
                <input type="hidden" name="tel_first" value="{{ $contact['tel_first'] }}">
                <input type="hidden" name="tel_second" value="{{ $contact['tel_second'] }}">
                <input type="hidden" name="tel_third" value="{{ $contact['tel_third'] }}">
                <input type="hidden" name="address" value="{{ $contact['address'] }}">
                <input type="hidden" name="building" value="{{ $contact['building'] ?? '' }}">
                <input type="hidden" name="categry_id" value="{{ $contact['categry_id'] }}">
                <input type="hidden" name="detail" value="{{ $contact['detail'] }}">

                <div class="form__button">
                    <button class="form__button-submit" type="submit">送信</button>
                    <button type="submit" formaction="/" formmethod="GET" class="form__button-back">修正</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
