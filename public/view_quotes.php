<?php

define('TITLE', 'Xem tất cả các Trích dẫn');
include '../partials/header.php';

echo '<h2>Tất cả các Trích dẫn</h2>';

include '../partials/check_admin.php';
include '../partials/db_connect.php';
$query = 'SELECT id, quote, source, favorite FROM quotes ORDER BY date_entered DESC';
try {
    $sth = $pdo->query($query);
    while ($row = $sth-> fetch()){
        $htmlspecialchars = 'htmlspecialchars';
        echo "
        <div>
            <blockquote>{$htmlspecialchars($row['quote'])}</blockquote>-
            {$htmlspecialchars($row['source'])}<br>";

            if ($row['favorite'] == 1) {
                echo ' <strong> Yeu thich! </strong>';
            }

            echo "<p> 
            <b> Quan tri trich dan:</b> 
            <a href=\"edit_quote.php?id={$row['id']}\">Sua</a> <->
            <a href=\"delete_quote.php?id={$row['id']}\">Xoa</a>
                </p>
        </div> <br>";
    }
} catch (PDOException $e){
    $error_message = "Khong the lay du lieu";
    $reason = $e->getMessage();
    include '../partials/show_error.php';
}

include '../partials/footer.php';
?>