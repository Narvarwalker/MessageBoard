<!-- Exercise from CH. 6 -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Message Board</title>
</head>
<body>
	<h1>Message Board</h1>
	<?php


		if (isset($_GET["action"])) {
			if ((file_exists("MessageBoard/messages.txt")) && 
				(filesize("MessageBoard/messages.txt") != 0)) {

				$MessageArray = file("MessageBoard/messages.txt");

				switch ($_GET["action"]) {
					case "Delete First": 
						array_shift($MessageArray);
						break;
					case "Delete Last":
						array_pop($MessageArray);
						break;
					case "Delete Message":
						if (isset($_GET["message"])) {
							$Index = $_GET['message'];
							unset($MessageArray[$Index]);
							$MessageArray = array_values($MessageArray);
						}
						break;
					case "Sort Ascending":
						sort($MessageArray);
						break;
					case "Remove Duplicates":
						$MessageArray = array_unique($MessageArray);
						$MessageArray = array_values($MessageArray);
						
						}
							
						
						
				

			}// End of switch statement
			if (count($MessageArray) > 0) {
				$NewMessages = implode($MessageArray);
				$MessageStore = fopen("MessageBoard/messages.txt", "wb");
				if ($MessageStore === FALSE) {
					echo "There qas an error updating the message file\n"; 
				
				} 
				else {
					fwrite($MessageStore, $NewMessages);
					fclose($MessageStore);
			
				} 
			} // end of count if statement
			else { 
				// we are because $MessageArray id empty
				unlink("MessageBoard/messages.txt");
			}
		} // end of file checking statement

	 // end of isset if statement

		if ((!file_exists("MessageBoard/messages.txt")) 
		 || (filesize("MessageBoard/messages.txt") 
		 == 0)) {
		 echo "<p>Sorry, there are no messages
		 posted.</p>\n";

		} // end of if branch
		else {

		 	$MessageArray =file("MessageBoard/messages.txt");

		 	echo "<table style=\"background-color:lightgray\"
		 			border=\"1\" width=\"100%\">\n";
		 	// end of else branch

			$count = count($MessageArray);

			 // a for loop to work with each individual message in the array
			for ($i = 0; $i < $count; ++$i) {
			 		$CurrMsg = explode("~", $MessageArray[$i]);

				echo "<tr>\n";
				echo "<td width=\"5%\"style=\"text-align:center;
				 			font-weight:bold\">" , ($i + 1) , "</td>\n";
				echo "<td width=\"85%\"><span style=\"font-weight:bold\">Subject: </span> " , htmlentities($CurrMsg[0]) ,"<br />\n";
					echo "<span style=\"font-weight:bold\">Name:
					 </span> " , htmlentities($CurrMsg[1]) ,
					 "<br />\n";
					echo "<span style=\"text-decoration:underline;
					  font-weight:bold\">Message </span><br />\n"  ,htmlentities($CurrMsg[2]) ,
					  "</td>\n";
					echo "<td width=\"10%\" style=\"text-align: center\">" , "<a href='MessageBoard.php?" , "action=Delete%20Message&" , "message=$i'>" , "Delete This Message</a></td>\n";

					echo "</tr>\n";
				} // end of for loop
				echo "</table>\n";
			} // end of else branch
		?>
		<p><a href="PostMessage.php">Post New Message</a></p>

		<p><a href="MessageBoard.php?action?Sort%20"></a></p>
		
		<p><a href="MessageBoard.php?action=Remove%20Duplicates">		Remove Duplicate Messages</a><br/></p>

		<p><a href="MessageBoard.php?action=Delete%20First">
			Delete First Message</a></p>

		<p><a href="MessageBoard.php?action=Delete%20Last">Delete 		Last Message</a></p>

		

</body>
</html>