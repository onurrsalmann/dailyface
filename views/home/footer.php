<div class="col-3" style="height:100%;">
  <div class="search">
    <form action="views/home/search.php" method="GET" class="search-form">
        <button>
            <img class="search-icon" src="images/icon/search.png" alt="Search Button">
          </button>
          &nbsp; &nbsp; <input required type="text" name="search" style="background: none; border:none; font-size: 120%;color:black;" placeholder="Ara">
    </form>
  </div>
  <div class="profil">
    <?php $kadi = $_SESSION["kadi"]; $profil = new Profil();?>
    <div class="baslik" style="padding:3%;">
      <a style="font-size: 150%;">Profil</a>
    </div>
    <div class="profil-bilgi">
      <img class="profil-pp" src="fotograflar/pp/<?php echo $profil->ProfilVeriCek($kadi,'pp'); ?>">
      <a class="profil-bilgi-baslik">Ad: </a><a class="profil-bilgi-icerik"> <?php echo $profil->ProfilVeriCek($kadi,'adi'); ?></a></br>
      <a class="profil-bilgi-baslik">Kullanıcı Adı:</a><a class="profil-bilgi-icerik"> @<?php echo $profil->ProfilVeriCek($kadi,'kadi'); ?></a></br>
      <a class="profil-bilgi-baslik">E-posta:</a><a class="profil-bilgi-icerik"><?php echo $profil->ProfilVeriCek($kadi,'eposta'); ?></a>
    </div>
    <div class="profil-post">
      <?php $profil->Postlar($kadi,'','');?>
    </div>
    <div class="profil-ayarlar">
      <a href="?s=4">Profili Düzenle</a>
    </div>
  </div>
</div>
</div>
</div>
<script>
var slideIndex = <?php print $p ?>;
showDivs(slideIndex);
function plusDivs(n) {
var x = document.getElementsByClassName("post-comment");
var now = slideIndex +=n;
if (now > x.length) {now = 1}
if (now == 0) {now = x.length}
window.location = "index.php?p="+now;
showDivs(now);
}

function showDivs(n) {
var i;
var x = document.getElementsByClassName("post-comment");
if (n > x.length) {slideIndex = 1}
if (n < 1) {slideIndex = x.length}
for (i = 0; i < x.length; i++) {
  x[i].style.display = "none";
}
x[slideIndex-1].style.display = "block";

}
</script>
</body>
</html>
