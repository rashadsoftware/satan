<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, target-densitydpi=device-dpi, user-scalable=no" />
        <meta name="HandheldFriendly" content="true" />
        <title>Оплата</title>
        <style>

    
            @font-face { font-family: icon; src: url(/assets/MGM0001/fonts/icon.ttf); }
            body                        { background-color: #FFFFFF }
            table                       { font-family: Tahoma, Arial; font-size: 16dp; }
            form                        { padding: 20px }
            text                        { width: 100%; text-align: center; display: block; font-size: 12px; color: #333333; margin-bottom: 30px }
            a                           { color: #fffeff }
            label                       { display: block; margin: 25px 0px 5px 0px }
            input                       { width: 100%; height: 40px; border: 0px; border: 1px solid #626262; outline: none; font-size: 14pt; background: transparent; background-color: transparent; border-radius: 0px; -webkit-tap-highlight-color: rgba(0,0,0,0); border-radius: 5px; background-color: #f5f5f5; padding-left: 13px; font-family: Arial !important; }
            button                      { width: 100%; height: 45px; padding: 5px 9px; border: 0px; border-radius: 10px; outline: none; font-size: 12pt; box-shadow: #005071 0px 1px 0px 0px; background-color: #efb21b; color: #fffeff; margin-top: 50px; font-weight: bold }
            button:active               { box-shadow: inset #005071 0px 1px 0px 0px; background-color: #efb21b; }
            button[disabled]            { background-color: #999; color: #D6D6D6 }
            div.twin.l                  { width: 47%; float: left }
            div.twin.r                  { width: 47%; float: right }
            div.twin input              { width: 100% }
            div.expiry input:last-child { float: right }
            input.error                 { color: red }
            input#pan,
            input#exp,
            input#csc                   { font-family: monospace; text-align: justify }
            img                         { margin: 30px auto 20px; display: block; }
            i                           { font-family: icon; font-style: normal; margin-right: 3px; }

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

            function breakExpiry(exp) {
                var mm = exp.split('/')[0].trim();
                var yy = exp.split('/').length > 1 ? exp.split('/')[1].trim() : '';
                return [mm, yy];
            }

            function valid(element, valid) {
                element.prop('valid', valid);
            }

            function changeButtonStatus() {
                $('button').attr('disabled', true);
                var csc = $('input[name=csc]');
                if($('input#pan').prop('valid') && $('input#exp').prop('valid') && csc.val().length == csc.prop('maxlength')) {
                     $('button').attr('disabled', false);
                }
            }

            $(document).ready(function () {

                var pan = $('input#pan');
                var exp = $('input#exp');
                var csc = $('input#csc');

                pan.prop('valid', false);
                exp.prop('valid', false);
                csc.prop('valid', false);

                $('form').submit(function () {
                    $('input[name=pan]').val(
                        pan.val().replace(/ /g, '')
                        );
                    $('input[name=month]').val(
                        breakExpiry(exp.val())[0]
                        );
                    $('input[name=year]').val(
                        breakExpiry(exp.val())[1]
                        );
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
                $([pan, exp, csc]).each(function () {
                    $(this).keydown(function (e) {
                        if (!(ctrl && [67, 86, 88].indexOf(e.keyCode) > -1) && (e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && [8, 9, 35, 36, 37, 39, 46].indexOf(e.keyCode) < 0) {
                            e.preventDefault();
                        }
                    });
                });
                pan.keydown(function (e) {
                    var length = pan.val().length;
                    if(e.keyCode !== 8) {
                        if(length == 4 || length == 9 || length == 14) {
                            pan.val(pan.val() + ' ');
                        }
                    } else {
                        pan.removeClass('error');
                        valid(pan, false);
                        changeButtonStatus();
                        if(length == 6 || length == 11 || length == 16) {
                            pan.val(pan.val().substring(0, length - 1));
                        }
                    }
                }).keyup(function(e) {
                    var length = pan.val().length;
                    if(length == 19) {
                        if(!validate(pan.val().replace(/ /g, ''))) {
                            pan.addClass('error');
                            valid(pan, false);
                            changeButtonStatus();
                        } else {
                            pan.removeClass('error');
                            valid(pan, true);
                            changeButtonStatus();
                            exp.focus();
                        }
                    }
                });
                exp.keydown(function (e) {
                    var length = exp.val().length;
                    if(e.keyCode !== 8) {
                        if(!isNaN(exp.val()) && length == 2) {
                            exp.val(exp.val() + ' / ');
                        }
                    } else {
                        exp.removeClass('error');
                        valid(exp, false);
                        changeButtonStatus();
                        if(length == 6) {
                            exp.val(exp.val().substring(0, length - 3));
                        }
                    }
                }).keyup(function(e) {
                    var length = exp.val().length;
                    if(e.keyCode == 8 && (length == 0 || exp[0].selectionStart == 0)) {
                        pan.focus();
                    } else if(length == 7 && e.keyCode != 37 && e.keyCode != 39) {
                        var mm = breakExpiry(exp.val())[0];
                        var yy = breakExpiry(exp.val())[1];
                        valid(exp, true);
                        changeButtonStatus();
                        if (mm.length < 2 || !isNumeric(mm) || parseInt(mm) > 12 || parseInt(mm) < 1) {
                            exp.addClass('error');
                            valid(exp, false);
                            changeButtonStatus();
                        } else if (yy.length < 2 || !isNumeric(yy)) {
                            exp.addClass('error');
                            valid(exp, false);
                            changeButtonStatus();
                        } else if (new Date() > new Date(2000 + parseInt(yy), parseInt(mm), 0)) {
                            exp.addClass('error');
                            valid(exp, false);
                            changeButtonStatus();
                        } else {
                            csc.focus();
                        }
                    }
                });
                csc.keyup(function (e) {
                    var length = csc.val().length;
                    if(e.keyCode == 8 && length == 0) {
                        exp.focus();
                    }
                    changeButtonStatus();
                });
                $([pan, exp, csc]).each(function () {
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
            <tr height="300px">
                <td></td>
                <td valign="middle">
                    <form action="{url}" method="post" autocomplete="off">
                        <text>Для удобства и быстрых оплат карточные данные будут безопасно сохранены</text>
                        <label for="pan"><b>Номер карты</b></label>
                        <input type="tel" id="pan" placeholder="4242 4242 4242 4242" maxlength="19"/>
                        <div class="twin l">
                            <label for="exp"><b>Действ. до</b></label>
                            <input type="tel" id="exp" placeholder="MM / YY" maxlength="7"/>
                        </div>
                        <div class="twin r">
                            <label for="cvv"><b>CVV/CVV2</b></label>
                            <input type="tel" id="csc" name="csc" placeholder="***" maxlength="3"/>
                        </div>
                        <input type="hidden" name="id" value="{id}"/>
                        <input type="hidden" name="pan"/>
                        <input type="hidden" name="month"/>
                        <input type="hidden" name="year"/>
                        <input type="hidden" name="holder" value="Holder"/>
                        <button type="submit" disabled>Оплатить</button>
                        <img src="/assets/MGM0001/checkout.png" width="200"/>
                        <text><p><i></i> Безопасная оплата обеспечивается<br/><b>YIĞIM Payment System</b></p></text>
                    </form>
                </td>
                <td></td>
            </tr>
            <tr><td colspan="3"></tr>
        </table>
    </body>
</html>