<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
	include ("connect.php");
?>
<div class="AdminWrap">
	<div style="width: 400px;" class="FloatLeft">
		<h1>Bruger indstillinger</h1>		
		<?php
		$m_id = "3";
			//HENT BRUGER
			$query = "SELECT 
				m_id,
				myemail,
				mypass,
				rank
					FROM
				medlemmer
					WHERE m_id=?";
			if ($stmt = $con->prepare($query)) {
				
				$stmt->bind_param('s', $m_id);

				/* execute statement */
				$stmt->execute();

				/* bind result variables */
				$stmt->bind_result($m_id, $myemail, $mypass, $rank);

				/* fetch values */
				$stmt->fetch();				

				/* close statement */
				$stmt->close();
			}	
			
			//skift kode
			if(isset($_POST['submit_changes'])){
				$post_username 			= $_POST['new-username'];
				$post_new_code 			= $_POST['new-password'];
				$post_new_code_again 	= $_POST['new-password-again'];
				$post_old_password 		= $_POST['current-password'];
				
				if($post_username == "") {
					echo "Husk at skrive et brugernavn<br />";
				}
				else if($post_new_code == "") {
					echo "Husk at skrive din nye kode<br />";
				}
				else if($post_new_code_again == "") {
					echo "Husk at skrive din nye kode igen<br />";
				}
				else if($post_old_password == "") {
					echo "Af sikkerhedsmæssige årsager skal du huske at skrive din gamle kode<br />";
				}
				
				if($post_new_code == $post_new_code_again) {
					if (password_verify($post_old_password, $mypass)) {
						$MyNewPass = trim($post_new_code);
						$MyNewPassHash = password_hash($MyNewPass, PASSWORD_DEFAULT);

						$_SESSION["myusername"] = $post_username;
						$_SESSION["myid"] = $m_id;
						echo "Dit brugernavn og kode er opdateret<br />";
						
						$stmtUpdateUser = $con->prepare("UPDATE medlemmer SET myemail = ?, mypass = ? 
						WHERE m_id = ?");
						$stmtUpdateUser->bind_param('sss', $post_username, $MyNewPassHash, $m_id);
						$stmtUpdateUser->execute(); 
						$stmtUpdateUser->close();
						
						$myemail = $post_username;
					}
					else {
						echo "Din gamle kode er ikke korrekt<br />";
					}
				}
				else {
					echo "Koderne matcher ikke<br />";
				}
			}		
		?>
		<form method="post" action="">
			<h2>Skift brugernavn/kode</h2>
			<p>Brugernavn</strong><br /><input type="text" name="new-username" placeholder="Brugernavn" value="<?php echo $myemail; ?>" /></p>
			<p>Ny kode</strong><br /><input type="password" name="new-password" placeholder="Ny kode" value="" /></p>
			<p>Ny kode igen</strong><br /><input type="password" name="new-password-again" placeholder="Ny kode igen" value="" /></p>
			<hr />
			<p>Nuværende kode</strong><br /><input type="password" name="current-password" placeholder="Din nuværende kode" value="" /></p>
			<p>Af sikkerhedsmæssige årsager skal du skrive din nuværende kode.</p>
			<p><input type="submit" value="Gem ændringer" name="submit_changes" /></p>
		</form>
	</div>
</div>
</div>
</div>