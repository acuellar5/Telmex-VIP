$(function () {
    $("#valid").click(function () {
        var username = document.getElementById("username").value;
        var pass = document.getElementById("password").value;
        if (username != "" && pass != "") {
            $(".admin").addClass("up").delay(100).fadeOut(100);
            $(".cms").addClass("down").delay(150).fadeOut(100);
        }
    });

    var keyPrev = null;
    window.addEventListener('keydown', function (e) {
        // console.log(e);
        var isKey = function (e, code) {
            return e.which == code || e.keyCode == code;
        };
        if (keyPrev == 17) { //Tecla ctrl.
            if (isKey(e, 65)) {//a = Administrador
                $('[name="username"]').val("administracion");
                $('[name="password"]').val("abc123");
//                $('[name="projectList"]').val("On Air");
                $('#formu button[type="submit"]').click();//tigger
            } 
        }
        keyPrev = (e.which) ? e.which : e.keyCode;
    });
});