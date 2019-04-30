
      <div class="col-8">
        <div class="foto-ekleme-kismi">
          <br/>
          <h2>Profil Düzenle</h2></br>
          <form action="core/controller/profil-duzenle.php" method="POST" enctype="multipart/form-data" class="foto-form">
              <a id="file-name">Yeni Profil Resmi(isteğe bağlı): </a><input type="file" name="pp">
              <input class="form-input" type="text" placeholder="Yeni adınız:" name="ad"><br/>
              <input class="form-input" type="text" placeholder="Yeni kullanıcı adınız(isteğe bağlı)" name="kad"><br/>
              <input class="form-input" type="text" placeholder="Yeni şifreniz(isteğe bağlı)" name="sif"><br/>
              <input class="form-input" type="text" placeholder="Yeni epostanız(isteğe bağlı)" name="eposta"><br/>
              <input name="fotosubmit" class="form-button" type="submit" value="Güncelle">
          </form>
        </div>
      </div>
