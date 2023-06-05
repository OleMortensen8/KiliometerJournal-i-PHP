<?php $sideTitlen = 'KiliometerJournalen i PHP';
 include('bootstrap.php'); ?>
    <main class="page landing-page">
        <section class="clean-block clean-hero" style="background-image:url(&quot;assets/img/tech/image4.jpg&quot;);color:rgba(9, 162, 255, 0.85);">
            <div class="text">
                <h2>Kiliometer Log</h2>
                <p>Intast dine Initialer og Kilometer tal her. Dine samlede Kilometer tal og data kan ses på listen</p>
                <form action="" method="POST">
                <label>Initialer</label><input class="form-control" name="ini" type="text">
                <label>Km - Start</label><input class="form-control" name="kmStart" type="text">
                <label>Km - Stop</label><input class="form-control" name="kmStop" type="text">
                <button class="btn btn-primary" type="submit" name="submit" style="margin-top:25px;padding-top:10px;padding-right:10px;margin-right:251px;padding-bottom:6px;padding-left:10px;background-color:rgb(0,25,255);">Submit</button></form>
            </div>
        </section>
    </main>
    <?php include('views/footer.php'); ?>