<?php
declare(strict_types=1);
?>

<!-- Banner -->
<section id="banner"></section>

<!-- About us -->
<section class="text-section" id="over-ons">
    <div class="inner">
        <header>
            <h2>Historie</h2>
        </header>
        <p>
            Het Christelijk gemend koor "Wijdt Hem Uw Kunst" uit Harderwijk werd
            opgericht in 1953 en heeft op dit moment 65 leden. Sinds 2018 staat
            het koor onder leiding van Marijn de Jong. Daarvoor stond het koor
            23 jaar onder leiding van Evert van de Veen. Het koor verleent haar
            medewerking aan verschillende zangavonden in Harderwijk en omgeving
            zoals de jaarlijks terugkerende Kerstzangdienst en Paaszangdienst in
            de Chr. Geref. Kerk te Harderwijk. De naam van het koor is ontleend
            aan het tweede vers van Psalm 33: "Wijdt Hem uw kunst". Dit is dan
            ook de doelstelling van het koor. Het koor oefent iedere
            woensdagavond.
        </p>
        <ul class="actions">
            <li><a href="#" class="button alt">Lees meer</a></li>
        </ul>
    </div>
</section>

<section class="text-section" id="concerten">
    <div class="inner">
        <header>
            <h2>Concerten</h2>
        </header>
        <p>
            Concerten tekst
        </p>

        <div class="row">
            <?php for ($x = 0; $x < 6; $x++) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="/images/kerk.jfif"
                             alt="Card image cap">
                        <div class="card-body p-2">
                            <h4 class="card-title p-0 m-0">Paas uitvoering</h4>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
