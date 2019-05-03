<div id="uyegoster-div">
  <img style="width:20%;"src="image/logom.png">
  <h1 style="font-family:Arial;">Üyeler</h1>
  <div id="uye-tablo">
    <table border="1" bordercolor="#b40ef0" style="margin:auto;" cellpadding="5">
          <colgroup>
              <col style="background-color:white">
              <col style="background-color:white">
              <col style="background-color:white">
              <col style="background-color:white">
          </colgroup>
          <thead>
              <tr>
                  <th>Eposta</th>
                  <th>Kullanıcı Adı</th>
                  <th>Adı</th>
                  <th>Kayıt Tarihi</th>
              </tr>
          </thead>
          <tbody>
            <?php  $cek= new Users(); $cek->userListele(); ?>
          </tbody>
      </table>
  </div></br>
  <div class="home-button">
    <a href="index.php" class="home-button-text">Geri Dön</a>
  </div>
</div>
