<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>E-Commerce / 3-D Secure təsdiqi üçün keçid</title>
        <style>
            body     { background-color: #F1F1F1 }
            div.logo { margin-bottom: 20px; text-align: center }
            table    { font-family: Tahoma, Arial; font-size: 14px; }
            form     { background-color: #FFFFFF; border: 1px solid #CCCCCC; padding: 50px; border-radius: 10px; text-align: center; }
            h1       { font-size: 18px; color: #0cd80c; font-weight: normal; text-align: center }
            hr       { border: 0px; border-top: 1px dashed #8c8b8b; margin: 20px 0px; }
            label    { display: block; margin: 10px 0px; }
            input    { width: 300px; height: 35px; padding: 5px 9px; border: 1px solid #999999; border-radius: 5px; outline: none }
            button   { width: 300px; height: 45px; padding: 5px 9px; border: 0px; border-radius: 100px; outline: none; font-size: 18px; box-shadow: #005071 0px 1px 0px 0px; background-color: #efb21b; color: white }
            button:active               { box-shadow: inset #005071 0px 1px 0px 0px; background-color: #efb21b; }
            button[type=cancel]         { color: #000000; background-color: #F1F1F1 }
            div.expiry                  { width: 300px }
            div.expiry input            { width: 145px }
            div.expiry input:last-child { float: right }
        </style>
        <script language="javascript" type="text/javascript" src="/assets/MGM0001/js/jquery.js"></script>
        <script language="javascript" type="text/javascript">

            $(document).ready(function () {
                $('button[type=cancel]').click(function () {
                    window.history.back();
                    return false;
                });
                var timeout = 9;
                var tmp = setInterval(function() {
                    if(timeout > 0) {
                        $('#countdown b').text(timeout + ' s.');
                        timeout--;
                    } else {
                        clearInterval(tmp);
                        $('form').submit();
                    }
                }, 1000);
            });

        </script>
    </head>
    <body>
        <table width="100%" height="100%" border="0">
            <tr>
                <td></td>
                <td width="300" valign="middle" >
                    <form action="{url}" method="post">
                        <div class="logo"><img src="/assets/MGM0001/logo.png" width="" height="64"/></div>
                        <h1>3-D Secure təsdiqi üçün keçid</h1>
                        <hr>
                        Daxil etdiyiniz kart məlumatları təsdiqi üçün bankınızın səhifəsinə keçid icra olunacaq
                        <label id="countdown"><b>9 s.</b></label>
                        <br/>
                        <input type="hidden" name="PaReq" value="{pareq}"/>
                        <input type="hidden" name="TermUrl" value="{returnURL}"/>
                        <button type="submit">Davam et</button>
                        <br/><br/>
                        <button type="cancel">Imtina</button>
                    </form>	
                </td>
                <td></td>
            </tr>
        </table>
    </body>
</html>