<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/azericard-config.php";

use elnurxf\AzeriCard\AzeriCard;
use elnurxf\AzeriCard\Exceptions\EmptyRequiredParametersException;
use elnurxf\AzeriCard\Exceptions\NoConfigException;

$order = [
    'AMOUNT'       => '3.70',
    'CURRENCY'     => 'AZN',
    'ORDER'        => '123456',
    'RRN'          => '123456',
    'INT_REF'      => '123456',
    'TRTYPE'       => '22', // 22 = REVERSAL, 24 = CLEARANCE
    'BUTTON_LABEL' => 'Refund 3.70 AZN - Reversal',
    'BUTTON_CLASS' => 'btn btn-primary btn-lg btn-block',
];

$config = array_merge($config, $order);

try {

    $azericard = new AzeriCard($config);

    try {

        $htmlForm = $azericard->reversalForm();

    } catch (EmptyRequiredParametersException $e) {

        die('Error: Parameter not set: ' . $e->getMessage());

    }

} catch (NoConfigException $e) {

    die('Error: Config are not set');

}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Example: AzeriCard - Reversal</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Reversal form</h2>
            <p class="lead">Reversal example form.</p>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-5">
                <?=$htmlForm; ?>
            </div>
        </div>
    </div>
</body>

</html>