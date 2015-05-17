<?php
define('PATH',"./");
require_once(PATH."phpinc/constant.php");
require_once(PATH."phpinc/main.class.php"); $main = new main();
$rows = $main->search_byname();
?>
<!doctype html>
<html lang="">
   <?php include("includes/header.php");?>

  <body>
   <?php include("includes/menu.php");?>

    <main>
      <form name="form1" method="get" action="<?php $_SERVER['PHP_SELF']?>" >
         <table>
            <tbody>
               <tr>
                  <td>
                  <input id="firstname" autocomplete="namef" placeholder="First Name" name="firstname" list="firstname" value="<?php
   						echo $main->fname; ?>" />
                  <input id="lastname" autocomplete="namel" placeholder="Last Name" name="lastname" list="lastname" value="<?php
   						echo $main->lname; ?>" />
         			<input type="submit" value="Search Employee">
         			<input type="button" value="Clear" onClick="parent.location='index.php'">
         			</td>
               </tr>
   			</tbody>
			</table>
      </form>

   <?php
   if(isset($_GET["lastname"]) || isset($_GET["lastname"])){
      if(sizeof($rows) <1 ){ ?> <h4>No Results Found</h4> <?php }
      else{
      ?>
      <h4 align="center" class="color--text" ><font color="orange"><?php if(sizeof($rows)==20){ echo "<em>Displaying only 20 results, narrow results by entering full name.</em>"; } ?></font></4>
       <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Salary</th>
          </tr>
        </thead>
        <tbody>
         <?php foreach ($rows as $v){ ?>
          <tr>
            <td><a href="employee.php?dbid=<?php echo $v['id']?>" ><?php echo ucfirst(strtolower($v['name_first']))." ".ucfirst(strtolower($v['name_last'])); ?></a></td>
            <td><a href="titles.php?title=<?php echo $v['title'];?>" ><?php echo $v['title']; ?></a></td>
            <td><?php echo "$".number_format($v['salary'], 0,'.', ',')?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
      <?php
         }
      }
   ?>
    </main>
    <?php include("includes/footer.php");?>
  </body>
</html>
