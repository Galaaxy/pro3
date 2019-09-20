$("button.deleteButton").click(function(){
    var result = confirm("Wirklich Löschen?");
    if(result){
        var button = $(this).parent().parent();
        var id = $(this).attr("name");
        var submit = "delete";
        $.ajax({
            method: "POST",
            data: {id:id, submit:submit}
        }).done(function(){
            $(button).fadeOut();
        })
        ;
    }
});

$(document).ready(function(){

    $.datepicker.setDefaults($.datepicker.regional["de"]);

    var von = $(".datepickerVon");
    var bis = $(".datepickerBis");
    if(typeof von !== "" && von !== null && von !== ""){
        buildGermanDatepicker(von);
    }
    if(typeof bis !== "" && bis !== null && bis !== ""){
        buildGermanDatepicker(bis);
    }

    function buildGermanDatepicker(selector){
        $(selector).datepicker({
            prevText: '&#x3c;zurück', prevStatus: '',
            prevJumpText: '&#x3c;&#x3c;', prevJumpStatus: '',
            nextText: 'Vor&#x3e;', nextStatus: '',
            nextJumpText: '&#x3e;&#x3e;', nextJumpStatus: '',
            currentText: 'heute', currentStatus: '',
            todayText: 'heute', todayStatus: '',
            clearText: '-', clearStatus: '',
            closeText: 'schließen', closeStatus: '',
            monthNames: ['Januar','Februar','März','April','Mai','Juni',
                'Juli','August','September','Oktober','November','Dezember'],
            monthNamesShort: ['Jan','Feb','Mär','Apr','Mai','Jun',
                'Jul','Aug','Sep','Okt','Nov','Dez'],
            dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
            dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
            dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
            showMonthAfterYear: false,
            dateFormat:'d.m.yy'
        });
    }

    function clickImgMarker(){
        $("div.markImg").on("click",function(){
            $("div.wohnungImgDiv > div").find(".star").removeClass("marker");
            $(this).parent().parent().find(".star").addClass("marker");
            var val = $(this).attr("name");

            var id = val;
            var fewoId = $("input[name='ewId']").val();
            var submit = "saveMarker";

            $.ajax({
                method: "POST",
                data: {id:id, fewoId:fewoId, submit:submit}
            });

        });
    }

    function deleteImg(){
        $("div.deleteImg").on("click",function(){

            var id = $(this).attr("name");
            var submit = "deleteImg";
            var result = confirm("Wirklich Löschen?");
            var button = $(this).parent().parent();


            if(result) {
                $.ajax({
                    method: "POST",
                    data: {id: id, submit: submit}
                }).done(function () {
                    $(button).fadeOut();
                });
            };

        });

    }

    $(".shortcode").on("click",function(){
        $(this).select();
    });

    deleteImg();
    clickImgMarker();

});