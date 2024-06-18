<?php
	session_start();
	if(isset($_POST['email']) && isset($_POST['password'])) {
		require('connect.php'); //Inkludere connect.php (require betyder at den ikke fortsætter med at kører funktionerne, ved fejl)
		
		$myusername = trim($_POST['email']); //Variabel der henter brugernavn fra login
		$mypassword = trim($_POST['password']); //Variabel der henter kode fra login
		
		if($myusername == "") {
			echo "no 1";
		} 
		else if($mypassword == "") {
			echo "no 2";
		}
		else {

			//HENT BRUGER
			$query = "SELECT 
				m_id,
				myemail,
				mypass,
				rank
					FROM
				medlemmer
					WHERE myemail=?";
			if ($stmt = $con->prepare($query)) {
				
				$stmt->bind_param('s', $myusername);

				/* execute statement */
				$stmt->execute();
				
				//NUM ROWS
				$stmt->store_result();
				$row_cnt = $stmt->num_rows;

				/* bind result variables */
				$stmt->bind_result($m_id, $myemail, $mypass, $rank);

				/* fetch values */
				$stmt->fetch();				

				/* close statement */
				$stmt->close();
			}		
		
			//CHECKER OM DER FINDES EN MED DEN EMAIL
			if($row_cnt > 0) {
				$mypass = trim($mypass);
				if (password_verify($mypassword, $mypass)) {
					$_SESSION["myusername"] = $myusername;
					$_SESSION["myid"] = $m_id;
					
					//CHEKKER FOR ADMIN
					if($rank == "1") {
						$_SESSION["admin"] = "fuckyeah";
					}
					
					//GÅ TIL INDEX

					header("Location: index.php?page=kingkong-control-panel");
				}
				else {
					//FORKERT KODE
					echo "no 3";
				}
			}
			else {
				//FINDES IKKE
				echo "no 4";
			}
		}
	}
	else {
		include ("404.php");
	}
?>