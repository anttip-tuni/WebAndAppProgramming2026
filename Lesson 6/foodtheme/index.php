<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
    
       global $wpdb; /* Access the built in WordPress database object, which simplifies database queries */

       $rowresults = $wpdb->get_results("SELECT name FROM foodsenglish"); /* 
       1. we are creating a variable called $rowresults, which will contain the results of our query. 

       2. we are assigning to it the results of the query, which we get by calling the get_results method of the $wpdb object.

       3. the query itself is a simple SQL query, which selects the name column from the foodsenglish table.

       */

       foreach ($rowresults as $row){
        /* We are using a PHP foreach loop to iterate through the results. We are deciding to call each individual row $row */
        ?>
        <!-- Here we closed the php tag so that we can use regular HTML to create some p tags -->
        <p>
        
            <?php echo $row->name; ?>
            <!-- we are taking the name property from the current row. Echo will write it to the page -->

        
        </p>
        <?php
       }
       /* We are using PHP again just to close the foreach loop  */

    ?>


</body>
</html>