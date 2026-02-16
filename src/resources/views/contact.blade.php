<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}" />
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
        <div class="contact-form__content">
            <div class="contact-form__heading">
                <h2 class="contact-title">Contact</h2>
            </div>
            <form action="/confirm" method="post" novalidate>
                @csrf
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お名前</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--name">
                            <div class="form__input--name-item">
                                <input type="text" name="last_name" placeholder="例:山田" value="{{ old('last_name', session('contact_input.last_name')) }}" />
                                <div class="form__error">
                                    @error('last_name')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form__input--name-item">
                                <input type="text" name="first_name" placeholder="例:太郎" value="{{ old('first_name', session('contact_input.first_name')) }}" />
                                <div class="form__error">
                                    @error('first_name')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">性別</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--radio">
                            <label>
                                <input type="radio" name="gender" value="1" {{ old('gender', session('contact_input.gender', '1')) == '1' ? 'checked' : '' }}>
                                男性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="2" {{ old('gender', session('contact_input.gender', '1')) == '2' ? 'checked' : '' }}>
                                女性
                            </label>
                            <label>
                                <input type="radio" name="gender" value="3" {{ old('gender', session('contact_input.gender', '1')) == '3' ? 'checked' : '' }}>
                                その他
                            </label>
                        </div>
                        <div class="form__error">
                            @error('gender')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">メールアドレス</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="email" name="email" placeholder="例:test@example.com" value="{{ old('email', session('contact_input.email')) }}" />
                        </div>
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">電話番号</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--tel">
                            <div class="form__input--tel-item">
                                <input type="tel" name="tel_first" placeholder="080" value="{{ old('tel_first', session('contact_input.tel_first')) }}" />
                                <div class="form__error">
                                    @error('tel_first')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <span class="form__label--hyphen">-</span>
                            <div class="form__input--tel-item">
                                <input type="tel" name="tel_second" placeholder="1234" value="{{ old('tel_second', session('contact_input.tel_second')) }}" />
                                <div class="form__error">
                                    @error('tel_second')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <span class="form__label--hyphen">-</span>
                            <div class="form__input--tel-item">
                                <input type="tel" name="tel_third" placeholder="5678" value="{{ old('tel_third', session('contact_input.tel_third')) }}" />
                                <div class="form__error">
                                    @error('tel_third')
                                    {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">住所</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="address" placeholder="例:東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address', session('contact_input.address')) }}" />
                        </div>
                        <div class="form__error">
                            @error('address')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">建物名</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101" value="{{ old('building', session('contact_input.building')) }}" />
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせの種類</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--text">
                            <select class="create-form__item-select" name="categry_id">
                                <option value="" disabled {{ old('categry_id', session('contact_input.categry_id')) ? '' : 'selected' }}>選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category['id'] }}" {{ old('categry_id', session('contact_input.categry_id')) == $category['id'] ? 'selected' : '' }}>
                                        {{ $category['content'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form__error">
                            @error('categry_id')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__group">
                    <div class="form__group-title">
                        <span class="form__label--item">お問い合わせ内容</span>
                        <span class="form__label--required">※</span>
                    </div>
                    <div class="form__group-content">
                        <div class="form__input--textarea">
                            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail', session('contact_input.detail')) }}</textarea>
                        </div>
                        <div class="form__error">
                            @error('detail')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form__button">
                    <button class="form__button-submit" type="submit">確認画面</button>
                </div>
            </form>
        </div>
    </main>
</body>

<script>
// セレクトボックスのテキストの色を初期表示と選択時で変えるため
document.addEventListener('DOMContentLoaded', function() {
    const selectElements = document.querySelectorAll('.form__input--text select');

    selectElements.forEach(function(select) {
        // 初期状態をチェック
        if (select.value !== '') {
            select.classList.add('has-value');
        }

        // 変更時にクラスを追加/削除
        select.addEventListener('change', function() {
            if (this.value !== '') {
                this.classList.add('has-value');
            } else {
                this.classList.remove('has-value');
            }
        });
    });
});
</script>

</html>
