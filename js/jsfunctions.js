$(document).ready(function () {

    var selectedYear  = $("#select-year option:selected").val();
    var selectedMonth = $("#select-month option:selected").val();
    var selectedMonthName = $("#select-month option:selected").html();
    selectedDay   = 1;

    $(".date-day-p").click(function (event) {
        ClearStyle();

        if(this.id != 0) {
            selectedDay = this.id;

            $(".bottom-date-p").html(selectedYear+ ". " + selectedMonthName + " " + selectedDay + ".");
            $("#form-date").val(selectedYear+ "-" + selectedMonth + "-" + selectedDay);
        
            AddStyle();

            AjaxMsql(selectedDay, selectedMonth, selectedYear);
        }
    });

    $("#add-meeting").click(function (event) {
        if($("#bottom-actual-dat-disabled").html() == "Válassz egy dátumot") {
            alert("Előbb válassz egy dátumot, csak utána tudsz eseményt hozzáadni!");
        }
        else {
            $("#bottom-form-disabled").hide();
            $("#bottom-form-enabled").show(); 
        }
        
    });

    $("#close-meeting").click(function (event) {
        $("#bottom-form-enabled").hide();
        $("#bottom-form-disabled").show();
    });

    $(document).on("click", ".today-button-delete", function(e) {
        event.preventDefault();
        if (confirm("Biztosan törölni akarod a bejegyzést?")) {
            id = $(this).parent().attr("id"),
            div = $(this).parent().parent().parent().parent().remove();
            $.post("delete.php", {id: id}, function (event) {
                ClearNotif();
                GetNotif(selectedMonth, selectedYear);
            });
        }
        else {}
    });

    GetNotif(selectedMonth, selectedYear);  //a bal felső számok megjelenítése, ha van esemény a hónapban

});


function ClearStyle() {
    $(".date-day-p").removeClass("selected");
}

function AddStyle() {
        $("#" + selectedDay).addClass("selected");
}


function AjaxMsql (id, month, year) {
    if (id == "") {
        $("#today-lists").html = "";
    }
    else {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4  && this.status == 200) {
                $("#today-lists").html(this.responseText);
            }
        };

        xmlhttp.open("GET","getmeeting.php?id="+id+"&year="+year+"&month="+month, true);
        xmlhttp.send();
    }
}

function GetNotif(month, year) {
    var date = {
        "year" : year,
        "month": month
    };

    date = $.param(date);

        /*var xmlhttp = new XMLHttpRequest();

        xmlhttp.open("POST","getnotif.php", true);
        xmlhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4  && this.status == 200) {
                alert(date);
            }
        };

        xmlhttp.send(date);*/

    $.ajax({
        type: "POST",
        datatype: "json",
        url: "getnotif.php",
        data: date,
        success: function (data) {
            var json = JSON.parse(data);
            if (json) {
                for ( i = 0; i < 31; i++) {
                    if (json[i] != 0) {
                        var dateid = i+1;
                        var divhez = "<div class='active-self show-elements'><span class='active-self-numb'>" + json[i] + "</span></div>";
                        var liparent = $("#" + dateid).parent();
                        liparent.append(divhez);
                    }
                }
            }
        }
    });
}

function ClearNotif() {
    $(".active-self").remove();
}

function GetNotifId(event) {
    form = event.parent();
    $.post("delete.php", form.serialize(), function (data) {
        $("#asd").html(data);
    });
}
