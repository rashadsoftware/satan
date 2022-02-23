
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

function valid(element, valid) {
    element.prop('valid', valid);
}

$(document).ready(function () {

    var pan =   $('input[name=pan]');
    var month = $('input[name=month]');
    var year =  $('input[name=year]');
    var csc =   $('input[name=csc]');
    var yearFrom = parseInt((new Date()).getFullYear().toString().replace(/^../, ''));

    $('form').submit(function () {
        $('input[name=pan]').val(
            pan.val().replace(/ /g, '')
        );

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

    pan.keydown(function (e) {
        var length = pan.val().length;
        if(e.keyCode !== 8) {
            if(length == 4 || length == 9 || length == 14) {
                pan.val(pan.val() + ' ');
            }
        } else {
            pan.removeClass('error');
            valid(pan, false);
            if(length == 6 || length == 11 || length == 16) {
                pan.val(pan.val().substring(0, length - 1));
            }
        }
    }).keyup(function(e) {
        var length = pan.val().length;
        pan.removeClass('visa');
        pan.removeClass('master');
        if(pan.val()[0] == 4){
            pan.addClass('visa')
        }else if(pan.val()[0] == 5){
            pan.addClass('master')
        }



        if(length == 19) {
            if(!validate(pan.val().replace(/ /g, ''))) {
                pan.addClass('error');
                valid(pan, false);
            } else {
                pan.removeClass('error');
                valid(pan, true);
                exp.focus();
            }
        }
    });

    $([pan, month, year, csc]).each(function () {
        $(this).keydown(function (e) {
            if (!(ctrl && [67, 86, 88].indexOf(e.keyCode) > -1) && (e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && [8, 9, 35, 36, 37, 39, 46].indexOf(e.keyCode) < 0) {
                e.preventDefault();
            }
        });
    });

    month.on('input', e=>{
        if($(e.target).val().length == 2){
            year.focus()
        }
    })

    year.on('input', e=>{
        let target = e.target;
        let val = parseInt(target.value);
        if(val < yearFrom){
            valid($(target), false);
            $(target).addClass('error');
        }else if($(e.target).val().length == 2){
            valid($(target), true);
            $(target).removeClass('error');
            csc.focus()
        }
    })

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
