<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>E-Commerce / Оплата в пользу {merchant}</title>
        <style>
            body     { background-color: #F1F1F1 }
            div.logo { margin-bottom: 20px; text-align: center }
            table    { font-family: Tahoma, Arial; font-size: 14px; }
            form     { background-color: #FFFFFF; border: 1px solid #CCCCCC; padding: 50px; border-radius: 10px; }
            h1       { font-size: 18px; color: #0cd80c; font-weight: normal; text-align: center }
            hr       { border: 0px; border-top: 1px dashed #8c8b8b; margin: 20px 0px; }
            label    { display: block; margin: 7px 0px; }
            input    { width: 300px; height: 35px; padding: 5px 9px; border: 1px solid #999999; border-radius: 5px; outline: none }
            button   { width: 300px; height: 45px; padding: 5px 9px; border: 0px; border-radius: 100px; outline: none; font-size: 18px; box-shadow: #005071 0px 1px 0px 0px; background-color: #efb21b; color: white }
            button:active               { box-shadow: inset #005071 0px 1px 0px 0px; background-color: #efb21b; }
            div.expiry                  { width: 300px }
            div.expiry input            { width: 145px }
            div.expiry input:last-child { float: right }
        </style>
        <script language="javascript">

        </script>

    </head>
    <body>
        <table width="100%" height="100%" border="0">
            <tr>
                <td></td>
                <td width="300" valign="middle" >
                    <form action="{url}" method="get">
                        <div class="logo"><img src="/assets/MGM0001/logo.png" width="" height="64"/></div>
                        <h1>Оплата прошла успешно!</h1>
                        <hr>
                        <label><b>Номер карты:</b> {pan}</label>
                        <label><b>Сумма:</b> {amount} {currency}</label>
                        <label><b>Комиссия:</b> {surcharge} {currency}</label>
                        <label><b>Описание:</b> {description}</label>
                        <label><b>Номер заказа:</b> {reference}</label>
                        <label><b>Номер транзакции:</b> {id}</label>
                        <label><b>RRN:</b> {rrn}</label>
                        <label><b>Код подтверждения банка:</b> {approval}</label>
                        <label><b>Дата платежа:</b> {datetime}</label>
                        <br/>
                        <br/>
                        <button type="submit">Вернуться к {merchant}</button>
                    </form>	
                </td>
                <td></td>
            </tr>
        </table>
    </body>
</html>