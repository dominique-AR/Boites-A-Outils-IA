<style>
      .agetipa_color {
            background-color: #009245;
            font-weight: bold;
        }
</style>

<footer class="agetipa_color p-3 mt-5">
    <div class="row text-light">
        <div class="col-12 col-xl-8 me-auto ms-2">
            <p><strong>Siège social et bureaux</strong> : Immeuble Le Colisée - 2ème étage LOT II W 26 X Ampasanimalo-
                ANTANANARIVO 101</p>
            <p><strong>B.P.</strong> : 8590</p>
            <p><strong>Tél.</strong> : + 261 20 76 336 12 - 76 206 96 - 76 330 84</p>
            <p><strong>E-mail</strong> : agetipa@gmail.com</p>
            <p><strong>Site</strong> : http://www.agetipa.mg</p>
        </div>
        <div class="col-12 col-xl d-flex justify-content-center ">
            <img src="assets/images/apave.jpg" id="logo" alt="">
        </div>
    </div>
</footer>
<script>
    
//ajout bg
document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) { // Modifiez "50" par la valeur de défilement souhaitée
            document.querySelector('header').classList.add('header-bg-white', 'shadow');
        } else {
            document.querySelector('header').classList.remove('header-bg-white', 'shadow');
        }
    });
});

</script>

<!-- Ou Option 2: Bootstrap et Popper séparément -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  </body>
</html>