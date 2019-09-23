<html>
   <head>
      <title>Create a MariaDB Table</title>
   </head>

   <body>
      <?php
         $dbhost = 'localhost:3036';
         $dbuser = 'root';
         $dbpass = 'rootpassword';
         $conn = mysql_connect($dbhost, $dbuser, $dbpass);

         if(! $conn ){
            die('Could not connect: ' . mysql_error());
         }
         echo 'Connected successfully<br />';

         $sql = "CREATE TABLE products_tbl( ".
            "product_id INT NOT NULL AUTO_INCREMENT, ".
            "product_name VARCHAR(100) NOT NULL, ".
            "product_manufacturer VARCHAR(40) NOT NULL, ".
            "submission_date DATE, ".
            "PRIMARY KEY ( product_id )); ";

         mysql_select_db( 'PRODUCTS' );
         $retval = mysql_query( $sql, $conn );

         if(! $retval ) {
            die('Could not create table: ' . mysql_error());
         }
         echo "Table created successfully";
         
         while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
            echo "Product ID :{$row['product_id']} <br> ".
               "Name: {$row['product_name']} <br> ".
               "Manufacturer: {$row['product_manufacturer']} <br> ".
               "Ship Date: {$row['ship_date']} <br> ".
               "--------------------------------<br>"; }

         mysql_close($conn);
      ?>
   </body>
</html>
