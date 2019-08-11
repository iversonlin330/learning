$(".teacher_login").hide();
$("#teacher_login").click(function () {
    $(".student_login").fadeOut(100);
    $(".teacher_login").delay(100).fadeIn(100);
    $("#student_login").removeClass("active");
    $("#teacher_login").addClass("active");
});
$("#student_login").click(function () {
    $(".student_login").delay(100).fadeIn(100);;
    $(".teacher_login").fadeOut(100);
    $("#student_login").addClass("active");
    $("#teacher_login").removeClass("active");
});