<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $totalAmount = 0;
        foreach ($transactions as $transaction): 
        $totalAmount += $transaction['amount'];
        ?>
    <tr>
        <td><?= $transaction['date']; ?></td>
        <td><?= $transaction['reference']; ?></td>
        <td><?= $transaction['description']; ?></td>
        <td><?= '$' . $transaction['amount']; ?></td>
    </tr>
<?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="1">To be put in savings:</th>
                <td><?= '$' . $totalAmount; ?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>