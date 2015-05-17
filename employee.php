<?php
define('PATH',"./");
if(!isset($_GET['dbid'])){ header('Location: index.php'); exit; }
require_once(PATH."phpinc/constant.php");
require_once(PATH."phpinc/main.class.php"); $main = new main();
$rows = $main->lookupbyid($_GET['dbid']);
?>
<!doctype html>
<html lang="">
   <?php include("includes/header.php");?>

  <body>
   <?php include("includes/menu.php");?>

    <main>

   <?php
      if(sizeof($rows) <1 ){ ?> <h4>URL Error</h4> <?php }
      else{
      ?>
      <p align="right">
         <a href="https://twitter.com/share" class="twitter-share-button" data-text="What <?php echo ucfirst(strtolower($rows[0]['name_first']))." ".ucfirst(strtolower($rows[0]['name_last'])); ?> makes: " data-hashtags="Salary,Database,UKY,UniversityofKentucky">Tweet</a>
         <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      </p>
       <table >
        <tbody>
         <?php foreach ($rows as $v){ ?>
          <tr>
            <td><strong>Name:</strong> &nbsp; <?php echo ucfirst(strtolower($v['name_first']))." ".ucfirst(strtolower($v['name_last'])); ?></td>
          </tr>
          <tr>
            <td>
               <strong>Title:</strong> &nbsp;
               <a href="titles.php?title=<?php echo $v['title']?>" ><?php echo $v['title']; ?></a>
            </td>
          </tr>
          <tr>
            <td><strong>Salary:</strong> &nbsp; <?php echo "$".number_format($v['salary'], 0,'.', ',')?> </td>
          </tr>
          <tr>
            <td>
               <strong>Department:</strong> &nbsp;
               <a href="department.php?dept=<?php echo $v['dept']?>" ><?php echo $v['dept']; ?></a>
            </td>
          </tr>
          <tr>
            <td><strong>Description:</strong> &nbsp; <?php echo $v['description']; ?> </td>
          </tr>
          <tr>
            <td><strong>Hire Date:</strong> &nbsp; <?php echo date("F j, Y", strtotime($v['datehire'])); ?> </td>
          </tr>
          <tr>
            <td><strong>Employee Status:</strong> &nbsp; <?php echo $v['status']; ?> </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <?php
         }
   ?>
    </main>
    <?php include("includes/footer.php");?>
  </body>
</html>