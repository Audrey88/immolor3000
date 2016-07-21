

<!-- fin du container déclaré dans header.php -->
</div>

<div class="panel-footer">
    <div class="row-fluid">
        <div class="span12">
            <div class="span2" style="width: 15%;">
                <ul class="unstyled">
                    plan du site:
                    <li><a href="index.php">accueil</a></li>
                    <li><a href="list.php">Nos offres</a></li>
                    <li><a href="add.php">Déposer une annonce</a></li>
                </ul>
            </div>
        </div>
        <p class="muted pull-right"><small>Simplon Epinal - Copyleft 2016</small></p>
    </div>
    </div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    $(function () {
        $("[data-href]").on('click',function(){
            document.location = $(this).data('href');
        })
    })
</script>
</body>
</html>
<?php
mysqli_close($bdd);