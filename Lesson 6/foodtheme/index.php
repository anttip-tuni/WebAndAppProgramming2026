<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
    
       global $wpdb;

       $rowresults = $wpdb->get_results("SELECT name FROM foodsenglish");

       foreach ($rowresults as $row){
        ?>
        <p><?php echo $row->name; ?></p>
        <?php
       }

    ?>


</body>
</html>