<?php
require('./inc/config.php');
require('./inc/header.php');
?>
<h1>Bienvenue sur notre blog</h1>

<?php
$phrase = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tristique eget nulla at eleifend. Integer et sapien eu velit facilisis vestibulum sit amet eu leo. Mauris vitae viverra nunc. Nullam sit amet urna et ante suscipit pharetra. Pellentesque ut finibus quam. Proin vitae laoreet quam, ut pharetra nibh. Sed ornare.";

$extrait = get_words(count: 12,sentence: $phrase )."...";
var_dump($_GET);
?>

<?php require('./inc/footer.php'); ?>
