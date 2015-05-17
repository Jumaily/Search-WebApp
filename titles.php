<?php
define('PATH',"./");
require_once(PATH."phpinc/constant.php");
require_once(PATH."phpinc/main.class.php"); $main = new main();
$rows = $main->lookupbytitle();
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
                     <div class="input_contentac">
                        <input id="search_keyword_id" onkeyup='autocomplet("title")' autocomplete="off" placeholder="Job Title" name="title" size="50" value="<?php echo $main->title; ?>" />
                        <ul id="search_keyword"></ul>
                        <input type="submit" value="Search Title">
                     </div>
         			</td>
               </tr>
   			</tbody>
			</table>
      </form>
      <?php
      if(isset($_GET['title']) && $_GET['title']!=''){
         if(sizeof($rows) <1 ){ ?> <h4>Can Not Find Results</h4> <?php }
         else{
            ?>
            <h4 align="center" class="color--text">
               <h4 id="get-started" align="center">
               <?php
                  if(sizeof($rows)==1000){ echo "<em>Displaying only 1,000 results, type more of title to narrow results.</em>"; }
                  else{ echo sizeof($rows)." Total Results Found For Title: <strong>{$main->title}</strong>"; }
               ?>
               </h4>
            </4>
             <table>
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Title</th>
                  <th>Department</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tbody>
               <?php foreach ($rows as $v){ ?>
                <tr>
                  <td><a href="employee.php?dbid=<?php echo $v['id']?>" ><?php echo ucfirst(strtolower($v['name_first']))." ".ucfirst(strtolower($v['name_last'])); ?></a></td>
                  <td><?php echo $v['title']; ?></td>
                  <td><a href="department.php?dept=<?php echo $v['dept']?>" ><?php echo ucfirst(strtolower($v['dept'])); ?></a></td>
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