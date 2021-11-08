<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>E-Commerce / {merchant} üçün ödəniş</title>
        <style>
		
		    @font-face { font-family: icon; src: url(/assets/MGM0001/fonts/icon.ttf); }
            body     { background-color: #F1F1F1 }
            div.logo { margin-bottom: 20px; text-align: center }
            table    { font-family: Tahoma, Arial; font-size: 14px; }
            form     { background-color: #FFFFFF; border: 1px solid #CCCCCC; padding: 50px; border-radius: 10px; padding-top: 5px; padding-bottom: 5px; }
			text     { width: 100%; text-align: center; display: block; font-size: 12px; color: #333333; margin-bottom: 30px }
            hr       { border: 0px; border-top: 1px dashed #8c8b8b; margin: 20px 0px; }
            label    { display: block; margin: 10px 0px; }
            input    { width: 300px; height: 35px; padding: 5px 9px; border: 1px solid #999999; border-radius: 5px; outline: none }
            button   { width: 300px; height: 45px; padding: 5px 9px; border: 0px; border-radius: 100px; outline: none; font-size: 18px; box-shadow: #005071 0px 1px 0px 0px; background-color: #efb21b; color: white }
            button:active               { box-shadow: inset #005071 0px 1px 0px 0px; background-color: #efb21b; }
            div.expiry                  { width: 300px }
            div.expiry input            { width: 145px }
            div.expiry input:last-child { float: right }
            input.error                 { background-color: #ffd3d3 }
			input#pan,
            input#exp,
            input#csc                   { font-family: monospace; text-align: justify }
            img                         { margin: 40px auto 30px; display: block }
            i                           { font-family: icon; font-style: normal; margin-right: 3px; )			 
		 </style>
        <script language="javascript" type="text/javascript" src="/assets/MGM0001/js/jquery.js"></script>
        <script language="javascript" type="text/javascript">

            function validate(value) {
                var sum = 0,
                    alt = false,
                    i = value.length - 1,
                    num;
                if (value.length < 13 || value.length > 19) {
                    return false;
                }
                while (i >= 0) {
                    num = parseInt(value.charAt(i), 10);
                    if (isNaN(num)) {
                        return false;
                    }
                    if (alt) {
                        num *= 2;
                        if (num > 9) {
                            num = (num % 10) + 1;
                        }
                    }
                    alt = !alt;
                    sum += num;
                    i--;
                }
                return (sum % 10 === 0);
            }

            function isNumeric(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            }

            $(document).ready(function () {

                var pan =   $('input[name=pan]');
                var month = $('input[name=month]');
                var year =  $('input[name=year]');
                var csc =   $('input[name=csc]');

                $('form').submit(function () {
                    $([pan, month, year, csc]).each(function () {
                        $(this).removeClass('error');
                    });
                    if (pan.val().length < 16 || !validate(pan.val())) {
                        pan.addClass('error').focus();
                        return false;
                    }
                    if (month.val().length < 2
                            || !isNumeric(month.val())
                            || parseInt(month.val()) > 12
                            || parseInt(month.val()) < 1
                            ) {
                        month.addClass('error').focus();
                        return false;
                    }
                    if (year.val().length < 2 || !isNumeric(year.val())) {
                        year.addClass('error').focus();
                        return false;
                    }
                    if (new Date() > new Date(2000 + parseInt(year.val()), parseInt(month.val()), 0)) {
                        month.addClass('error').focus();
                        year.addClass('error');
                        return false;
                    }
                    if (csc.val().length < 3 || !isNumeric(csc.val())) {
                        csc.addClass('error').focus();
                        return false;
                    }
                    $('button').attr('disabled', true);
                });

                var ctrl = false;

                $(document).keydown(function(e) {
                    switch (e.keyCode) {
                        case 17:
                        case 91:
                            ctrl = true;
                            break;
                    }
                }).keyup(function(e) {
                    switch (e.keyCode) {
                        case 17:
                        case 91:
                            ctrl = false;
                            break;
                    }
                });
                $([pan, month, year, csc]).each(function () {
                    $(this).keydown(function (e) {
                        if (!(ctrl && [67, 86, 88].indexOf(e.keyCode) > -1) && (e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && [8, 9, 35, 36, 37, 39, 46].indexOf(e.keyCode) < 0) {
                            e.preventDefault();
                        }
                    });
                });
                $([pan, month, year, csc]).each(function () {
                    var element = $(this);
                    element.bind('paste', function (e) {
                        e.stopPropagation(); e.preventDefault();
                        var data = e.originalEvent.clipboardData.getData('Text');
                        if(!isNaN(data)) {
                            element.val((element.val() + data).substring(
                                    0,
                                    element.attr('maxlength') || data.length
                                    )
                                    );
                        }
                    });
                });
            });

        </script>

    </head>
    <body>
        <table width="100%" height="100%" border="0">
            <tr>
                <td></td>
                <td width="300" valign="middle" >
                    <form action="{url}" method="post" autocomplete="off">
                        <div class="logo"><img src="/assets/MGM0001/logo.png" width="" height="64"/></div>
                        <label><b>Məbləğ:</b> {amount} {currency}</label>
                        <label><b>Təsvir:</b> {description}</label>
                        <hr/>
                        <label for="pan"><b>Kart nömrəsi</b></label>
                        <input type="text" id="pan" name="pan" maxlength="16"/>
                        <div class="expiry">
                            <label for="month"><b>Bitmə tarixi</b></label>
                            <input type="tel" name="month" placeholder="MM" maxlength="2"/>
                            <input type="tel" name="year" placeholder="YY" maxlength="2"/>
                        </div>
                        <label for="cvv"><b>CVV/CVV2</b></label>
                        <input type="password" name="csc" maxlength="4"/>
                        <br/>
                        <br/>
                        <br/>
                        <input type="hidden" name="id" value="{id}"/>
                        <input type="hidden" name="holder" value="Holder"/>
                        <button type="submit">Ödəniş</button>
						<img src="/assets/MGM0001/checkout.png" width="300"/>
                        <text><p><i></i> Təhlükəsiz ödəniş <b>YIĞIM Payment System</b> tərəfindən təmin olunur</p></text>															 
                    </form>	
                </td>
                <td></td>
            </tr>
        </table>
    </body>
</html>