<div class="layout-wrapper">
	<div class="layout-content">
<?php
	include ("king-kong-dog-include-check.php");
?>

<?php
	include ("connect.php");
	
	$get_a_id = $_GET['id'];
	
	//HENT HUND
	$query = "SELECT 
		a_id,
		title,
		meta_description,
		linktitle,
		toc,
		article,
		cover,
		public
			FROM
		articles
			WHERE a_id=?";
	if ($stmt = $con->prepare($query)) {
		
		$stmt->bind_param('s', $get_a_id);

		/* execute statement */
		$stmt->execute();

		/* bind result variables */
		$stmt->bind_result($a_id,
		$title,
		$meta_description,
		$linktitle,
		$toc,
		$article,
		$cover,
		$public);

		/* fetch values */
		$stmt->fetch();				

		/* close statement */
		$stmt->close();
	}
?>

<form style="width: 700px; float: left;" class="AdminWrap" method="post" action="king-kong-dog-checkarticle.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data">
	<p>
		Coverbillede<br />
		<img src="gallery_images_small/<?php echo $cover; ?>" style="width: 150px;" /><br />
		<input type="text" name="article_cover" placeholder="cover på artikel" value="<?php echo $cover; ?>" />
	</p>
	<p>
		Titel på artikel<br />
		<input type="text" name="article_title" placeholder="Titlen på artiklen" value="<?php echo $title; ?>" />
	</p>
	<p>
		Kort intro / meta beskrivelse<br />
		<textarea name="article_short_description" rows="5" placeholder="Kort intro"><?php echo $meta_description; ?></textarea>
	</p>
	<p>
		Linktitel<br />
		<input type="text" name="article_linktitle" placeholder="Eksempelvis: hunde-elsker-mad" value="<?php echo $linktitle; ?>" />
	</p>
	<p>
		Indholdsfortegnelse<br />
		<textarea name="article_toc" rows="5" placeholder="Indholdsfortegnelse"><?php if($toc == "") { ?>[toc]1 <a href="#ID">HEADER</a>[/toc] <?php } else { echo $toc; } ?></textarea>
	</p>
	<p>
		Artiklen<br />
<textarea name="article_thearticle" rows="20" placeholder="Skriv din artikel...">
<?php
	if($article == "") {
?>
[section]
<h2 id="#ID">HEADER</h2>
<p>TEKST</p>
[/section]
<?php
	}
	else {
		echo $article;
	}
?>
</textarea>
	</p>
	
	<p>Offentlig<br /><input type="text" name="article_public" placeholder="Offentlig?" value="<?php echo $public; ?>" /></p>
	
	<p><input type="submit" name="submit" value="Opdatér artikel" /></p>
</form>

<style>
				.SearchBarWrap {
					position: relative;
					display: inline-block;
				}
					.SearchLogo {
						width: -moz-calc(100% - 40px);
						width: -webkit-calc(100% - 40px);
						width: -o-calc(100% - 40px);
						width: calc(100% - 40px);
						height: 100px;
						background: url("../images/logo.png") center center no-repeat;
						margin: 0 20px;
						background-size: 300px;
					}
					.SearchBar {
						width: -moz-calc(100% - 62px);
						width: -webkit-calc(100% - 62px);
						width: -o-calc(100% - 62px);
						width: calc(100% - 62px);
						padding: 15px 30px;
						margin: 10px 0 0 0;
						/*box-shadow: 0 0 8px #e2e2e2;*/
						font-size: 1.500em;
						border-radius: 5px 5px 0 0;
					}
					.sSearchBarResults {
					  display: none;
					  position: absolute;
					  background-color: #fff;
					  min-width: 160px;
					  max-width: 252px;
					  z-index: 1;
					  border-right: 1px solid #e2e2e2;
					  border-bottom: 1px solid #e2e2e2;
					  border-left: 1px solid #e2e2e2;
					  margin: 0 0 0 20px;
					}
					.SearchBarResults {
						display: none;
						width: -moz-calc(100% - 42px);
						width: -webkit-calc(100% - 42px);
						width: -o-calc(100% - 42px);
						width: calc(100% - 42px);
						border: 1px solid #e2e2e2;
						padding: 20px;
						float: left;
					}
						a.SearchBarResultUnitWrap:link,a.SearchBarResultUnitWrap:visited,a.SearchBarResultUnitWrap:active {
							width: 100%;
							border-bottom: 1px solid #e2e2e2;
							text-decoration: none;
						}
							a.SearchBarResultUnitWrap:hover {
								background: #f9f9f9;
							}
							.SearchBarResultUnitName {
								width: 200px;
								height: auto;
								color: #333;
								padding: 15px 0 15px 10px;
							}
							.SearchBarUnitFlag {
								width: 32px;
								height: 20px;
								position: relative;
								padding: 15px 0 0 0;
							}
								.SearchBarUnitFlag img {
									position: absolute;
									bottom: 0;
									right: 0;
									width: 30px;
									height: 18px;
									border: 1px solid #e2e2e2;
								}
</style>

<div style="width: 400px; float: right; margin: 27px 0 0 0; position: relative; height: 10000px;">
	<div style="position: -webkit-sticky;position: sticky;top: 70px;">
		<input id="searchBox" class="SearchBar BorderFull" type="text" placeholder="Søg efter et billede" />
		<div class="SearchBarResults DisplayNone" id="result"></div>
	</div>
		
    <script>
        $(document).ready(function(){
            //jQuery function to get the keys entered by keyboard
            $('#searchBox').keyup(function(){   
                var query = $('#searchBox').val();
                //check whether the entered word phrase contains at least one character
                if(query.length>1){             
                    // start Ajax call to get the suggestions
                    $.ajax({
                        //Path for PHP file to fetch suggestion from DB
                        url: "king-kong-dog-gallery-fetch.php", 
                        //Fetching method       
                        method: "POST",
                        //Data send to the server to get the results
                        data: {
                           search : 1,             
                           q: query 
                        },
                        //If data fetched successfully from the server, execute this function
                        success:function(data){   
                            //Print the fetched suggestion results in the section wih ID - #result      
                            $('#result').html(data); 
							$('#result').show(); 
                        },
                        //Type of data sent to the server
                        dataType: "text"                
                    });
                    // end Ajax call to get the suggestions
                }
				else {   
					$('#result').html("");
					$('#result').hide(); 	
				}
            });
			//If clicked outside resultbox
			// $(document).mouseup(function(e) {
				// var container = $("#searchBox,#result");
				// if (!container.is(e.target) && container.has(e.target).length === 0) 
				// {
					// $("#result").hide();
				// }
			// });
			//If clicked on searchbox
			$("#searchBox").click(function(event) {
				event.preventDefault();
				var queryVal = $('#searchBox').val();
				if(queryVal.length>1){
					$("#result").show();
				}
			});
        });
		
    $('.lol').click(function(){
		$(this).select(); 
    });
    </script>
</div>

<script src='js/autosize.min.js'></script>
<script>
	$(document).ready(function() {
		autosize($('textarea'));
	});
</script>
</div>
</div>