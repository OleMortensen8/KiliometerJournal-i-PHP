</div>
<footer class="page-footer dark">
        <div class="footer-copyright" style="margin-top:2px;">
            <p style="height:24px;margin-top:10px;">© <?php echo  date('Y', strtotime('Now'));  ?> Copyright</p>
        </div>
    </footer>

<!-- Include jQuery library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Then load bootstrap bundle -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>

<!-- Load the Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Then, your own scripts -->
<script src="assets/js/script.min.js"></script>

<!-- Custom JavaScript/jQuery code -->
<script>
$(document).ready(function() {
    refreshTable();
    setInterval(refreshTable, 5000); // refresh table every 5 seconds
});

function refreshTable() {
    $.get("fetch_table_data.php", function(data) {
        $("#printableArea").html(data);
    });
}
</script>
<script>
$(document).ready(function() {
    $.getJSON("data.php", function(result){
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: result.labels,
                datasets: [{
                    label: 'Samlede antal',
                    data: result.data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // color of the fill (under the line)
                    borderColor: 'rgba(75, 192, 192, 1)', // color of the line
                    borderWidth: 1 // thickness of the line
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
});
</script>

</body>
</html>
