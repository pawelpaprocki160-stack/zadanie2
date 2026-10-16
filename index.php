<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dziennik ocen</title>
</head>
<body>

    <?php
    // Obsługa zapisu danych po wysłaniu formularza
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['zapisz'])) {
        $imieNazwisko = $_POST['imie'] ?? '';
        $przedmiot = $_POST['przedmiot'] ?? '';
        $ocena = $_POST['ocena'] ?? '';

        if (!empty($imieNazwisko) && !empty($przedmiot) && !empty($ocena)) {
            $plik = fopen('oceny.txt', 'a');
            if ($plik) {
                $linia = $imieNazwisko . ' | ' . $przedmiot . ' | ocena: ' . $ocena . "\n";
                fwrite($plik, $linia);
                fclose($plik);
            }
        }
    }
    ?>

    <form method="POST" action="">
        <label>Imię i nazwisko ucznia:</label><br>
        <input type="text" name="imie" required><br><br>

        <label>Ocena:</label><br>
        <select name="ocena" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select><br><br>

        <label>Przedmiot:</label><br>
        <input type="text" name="przedmiot" required><br><br>

        <button type="submit" name="zapisz">Zapisz ocenę</button>
    </form>

    <hr>

    <!-- Odczyt danych z pliku -->
    <h2>Zapisane oceny</h2>
    <?php
    $nazwaPliku = 'oceny.txt';

    if (file_exists($nazwaPliku)) {
        $plik = fopen($nazwaPliku, 'r');
        if ($plik) {
            while (!feof($plik)) {
                $linia = fgets($plik);
                if ($linia !== false) {
                    echo htmlspecialchars($linia) . "<br>";
                }
            }
            fclose($plik);
        }
    }
    ?>

</body>
</html>