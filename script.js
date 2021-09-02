jQuery(function ($) {
    function getRegion(val) {
        $.ajax({
            type: "POST",
            url: "addOscar.php",
            data: 'codeUt=' + val,
            success: function (data) {
                $("#region").html(data);
            }
        });
    }

    $('#service').on('change', function () {
        if (this.value == 'READ      ' || this.value == 'CDG       ') {
            $('#dut').prop('disabled', true);
            $('#region').prop('disabled', true);
        } else if (this.value == 'DR        ') {
            $('#dut').prop('disabled', false);
            $('#region').prop('disabled', true);
        } else {
            $('#dut').prop('disabled', false);
            $('#region').prop('disabled', false);
        }
    });
});