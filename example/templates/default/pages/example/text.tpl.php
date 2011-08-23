This is a quick example of how you can build pages in Bonita that very quickly become independent of their template types.

(In future, we'll probably go further.)

<?=$t->draw('pages/example/link');?>

<a href="<?php echo $vars['url'];?>">Here's a link back to the Bonita project on Github.</a>