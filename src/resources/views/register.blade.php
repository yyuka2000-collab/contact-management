<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>
            <a class="header__login-link" href="/login">login</a>
        </div>
    </header>

    <main>
        <div class="register__content">
            <div class="register__heading">
                <h2>Register</h2>
            </div>
            <div class="register__form">
                <form action="/register" method="post" novalidate>
                    @csrf
                    <div class="form__group">
                        <label class="form__label">お名前</label>
                        <input type="text" name="name" placeholder="例: 山田　太郎" value="{{ old('name') }}">
                        <div class="form__error">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form__group">
                        <label class="form__label">メールアドレス</label>
                        <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                        <div class="form__error">
                            @error('email')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form__group">
                        <label class="form__label">パスワード</label>
                        <input type="password" name="password" placeholder="例: coachtech1106">
                        <div class="form__error">
                            @error('password')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form__button">
                        <button type="submit">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>