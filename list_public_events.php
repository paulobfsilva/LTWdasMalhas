<?php
	include_once("database/connection.php");
	include_once("database/public_events.php");

	include_once("templates/header.php");  ?>
	<div class="mainContent">
    	<div class="content">
        	<article class="topcontent">
            	<header>
                	<h2><a href="#" title="Title">Public Events</a></h2>
                </header>
                
                <content>
                    <!--table containing all the public events-->
                    <table>
                        <tr>
                            <th class="left">Event Id</th>
                            <th class="left">Owner</th>
                            <th class="center">Description</th>
                            <th class="center">Type</th>
                            <th class="center">Date</th>
                            <th class="center">Image</th>
                        </tr> 

                    <?php 
                        $db=new PDO('sqlite:DB.db');
                        $stmt =$db->prepare('SELECT * FROM Events WHERE public=1');
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        foreach( $result as $row) {
                            echo '<tr>';
                            echo '<td>' . $row['idEvent'] . '</td>';
                            $id=(int)$row['idUser'];
                            $db1=new PDO('sqlite:DB.db');
                            $stmt1 =$db1->prepare('SELECT nome FROM Users WHERE idUser LIKE "%'.$id.'%" LIMIT 1');
                            $stmt1->execute();
                            $result1 = $stmt1->fetch();
                            echo '<td>' . $result1['nome'] . '</td>';
                            echo '<td>' . $row['description'] . '</td>';
                            echo '<td>' . $row['event_type'] . '</td>';
                            echo '<td>' . $row['event_date'] . '</td>';
                            echo '<td><img src="'.$row['image_link'].'" alt="Image" height="42" width="42"></td>';
                            echo '</tr>';
                        }
                    ?>
                    </table>                	
                </content>
            </article>
        </div>
    </div>
<?php 
 	include_once("templates/footer.php");
?>