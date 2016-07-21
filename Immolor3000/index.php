<?php
$page_title = "Accueil";

include 'header.php';

// page d'accueil
?>
    <div>
        <div>
            <img id="Image-Maps-Com-image-maps-2016-07-19-032353"
                 src="http://www.image-maps.com/m/private/70027/77756-l16bj8g879c2lt2h7ojnih0q45_grand-est.jpg"
                 border="0" width="540" height="394" orgWidth="540" orgHeight="394"
                 usemap="#image-maps-2016-07-19-032353" alt=""/>
            <map name="image-maps-2016-07-19-032353" id="ImageMapsCom-image-maps-2016-07-19-032353">
                <area shape="rect" coords="538,392,540,394" alt="Image Map" style="outline:none;" title="Image Map"
                      href="http://www.image-maps.com/index.php?aff=mapped_users_70027"/>
                <area id="1" href="list.php?id=1" shape="poly" coords="171,36,118,69,114,129,177,144,188,94"
                      style="outline:none;"/>
                <area id="2" href="list.php?id=2" shape="poly" coords="103,230,49,263,120,318,162,287"
                      style="outline:none;"/>
                <area id="6" href="list.php?id=6" shape="poly" coords="216,118,189,163,201,234,241,252,255,213,248,140"
                      style="outline:none;"/>
                <area id="4" href="list.php?id=4" shape="poly"
                      coords="182,238,178,311,212,358,249,351,260,322,240,282,209,253,181,232" style="outline:none;"/>
                <area id="3" href="list.php?id=3" shape="poly" coords="177,163,66,148,54,220,102,219,160,234"
                      style="outline:none;"/>
                <area id="10" href="list.php?id=10" shape="poly" coords="250,264,280,309,376,322,394,258,320,270"
                      style="outline:none;"/>
                <area id="5" href="list.php?id=5" shape="poly" coords="264,115,249,115,288,248,377,244,303,199,284,179"
                      style="outline:none;"/>
                <area id="9" href="list.php?id=9" shape="poly"
                      coords="445,371,418,375,397,331,403,284,434,288,451,315,439,338" style="outline:none;"/>
                <area id="8" href="list.php?id=8" shape="poly"
                      coords="506,180,455,171,441,190,395,188,431,229,411,257,445,280,465,227" style="outline:none;"/>
                <area id="7" href="list.php?id=7" shape="poly"
                      coords="436,171,309,127,290,143,293,173,325,194,361,218,411,239,374,180,381,169"
                      style="outline:none;"/>
            </map>
        </div>
        <div>
            <ul>
                <li data-href="list.php?id=1"><label>Ardennes:</label> <br>
                Charleville-Mézières
                    <?php $sql= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Char%'";
                $charleville = $bdd->query($sql);
                $charle = mysqli_fetch_object($charleville);
                echo $charle->nombreVille;
                ?></li>
                <li data-href="list.php?id=2"><label>Aube:</label><br>
                Troyes
                    <?php $sqlu= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Tro%'";
                    $troyes = $bdd->query($sqlu);
                    $troy = mysqli_fetch_object($troyes);
                    echo $troy->nombreVille;
                    ?></li>
                <li data-href="list.php?id=3"><label>Marne</label><br>
                Châlons-En-Champagne
                    <?php $sqld= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Chal%'";
                    $chalon = $bdd->query($sqld);
                    $chal = mysqli_fetch_object($chalon);
                    echo $chal->nombreVille;
                    ?></li>
                <li data-href="list.php?id=4"><label>Haute-Marne</label><br>
                Chaumont
                    <?php $sqlt= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Chau%'";
                    $chaumon = $bdd->query($sqlt);
                    $chaum = mysqli_fetch_object($chaumon);
                    echo $chaum->nombreVille;
                    ?></li>
                <li data-href="list.php?id=5"><label>Meurthe-et-Moselle</label><br>
                Nancy
                    <?php $sqlq= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Nan%'";
                    $nancy = $bdd->query($sqlq);
                    $nan = mysqli_fetch_object($nancy);
                    echo $nan->nombreVille;
                    ?></li>
                <li data-href="list.php?id=6"><label>Meuse</label><br>
                Verdun
                    <?php $sqlc= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Ver%'";
                    $verdun = $bdd->query($sqlc);
                    $ver = mysqli_fetch_object($verdun);
                    echo $ver->nombreVille;
                    ?><br>
                Bar-le-Duc
                    <?php $sqls= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Bar%'";
                    $barLeDuc = $bdd->query($sqls);
                    $bar = mysqli_fetch_object($barLeDuc);
                    echo $bar->nombreVille;
                    ?>
                </li>
                <li data-href="list.php?id=7"><label>Moselle</label><br>
                Metz
                    <?php $sqlse= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Met%'";
                    $metz = $bdd->query($sqlse);
                    $met = mysqli_fetch_object($metz);
                    echo $met->nombreVille;
                    ?></li>
                <li data-href="list.php?id=8"><label>Bas-Rhin</label><br>
                Strasbourg
                    <?php $sqlh= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Strasb%'";
                    $strasbourg = $bdd->query($sqlh);
                    $stras = mysqli_fetch_object($strasbourg);
                    echo $stras->nombreVille;
                    ?></li>
                <li data-href="list.php?id=9"><label>Haut-Rhin</label><br>
                Colmar
                    <?php $sqln=" 
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Colma%' ";
                    $colmar = $bdd->query($sqln);
                    $col = mysqli_fetch_object($colmar);
                    echo $col->nombreVille;
                    ?><br>
                Mulhouse
                    <?php $sqldi= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Mulh%'";
                    $mulhouse = $bdd->query($sqldi);
                    $mul = mysqli_fetch_object($mulhouse);
                    echo $mul->nombreVille;
                    ?>
                </li>
                <li data-href="list.php?id=10"><label>Vosges</label><br>
                Epinal
                    <?php $sqlo= "
SELECT o.id, count(o.id) as nombreVille FROM `offers` as o WHERE o.city Like '%Epi%'";
                    $epinal = $bdd->query($sqlo);
                    $epi = mysqli_fetch_object($epinal);
                    echo $epi->nombreVille;
                    ?></li>
                <?php

                ?>
            </ul>
        </div>
    </div>
<?php

include 'footer.php';