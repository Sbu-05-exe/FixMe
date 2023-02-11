<script src="https://www.gstatic.com/charts/loader.js"></script>
<script> google.charts.load('current', 
    { packages: ['corechart']
    });
google.charts.setOnLoadCallback(drawDonutChart);
google.charts.setOnLoadCallback(drawPartsOrdered);
google.charts.setOnLoadCallback(drawMonthlyTurnover);
//parts - num - total value
//salary info
//avg turnover rate by device type



function drawDonutChart() {
    //pie chart of most popular device types
        <?php
            require_once("config.php");
            $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                        
            $query = "select count(category) AS number, category
                    from ctrls.devices
                    group by category";
                       
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                   
            echo "var data = google.visualization.arrayToDataTable([";
            echo "['Device category','Percent'],";

            while ($row = mysqli_fetch_array($result)){
                echo "['{$row['category']}',{$row['number']}],";
            }
            echo "]);";
            //mysqli_close($conn);
        ?>

    //set options 
    var options = {
        title: '',
        title: 'Distribution of decive type',
        //pieHole: 0.4,
        /*slices: {
            0: {color: '#0bb035'},
            1: {color: '#0ee067'},
            2: {color: '#47f473'}
        }*/
    };

    //draw
    var chart = new google.visualization.PieChart(document.getElementById('myChart'));
    chart.draw(data, options);
}

function drawPartsOrdered() {
//breakdown of parts ordered
        <?php
            $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                        
            $query = "select Type,sum(price) as Total
                    from ctrls.parts
                    group by type;";
                       
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                   
            echo "var data = google.visualization.arrayToDataTable([";
            echo "['Device category','Percent'],";

            while ($row = mysqli_fetch_array($result)){
                echo "['{$row['Type']}',{$row['Total']}],";
            }
            echo "]);";
            mysqli_close($conn);
        ?>
    //set options 
    var options = {
        title: 'Total Cost by Part',
        //pieHole: 0.45,
        /*slices: {
            0: {color: '#0bb035'},
            1: {color: '#0ee044'},
            2: {color: '#47f473'}
        }*/
    };

    //draw
    var chart = new google.visualization.PieChart(document.getElementById('ourChart'));
    chart.draw(data, options);
}

function drawMonthlyTurnover(){
            <?php
            $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Could not connect to database");
                        
            $query = "select date_format(date, '%M') as month, 
                       sum(inspectionFee + repairFee) as total from ctrls.repairjobs
                       group by date_format(date, '%M')
                       order by extract(month from date)ASC ;";
                       
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                   
            echo "var data = google.visualization.arrayToDataTable([";
            echo "['Device category','Percent'],";

            while ($row = mysqli_fetch_array($result)){
                echo "['{$row['month']}',{$row['total']}],";
            }
            echo "]);";
            mysqli_close($conn);
        ?>

        var options = {
            title: 'Turnover by Month',
            width: 900,
            height: 400,
            legend: {position: "none"},
        }
    var chart = new google.visualization.ColumnChart(document.getElementById("monthlyTurnOver"));
    chart.draw(data,options);
}

</script>