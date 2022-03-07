<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, target-densitydpi=device-dpi, user-scalable=no" />
        <meta name="HandheldFriendly" content="true" />
        <title>Оплата</title>
        <style>

            body             { background-color: #FFFFFF }
            table            { font-family: Tahoma, Arial; font-size: 16dp; }
            form             { padding: 20px }
            button           { width: 100%; height: 45px; padding: 5px 9px; border: 0px; border-radius: 10px; outline: none; font-size: 12pt; box-shadow: #005071 0px 1px 0px 0px; background-color: #efb21b; color: #fff5f9; font-weight: bold }
            button:active    { box-shadow: inset #005071 0px 1px 0px 0px; background-color: #efb21b; }
            button[disabled] { background-color: #AFAFAF; color: #D6D6D6 }
            text             { width: 100%; text-align: center; display: block; font-size: 14px; color: #333333; margin-bottom: 40px }
            text h1          { font-size: 18pt; font-weight: normal; margin-bottom: 30px }
            img              { margin: 30px auto 50px; display: block; opacity: 1 }

        </style>
        <script language="javascript" type="text/javascript" src="/assets/MGM0001/js/jquery.js"></script>
        <script language="javascript" type="text/javascript">

            $(document).ready(function () {});

        </script>

    </head>
    <body>
        <table width="100%" height="100%" border="0">
            <tr height="300px">
                <td></td>
                <td valign="middle">
                    <form action="{url}" method="post" autocomplete="off">
                        <img src="/assets/MGM0001/sad.svg"" width="90" height="90"/>
                        <text>
                            <h1>Карта не добавлена</h1>
                            <p>Код ошибки: <b>10</b><br />Описание: <b>Неизвестная ошибка</b></p>
                            <p>Пожалуйста, вернитесь (или закройте окно) и попробуйте снова</p>
                        </text>
                        <button type="submit" onclick="window.location = this.form.action; return false">Вернуться назад</button>
                    </form>
                </td>
                <td></td>
            </tr>
            <tr><td colspan="3"></tr>
        </table>
    </body>
</html>