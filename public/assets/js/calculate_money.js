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
    });

    let bmi_cal = (h, w) => {
        let rate = (w*10000/(h*h)).toFixed(2);

        let status = "<h2 class='text-danger fw-bold'>"+rate+" Thừa Cân</h2>";

        if(rate < 25) {
            status = "<h2 class='text-success fw-bold'>"+rate+" Khỏe mạnh</h2>";
        }

        if(rate < 18.5) {
            status = "<h2 class='text-danger fw-bold'>"+rate+" Thiếu Cân</h2>";
        }

        if(rate > 27) {
            status = "<h2 class='text-danger fw-bold'>"+rate+" Bạn là con heo :> <strong>Kêu éc éc đi!!!</strong></h2>";
        }

        return {
            rate: rate,
            status:status
        };
    }

    $('#bmi-height, #bmi-weight').keyup(function(){

        $('#result-bmi').html(bmi_cal($('#bmi-height').val(), $('#bmi-weight').val()).status)
    });

})