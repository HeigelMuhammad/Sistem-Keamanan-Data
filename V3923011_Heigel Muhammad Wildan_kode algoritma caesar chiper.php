<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sistem Keamanan Data</title>
    <style>
        body {
            background-color: #f3f0ff;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(90deg, #6f42c1, #8a2be2);
            color: #fff;
            text-align: center;
            padding: 20px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            background-color: #e6e6fa;
            padding: 30px;
        }

        .btn {
            border-radius: 25px;
        }

        .btn-success {
            background-color: #6f42c1;
            border: none;
        }

        .btn-danger {
            background-color: #e3342f;
            border: none;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .result {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .result p {
            font-size: 1.1em;
            color: #333;
        }

        .footer {
            text-align: center;
            padding: 10px;
            background-color: #6f42c1;
            color: #fff;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2><b>Sistem Keamanan Data</b></h2>
            </div>
            <div class="card-body">
                <?php
                function cipher($char, $key) {
                    if (ctype_alpha($char)) {
                        $nilai = ord(ctype_upper($char) ? 'A' : 'a');
                        $mod = fmod(ord($char) + $key - $nilai, 26);
                        return chr($mod + $nilai);
                    }
                    return $char;
                }

                function enkripsi($input, $key) {
                    return implode(array_map(function($char) use ($key) {
                        return cipher($char, $key);
                    }, str_split($input)));
                }

                function dekripsi($input, $key) {
                    return enkripsi($input, 26 - $key);
                }
                ?>

                <form method="post">
                    <div class="mb-3">
                        <label for="plain" class="form-label">Input Text</label>
                        <input type="text" name="plain" class="form-control" id="plain" placeholder="Masukkan teks">
                    </div>
                    <div class="mb-3">
                        <label for="key" class="form-label">Input Key</label>
                        <input type="number" name="key" class="form-control" id="key" placeholder="Masukkan kunci">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-success" type="submit" name="enkripsi">Enkripsi</button>
                        <button class="btn btn-danger" type="submit" name="dekripsi">Dekripsi</button>
                    </div>
                </form>
            </div>
            <div class="footer">
                <h4><b>HASIL</b></h4>
            </div>
            <div class="card-body result">
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <p><strong>Output yang dihasilkan:</strong> <?= isset($_POST['enkripsi']) ? enkripsi($_POST['plain'], $_POST['key']) : dekripsi($_POST['plain'], $_POST['key']) ?></p>
                    <p><strong>Text yang dimasukkan:</strong> <?= $_POST['plain'] ?></p>
                    <p><strong>Key:</strong> <?= $_POST['key'] ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>
