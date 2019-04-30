<?php $kadi = $_SESSION["kadi"]; $profil = new Profil(); $notf = new Notf();?>
      <div class="col-8">
        <div class="posts">
          <br/>
          <h2>Bildirimler</h2></br>
          <?php $notf->NotfGoster(); ?>

        </div>
      </div>
