<?php 
$multi = array(
            "musicals" => array("Oklahoma", "The Music Man", "South Pacific"),
            "dramas" => array("Lawrence of Arabia", "To Kill a Mockingbird", "Casablanca"),
            "mysteries" => array("The Maltese Falcon", "Rear Window", "North by Northwest") );

 foreach($multi as $key => $values) {
   echo strtoupper($key);
   echo "<br>";
   foreach($values as $i => $value) {
     echo "----> $i = $value";
     echo "<br>";
   }
 }
 krsort($multi);
 echo "The sorted array in decreasing order by genre is:";
 echo "<br>";
 foreach($multi as $key => $values) {
  echo strtoupper($key);
  echo "<br>";
  foreach($values as $i => $value) {
    echo "----> $i = $value";
    echo "<br>";
  }
}
?>
