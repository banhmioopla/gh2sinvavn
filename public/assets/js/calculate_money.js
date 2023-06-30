$(document).ready(function(){
    let addCommas = (nStr) =>
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    let numHasValue = (num) => {
        return num && $.isNumeric(num);
    }

    $('.money-counter').keyup(function () {
        let sum = 0;
        let valid = true;
        let result = $('#result');

        $('.money-counter').each(function() {

            let count = $(this).val().length ? $(this).val() : 0;
            console.log('-- count', count);
            console.log('-- numHasValue', numHasValue(count));
            if( $(this).val().length && !numHasValue(count)){
                valid = false;
                return false;
            }
            sum += count * $(this).data('deno');
        });

        if(valid === false){
            result.html(`<span class="text-danger">Vui lòng chỉ nhập số</span>`);
            return;
        }

        result.text(addCommas(sum));
    })
})