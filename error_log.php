<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Log</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    $logFile = 'writable/logs/log-' . date("Y-m-d") . '.log'; // Update this path to your actual log file
    if (isset($_POST['clear_log'])) {
        if (file_exists($logFile)) {
            file_put_contents($logFile, '');
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
    ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h5>Error Log - <?= date("d M, Y") ?></h5>
                </div>
                <div class="float-right">
                    <form method="post" action="">
                        <button type="submit" name="clear_log" class="btn btn-danger btn-sm">Clear Log</button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <code>
                    <?php
                    if (file_exists($logFile)) {
                        $log_content = htmlspecialchars(file_get_contents($logFile));
                        echo nl2br($log_content) . "\n";
                    } else {
                        echo "Log file not found.";
                    }
                    ?>
                </code>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>