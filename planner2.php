
<!-- bootstrap-css -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="Bootstrap/js/bootstrap.min.js"></script>

<style>
    .planner {
        width: 100%;
    }
    tr.strip {
        height: 60px;
    }
    th {
        text-align: center;
    }
    th.van {
        width: 10%;
        color: red;
        border: 1px solid grey;
    }

    th.days {
        width: 2.5%;
        color: beige;
        border: 1px solid grey;
    }
    th.weekend {
        background-color: #e9ffff;
        border: 1px solid grey;
    }

</style>

<div class="container">
    <div class="row">
        <h1>Vehicle Planner</h1>
        <div class="date_picker">
            <button id="back"><<</button>
            <span id="date"></span>
            <button id="forward">>></button>

        </div>
    </div>
    <div class="row">
        <div id="calendar">

        </div>
    </div>
</div>



<script>

    function getCalendar(info) {

        $.ajax({
            url: 'planner_proc.php',
            method: 'post',
            dataType: 'json',
            data: {info: info},
            success: function (data) {
                $('#date').html(data.month+" "+data.year);
                $('#calendar').html(data.calendar);
                console.log(data.vehicles);

            }
        });
    }


var d = new Date();

var info = {month: d.getMonth()+1, year: d.getFullYear()};

getCalendar(info);


    $("#back").click(function(){
        info.month--;
        if (info.month<1) {
            info.month = 12;
            info.year--;
        }
        getCalendar(info);
    });

    $("#forward").click(function(){
        info.month++;
        if (info.month > 12) {
            info.month = 1;
            info.year ++;
        }
        getCalendar(info);
    });

</script>