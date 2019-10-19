$(document).ready(function () {
    $(document).on("click", ".sp_button", function () {
        spoyler(this);
    });
});

function spoyler(obj) {
    var spoil = $(obj).parent().parent(".spoil");
    var he = spoil.find(".sp_text").innerHeight() + 60;

    if (spoil.height() == 24) {
        $(obj).text("Свернуть");
        spoil.stop(true).animate({ height: he + "px" }, 200);
    } else {
        $(obj).text("Развернуть");
        spoil.stop(true).animate({ height: 24 + "px" }, 200);
    }

}