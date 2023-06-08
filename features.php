<?php
$sideTitlen = 'KilometerJournalen i PHP'; 
 require "bootstrap.php"; ?>
    <main class="page">
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="letter-spacing:0px;">
                        <a href="https://bootstrapstudio.io/app/features.html"><strong>KILOMETER LISTE</strong></a>
                        <br></h2>
                    <p>Her er et overblik over alle instastede kørseler</p>
                </div>
                <div>
                    <div class="table-responsive">
                    <div id="printableArea">
                        <!-- table will be dynamically inserted here -->
                    </div>
   <script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
    }</script>
                        
                    </div>
                </div>
        <canvas id="myChart"></canvas>
            </div>
        </section>
    </main>
  <?php require('views/footer.php'); ?>