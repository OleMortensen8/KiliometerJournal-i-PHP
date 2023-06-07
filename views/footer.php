</div>
<footer class="page-footer dark">
        <div class="footer-copyright" style="margin-top:2px;">
            <p style="height:24px;margin-top:10px;">© <?php echo  date('Y', strtotime('Now'));  ?> Copyright</p>
        </div>
    </footer>
    <script>
 window.onload = function() {
    var labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
    var data = [10, 20, 30, 40, 50, 60, 70];

    if (labels.length === 0 || data.length === 0) {
        console.log("No data available for chart");
    } else {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Monthly Sales',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
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
    }
}
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>