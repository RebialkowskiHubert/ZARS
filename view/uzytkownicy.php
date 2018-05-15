<?php
if(!isset($user) || $user->typ!=1)
    exit();
?>
<section id="uzytkownicy" class="podstrona">
    <div class="container-fluid">
        <h1>Użytkownicy</h1>

        <div class="table-responsive">
            <table id="tab" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Login</th>
                        <th>Data&nbsp;urodzenia</th>
                        <th>Miejscowość</th>
                        <th>E-mail</th>
                        <th>Telefon</th>
                        <th>Administrator</th>
                        <th>Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $klienci = $DB->wybierz("uzytkownicy", "*", "all", null, null, null);
                    foreach ($klienci as $klient) {
                        echo '<tr>' .
                        '<td>' . $klient["id_uzytkownik"] . '</td>' .
                        '<td>' . $klient["imie"] . '</td>' .
                        '<td>' . $klient["nazwisko"] . '</td>' .
                        '<td>' . $klient["login"] . '</td>' .
                        '<td>' . $klient["data"] . '</td>' .
                        '<td>' . $klient["miejscowosc"] . '</td>' .
                        '<td>' . $klient["email"] . '</td>' .
                        '<td>' . $klient["telefon"] . '</td>';
                        if($klient["typ"]==0)
                            echo '<td><img src="../img/nok.png" width="25" onclick="zmienUprawnienia('.$klient["id_uzytkownik"].');"/></td>';
                        else
                            echo '<td><img src="../img/ok.png" width="25" onclick="zmienUprawnienia('.$klient["id_uzytkownik"].');"/></td>';
                        echo '<td><img src="../img/nok.svg" width="25" onclick="usunUzytkownika('.$klient["id_uzytkownik"].');"/></td>'.
                        '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
