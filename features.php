<?php $sideTitlen = 'KilometerJournalen i PHP'; 
 include('bootstrap.php');?>
    <main class="page">
        <section class="clean-block features">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info" style="letter-spacing:0px;"><a href="https://bootstrapstudio.io/app/features.html"><strong>KILOMETER LISTE</strong></a><br></h2>
                    <p>Her er et overblik over alle instastede kørseler</p>
                </div>
                <div>
                    <div class="table-responsive">
                        <div id="printableArea">
                                <table class="table">
                                    <?php $table->createTable($db->getDataToSql());
                                    if($db->getDataToSql()){
                                    echo $table->getTable();
                                }else{
                                echo '<p style="text-align:center;">Data Kommer Snart</p>';}
                                ?>
                                </table>
                        </div>
                        <?php if($db->getDataToSql()){ ?>
    <button class="btn btn-primary" type="button" onclick="printDiv('printableArea')" ><img src="printer.svg"/></button>
    <div>Icons made by <a href="https://www.flaticon.com/authors/simpleicon" title="Printer">Printer</a> from <a href="https://www.flaticon.com/"     title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/"     title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
    <script>
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
    }</script><?php } ?>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
  <?php include('views/footer.php'); ?>