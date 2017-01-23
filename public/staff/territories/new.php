<?php
require_once('../../../private/initialize.php');



// Set default values for all variables the page needs.
$errors = array();
$territory = array(
  'name' => '',
  'state_id' => 0,
  'position' => ''
);



if(is_post_request()){
  if(isset($_POST['name'])){$territory['name'] = $_POST['name'];}
  //insert the state_id in the Database
  $territory['state_id'] = $_GET['id'];
  if(isset($_POST['position'])){$territory['position'] = $_POST['position'];}

  $result = insert_territory($territory);
  if($result === true){
    $new_id = db_insert_id($db);

    redirect_to('show.php?id=' . $new_id);

  }else{
    $errors = $result;
  }

}
?>
<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <!-- <a href="index.php">Back to State Details</a><br /> -->
  <a href="../states/show.php?id=<?php echo $_GET['id'] ?>">Back to State Details</a><br />

  <h1>New Territory</h1>

  <!-- TODO add form -->
  <?php echo display_errors($errors); ?>

  <form action="#" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo $territory['name']; ?>" /><br />
    Position:<br />
    <input type="text" name="position" value="<?php echo $territory['position']; ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Create"  />
  </form>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
