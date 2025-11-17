<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация на платформе</title>
</head>
<body style="margin: 0; padding: 0; background: #F5F5F5; font-family: Arial, sans-serif;">

<div style="max-width: 600px; margin: 0 auto; background: #fff; padding: 32px; border-radius: 8px; color: #444444;">
    <h1 style="margin: 0 0 24px 0; font-size: 26px; font-weight: bold; color: #1C1C1C; text-align: left;">
        Регистрация на платформе
    </h1>

    <p style="font-size: 16px; line-height: 1.5; color: #595959; margin-bottom: 24px;">
        Вы успешно зарегистрировались на платформе <strong style="color:#1C1C1C;">ПрофУчёт</strong>.
        Для завершения регистрации необходимо подтвердить ваш email.
    </p>

    <div style="
        background: #EAE5FB;
        border: 1px solid #A181FF;
        padding: 20px;
        text-align: center;
        border-radius: 8px;
        margin-bottom: 28px;
    ">
        <div style="font-size: 14px; color: #2E2F34; margin-bottom: 6px;">Ваш код подтверждения:</div>
        <div style="font-size: 32px; font-weight: bold; color: #1B71E2; letter-spacing: 2px;">
            {{$code}}
        </div>
    </div>
    <p style="font-size: 14px; color: #7F7F7F;">
        Если вы не совершали никаких действий — просто удалите это письмо.
    </p>
</div>

</body>
</html>
