<?php
	$pageMeta  = "Har du af den ene eller anden årsag brug for, at komme i kontakt med hunderacer.dk, så indtast da dit navn, din email og din besked i formen på siden.";
	$pageTitle = "Kontakt hunderacer.dk";
	$pageCanonical = "https://hunderacer.dk/kontakt";
?>

<div class="layout-wrapper">
	<div class="layout-content">
		<div class="width-100 float-left">
		<header>			
			<h1>Kontakt hunderacer.dk</h1>
		</header>
		
		<section class="float-left">	
			<p>Du skal være velkommen til, at kontakte hunderacer.dk via formen herunder. Har du eventuelle bidrag til hunderacer, artikler, nyheder eller andet i den dur hører vi også meget gerne fra dig. Er der fejlagtige oplysninger omkring hunderacer, i artikler eller nyheder må du meget gerne kontakte os, da vi gør vores bedste for, at alle oplysninger på siden er troværdige og korrekte. Uanset hvad din henvendelse drejer sig om (så længe det er relevant ift. hunde eller hunderacer.dk), så ser vi frem til, at høre fra dig.</p>
    
			<p><strong>Vær opmærksom på:</strong> Vi har endnu ikke listet alle hunderacer endnu. Det kræver meget tid og arbejde. Vi er for nylig begyndt, at skrive om de forskellige hunderacer - så hvis ikke du kan finde en specifik hunderace på nuværende tidspunkt, så kommer den formentlig på siden indenfor en overskuelig fremtid.</p>
		</section>
		
		<section class="contact-form-wrapper float-left">
		
			<?php
				if(isset($_POST['submit'])){
					$hunderaceremail = "kontakt@hunderacer.dk";
					//Vi chekker lige human
					if(isset($_POST['human'])){
						if($_POST['human'] == "1") {
							$human = "1";
						}
						else {
							$human = "0";
						}
					}
					else {
						$human = "0";
					}
					//hvor mange ord?
					$NumberOfWords = str_word_count($_POST['besked']);
					//Vi gennemgår det hele
					if($_POST['navn'] == "") {
						echo "<p><span class='strong-error'>Fejl:</span> Angiv venligst dit navn.</p>";
					}
					else if($_POST['email'] == "") {
						echo "<p><span class='strong-error'>Fejl:</span> Angiv venligst din korrekte email.</p>";
					}
					else if($_POST['besked'] == "") {
						echo "<p><span class='strong-error'>Fejl:</span> Du har vist glemt, at skrive en besked til os.</p>";
					}
					else if(preg_match('(cartoon|porn|porno|pictures|professional|domestic|click|click here|business|lawyer|hundreds|millions|millionaire|expert|company|galleries|virgin|asian|tit|tits|boobs|penis|dick|milking|teen|cryptocurrency|crypto|earning|earn|jack off|adult|butt|booty|tranny|dirty|gallery|casino|jackpot|deposit|bonuses|bookings|tickets|gay|uncensored|censored|соmmеrсiаl|impоrtаnt|prоpоsаl|legally|lаwfully|аutоmаtiсаlly|forced|brystvorter|pik|røv|kneppe|College|girls|women|young|credit card|naughty)', $_POST['besked']) === 1) { 
						echo "<p><span class='strong-error'>Fejl:</span> Nej tak.</p>";
					} 
					// else if(preg_match("/([%\$#ЧикйбдЯКшЏ°є†ѓЂЊфôà\*]+)/", $_POST['besked'])) {
						// echo "<p><span class='strong-error'>Fejl:</span> Yup... Nej tak.</p>";
					// }
					else if($NumberOfWords < 3) {
						echo "<p><span class='strong-error'>Fejl:</span> Din besked er ret kort</p>";
					}
					else if($human == "0") {
						echo "<p><span class='strong-error'>Fejl:</span> Du skal lige markere, at du er et menneske. Dette er for, at undgå for meget spam - beklager.</p>";
					}
					else {
						
						echo "<p><strong>Tak for din besked. Vi besvarer den så snart vi kan :-)</strong></p>";
			
						$to      = 'morten409@gmail.com';
						$subject = 'Fra hunderacer.dk';
						$message = addslashes(strip_tags($_POST['besked']));
						$message = "Fra: ".$_POST['email']."\r\n"."\r\n".$message;
						$headers = 'From: '.$hunderaceremail.'' . "\r\n" .
							'Reply-To: '.$_POST['email'].'' . "\r\n" .
							'X-Mailer: PHP/' . phpversion();
			
						mail($to, $subject, $message, $headers);
					}
				}
			?>
		
			<form class="contact-form" method="post" action="">
						<p><input type="text" name="navn" id="navn" value="" placeholder="Dit navn" required /></p>
						<p><input type="email" name="email" id="email" value="" placeholder="Din e-mail" required /></p>
						<p><input type="checkbox" id="human" name="human" value="1" required />
						<label for="human">Er du et menneske?</label></p>
						<p><textarea name="besked" id="besked" placeholder="Besked" rows="6" required></textarea></p>
						<p><input type="submit" name="submit" value="Send mail" class="special" style="margin: 0 30px 0 0;" />
						<input type="reset" value="Slet alt" /></p>
					</div>
				</div>
			</form>
		</section>
		</div>
	</div>
</div>