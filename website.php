<!DOCTYPE HTML>  
<html>
<head>
<style>
h2 {text-align: center;}
p {text-align: center;}
div {text-align: center;}
form {text-align: center;}
a {text-align: center;}

.error {color: #FF0000;}
div {white-space: pre-wrap;}
.loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  /* background: rgba(0,0,0,0.75) url(/images/Loading_2.gif) no-repeat center center; */
  /* background: rgba(0,0,0,0.75) url("http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif") no-repeat center center; */
  background: rgba(0,0,0,0.75) url(/images/loading_resized.gif) no-repeat center center;
  /* no-repeat center center; */
  /* <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." /> */
  z-index: 10000;
}
.loader.active {
  display: block;
}

</style>
</head>
<body>  

<?php
// define variables and set to empty values
$mutation_ptErr = "";
$mutation_pt = "";
$Tissue = "";
$Sessionid = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {   
  if (empty($_POST["mutation_pt"])) {
    $mutation_ptErr = "Must Input SNPs";
  } else {
    $mutation_pt =($_POST["mutation_pt"]);
    $mutation_ptErr = test_input($mutation_pt);
  }
  $Tissue = ($_POST["Tissue"]);
  $Pathways = ($_POST["Pathways"]);
  $Gene_gene_interaction = ($_POST["Gene_gene_interaction"]);
  $Weighting = ($_POST["Weighting"]);
  $Sessionid = ($_POST["sessionId"]);

}
function test_input($data) {
  $converted = "";
  $short_converted = "";
  $mutation_ptErr = "";
  $result = preg_split("/[\s,]+/", $data); 
  foreach ($result as &$value) {
    if (preg_match('/([\d+XYxy]):(\d+)-\d+/i',$value,$matches)) {
      // echo "Matched!!";
      // echo $matches[1];
      // echo "<br>";
      // echo $matches[2];
      // echo "<br>";
      $short_converted = chr . $matches[1] . "_" .$matches[2];
      if ( $converted == "" ) {
        $converted = $short_converted;
      } else {
        $converted = $converted . "\n" .$short_converted;
      }
      file_put_contents("test.txt",$converted);
      file_put_contents("web_server/gene_sets/GWAS_29059683.txt",$converted);
      // file_put_contents("ml_program/GWAS_29059683.txt",$converted);
    } elseif($value = "\n") {
      //$value is string
      continue;
    } else {
      $mutation_ptErr = "Invalid SNPs"; 
    }
  }
  unset($value);  // good practice: destroy reference
  return $mutation_ptErr;
}

?>

<h2>SNPs</h2>
<div id="banner">
<img alt="Logo" src="/images/logo.jpg" width="400px">
<!-- <br><small>v 1.0</small>   -->
<br>
</div>
<p><span class="error">* required field</span></p>
<div><p><span class="error">NOTICE: Correct Form 4:999-999
                                       X:999-999</span></p></div>
<p><span class="error">NOTICE: Numbers before dash (999) should be equal to numbers after dash (999) </span></p>
<form id="myform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  SNPS: <textarea name="mutation_pt" rows="5" cols="40"><?php echo $mutation_pt;?></textarea>
  <input id="sessionId" name="sessionId" type="hidden" value="<?php echo getenv("REMOTE_ADDR") . "_" . rand(0, 65000);?>">
  <br><br>
  <span class="error"> * <?php echo $mutation_ptErr;?></span>
  <br><br>


  <label for="Tissue">Choose a type of tissue:</label>
  <select name="Tissue", id="Tissue">
    <option value="all">all</option>
    <option value="breast">breast</option>
    <option value="lung">lung</option>
    <option value="liver">liver</option>
  </select>
  <br>

  <label for="Pathways">Choose a pathway:</label>
  <select name="Pathways", id="Pathways">
    <option value="Reactome">Reactome</option>
    <option value="KEGG">KEGG</option>
  </select>
  <br>

  <label for="Gene-gene interaction">Choose a Gene-gene interaction:</label>
  <select name="Gene_gene_interaction", id="Gene-gene interaction">
    <option value="PPI">PPI</option>
    <option value="None">None</option>
  </select>
  <br>

  <label for="Weighting">Choose Weighting:</label>
  <select name = "Weighting", id="Weighting">
    <option value="1">1</option>
    <option value="0">0</option>
  </select>
  <br>
  
  <!-- <input type="submit" name="submit" value="Submit">   -->
  <button class="myBtn" type="submit">Submit
  </button><br>

  <br>
  <br>

</form>

<!-- loader declaration  -->
<div class="loader"></div>



<!-- loading animation  -->
<script type="text/javascript"> 
   
    function loadScript(url, callback) {
      var e = document.createElement("script");
      e.src = url;
      e.type = "text/javascript";
      e.addEventListener('load', callback);
      document.getElementsByTagName("head")[0].appendChild(e);
    }

    loadScript("https://code.jquery.com/jquery-latest.min.js", function() {
      // This callback will fire once the script is loaded
      // if (window.jQuery) {
      //   window['jqy'] = jQuery.noConflict();
      //   alert('jQuery is loaded');
      // } else {
      //   alert('jQuery not loaded');
      // }
      $(document).ready(function(){
        //prompt("GeeksForGeeks"); 
        $('.myBtn').on('click', function(){
          var $loader = $('.loader');
          $loader.addClass('active');
        });
        // $("#myform").on("submit", function(){
        //   var $loader = $('.loader');
        //   $loader.addClass('active');
        //   //prompt("GeeksForGeeks"); 
        //   alert("computing")
        //   //$("#myloader").fadeIn();
        //   $( "#Logo" ).fadeIn( "slow", function() {
        //     // Animation complete
        //   });
        // });
      }); 

    });

</script>



<?php
echo "<h2>Your Output:</h2>"; 

// echo '<script type="text/JavaScript">  
//       $(document).ready(function(){
//         prompt("GeeksForGeeks"); 
//         // $("#myform").on("submit", function(){
//         //   $("#loader").fadeIn();
//         // });
//       });
//       //prompt("GeeksForGeeks"); 
//      </script>' ;

if (($_SERVER["REQUEST_METHOD"] == "POST") && ($mutation_ptErr == "")){
  file_put_contents("test_input", "./run_all.sh GWAS_29059683" . " " . $Tissue . " " .$Pathways . " " . $Gene_gene_interaction. " " . $Weighting ." ".$Sessionid." ". "1");


  //speedy.sh testing 
  // $output_speed = shell_exec("cd ml_program;./speedy.sh GWAS_29059683.txt $Tissue $Pathways $Gene_gene_interaction $Weighting");  // difference btw "" and ''
  // echo "<pre>$output_speed</pre>";
  // $output2 = shell_exec('yes | sudo apt-get install r-cran-rocr');
  // $output3 = shell_exec('cd ml_program;./run_DRaWR_Tissue_Coding_same_edge_type.sh GWAS_29059683 1  2>&1');

  //real program 
  shell_exec("yes | sudo apt-get install r-cran-rocr");
  // $output = shell_exec("cd web_server; ./run_all.sh GWAS_29059683 $Tissue $Pathways $Gene_gene_interaction $Weighting 1");
  // echo "<pre>$output</pre>"; 
  // credit: https://stackoverflow.com/questions/4914750/how-to-zip-a-whole-folder-using-php
  // Get real path for our folder
  $rootPath = realpath('web_server/results/');

  // Initialize archive object
  $zip = new ZipArchive();
  $zip->open('results.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

  // Create recursive directory iterator
  /** @var SplFileInfo[] $files */
  $files = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($rootPath),
      RecursiveIteratorIterator::LEAVES_ONLY
  );
  foreach ($files as $name => $file)
  {
      // Skip directories (they would be added automatically)
      if (!$file->isDir())
      {
          // Get real and relative path for current file
          $filePath = $file->getRealPath();
          $relativePath = substr($filePath, strlen($rootPath) + 1);

          // Add current file to archive
          $zip->addFile($filePath, $relativePath);
      }
  }
  // Zip archive will be created only after closing object
  $zip->close();

  // echo' <center> <a href="results.zip" download>Result</a></center>';
  echo '<center> <a href="results.zip" download>
  <button type="button">Download Result</button> </center>';

 
}
?>

</body>
</html>